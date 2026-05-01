<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Lelang - {{ $auction->car->merk }} {{ $auction->car->model }}</title>

    <!-- Fonts (Old Money) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[var(--color-page)] text-gray-900 font-sans antialiased">
    <div class="min-h-screen py-12 px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="font-serif tracking-tight text-4xl text-gray-950">Panel Host</h1>
                    <p class="text-sm text-gray-600">Sesi Lelang: {{ $auction->car->merk }} {{ $auction->car->model }}</p>
                </div>
                <a href="{{ route('host.dashboard') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Kembali ke Dashboard</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-8 rounded-3xl border border-gray-200 flex flex-col md:flex-row gap-8">
                        <div class="w-full md:w-2/5 h-64 bg-gray-100 rounded-2xl overflow-hidden border border-gray-200">
                            <img src="{{ asset('storage/' . $auction->car->gambar1) }}" alt="Gambar Mobil" class="w-full h-full object-cover">
                        </div>
                        <div class="w-full md:w-3/5 flex flex-col justify-between">
                            <div>
                                <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold
                                    @if($auction->status === 'active') border-green-200 bg-green-50 text-green-700
                                    @elseif($auction->status === 'pending') border-yellow-200 bg-yellow-50 text-yellow-700
                                    @else border-gray-200 bg-gray-50 text-gray-700 @endif">
                                    {{ strtoupper($auction->status) }}
                                </span>
                                <h2 class="font-serif tracking-tight text-2xl text-gray-950 mt-3">{{ $auction->car->merk }} {{ $auction->car->model }} ({{ $auction->car->tahun }})</h2>
                                <p class="text-gray-500 text-sm mt-1">Harga Dasar: Rp {{ number_format($auction->car->harga_awal, 0, ',', '.') }}</p>
                            </div>

                            <div class="mt-6">
                                @if($auction->status === 'pending')
                                    <form action="{{ route('host.auction.start', $auction->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-150">
                                            Mulai Lelang (Buka Sesi 1 Menit)
                                        </button>
                                    </form>
                                @elseif($auction->status === 'active')
                                    <div class="mb-4 p-6 bg-indigo-50 border border-indigo-100 rounded-2xl text-center">
                                        <span class="text-xs text-indigo-700 font-semibold uppercase tracking-wider">Sisa Waktu</span>
                                        <div id="timer" class="mt-2 font-serif tracking-tight text-5xl text-indigo-950">00:00</div>
                                    </div>
                                    <form action="{{ route('host.auction.close', $auction->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-150">
                                            Tutup Lelang (Kunci Pemenang)
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-gray-50 border border-gray-200 p-4 rounded-2xl text-center text-gray-700 font-semibold">
                                        Lelang Telah Selesai
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-200">
                        <h3 class="font-serif tracking-tight text-2xl text-gray-950 mb-6">Statistik Penawaran</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Penawaran Tertinggi</p>
                                <p class="mt-2 font-serif tracking-tight text-4xl text-gray-950">
                                    Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="md:text-right">
                                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider">Total Penawaran</p>
                                <p class="mt-2 text-2xl font-semibold text-gray-950">{{ $auction->bids_count }} kali</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Pemenang Sementara:</p>
                            @if($auction->highestBid)
                                <div class="p-5 bg-gray-50 border border-gray-200 rounded-2xl flex justify-between items-center">
                                    <span class="font-semibold text-gray-950">{{ $auction->highestBid->user->name }}</span>
                                    <span class="text-xs text-gray-600 font-semibold">
                                        {{ $auction->highestBid->created_at->format('H:i:s') }}
                                    </span>
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum ada penawaran masuk.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-3xl border border-gray-200 flex flex-col">
                    <h3 class="font-serif tracking-tight text-2xl text-gray-950 mb-6">Daftar Bid Masuk</h3>
                    <div class="flex-1 overflow-y-auto max-h-[520px] divide-y divide-gray-100">
                        @forelse($auction->bids->sortByDesc('bid_amount') as $index => $bid)
                            <div class="py-5 flex justify-between items-center text-sm first:pt-0">
                                <div>
                                    <span class="text-xs font-semibold text-gray-400">#{{ $index + 1 }}</span>
                                    <span class="font-semibold text-gray-950 ml-2">{{ $bid->user->name }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="font-serif tracking-tight text-xl text-gray-950">Rp {{ number_format($bid->bid_amount, 0, ',', '.') }}</span>
                                    <p class="text-xxs text-gray-400">{{ $bid->created_at->format('H:i:s') }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-400 text-center py-6 italic">Belum ada bid yang masuk pada sesi ini.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($auction->status === 'active' && $auction->end_time)
        <script>
            // Ambil waktu akhir lelang (end_time)
            const endTime = new Date("{{ $auction->end_time->toIso8601String() }}").getTime();

            const timerFunction = setInterval(() => {
                const now = new Date().getTime();
                const distance = endTime - now;
                if (distance < 0) {
                    clearInterval(timerFunction);
                    document.getElementById("timer").innerHTML = "Merekap...";
                    
                    // Otomatis suruh server evaluasi ronde
                    fetch("{{ route('host.auction.evaluate', $auction->id) }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                            "Accept": "application/json"
                        }
                    }).then(() => {
                        window.location.reload(); // Reload untuk melihat apakah masuk ronde baru atau selesai
                    });
                    return;
                }

                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                document.getElementById("timer").innerHTML =
                    (minutes < 10 ? "0" : "") + minutes + ":" +
                    (seconds < 10 ? "0" : "") + seconds;
            }, 1000);
        </script>
    @endif
</body>
</html>