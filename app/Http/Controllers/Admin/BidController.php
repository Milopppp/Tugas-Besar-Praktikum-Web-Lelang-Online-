<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Auction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, $auctionId)
    {
        $request->validate([
            'harga_penawaran' => 'required|numeric',
        ]);

        $auction = Auction::with('item')->findOrFail($auctionId);

        // REVISI: Pastikan lelang masih dibuka
        if ($auction->status !== 'dibuka') {
            return back()->with('error', 'Maaf, lelang sudah ditutup.');
        }

        $maxBid = Bid::where('auction_id', $auctionId)->max('penawaran_harga');
        $hargaMinimal = $maxBid ?: $auction->item->harga_awal;

        if ($request->harga_penawaran <= $hargaMinimal) {
            return back()->with('error', 'Tawaran harus lebih tinggi dari Rp ' . number_format($hargaMinimal, 0, ',', '.'));
        }

        Bid::create([
            'auction_id' => $auctionId,
            'user_id' => Auth::id(),
            'penawaran_harga' => $request->harga_penawaran,
            'tgl_penawaran' => now(), 
        ]);

        // REVISI: Update harga tertinggi di tabel auctions
        $auction->update(['harga_akhir' => $request->harga_penawaran]);

        return back()->with('success', 'Penawaran Anda berhasil dikirim!');
    }
}