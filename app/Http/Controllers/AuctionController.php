<?php
namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\Bid;
use App\Events\BidPlaced;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuctionController extends Controller
{
    /**
     * Dashboard untuk player
     */
    public function playerDashboard()
    {
        $auctions = Auction::query()
            ->with(['car', 'highestBid.user'])
            ->withCount('bids')
            ->latest()
            ->get();

        return view('player.dashboard', compact('auctions'));
    }

    /**
     * Dashboard untuk host
     */
    public function hostDashboard()
    {
        $auctions = Auction::query()
            ->with(['car', 'highestBid.user'])
            ->withCount('bids')
            ->latest()
            ->get();

        return view('host.dashboard', compact('auctions'));
    }

    /**
     * Form create auction (host)
     */
    public function create()
    {
        return view('host.auctions.create');
    }

    /**
     * Menampilkan detail mobil lelang
     */
    public function show(Auction $auction)
    {
        // Load relasi car, bid tertinggi, dan hitung jumlah bid
        $auction->load(['car', 'highestBid.user'])->loadCount('bids');
        
        return view('auctions.show', compact('auction'));
    }

    /**
     * Logika menempatkan penawaran (Bid)
     */
    public function placeBid(Request $request, Auction $auction)
    {

        // Validasi Sesi: pastikan lelang sedang active
        if ($auction->status !== 'active') {
            return back()->with('error', 'Sesi lelang belum dibuka atau sudah ditutup.');
        }
                
        // 1. Validasi nominal harus ada
        $request->validate([
            'bid_amount' => 'required|numeric|min:1',
        ]);

        $newBidAmount = $request->bid_amount;
        $currentHighestBid = $auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal;

        // 2. Validasi: Bid baru harus lebih tinggi dari harga sekarang
        // Misal kita tetapkan minimal naik Rp 500.000
        if ($newBidAmount <= $currentHighestBid) {
            return back()->with('error', 'Penawaran harus lebih tinggi dari harga saat ini!');
        }

        // Validasi : Jangan biarkan user yang sama ngebid dua kali berturut-turut
        if ($auction->highestBid && $auction->highestBid->user_id === Auth::id()) {
            return back()->with('error', 'Kamu masih menjadi penawar tertinggi!');
        }

        // 3. Simpan penawaran ke database
        $bid = Bid::create([
            'auction_id' => $auction->id,
            'user_id' => Auth::id(),
            'bid_amount' => $newBidAmount,
        ]);


        // 4. Pemicu WebSocket (Real-time update)
        // Ini yang akan mengirim data ke Laravel Reverb
        broadcast(new BidPlaced($bid))->toOthers();

        return back()->with('success', 'Berhasil melakukan penawaran!');
    }
}