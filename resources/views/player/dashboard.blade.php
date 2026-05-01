<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif tracking-tight text-3xl text-gray-950 leading-tight">
                Daftar Lelang
            </h2>
            <p class="mt-2 text-sm text-gray-600 font-sans">
                Kurasi mobil pilihan—tawar dengan tenang, menang dengan elegan.
            </p>
        </div>
    </x-slot>

    <div class="py-16">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($auctions as $auction)
                    <a href="{{ route('auctions.show', $auction->id) }}" class="group block bg-white border border-gray-200 rounded-2xl overflow-hidden transition hover:border-gray-300">
                            <div class="aspect-[16/10] bg-gray-100 overflow-hidden">
                                @if($auction->car?->gambar1)
                                    <img
                                        src="{{ url('storage/cars/' . $auction->car->gambar1) }}"
                                        alt="{{ $auction->car?->merk ?? 'Mobil' }} {{ $auction->car?->model ?? '' }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300"
                                        loading="lazy"
                                        onerror="this.style.display='none'; this.nextElementSibling.classList.remove('hidden');"
                                    >
                                    <div class="hidden w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <span>Tidak ada gambar</span>
                                    </div>
                                @else
                                    <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400">
                                        <span>Tidak ada gambar</span>
                                    </div>
                                @endif
                            </div>

                            <div class="p-7">
                                <h3 class="font-serif tracking-tight text-xl text-gray-950 truncate">
                                    {{ $auction->car?->merk ?? 'Merek' }} {{ $auction->car?->model ?? 'Model Tidak Ditemukan' }}
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">Tahun: {{ $auction->car?->tahun ?? '-' }}</p>

                                <div class="mt-5 flex items-center justify-between">
                                    <span class="inline-flex items-center rounded-full border px-3 py-1 text-xs font-semibold
                                        @if($auction->status === 'active') border-green-200 bg-green-50 text-green-700
                                        @elseif($auction->status === 'pending') border-yellow-200 bg-yellow-50 text-yellow-700
                                        @else border-gray-200 bg-gray-50 text-gray-700 @endif
                                    ">
                                        {{ ucfirst($auction->status) }}
                                    </span>
                                </div>

                                <div class="mt-6 flex items-end justify-between">
                                    <div>
                                        <p class="text-xs text-gray-500 uppercase tracking-wider">Harga saat ini</p>
                                        <p class="mt-1 text-lg font-semibold text-gray-950">
                                            Rp {{ number_format($auction->highestBid ? $auction->highestBid->bid_amount : ($auction->car?->harga_awal ?? 0), 0, ',', '.') }}
                                        </p>
                                    </div>
                                    <p class="text-xs text-gray-500">{{ $auction->bids_count ?? 0 }} bid</p>
                                </div>
                                
                                <div class="mt-8">
                                    @if($auction->status === 'active')
                                        <span class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-4 rounded-xl transition">
                                            Ikut Lelang
                                        </span>
                                    @else
                                        <span class="block w-full text-center bg-gray-100 text-gray-600 font-medium py-3 px-4 rounded-xl border border-gray-200 cursor-not-allowed">
                                            Menunggu Sesi Dibuka
                                        </span>
                                    @endif
                                </div>
                               
                            </div>
                    </a>
                @empty
                    <div class="col-span-full bg-white border border-gray-200 rounded-2xl p-10 text-center">
                        <p class="font-serif tracking-tight text-2xl text-gray-950">Belum ada lelang.</p>
                        <p class="text-sm text-gray-600 mt-2">Silakan tunggu hingga host membuka sesi.</p>
                    </div>
                @endforelse
                {{-- @forelse($auctions as $auction)
                        
                    @empty--}}
            </div>
        </div>
    </div>
</x-app-layout>