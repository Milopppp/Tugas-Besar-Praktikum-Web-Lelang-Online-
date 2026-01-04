<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Auction;
use App\Models\Item;
use App\Models\Bid; // Tambahkan ini
use Barryvdh\DomPDF\Facade\Pdf;

class AuctionController extends Controller
{
   public function index(Request $request)
    {
        // Memulai query dengan relasi item
        $query = \App\Models\Auction::with('item');

        // LOGIKA SORTING
        if ($request->sort == 'nama_az') {
            // Karena nama barang ada di tabel 'items', kita perlu join
            $query->join('items', 'auctions.item_id', '=', 'items.id')
                ->select('auctions.*')
                ->orderBy('items.nama', 'asc');
        } 
        elseif ($request->sort == 'nama_za') {
            $query->join('items', 'auctions.item_id', '=', 'items.id')
                ->select('auctions.*')
                ->orderBy('items.nama', 'desc');
        } 
        elseif ($request->sort == 'waktu_lama') {
            $query->orderBy('created_at', 'asc');
        } 
        else {
            // Default: Terbaru
            $query->orderBy('created_at', 'desc');
        }

        $auctions = $query->get();

        return view('admin.auctions.index', compact('auctions'));
    }

    public function create()
    {
        $items = Item::all();
        return view('admin.auctions.create', compact('items'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:items,id',
            'tgl_lelang' => 'required|date',
            'tgl_akhir' => 'required|date|after:tgl_lelang',
            'status' => 'required|in:dibuka,ditutup',
        ]);

        Auction::create([
            'item_id' => $request->item_id,
            'tgl_lelang' => $request->tgl_lelang,
            'tgl_akhir' => $request->tgl_akhir,
            'petugas_id' => auth()->id(),
            'status' => $request->status,
        ]);

        return redirect()->route('admin.auctions.index')->with('success', 'Sesi lelang berhasil diaktifkan!');
    }

    public function show(string $id)
    {
        $auction = Auction::with(['item', 'bids' => function($query) {
            $query->orderBy('penawaran_harga', 'desc')->limit(10);
        }, 'bids.user'])->findOrFail($id);

        return view('admin.auctions.show', compact('auction'));
    }

    public function edit(string $id)
    {
        $auction = Auction::with('item')->findOrFail($id);
        return view('admin.auctions.edit', compact('auction'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_akhir' => 'required|date',
            'status' => 'required|in:dibuka,ditutup',
        ]);

        $auction = Auction::findOrFail($id);
        
        $data = [
            'tgl_akhir' => $request->tgl_akhir,
            'status' => $request->status,
        ];

        // LOGIKA KRUSIAL: Menentukan Pemenang saat Admin klik 'Ditutup'
        if ($request->status == 'ditutup') {
            // Cari bid tertinggi untuk lelang ini
            $topBid = $auction->bids()->orderBy('penawaran_harga', 'desc')->first();
            
            if ($topBid) {
                $data['harga_akhir'] = $topBid->penawaran_harga;
                $data['user_id'] = $topBid->user_id; // Simpan ID Pemenang ke tabel auctions
            }
        } else {
            // Jika lelang dibuka kembali, hapus data pemenang
            $data['user_id'] = null;
            $data['harga_akhir'] = null;
        }

        $auction->update($data);

        return redirect()->route('admin.auctions.index')->with('success', 'Data lelang diperbarui & pemenang telah ditentukan!');
    }

    public function destroy(string $id)
    {
        $auction = Auction::findOrFail($id);
        $auction->delete();
        return redirect()->route('admin.auctions.index')->with('success', 'Sesi lelang berhasil dihapus.');
    }

    public function generatePDF($id)
    {
        // Load relasi 'user' (sebagai pemenang) dan 'bids.user' (sebagai riwayat)
        $auction = Auction::with(['item', 'user', 'bids.user'])->findOrFail($id);
        
        $data = [
            'title' => 'Laporan Hasil Lelang',
            'auction' => $auction,
            'date' => now()->format('d/m/Y')
        ];
        
        $pdf = Pdf::loadView('admin.auctions.report_pdf', $data);
        return $pdf->download('laporan-lelang-' . $auction->item->nama . '.pdf');
    }
}