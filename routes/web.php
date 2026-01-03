<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ItemController; 
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LandingController::class, 'index'])->name('user.index');

Route::middleware('auth')->group(function () {

    // =====================
    // USER DETAIL
    // =====================
    Route::get('/user/detail/{id}', [LandingController::class, 'show'])
        ->name('user.show');

    // =====================
    // BID LELANG (WAJIB ADA) ← INI YANG PENTING!
    // =====================
    Route::post('/lelang/{id}/bid', [BidController::class, 'store'])
        ->name('user.bid.store');

    // =====================
    // PROFILE
    // =====================
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // =====================
    // ADMIN AREA
    // =====================
    Route::middleware(['admin'])->group(function () {

        Route::get('/admin/dashboard', function () {
            $totalBarang = \App\Models\Item::count();
            $lelangAktif = \App\Models\Auction::where('status', 'dibuka')->count();
            return view('admin.index', compact('totalBarang', 'lelangAktif')); 
        })->name('admin.dashboard');

        Route::resource('/admin/items', ItemController::class)->names('admin.items');
        Route::resource('/admin/auctions', AuctionController::class)->names('admin.auctions');

        Route::post('/admin/auctions/{id}/open', [AuctionController::class, 'open'])
            ->name('admin.auctions.open');

        Route::post('/admin/auctions/{id}/close', [AuctionController::class, 'close'])
            ->name('admin.auctions.close');

        Route::get('/admin/users', [UserController::class, 'index'])
            ->name('admin.users.index');

        Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])
            ->name('admin.users.destroy');
    });
});

require __DIR__.'/auth.php';