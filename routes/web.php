<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ItemController; 
use App\Http\Controllers\Admin\AuctionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| RUTE PUBLIK: Langsung ke Login
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('auth.login');
});

/*
|--------------------------------------------------------------------------
| RUTE TERPROTEKSI (Harus Login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    
    // 1. HALAMAN UTAMA USER (Katalog Baru Muncul Setelah Login)
    Route::get('/katalog', [LandingController::class, 'index'])->name('user.index');
    Route::get('/user/detail/{id}', [LandingController::class, 'show'])->name('user.show');

    // 2. RUTE PROFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 3. --- GROUP KHUSUS ADMIN ---
    Route::middleware(['admin'])->group(function () {
        
        // Dashboard Admin
        Route::get('/admin/dashboard', function () {
            $totalBarang = \App\Models\Item::count();
            $lelangAktif = \App\Models\Auction::where('status', 'dibuka')->count();
            return view('admin.index', compact('totalBarang', 'lelangAktif')); 
        })->name('admin.dashboard');

        // Route Manajemen Items
        Route::resource('/admin/items', ItemController::class)->names([
            'index' => 'admin.items.index',
            'create' => 'admin.items.create',
            'store' => 'admin.items.store',
            'show' => 'admin.items.show',
            'edit' => 'admin.items.edit',
            'update' => 'admin.items.update',
            'destroy' => 'admin.items.destroy',
        ]);

        // Route Manajemen Auctions
        Route::post('/admin/auctions/{id}/open', [AuctionController::class, 'open'])->name('admin.auctions.open');
        Route::post('/admin/auctions/{id}/close', [AuctionController::class, 'close'])->name('admin.auctions.close');
        Route::resource('/admin/auctions', AuctionController::class)->names([
            'index' => 'admin.auctions.index',
            'create' => 'admin.auctions.create',
            'store' => 'admin.auctions.store',
            'show' => 'admin.auctions.show',
            'edit' => 'admin.auctions.edit',
            'update' => 'admin.auctions.update',
            'destroy' => 'admin.auctions.destroy',
        ]);

        // Route Manajemen Users
        Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    });
});

require __DIR__.'/auth.php';