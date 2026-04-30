<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $auction->car->merk }} {{ $auction->car->model }} - Detail Lelang</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-50">
    <!-- Flash Messages -->
    @if (session('success'))
        <div class="fixed top-4 right-4 z-50 max-w-md">
            <div class="bg-green-50 border border-green-200 rounded-lg shadow-lg p-4 flex items-start gap-3">
                <div class="flex-shrink-0">
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
            <div class="bg-red-50 border border-red-200 rounded-lg shadow-lg p-4 flex items-start gap-3">
                <div class="flex-shrink-0">
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
    <div class="min-h-screen py-8 px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="/" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-medium transition">
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
                    <!-- Image Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Large Main Image -->
                        <div class="md:col-span-2 row-span-2">
                            <div class="relative w-full h-96 md:h-full rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                <img 
                                    src="{{ asset('storage/' . $auction->car->gambar1) }}" 
                                    alt="Gambar 1 - {{ $auction->car->merk }} {{ $auction->car->model }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        </div>

                        <!-- Small Images (Stacked Right) -->
                        <div class="space-y-4">
                            <div class="relative w-full h-44 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                <img 
                                    src="{{ asset('storage/' . $auction->car->gambar2) }}" 
                                    alt="Gambar 2 - {{ $auction->car->merk }} {{ $auction->car->model }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                            <div class="relative w-full h-44 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition">
                                <img 
                                    src="{{ asset('storage/' . $auction->car->gambar3) }}" 
                                    alt="Gambar 3 - {{ $auction->car->merk }} {{ $auction->car->model }}"
                                    class="w-full h-full object-cover"
                                >
                            </div>
                        </div>
                    </div>

                    <!-- Car Info -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                                    {{ $auction->car->merk }} {{ $auction->car->model }}
                                </h1>
                                <p class="text-lg text-gray-600">Tahun: <span class="font-semibold">{{ $auction->car->tahun }}</span></p>
                            </div>

                            <!-- Grade Badge -->
                            @php
                                $gradeBadgeClass = match($auction->car->grade) {
                                    'A' => 'bg-green-100 text-green-800 border-green-300',
                                    'B' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                    default => 'bg-orange-100 text-orange-800 border-orange-300',
                                };
                            @endphp
                            <div class="border-2 {{ $gradeBadgeClass }} rounded-lg px-4 py-2 font-bold text-lg">
                                Grade: {{ $auction->car->grade }}
                            </div>
                        </div>

                        <!-- Additional Car Details -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12a3 3 0 100-6 3 3 0 000 6z" />
                                    <path fill-rule="evenodd" d="M12.316 3.051a1 1 0 01.633 1.265l-4 12a1 1 0 11-1.898-.632l4-12a1 1 0 011.265-.633z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">Odometer: <span class="font-semibold text-gray-900">{{ number_format($auction->car->odometer, 0, ',', '.') }} km</span></span>
                            </div>
                            <div class="flex items-center gap-2 text-gray-600">
                                <svg class="h-5 w-5 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3 6a3 3 0 013-3h10a1 1 0 00-1-1 1 1 0 00-1 1H4a1 1 0 00-1 1v10a1 1 0 001 1h10a1 1 0 001-1v-3a1 1 0 011-1 1 1 0 011 1v4a3 3 0 01-3 3H6a3 3 0 01-3-3V6z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm">Harga Awal: <span class="font-semibold text-gray-900">Rp {{ number_format($auction->car->harga_awal, 0, ',', '.') }}</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">Deskripsi</h2>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">
                            {{ $auction->car->deskripsi }}
                        </p>
                    </div>
                </div>

                <!-- Bidding Section (Right/Sidebar) -->
                <div>
                    <div class="bg-white rounded-lg p-6 shadow-sm sticky top-8 space-y-6">
                        <!-- Status Badge -->
                        @php
                            $statusClass = match($auction->status) {
                                'active' => 'bg-green-100 text-green-800 border-green-300',
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
                                'closed' => 'bg-gray-100 text-gray-800 border-gray-300',
                                default => 'bg-gray-100 text-gray-800 border-gray-300',
                            };
                            $statusLabel = match($auction->status) {
                                'active' => 'Lelang Aktif',
                                'pending' => 'Menunggu',
                                'closed' => 'Lelang Selesai',
                                default => 'Status Tidak Diketahui',
                            };
                        @endphp
                        <div class="border-2 {{ $statusClass }} rounded-lg px-4 py-2 font-semibold text-center">
                            {{ $statusLabel }}
                        </div>

                        <!-- Current Price -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-600 font-medium mb-2">Harga Saat Ini</p>
                            <p class="text-3xl font-bold text-indigo-600">
                                Rp {{ number_format(
                                    $auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal,
                                    0,
                                    ',',
                                    '.'
                                ) }}
                            </p>
                            @if($auction->highestBid)
                                <p class="text-xs text-gray-500 mt-2">
                                    Penawaran tertinggi oleh: <span class="font-semibold">{{ $auction->highestBid->user->name ?? 'Anonymous' }}</span>
                                </p>
                            @else
                                <p class="text-xs text-gray-500 mt-2">Harga pembukaan</p>
                            @endif
                        </div>

                        <!-- Bidding Form -->
                        @if($auction->status === 'active')
                            <form action="{{ route('auctions.placeBid', $auction->id) }}" method="POST" class="space-y-4">
                                @csrf

                                <!-- Bid Amount Input -->
                                <div>
                                    <label for="bid_amount" class="block text-sm font-semibold text-gray-900 mb-2">
                                        Jumlah Penawaran (Rp)
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-3.5 text-gray-500 font-semibold">Rp</span>
                                        <input 
                                            type="number" 
                                            id="bid_amount" 
                                            name="bid_amount" 
                                            placeholder="Contoh: 500000000"
                                            min="{{ ($auction->highestBid ? $auction->highestBid->bid_amount : $auction->car->harga_awal) + 1 }}"
                                            step="1"
                                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition @error('bid_amount') border-red-500 @enderror"
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

                                <!-- Submit Button -->
                                <button 
                                    type="submit"
                                    class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2 shadow-sm hover:shadow-md"
                                >
                                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                    </svg>
                                    Tawar Sekarang
                                </button>
                            </form>

                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <p class="text-xs text-blue-700">
                                    <svg class="h-4 w-4 inline-block mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zm-11-1a1 1 0 100 2H9V4z" clip-rule="evenodd" />
                                    </svg>
                                    Semakin tinggi penawaran Anda, semakin besar peluang memenangkan lelang ini.
                                </p>
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-lg p-4 text-center">
                                <p class="text-gray-600 font-semibold">Lelang Tidak Aktif</p>
                                <p class="text-xs text-gray-500 mt-2">Anda tidak dapat melakukan penawaran pada saat ini.</p>
                            </div>
                        @endif

                        <!-- Quick Stats -->
                        <div class="border-t pt-4 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-gray-600">Total Penawaran:</span>
                                <span class="font-bold text-gray-900">{{ $auction->bids_count ?? 0 }}</span>
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
</body>
</html>
