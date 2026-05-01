<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $auction->car->merk }} {{ $auction->car->model }} - Detail Lelang</title>

    <!-- Fonts (Old Money) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-page)] text-gray-900 font-sans">
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-green-50 border border-green-200 rounded-2xl p-4 flex items-start gap-3">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-green-900">Berhasil!</h3>
                    <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-green-500 hover:text-green-700">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-red-50 border border-red-200 rounded-2xl p-4 flex items-start gap-3">
                <div class="shrink-0">
                    <svg class="h-5 w-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-sm font-medium text-red-900">Gagal!</h3>
                    <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="this.parentElement.parentElement.remove()" class="text-red-500 hover:text-red-700">
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <!-- Main Container -->
    <div class="min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="/" class="inline-flex items-center gap-2 text-gray-700 hover:text-gray-950 font-medium transition">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            </div>

            <!-- Main Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Image & Description Section (Left/Top) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Single Hero Image -->
                    <div class="relative w-full h-112 rounded-2xl overflow-hidden border border-gray-200 bg-gray-100">
                        @if($auction->car?->gambar1)
                            <img 
                                src="{{ url('storage/cars/' . $auction->car->gambar1) }}" 
                                alt="{{ $auction->car->merk }} {{ $auction->car->model }}"
                                class="w-full h-full object-cover"
                                loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');"
                            >
                            <div class="hidden w-full h-full flex items-center justify-center text-gray-400">
                                <span>Gambar tidak tersedia</span>
                            </div>
                        @else
                            <div class="w-full h-full flex items-center justify-center text-gray-400">
                                <span>Gambar tidak tersedia</span>
                            </div>
                        @endif
                    </div>

                    <!-- Car Info -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h1 class="font-serif tracking-tight text-4xl md:text-5xl text-gray-950 mb-2">
                                    {{ $auction->car->merk }} {{ $auction->car->model }}
                                </h1>
                                <p class="text-base text-gray-600">
                                    Tahun: <span class="font-semibold text-gray-950">{{ $auction->car->tahun }}</span>
                                </p>
                            </div>

                            <!-- Grade Badge -->
                            @php
                                $gradeBadgeClass = match($auction->car->grade) {
                                    'A' => 'bg-green-50 text-green-700 border-green-200',
                                    'B' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                    default => 'bg-orange-50 text-orange-700 border-orange-200',
                                };
                            @endphp
                            <div class="border {{ $gradeBadgeClass }} rounded-full px-4 py-2 font-semibold text-sm">
                                <span class="font-serif">Grade</span>: {{ $auction->car->grade }}
                            </div>
                        </div>

                        <!-- Additional Car Details -->
                        <div class="mt-8 grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="rounded-xl border border-gray-200 bg-white p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Odometer</p>
                                <p class="mt-2 text-sm font-semibold text-gray-950">{{ number_format($auction->car->odometer, 0, ',', '.') }} km</p>
                            </div>
                            <div class="rounded-xl border border-gray-200 bg-white p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Mesin</p>
                                <p class="mt-2 text-sm font-semibold text-gray-950">{{ $auction->car->mesin ?? '-' }}</p>
                            </div>
                            <div class="rounded-xl border border-gray-200 bg-white p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Warna</p>
                                <p class="mt-2 text-sm font-semibold text-gray-950">{{ $auction->car->warna ?? '-' }}</p>
                            </div>
                            <div class="rounded-xl border border-gray-200 bg-white p-4">
                                <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Harga Awal</p>
                                <p class="mt-2 text-sm font-semibold text-gray-950">Rp {{ number_format($auction->car->harga_awal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="bg-white border border-gray-200 rounded-2xl p-8">
                        <h2 class="font-serif tracking-tight text-2xl text-gray-950 mb-4">Deskripsi</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                            {{ $auction->car->deskripsi }}
                        </p>
                    </div>
                </div>

                <!-- Bidding Section (Right/Sidebar) -->
                <div>
                    <div class="bg-white border border-gray-200 rounded-2xl p-8 sticky top-8 space-y-8">
                        <!-- Status Badge -->
                        @php
                            $statusClass = match($auction->status) {
                                'active' => 'bg-green-50 text-green-700 border-green-200',
                                'pending' => 'bg-yellow-50 text-yellow-700 border-yellow-200',
                                'closed' => 'bg-gray-50 text-gray-700 border-gray-200',
                                default => 'bg-gray-50 text-gray-700 border-gray-200',
                            };
                            $statusLabel = match($auction->status) {
                                'active' => 'Lelang Aktif',
                                'pending' => 'Menunggu',
                                'closed' => 'Lelang Selesai',
                                default => 'Status Tidak Diketahui',
                            };
                        @endphp
                        <div class="border {{ $statusClass }} rounded-full px-4 py-2 text-sm font-semibold text-center">
                            {{ $statusLabel }}
                        </div>

                        <!-- Current Price -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6">
                            <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Harga Saat Ini</p>
                            <span id="current-bid" class="block mt-2 font-serif tracking-tight text-4xl text-gray-950">
                                Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal, 0, ',', '.') }}
                            </span>

                            <p class="text-xs text-gray-600 mt-4">
                                Penawaran tertinggi oleh:
                                <span id="highest-bidder" class="text-gray-900 font-bold">
                                    {{ $auction->highestBid ? $auction->highestBid->user->name : 'Belum ada penawar' }}
                                </span>
                            </p>

                            @if(!$auction->highestBid)
                                <p class="text-xs text-gray-500 mt-1">Harga pembukaan</p>
                            @endif
                        </div>
@auth
    @if(auth()->user()->role === 'host')
        <div class="bg-white border border-gray-200 rounded-2xl p-6 mt-6">
            <h3 class="font-serif tracking-tight text-xl text-gray-950 mb-4">Panel Host</h3>

            @if($auction->status === 'pending')
                <form action="{{ route('host.auction.start', $auction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-150 text-center">
                        Mulai Lelang
                    </button>
                </form>
            @elseif($auction->status === 'active')
                <div class="mb-4 p-4 bg-indigo-50 border border-indigo-100 rounded-2xl text-center">
                    <span class="text-xs text-indigo-700 font-semibold uppercase tracking-wider">Sisa Waktu</span>
                    <div id="timer" class="mt-2 font-serif tracking-tight text-3xl text-indigo-950">00:00</div>
                </div>

                <form action="{{ route('host.auction.close', $auction->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-4 rounded-xl transition duration-150 text-center">
                        Tutup Lelang
                    </button>
                </form>
            @else
                <div class="bg-gray-50 border border-gray-200 text-gray-700 font-semibold py-3 px-4 rounded-2xl text-center">
                    Lelang Selesai
                </div>
            @endif
        </div>

        @if($auction->status === 'active' && $auction->end_time)
            <script>
                const endTime = new Date("{{ $auction->end_time->toIso8601String() }}").getTime();
                
                const timerFunction = setInterval(() => {
                    const now = new Date().getTime();
                    const distance = endTime - now;

                    if (distance < 0) {
                        clearInterval(timerFunction);
                        const timerEl = document.getElementById("timer");
                        if (timerEl) timerEl.innerHTML = "Merekap...";

                        // Host memicu evaluasi ronde via AJAX
                        fetch("{{ route('host.auction.evaluate', $auction->id) }}", {
                            method: "POST",
                            headers: {
                                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                "Accept": "application/json"
                            }
                        }).then(() => {
                            window.location.reload();
                        });
                        return;
                    }

                    // Update tampilan countdown host
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    const timerEl = document.getElementById("timer");
                    if (timerEl) {
                        timerEl.innerHTML = (minutes < 10 ? "0" : "") + minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
                    }
                }, 1000);
            </script>
        @endif
    @endif
@endauth
                        <!-- Bidding Form -->
                        @if($auction->status === 'active')
                            <form action="{{ route('player.auction.bid', $auction->id) }}" method="POST" class="space-y-4">
                                @csrf

                                <!-- Bid Amount Input -->
                                <div>
                                    <label for="bid_amount" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Jumlah Penawaran (Rp)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-4 text-gray-500 font-semibold">Rp</span>
                                        <input 
                                            type="number" 
                                            id="bid_amount" 
                                            name="bid_amount" 
                                            placeholder="Contoh: 500000000"
                                            min="{{ ($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal) + 1 }}"
                                            step="1"
                                            class="w-full pl-12 pr-4 py-4 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-600 focus:border-indigo-600 transition @error('bid_amount') border-red-500 @enderror"
                                            required
                                        />
                                    </div>
                                    @error('bid_amount')
                                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                    <p class="text-xs text-gray-500 mt-2">
                                        Minimal: Rp {{ number_format(
                                            ($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal) + 1,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </p>
                                </div>
                                {{-- <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded-r-md">
                                        <div class="flex">
                                            <div class="shrink-0">
                                                <svg class="h-5 w-5 text-yellow-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                                </svg>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm text-yellow-700">
                                                    Sesi lelang aktif! Waktu tersisa: 
                                                    <span id="countdown" class="font-bold text-red-600 text-base">30</span> detik.
                                                </p>
                                            </div>
                                        </div>
                                    </div>                                 --}}

                                <!-- Submit Button -->
                                <button 
                                    type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-4 px-6 rounded-xl transition duration-200 flex items-center justify-center gap-2"
                                >
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    Tawar Sekarang
                                </button>
                            </form>

                            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-5">
                                <p class="text-xs text-gray-700">
                                    <svg class="h-4 w-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 100 2H9V4z" clip-rule="evenodd" />
                                    </svg>
                                    Semakin tinggi penawaran Anda, semakin besar peluang memenangkan lelang ini.
                                </p>
                            </div>
                        @else
                            <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6 text-center">
                                <p class="font-serif tracking-tight text-xl text-gray-950">Lelang Tidak Aktif</p>
                                <p class="text-xs text-gray-600 mt-2">Anda tidak dapat melakukan penawaran pada saat ini.</p>
                            </div>
                        @endif

                        <!-- Quick Stats -->
                        <div class="border-t border-gray-200 pt-6 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Total Penawaran:</span>
                                <span id="bids-count" class="font-bold text-gray-900">{{ $auction->bids_count ?? 0 }}</span>
                            </div>
                            @if($auction->created_at)
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-gray-600">Dimulai:</span>
                                    <span class="font-semibold text-gray-900">{{ $auction->created_at->format('d M Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if($auction->status === 'active' && $auction->end_time)
        @auth
            @if(auth()->user()->role === 'player')
                <div class="mt-10 bg-white border border-gray-200 rounded-2xl p-6 text-center">
                    <span class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Sisa Waktu</span>
                    <div id="player-timer" class="mt-2 font-serif tracking-tight text-4xl text-gray-950">00:00</div>
                </div> 
            @endif
        @endauth
 
        
        <script>
            const endTimePlayer = new Date("{{ $auction->end_time->toIso8601String() }}").getTime();
            const playerTimerEl = document.getElementById("player-timer");
            if (!playerTimerEl) {
                // Jika elemen timer player tidak ada (mis. bukan role player), tidak perlu menjalankan countdown ini.
            } else {
            const countdown = setInterval(() => {
                const now = new Date().getTime();
                const distance = endTimePlayer - now;

                if (distance < 0) {
                    clearInterval(countdown);
                    playerTimerEl.innerHTML = "Merekap Putaran...";

                    // Beri waktu host mengeksekusi evaluasi ronde, lalu reload.
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                    return;
                } else {
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    playerTimerEl.innerHTML = 
                        (minutes < 10 ? "0" : "") + minutes + ":" + 
                        (seconds < 10 ? "0" : "") + seconds;
                }
            }, 1000);
            }
        </script>
    @endif
{{--     
    <script type="module">
        document.addEventListener("DOMContentLoaded", function () {
            let timeLeft = 30;
            const countdownElement = document.getElementById("countdown");

            if (countdownElement) {
                const timer = setInterval(function () {
                    timeLeft--;
                    countdownElement.innerText = timeLeft;

                    if (timeLeft <= 0) {
                        clearInterval(timer);
                        
                        // Pastikan hanya reload jika lelang aktif
                        @if($auction->status === 'active')
                            window.location.reload();
                        @endif
                    }
                }, 1000);
            }
        });
        // Di dalam blok script show.blade.php
        if (timeLeft <= 0) {
            clearInterval(timer);
            if (countdownElement) {
                countdownElement.innerText = "0";
            }
            
            // Pastikan hanya reload jika status lelang aktif
            @if($auction->status === 'active')
                window.location.reload();
            @endif
        }
        console.log("Menghubungkan ke channel: auction.{{ $auction->id }}");

        window.Echo.channel('auction.{{ $auction->id }}')
            .listen('.bid.updated', (e) => {
                console.log('Event bid.updated diterima:', e);

                // 1. Update Harga Tertinggi
                const priceElement = document.getElementById('current-bid');
                if (priceElement) {
                    priceElement.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(e.bid.bid_amount);
                }

                // 2. Update Nama Penawar
                const bidderElement = document.getElementById('highest-bidder');
                if (bidderElement) {
                    bidderElement.innerText = e?.bid?.user?.name ?? 'Belum ada penawar';
                }

                // 3. Update Jumlah Penawaran
                const countElement = document.getElementById('bids-count');
                if (countElement) {
                    const currentCount = parseInt(countElement.innerText) || 0;
                    countElement.innerText = currentCount + 1;
                }
            });
    </script> --}}
</body>
</html>
