@extends('layouts.user')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-12">

        {{-- Header Section - Meniru Header Dashboard Admin --}}
        <div class="bg-white p-10 rounded-[24px] shadow-sm border border-slate-100 mb-12">
            <h1 class="text-xs font-bold text-blue-600 uppercase tracking-[0.2em] mb-3">Aktivitas Lelang</h1>
            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Riwayat <span class="text-blue-600">Penawaran Anda</span></h2>
            <p class="mt-4 text-slate-500 max-w-2xl text-base font-medium leading-relaxed">
                Pantau seluruh aktivitas bid Anda. Lot yang sedang Anda pimpin akan ditandai dengan aksen kuning premium.
            </p>
        </div>

        {{-- Content --}}
        @if($myBids->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($myBids as $auctionId => $bids)
                    @php
                        $auction = $bids->first()->auction;
                        $myHighestBid = $bids->max('penawaran_harga');
                        $overallHighestBid = $auction->bids->max('penawaran_harga');
                        $myBidCount = $bids->count();
                        $isWinning = ($myHighestBid == $overallHighestBid);
                        $isOpen = ($auction->status === 'dibuka');
                    @endphp

                    {{-- Kotak Utama - Radius Lembut & Border Dinamis --}}
                    <div class="group bg-white border-2 {{ ($isWinning && $isOpen) ? 'border-yellow-400 shadow-xl shadow-yellow-50' : 'border-slate-100 shadow-sm' }} rounded-[20px] overflow-hidden flex flex-col transition-all duration-300 hover:shadow-md">

                        {{-- Area Visual dengan Badge Status --}}
                        <div class="relative aspect-[16/10] overflow-hidden bg-slate-50 border-b border-slate-50">
                            @if($auction->item->foto)
                                <img src="{{ asset('images/items/' . $auction->item->foto) }}"
                                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105 {{ !$isOpen ? 'grayscale opacity-70' : '' }}">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-300 font-bold uppercase tracking-widest text-[10px]">No Image</div>
                            @endif

                            {{-- Badge Status Berwarna --}}
                            <div class="absolute top-4 left-4 flex gap-2">
                                @if($isOpen)
                                    <span class="bg-emerald-500 text-white text-[9px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider shadow-sm flex items-center gap-1.5 border border-emerald-400">
                                        <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Aktif
                                    </span>
                                @else
                                    <span class="bg-red-600 text-white text-[9px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wider border border-red-500 shadow-sm">
                                        Selesai
                                    </span>
                                @endif

                                @if($isWinning && $isOpen)

                                @endif
                            </div>
                        </div>

                        {{-- Area Info Konten --}}
                        <div class="p-8 flex-grow flex flex-col space-y-6">
                            <div>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest mb-1.5">Lot #{{ str_pad($auction->id, 4, '0', STR_PAD_LEFT) }}</p>
                                <h3 class="text-lg font-extrabold text-slate-900 leading-tight group-hover:text-blue-600 transition-colors">
                                    {{ $auction->item->nama }}
                                </h3>
                            </div>

                            <div class="space-y-4 flex-grow">
                                {{-- Kotak Penawaran Anda --}}
                                <div class="{{ ($isWinning && $isOpen) ? 'bg-yellow-50 border-yellow-200' : 'bg-slate-50 border-slate-100' }} p-5 rounded-xl border transition-colors">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Bid Tertinggi Anda</span>
                                    <div class="flex items-baseline justify-between">
                                        <span class="text-xl font-extrabold text-slate-900">Rp{{ number_format($myHighestBid, 0, ',', '.') }}</span>
                                        <span class="text-[10px] font-bold text-slate-400 uppercase bg-white px-2 py-0.5 rounded border border-slate-100">{{ $myBidCount }}x Bid</span>
                                    </div>
                                </div>

                                {{-- Status Pasar --}}
                                <div class="px-1">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-2">Status Posisi</span>
                                    <p class="text-sm font-bold {{ $isWinning ? 'text-blue-600' : 'text-red-500' }} flex items-center gap-2">
                                        @if($isWinning)
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                                            Penawaran Tertinggi
                                        @else
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Tawaran Terlampaui
                                        @endif
                                    </p>
                                    <p class="text-xs font-semibold text-slate-400 mt-1 italic">
                                        Pasar Saat Ini: Rp{{ number_format($overallHighestBid, 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="pt-4 border-t border-slate-50">
                                @if($isOpen)
                                    <a href="{{ route('user.show', $auction->id) }}"
                                       class="block w-full bg-[#1E293B] hover:bg-blue-600 text-white text-center py-3.5 rounded-xl text-[11px] font-bold uppercase tracking-widest transition-all duration-300 shadow-lg shadow-slate-200 active:scale-95">
                                        Detail & Bid Lagi
                                    </a>
                                @else
                                    <button disabled class="w-full bg-slate-100 text-slate-400 text-center py-3.5 rounded-xl text-[11px] font-bold uppercase tracking-widest cursor-not-allowed border border-slate-200">
                                        Sesi Berakhir
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="py-32 text-center bg-white rounded-[32px] border border-dashed border-slate-200">
                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl text-slate-200 italic">🔍</span>
                </div>
                <h2 class="text-lg font-bold text-slate-400 uppercase tracking-widest mb-8">Belum Ada History Bid</h2>
                <a href="{{ route('user.index') }}" class="inline-flex items-center gap-2 bg-blue-600 hover:bg-slate-900 text-white px-8 py-4 rounded-xl text-xs font-bold uppercase tracking-widest transition-all shadow-lg shadow-blue-100">
                    Mulai Jelajahi Katalog
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
