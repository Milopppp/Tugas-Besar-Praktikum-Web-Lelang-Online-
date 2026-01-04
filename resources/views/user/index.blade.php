@extends('layouts.user')

@section('content')
<div class="py-16">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-blue-900 to-gray-800 py-20 mb-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-6xl font-black text-white uppercase italic mb-4">LELANG <span class="text-blue-400">PRO</span></h1>
            <p class="text-gray-300 text-xl">Katalog Barang Lelang Berkualitas</p>
        </div>
    </div>

    {{-- List Lelang --}}
    <div class="max-w-7xl mx-auto px-4">
        @if($auctions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($auctions as $auction)
                    <div class="bg-gray-800 rounded-2xl overflow-hidden border border-gray-700 hover:border-blue-500 transition shadow-xl hover:shadow-2xl">
                        {{-- Badge --}}
                        <div class="relative">
                            @if($auction->item->foto)
                                <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full h-56 object-cover">
                            @else
                                <div class="w-full h-56 bg-gray-700 flex items-center justify-center">
                                    <span class="text-gray-500 text-6xl">📦</span>
                                </div>
                            @endif
                            <span class="absolute top-3 left-3 bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">
                                AKTIF
                            </span>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <h3 class="text-2xl font-black text-white uppercase mb-3">{{ $auction->item->nama }}</h3>
                            
                            <div class="bg-blue-900/30 p-4 rounded-xl mb-4 border border-blue-800">
                                <p class="text-xs text-blue-400 font-bold uppercase mb-1">Harga Awal</p>
                                <p class="text-2xl font-black text-blue-400">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
                            </div>

                            <a href="{{ route('user.show', $auction->id) }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-xl font-bold uppercase hover:bg-blue-500 transition">
                                Lihat Detail & Bid
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-gray-800 rounded-3xl p-16 text-center border-2 border-dashed border-gray-700">
                <div class="text-8xl mb-6">🔍</div>
                <h2 class="text-3xl font-black text-white uppercase mb-4">Belum Ada Lelang Aktif</h2>
                <p class="text-gray-400 text-lg">Saat ini belum ada lelang yang sedang dibuka</p>
            </div>
        @endif
    </div>
</div>
@endsection