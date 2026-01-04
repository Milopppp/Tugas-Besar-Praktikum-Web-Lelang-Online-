@extends('layouts.user')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen">
    {{-- Hero Section - Diselaraskan dengan gaya Header Admin --}}
    <div class="max-w-7xl mx-auto px-4 pt-20 pb-12">
        <div class="bg-white p-10 rounded-[24px] shadow-sm border border-gray-100">
            <div class="text-left">
                <h1 class="text-[10px] font-bold text-blue-600 uppercase tracking-[0.3em] mb-4">Lelang Selesai</h1>
                <h2 class="text-4xl font-bold text-slate-900 tracking-tighter uppercase">
                    Daftar Pemenang Lelang
                </h2>
                <p class="mt-4 text-slate-500 max-w-xl text-lg font-medium leading-relaxed">
                    Daftar resmi barang-barang yang telah terjual kepada penawar tertinggi melalui proses yang transparan.
                </p>
            </div>
        </div>
    </div>

    {{-- List Pemenang dengan Kotak Pembatas Lembut --}}
    <div class="max-w-7xl mx-auto px-4 pb-24">
        @if($winners->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($winners as $item)
                    @php
                        $auction = $item['auction'];
                        $winningBid = $item['winning_bid'];
                        $winner = $item['winner'];
                        $isMyWin = $winner && Auth::check() && $winner->id === Auth::id();
                    @endphp

                    {{-- Kotak Utama Pemenang - Radius disesuaikan agar tidak tajam --}}
                    <div class="group bg-white border {{ $isMyWin ? 'border-yellow-400 shadow-xl shadow-yellow-50' : 'border-gray-100 shadow-sm' }} rounded-[20px] overflow-hidden flex flex-col transition-all duration-500 hover:shadow-md">

                        {{-- Area Gambar (Grayscale untuk barang terjual) --}}
                        <div class="relative aspect-square overflow-hidden bg-slate-50 border-b border-gray-50">
                            @if($auction->item->foto)
                                <img src="{{ asset('images/items/' . $auction->item->foto) }}"
                                     class="w-full h-full object-cover grayscale transition-all duration-700 group-hover:grayscale-0">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-200 uppercase tracking-widest font-bold text-xs">
                                    Tanpa Gambar
                                </div>
                            @endif

                            {{-- Label Terjual - Pill Style --}}
                            <div class="absolute top-4 right-4 bg-slate-900/80 backdrop-blur-md px-3 py-1.5 rounded-full border border-white/20">
                                <span class="text-[9px] font-bold text-white uppercase tracking-wider">Sold Out</span>
                            </div>

                            @if($isMyWin)
                                <div class="absolute top-4 left-4 bg-yellow-400 px-4 py-1.5 rounded-full shadow-sm border border-yellow-300">
                                    <span class="text-[10px] font-extrabold text-gray-900 uppercase tracking-tight">Anda Memenangkannya</span>
                                </div>
                            @endif
                        </div>

                        {{-- Area Konten --}}
                        <div class="p-8 flex flex-col flex-grow">
                            <div class="mb-6">
                                <div class="flex items-center gap-2 mb-3">
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">Lot #{{ str_pad($auction->id, 4, '0', STR_PAD_LEFT) }}</p>
                                    <span class="w-1 h-1 bg-slate-200 rounded-full"></span>
                                    <p class="text-[10px] text-slate-400 font-bold uppercase tracking-wider">{{ $auction->updated_at->format('d M Y') }}</p>
                                </div>
                                <h3 class="text-xl font-bold text-slate-900 uppercase tracking-tight leading-tight group-hover:text-blue-600 transition-colors">
                                    {{ $auction->item->nama }}
                                </h3>
                            </div>

                            {{-- Info Harga Menang --}}
                            <div class="mt-auto pt-6 border-t border-slate-50">
                                <div class="bg-slate-50 p-5 rounded-xl border border-slate-100 mb-5">
                                    <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest block mb-1">Harga Final</span>
                                    <span class="text-2xl font-extrabold text-blue-600 tracking-tighter">
                                        Rp{{ number_format($winningBid->penawaran_harga ?? 0, 0, ',', '.') }}
                                    </span>
                                </div>

                                {{-- Nama Pemenang --}}
                                <div class="flex items-center gap-3 px-1">
                                    <div class="w-9 h-9 bg-slate-900 text-white flex items-center justify-center rounded-full text-[11px] font-bold">
                                        {{ strtoupper(substr($winner->name ?? '?', 0, 1)) }}
                                    </div>
                                    <div class="truncate">
                                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-none mb-1.5">Pemenang</p>
                                        <p class="text-sm font-bold text-slate-900 uppercase truncate">{{ $winner->name ?? 'Tidak ada penawar' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="py-32 text-center bg-white rounded-[24px] border border-dashed border-slate-200">
                <div class="text-5xl mb-6 opacity-20"></div>
                <h2 class="text-sm font-bold text-slate-300 uppercase tracking-[0.4em]">Belum ada riwayat pemenang</h2>
            </div>
        @endif
    </div>
</div>
@endsection
