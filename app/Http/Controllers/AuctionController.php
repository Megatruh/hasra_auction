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
            'round_number' => $auction->current_round,
        ]);


        // 4. Pemicu WebSocket (Real-time update)
        // Ini yang akan mengirim data ke Laravel Reverb
        broadcast(new BidPlaced($bid))->toOthers();

        return back()->with('success', 'Berhasil melakukan penawaran!');
    }
    /**
     * Membuka sesi lelang (dari pending ke active)
     */
    public function startAuction(Auction $auction)
    {
        // Validasi agar hanya host yang bisa membuka lelang
        if (Auth::user()->role !== 'host') {
            abort(403, 'Akses tidak diizinkan.');
        }

        $auction->update([
            'status' => 'active',
            'start_time' => now(),
            'end_time' => now()->addMinute(),
            'current_round' => 1, // Catat waktu mulai
        ]);

        return back()->with('success', 'Sesi lelang berhasil dibuka!');
    }

    /**
     * Menutup sesi lelang (dari active ke closed)
     */
    public function closeAuction(Auction $auction)
    {
        if (Auth::user()->role !== 'host') {
            abort(403, 'Akses tidak diizinkan.');
        }

        $auction->update([
            'status' => 'closed',
            'end_time' => now(), // Catat waktu selesai
        ]);

        return back()->with('success', 'Sesi lelang berhasil ditutup. Pemenang telah ditentukan!');
    }
    /**
     * Menampilkan halaman kontrol / sesi lelang untuk host.
     */
    public function hostSession(Auction $auction)
    {
        $auction->load(['car', 'highestBid.user', 'bids.user']);
        $auction->loadCount('bids');

        return view('host.auctions.session', compact('auction'));
    }

    /**
     * Wasit Putaran: Mengevaluasi pemenang di ronde berjalan
     */
    public function evaluateRound(Auction $auction)
    {
        if ($auction->status !== 'active') return response()->json(['message' => 'Lelang tidak aktif'], 400);

        $hasBidsThisRound = Bid::query()
            ->where('auction_id', $auction->id)
            ->where('round_number', $auction->current_round)
            ->exists();

        if ($hasBidsThisRound) {
            // Jika ada bid di ronde ini, ronde berlanjut dan waktu diperpanjang 1 menit.
            $auction->update([
                'current_round' => $auction->current_round + 1,
                'end_time' => now()->addMinute(),
            ]);
            return response()->json(['status' => 'continue']);
        } else {
            // Jika tidak ada bid sama sekali di ronde ini, lelang ditutup.
            $auction->update([
                'status' => 'closed',
                'end_time' => now(),
            ]);
            return response()->json(['status' => 'closed']);
        }
    }
}