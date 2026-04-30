<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Player - Daftar Lelang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($auctions as $auction)
                    <a href="{{ route('auctions.show', $auction->id) }}" class="group bg-white rounded-xl shadow-sm hover:shadow-md transition overflow-hidden">
                        <div class="aspect-[16/10] bg-gray-100">
                            @if($auction->car?->gambar1)
                                <img
                                    src="{{ asset('storage/' . $auction->car->gambar1) }}"
                                    alt="Gambar Mobil"
                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                >
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                    <span>Tidak ada gambar</span>
                                </div>
                            @endif
                        </div>

                        <div class="p-5">
                            <span class="text-xs font-semibold uppercase tracking-wider text-indigo-600">
                                {{ $auction->car?->merk ?? 'Merek' }}
                            </span>
                            <h3 class="text-lg font-bold text-gray-900 mt-1 truncate">
                                {{ $auction->car?->model ?? 'Model Tidak Ditemukan' }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">Tahun: {{ $auction->car?->tahun ?? '-' }}</p>

                            <div class="mt-3 flex items-center justify-between">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                    @if($auction->status === 'active') bg-green-100 text-green-700
                                    @elseif($auction->status === 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-gray-100 text-gray-700 @endif
                                ">
                                    {{ ucfirst($auction->status) }}
                                </span>
                            </div>

                            <div class="mt-4 flex items-end justify-between">
                                <div>
                                    <p class="text-xs text-gray-500">Harga saat ini</p>
                                    <p class="text-base font-bold text-indigo-600">
                                        Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : ($auction->car?->harga_awal ?? 0), 0, ',', '.') }}
                                    </p>
                                </div>
                                <p class="text-xs text-gray-500">{{ $auction->bids_count ?? 0 }} bid</p>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white rounded-lg shadow-sm p-6 text-center">
                        <p class="text-gray-700 font-semibold">Belum ada lelang yang terdaftar.</p>
                        <p class="text-sm text-gray-500 mt-1">Silakan tunggu hingga host membuka sesi.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>