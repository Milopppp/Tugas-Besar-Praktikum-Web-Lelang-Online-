<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'harga_penawaran' => 'required|numeric',
        ]);

        // Cari data lelang
        $auction = Auction::with('item')->findOrFail($id);

        // Cek status lelang masih dibuka atau tidak
        if ($auction->status !== 'dibuka') {
            return back()->with('error', 'Maaf, lelang sudah ditutup.');
        }

        // Ambil tawaran tertinggi saat ini
        $maxBid = Bid::where('auction_id', $id)->max('penawaran_harga');
        $hargaMinimal = $maxBid ?: $auction->item->harga_awal;

        // Validasi harga harus lebih tinggi
        if ($request->harga_penawaran <= $hargaMinimal) {
            return back()->with('error', 'Tawaran harus lebih tinggi dari Rp ' . number_format($hargaMinimal, 0, ',', '.'));
        }

        // Simpan data bid
        Bid::create([
            'auction_id' => $id,
            'user_id' => Auth::id(),
            'penawaran_harga' => $request->harga_penawaran,
            'tgl_penawaran' => now(), 
        ]);

        // Update harga_akhir di tabel auctions
        $auction->update(['harga_akhir' => $request->harga_penawaran]);

        return back()->with('success', 'Penawaran berhasil dikirim!');
    }

    // TAMBAHKAN METHOD INI ← PENTING!
    public function history()
    {
        // Ambil semua bid milik user yang login, beserta data auction dan item
        $myBids = Bid::with(['auction.item', 'auction.bids'])
            ->where('user_id', Auth::id())
            ->latest()
            ->get()
            ->groupBy('auction_id'); // Group by auction agar tidak duplikat

        return view('user.history-bid', compact('myBids'));
    }

    public function winners()
    {
        // Ambil semua lelang yang sudah ditutup
        $closedAuctions = Auction::with(['item', 'bids.user'])
            ->where('status', 'ditutup')
            ->latest()
            ->get();

        // Untuk setiap lelang, tentukan pemenangnya (bid tertinggi)
        $winners = $closedAuctions->map(function($auction) {
            $winningBid = $auction->bids()->orderBy('penawaran_harga', 'desc')->first();
            
            return [
                'auction' => $auction,
                'winning_bid' => $winningBid,
                'winner' => $winningBid ? $winningBid->user : null,
            ];
        });

        return view('user.winners', compact('winners'));
    }
}