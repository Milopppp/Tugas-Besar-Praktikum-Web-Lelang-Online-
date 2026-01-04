@extends('layouts.user')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen">
    {{-- Hero Section - Diselaraskan dengan Header Admin --}}
    <div class="max-w-7xl mx-auto px-4 pt-16 pb-12">
        <div class="bg-white p-10 rounded-[24px] shadow-sm border border-gray-100 relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-sm font-bold text-blue-600 uppercase tracking-widest mb-3">Katalog Lelang Eksklusif</h1>
                <h2 class="text-4xl font-extrabold text-slate-900 tracking-tight">Temukan Barang <span class="text-blue-600">Impian Anda</span></h2>
                <p class="mt-4 text-slate-500 max-w-xl text-lg font-medium leading-relaxed">
                    Sistem penawaran transparan dengan kurasi barang kualitas terbaik.
                </p>
            </div>
            {{-- Dekorasi Abstract khas Dashboard Modern --}}
            <div class="absolute -right-10 -top-10 w-64 h-64 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
        </div>
    </div>

    {{-- List Lelang --}}
    <div class="max-w-7xl mx-auto px-4 pb-24">
        @if($auctions->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($auctions as $auction)
                    <div class="group bg-white rounded-[20px] p-4 shadow-sm border border-gray-100 hover:shadow-admin transition-all duration-300 flex flex-col">

                        {{-- Image Area - Radius Lembut --}}
                        <div class="relative aspect-[4/3] overflow-hidden bg-slate-50 rounded-[16px] mb-5">
                            @if($auction->item->foto)
                                <img src="{{ asset('images/items/' . $auction->item->foto) }}"
                                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400">
                                    <svg class="w-12 h-12 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            @endif

                            {{-- Badge Status Modern --}}
                            <div class="absolute top-3 left-3 flex items-center gap-2 bg-white/80 backdrop-blur-md px-3 py-1.5 rounded-full shadow-sm">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-[10px] font-bold text-slate-900 uppercase tracking-wider">Live Auction</span>
                            </div>
                        </div>

                        {{-- Content Area --}}
                        <div class="px-2 flex flex-col flex-grow">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-lg font-bold text-slate-800 leading-tight group-hover:text-blue-600 transition-colors">
                                    {{ $auction->item->nama }}
                                </h3>
                            </div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-6">Lot #{{ str_pad($auction->id, 4, '0', STR_PAD_LEFT) }}</p>

                            <div class="mt-auto flex items-center justify-between pt-4 border-t border-slate-50">
                                <div>
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-0.5">Mulai Dari</span>
                                    <span class="text-lg font-extrabold text-slate-900">
                                        Rp{{ number_format($auction->item->harga_awal, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Button dengan Radius Lembut --}}
                                <a href="{{ route('user.show', $auction->id) }}"
                                   class="bg-blue-600 hover:bg-[#1E293B] text-white px-5 py-2.5 rounded-xl text-xs font-bold transition-all duration-300 shadow-lg shadow-blue-100 flex items-center gap-2 group/btn">
                                    Ikut Bid
                                    <svg class="w-4 h-4 transform group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-32 text-center bg-white rounded-[24px] border border-dashed border-slate-200">
                <div class="bg-slate-50 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8.4 7-8.4-7"></path></svg>
                </div>
                <h2 class="text-lg font-bold text-slate-400 uppercase tracking-widest">Belum Ada Barang Lelang</h2>
            </div>
        @endif
    </div>
</div>
@endsection
