<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller; // Wajib tambah ini
use Illuminate\Http\Request;
use App\Models\Auction; // Tambahkan agar tidak error Class Not Found
use App\Models\Item;    // Tambahkan agar tidak error Class Not Found

class AuctionController extends Controller
{
    public function index()
    {
        // Mengambil data lelang beserta relasi barangnya
        $auctions = \App\Models\Auction::with('item')->get();
        return view('admin.auctions.index', compact('auctions'));
    }

    public function create()
    {
        // Ambil barang yang belum dilelang (opsional) atau semua barang
        $items = \App\Models\Item::all();
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

        \App\Models\Auction::create([
            'item_id' => $request->item_id,
            'tgl_lelang' => $request->tgl_lelang,
            'tgl_akhir' => $request->tgl_akhir,
            'petugas_id' => auth()->id(), // Mengambil ID Admin yang login
            'status' => $request->status,
        ]);

        return redirect()->route('admin.auctions.index')->with('success', 'Sesi lelang berhasil diaktifkan!');
    }

    public function show(string $id)
    {
        // Mengambil data lelang, barang terkait, dan 10 penawar tertinggi
        $auction = \App\Models\Auction::with(['item', 'bids' => function($query) {
            $query->orderBy('penawaran_harga', 'desc')->limit(10);
        }, 'bids.user'])->findOrFail($id);

        return view('admin.auctions.show', compact('auction'));
    }

    public function edit(string $id)
    {
        $auction = \App\Models\Auction::with('item')->findOrFail($id);
        return view('admin.auctions.edit', compact('auction'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'tgl_akhir' => 'required|date',
            'status' => 'required|in:dibuka,ditutup',
        ]);

        $auction = \App\Models\Auction::findOrFail($id);
        
        $data = [
            'tgl_akhir' => $request->tgl_akhir,
            'status' => $request->status,
        ];

        // Logika Otomatis: Jika status diubah ke ditutup, cari pemenang tertinggi
        if ($request->status == 'ditutup') {
            $topBid = $auction->bids()->orderBy('penawaran_harga', 'desc')->first();
            if ($topBid) {
                $data['harga_akhir'] = $topBid->penawaran_harga;
                $data['user_id'] = $topBid->user_id;
            }
        } else {
            // Jika dibuka kembali, kosongkan pemenang
            $data['user_id'] = null;
        }

        $auction->update($data);

        return redirect()->route('admin.auctions.index')->with('success', 'Data lelang berhasil diperbarui.');
    }

    public function destroy(string $id)
    {
        $auction = \App\Models\Auction::findOrFail($id);
        $auction->delete();

        return redirect()->route('admin.auctions.index')->with('success', 'Sesi lelang berhasil dihapus.');
    }
}
