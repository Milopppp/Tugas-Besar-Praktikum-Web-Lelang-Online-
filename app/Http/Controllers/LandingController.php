<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index()
    {
        // Jika belum login, dilempar ke login (karena '/' di web.php mengarah ke login)
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        // Jika yang masuk adalah ADMIN, paksa ke dashboard admin
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Jika yang masuk adalah USER
        $auctions = \App\Models\Auction::where('status', 'dibuka')->with('item')->get();
        return view('user.index', compact('auctions'));
    }
    public function show($id)
    {
        $auction = Auction::with(['item', 'bids.user'])->findOrFail($id);
        return view('user.show', compact('auction'));
    }
}