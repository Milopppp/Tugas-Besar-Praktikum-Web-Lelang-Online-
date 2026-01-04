@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    
    {{-- Header --}}
    <div class="mb-12">
        <h1 class="text-5xl font-black text-gray-900 uppercase italic mb-2">History Bid</h1>
        <p class="text-gray-500 text-lg">Riwayat lelang yang pernah Anda ikuti</p>
    </div>

    {{-- Content --}}
    @if($myBids->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($myBids as $auctionId => $bids)
                @php
                    $auction = $bids->first()->auction;
                    $myHighestBid = $bids->max('penawaran_harga');
                    $overallHighestBid = $auction->bids->max('penawaran_harga');
                    $myBidCount = $bids->count();
                    $isWinning = ($myHighestBid == $overallHighestBid);
                @endphp

                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border-2 {{ $isWinning ? 'border-green-500' : 'border-gray-100' }} hover:shadow-2xl transition">
                    
                    {{-- Badge Status --}}
                    <div class="relative">
                        @if($auction->item->foto)
                            <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                <span class="text-gray-400 text-4xl">📦</span>
                            </div>
                        @endif
                        
                        <div class="absolute top-3 left-3">
                            @if($auction->status === 'dibuka')
                                <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">AKTIF</span>
                            @else
                                <span class="bg-gray-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase">DITUTUP</span>
                            @endif
                        </div>

                        @if($isWinning && $auction->status === 'dibuka')
                            <div class="absolute top-3 right-3">
                                <span class="bg-yellow-400 text-gray-900 px-3 py-1 rounded-full text-xs font-bold uppercase">🏆 LEADING</span>
                            </div>
                        @endif
                    </div>

                    {{-- Info --}}
                    <div class="p-6">
                        <h3 class="text-xl font-black text-gray-900 uppercase mb-2">{{ $auction->item->nama }}</h3>
                        
                        <div class="mb-4">
                            <p class="text-xs text-gray-400 uppercase font-bold mb-1">Harga Awal</p>
                            <p class="text-lg font-black text-gray-600">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
                        </div>

                        <div class="bg-teal-50 p-4 rounded-xl mb-4">
                            <p class="text-xs text-teal-600 uppercase font-bold mb-1">Penawaran Tertinggi Anda</p>
                            <p class="text-2xl font-black text-teal-800">Rp {{ number_format($myHighestBid, 0, ',', '.') }}</p>
                            <p class="text-xs text-teal-600 mt-1">{{ $myBidCount }} kali penawaran</p>
                        </div>

                        <div class="mb-4">
                            <p class="text-xs text-gray-400 uppercase font-bold mb-1">Penawaran Tertinggi Saat Ini</p>
                            <p class="text-lg font-black {{ $isWinning ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($overallHighestBid, 0, ',', '.') }}
                            </p>
                        </div>

                        @if($auction->status === 'dibuka')
                            <a href="{{ route('user.show', $auction->id) }}" class="block w-full bg-teal-600 text-white text-center py-3 rounded-xl font-bold uppercase text-sm hover:bg-teal-700 transition">
                                Lihat Detail & Bid Lagi
                            </a>
                        @else
                            <button disabled class="block w-full bg-gray-300 text-gray-500 text-center py-3 rounded-xl font-bold uppercase text-sm cursor-not-allowed">
                                Lelang Ditutup
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="bg-white rounded-3xl shadow-lg p-16 text-center border-2 border-dashed border-gray-200">
            <div class="text-8xl mb-6">🔍</div>
            <h2 class="text-3xl font-black text-gray-900 uppercase mb-4">Belum Ada History Bid</h2>
            <p class="text-gray-500 mb-8 text-lg">Anda belum pernah mengikuti lelang apapun</p>
            <a href="{{ route('user.index') }}" class="inline-block bg-teal-600 text-white px-8 py-4 rounded-xl font-bold uppercase hover:bg-teal-700 transition">
                Mulai Ikut Lelang
            </a>
        </div>
    @endif

</div>
@endsection