<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Host</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="flex items-center justify-between gap-4 mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Dashboard Host</h1>
                    <p class="text-sm text-gray-600">Kelola lelang yang tersedia.</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('host.auctions.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-4 py-2 rounded-lg shadow-sm">Buat Lelang</a>
                    <a href="/" class="text-indigo-600 hover:text-indigo-700 font-semibold">Kembali</a>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600">
                            <tr>
                                <th class="text-left px-4 py-3">Mobil</th>
                                <th class="text-left px-4 py-3">Status</th>
                                <th class="text-left px-4 py-3">Harga saat ini</th>
                                <th class="text-left px-4 py-3">Bid</th>
                                <th class="text-left px-4 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y">
                            @forelse($auctions as $auction)
                                <tr>
                                    <td class="px-4 py-3">
                                        <div class="font-semibold text-gray-900">
                                            {{ $auction->car?->merk }} {{ $auction->car?->model }}
                                        </div>
                                        <div class="text-xs text-gray-500">{{ $auction->car?->tahun }} • Grade {{ $auction->car?->grade ?? '-' }}</div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="text-xs font-semibold px-2 py-1 rounded-full
                                            @if($auction->status === 'active') bg-green-100 text-green-700
                                            @elseif($auction->status === 'pending') bg-yellow-100 text-yellow-700
                                            @else bg-gray-100 text-gray-700 @endif
                                        ">
                                            {{ $auction->status }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 font-semibold text-indigo-600">
                                        Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : ($auction->car?->harga_awal ?? 0), 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-gray-600">{{ $auction->bids_count ?? 0 }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('auctions.show', $auction->id) }}" class="text-indigo-600 hover:text-indigo-700 font-semibold">Detail</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-gray-600">Belum ada lelang.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
