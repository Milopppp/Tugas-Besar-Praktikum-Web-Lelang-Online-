@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    
    {{-- Header --}}
    <div class="mb-12">
        <h1 class="text-5xl font-black text-black uppercase mb-2">🏆 Daftar Pemenang</h1>
        <p class="text-gray-400 text-lg">Lelang yang telah selesai dan pemenangnya</p>
    </div>

    {{-- Content --}}
    @if($winners->count() > 0)
        <div class="space-y-6">
            @foreach($winners as $item)
                @php
                    $auction = $item['auction'];
                    $winningBid = $item['winning_bid'];
                    $winner = $item['winner'];
                    $isMyWin = $winner && Auth::check() && $winner->id === Auth::id();
                @endphp

                <div class="bg-gray-800 rounded-3xl shadow-2xl overflow-hidden border-2 {{ $isMyWin ? 'border-yellow-400' : 'border-gray-700' }} hover:border-blue-500 transition">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        
                        {{-- Gambar Barang --}}
                        <div class="relative bg-gray-900 p-6 flex items-center justify-center">
                            @if($auction->item->foto)
                                <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full h-64 object-cover rounded-2xl shadow-lg">
                            @else
                                <div class="w-full h-64 bg-gray-700 rounded-2xl flex items-center justify-center">
                                    <span class="text-gray-500 text-6xl">📦</span>
                                </div>
                            @endif

                            @if($isMyWin)
                                <div class="absolute top-4 left-4">
                                    <span class="bg-yellow-400 text-gray-900 px-4 py-2 rounded-full text-sm font-black uppercase shadow-lg">
                                        🎉 Anda Menang!
                                    </span>
                                </div>
                            @endif
                        </div>

                        {{-- Info Lelang --}}
                        <div class="p-8 md:col-span-2">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-3xl font-black text-white uppercase mb-2">{{ $auction->item->nama }}</h2>
                                    <p class="text-gray-400 text-sm">{{ $auction->item->deskripsi_barang }}</p>
                                </div>
                                <span class="bg-gray-700 text-gray-300 px-4 py-1 rounded-full text-xs font-bold uppercase border border-gray-600">
                                    DITUTUP
                                </span>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-6">
                                {{-- Harga Awal --}}
                                <div class="bg-gray-900 p-4 rounded-xl border border-gray-700">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Harga Awal</p>
                                    <p class="text-lg font-black text-gray-300">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
                                </div>

                                {{-- Total Bid --}}
                                <div class="bg-gray-900 p-4 rounded-xl border border-gray-700">
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Total Penawaran</p>
                                    <p class="text-lg font-black text-gray-300">{{ $auction->bids->count() }} Bid</p>
                                </div>
                            </div>

                            <hr class="my-6 border-gray-700">

                            {{-- Pemenang --}}
                            @if($winningBid && $winner)
                                <div class="bg-gradient-to-r from-yellow-900/30 to-yellow-800/30 p-6 rounded-2xl border-2 border-yellow-600">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-4">
                                            <div class="bg-yellow-500 w-16 h-16 rounded-full flex items-center justify-center shadow-lg">
                                                <span class="text-3xl">👑</span>
                                            </div>
                                            <div>
                                                <p class="text-xs text-yellow-400 uppercase font-bold mb-1">Pemenang Lelang</p>
                                                <p class="text-2xl font-black text-white uppercase">{{ $winner->name }}</p>
                                                <p class="text-sm text-yellow-400">{{ $winner->email }}</p>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-xs text-yellow-400 uppercase font-bold mb-1">Harga Menang</p>
                                            <p class="text-3xl font-black text-yellow-400">Rp {{ number_format($winningBid->penawaran_harga, 0, ',', '.') }}</p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="bg-gray-900 p-6 rounded-2xl border-2 border-dashed border-gray-700 text-center">
                                    <p class="text-gray-500 font-semibold">Tidak ada pemenang (tidak ada penawaran)</p>
                                </div>
                            @endif

                            {{-- Top 3 Bidders --}}
                            @if($auction->bids->count() > 0)
                                <div class="mt-6">
                                    <h3 class="text-sm font-black text-gray-300 uppercase mb-3">🏅 Top 3 Penawaran Tertinggi</h3>
                                    <div class="space-y-2">
                                        @foreach($auction->bids()->orderBy('penawaran_harga', 'desc')->take(3)->get() as $index => $bid)
                                            <div class="flex justify-between items-center bg-gray-900 p-3 rounded-xl border {{ $index === 0 ? 'border-yellow-500' : 'border-gray-700' }}">
                                                <div class="flex items-center gap-3">
                                                    <span class="text-lg font-black {{ $index === 0 ? 'text-yellow-400' : 'text-gray-500' }}">
                                                        #{{ $index + 1 }}
                                                    </span>
                                                    <div>
                                                        <p class="font-bold {{ $bid->user_id === Auth::id() ? 'text-blue-400' : 'text-white' }}">
                                                            {{ $bid->user->name }}
                                                            @if($bid->user_id === Auth::id())
                                                                <span class="text-xs text-blue-400">(Anda)</span>
                                                            @endif
                                                        </p>
                                                        <p class="text-xs text-gray-500">{{ $bid->created_at->diffForHumans() }}</p>
                                                    </div>
                                                </div>
                                                <p class="font-black {{ $index === 0 ? 'text-yellow-400' : 'text-gray-300' }}">
                                                    Rp {{ number_format($bid->penawaran_harga, 0, ',', '.') }}
                                                </p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-gray-800 rounded-3xl shadow-2xl p-16 text-center border-2 border-dashed border-gray-700">
            <div class="text-8xl mb-6">🏆</div>
            <h2 class="text-3xl font-black text-white uppercase mb-4">Belum Ada Lelang yang Ditutup</h2>
            <p class="text-gray-400 mb-8 text-lg">Belum ada lelang yang selesai dan memiliki pemenang</p>
            <a href="{{ route('user.index') }}" class="inline-block bg-blue-600 text-white px-8 py-4 rounded-xl font-bold uppercase hover:bg-blue-500 transition">
                Lihat Lelang Aktif
            </a>
        </div>
    @endif

</div>
@endsection