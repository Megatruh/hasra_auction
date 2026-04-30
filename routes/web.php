<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// 1. Mengubah rute '/' agar tidak ke halaman welcome, tapi mengarah ke halaman login.
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    
    // 2. Mengarahkan ke dashboard sesuai role masing-masing setelah login.
    Route::get('/dashboard', function () {
        if (Auth::user()->role === 'host') {
            return redirect()->route('host.dashboard');
        } elseif (Auth::user()->role === 'player') {
            return redirect()->route('player.dashboard');
        }
        return view('dashboard'); // Default untuk user biasa
    })->name('dashboard');

    Route::get('/auctions/{auction}', [
        AuctionController::class, 
        'show'
    ])->name('auctions.show');

    Route::get('/profile', [
        ProfileController::class, 
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class, 
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class, 
        'destroy'
    ])->name('profile.destroy');

    // Rute Player
    Route::middleware(['player'])->prefix('player')->name('player.')->group(function () {
        Route::get('dashboard', [
            AuctionController::class, 
            'playerDashboard'
        ])->name('dashboard');

        Route::post('/auctions/{auction}/bid', [
            AuctionController::class, 
            'placeBid'
        ])->name('auction.bid');
    });

    // Rute Host
    Route::middleware(['host'])->prefix('host')->name('host.')->group(function () {
        Route::get('/dashboard', [
            AuctionController::class, 
            'hostDashboard'
        ])->name('dashboard');

        Route::get('/auctions/create', [
            AuctionController::class, 
            'create'
        ])->name('auction.create');

        Route::post('/auctions', [
            AuctionController::class, 
            'store'
        ])->name('auction.store');
    });
});

require __DIR__.'/auth.php';