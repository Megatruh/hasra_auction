<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Lelang - {{ $auction->car->merk }} {{ $auction->car->model }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50 font-sans antialiased">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Panel Kontrol Host</h1>
                    <p class="text-sm text-gray-600">Sesi Lelang: {{ $auction->car->merk }} {{ $auction->car->model }}</p>
                </div>
                <a href="{{ route('host.dashboard') }}" class="text-indigo-600 hover:text-indigo-900 font-medium">Kembali ke Dashboard</a>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col md:flex-row gap-6">
                        <div class="w-full md:w-2/5 h-64 bg-gray-100 rounded-xl overflow-hidden shadow-inner">
                            <img src="{{ asset('storage/' . $auction->car->gambar1) }}" alt="Gambar Mobil" class="w-full h-full object-cover">
                        </div>
                        <div class="w-full md:w-3/5 flex flex-col justify-between">
                            <div>
                                <span class="px-3 py-1 text-xs font-semibold rounded-full 
                                    @if($auction->status === 'active') bg-green-100 text-green-800 
                                    @elseif($auction->status === 'pending') bg-yellow-100 text-yellow-800 
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ strtoupper($auction->status) }}
                                </span>
                                <h2 class="text-xl font-bold text-gray-900 mt-2">{{ $auction->car->merk }} {{ $auction->car->model }} ({{ $auction->car->tahun }})</h2>
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
                                    <div class="mb-4 p-4 bg-indigo-50 border border-indigo-100 rounded-xl text-center">
                                        <span class="text-xs text-indigo-600 font-bold uppercase tracking-wider">Sisa Waktu Lelang</span>
                                        <div id="timer" class="text-3xl font-black text-indigo-900 mt-1">00:00</div>
                                    </div>
                                    <form action="{{ route('host.auction.close', $auction->id) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 px-6 rounded-xl transition duration-150">
                                            Tutup Lelang (Kunci Pemenang)
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-gray-100 p-4 rounded-xl text-center text-gray-600 font-semibold">
                                        Lelang Telah Selesai
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Statistik Penawaran (Bid) Saat Ini</h3>
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl mb-4">
                            <div>
                                <p class="text-xs text-gray-500 font-semibold uppercase">Penawaran Tertinggi</p>
                                <p class="text-2xl font-black text-indigo-600 mt-1">
                                    Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 font-semibold uppercase">Total Penawaran</p>
                                <p class="text-xl font-bold text-gray-900 mt-1">{{ $auction->bids_count }} kali</p>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-600 font-semibold mb-2">Pemenang Sementara:</p>
                            @if($auction->highestBid)
                                <div class="p-3 bg-indigo-50/40 border border-indigo-100 rounded-lg flex justify-between items-center">
                                    <span class="font-medium text-indigo-900">{{ $auction->highestBid->user->name }}</span>
                                    <span class="text-xs text-indigo-600 font-semibold">
                                        {{ $auction->highestBid->created_at->format('H:i:s') }}
                                    </span>
                                </div>
                            @else
                                <p class="text-sm text-gray-400 italic">Belum ada penawaran masuk.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Daftar Bid Masuk</h3>
                    <div class="flex-1 overflow-y-auto max-h-[500px] space-y-2 divide-y divide-gray-50">
                        @forelse($auction->bids->sortByDesc('bid_amount') as $index => $bid)
                            <div class="py-3 flex justify-between items-center text-sm first:pt-0">
                                <div>
                                    <span class="text-xs font-semibold text-gray-400">#{{ $index + 1 }}</span>
                                    <span class="font-medium text-gray-800 ml-2">{{ $bid->user->name }}</span>
                                </div>
                                <div class="text-right">
                                    <span class="font-bold text-indigo-600">Rp {{ number_format($bid->bid_amount, 0, ',', '.') }}</span>
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