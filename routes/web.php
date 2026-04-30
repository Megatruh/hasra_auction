<?php

use App\Http\Controllers\AuctionController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

// Auction detail page (public or accessible)
Route::get('/auctions/{auction}', [AuctionController::class, 'show'])->name('auctions.show');

// Route user yang login
Route::middleware('auth')->group(function(){
    //route player 
    Route::middleware(['player'])->group(function(){
        Route::get('/dashboard', [AuctionController::class, 'playerDashboard'])->name('player.dashboard');
        Route::post('/auctions/{auction}/bid', [AuctionController::class, 'placeBid'])->name('auctions.placeBid');
    });
    Route::middleware(['host'])->group(function(){
        Route::get('/host/dashboard', [AuctionController::class, 'hostDashboard'])->name('host.dashboard');
        Route::get('/host/auctions/create', [AuctionController::class, 'create'])->name('host.auctions.create');
    });
});
