@extends('layouts.user')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen">
    <div class="max-w-7xl mx-auto px-4 py-12">

        {{-- Breadcrumb Modern --}}
        <nav class="flex mb-8 text-[11px] font-semibold uppercase tracking-wider text-slate-400">
            <a href="{{ route('user.index') }}" class="hover:text-blue-600 transition">Katalog</a>
            <span class="mx-3 opacity-50">/</span>
            <span class="text-slate-900">Detail Lot #{{ str_pad($auction->id, 4, '0', STR_PAD_LEFT) }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

            {{-- KIRI: Visual Barang --}}
            <div class="lg:col-span-7 space-y-8">
                <div class="bg-white p-4 rounded-[32px] shadow-sm border border-slate-100 group">
                    <div class="relative aspect-square overflow-hidden rounded-[24px] bg-slate-50 flex items-center justify-center">
                        @if($auction->item->foto)
                            <img src="{{ asset('images/items/' . $auction->item->foto) }}"
                                 class="w-full h-full object-cover transition-all duration-700 group-hover:scale-105">
                        @else
                            <div class="text-slate-300 uppercase tracking-widest font-bold italic">Visual Tidak Tersedia</div>
                        @endif

                        {{-- Badge Status --}}
                        <div class="absolute top-6 left-6 flex items-center gap-2 bg-white/90 backdrop-blur-md px-4 py-2 rounded-full shadow-sm border border-white">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-bold text-slate-900 uppercase tracking-wider">Lelang Aktif</span>
                        </div>
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="bg-white p-8 rounded-[24px] shadow-sm border border-slate-100">
                    <h2 class="text-xs font-bold uppercase tracking-[0.2em] text-blue-600 mb-6 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-blue-600"></span>
                        Deskripsi Barang
                    </h2>
                    <p class="text-slate-600 font-medium leading-loose text-lg italic">
                        "{{ $auction->item->deskripsi_barang }}"
                    </p>
                </div>
            </div>

            {{-- KANAN: Panel Penawaran (Bid) --}}
            <div class="lg:col-span-5">
                <div class="sticky top-28 space-y-6">

                    {{-- Info Utama --}}
                    <div class="bg-white p-8 rounded-[24px] shadow-sm border border-slate-100">
                        <div class="mb-6">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] block mb-2">Identitas Lot</span>
                            <h1 class="text-4xl font-extrabold text-slate-900 tracking-tight leading-tight uppercase">
                                {{ $auction->item->nama }}
                            </h1>
                        </div>

                        <div class="py-6 border-y border-slate-50 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Harga Pembukaan</span>
                                <p class="text-3xl font-extrabold text-blue-600 tracking-tighter">
                                    Rp{{ number_format($auction->item->harga_awal, 0, ',', '.') }}
                                </p>
                            </div>
                            <div class="text-right">
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-wider block mb-1">Total Penawar</span>
                                <p class="text-xl font-bold text-slate-900">{{ $auction->bids->count() }} Bid</p>
                            </div>
                        </div>

                        {{-- Form Penawaran --}}
                        <form action="{{ route('user.bid.store', $auction->id) }}" method="POST" class="mt-8 space-y-6">
                            @csrf

                            @if(session('success'))
                                <div class="p-4 bg-emerald-50 border border-emerald-100 text-emerald-700 text-[11px] font-bold rounded-xl uppercase tracking-wider">
                                    {{ session('success') }}
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="p-4 bg-red-50 border border-red-100 text-red-700 text-[11px] font-bold rounded-xl uppercase tracking-wider">
                                    {{ session('error') }}
                                </div>
                            @endif

                            <div class="space-y-3">
                                <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest block ml-1">Nilai Penawaran (IDR)</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 font-bold">Rp</span>
                                    <input type="number" name="harga_penawaran" required
                                           class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 pl-12 pr-6 text-xl font-bold text-slate-900 focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 focus:bg-white outline-none transition appearance-none"
                                           placeholder="000.000.000">
                                </div>
                            </div>

                            <button type="submit" class="w-full bg-[#1E293B] hover:bg-blue-600 text-white font-bold py-5 rounded-2xl uppercase text-[11px] tracking-[0.2em] transition-all duration-300 shadow-xl shadow-slate-200 active:scale-95 flex items-center justify-center gap-3 group">
                                Kirim Penawaran Terbaik
                                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                            </button>
                        </form>
                    </div>

                    {{-- Riwayat Penawaran (Bid History) --}}
                    <div class="bg-white rounded-[24px] shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-8 py-5 border-b border-slate-50 flex items-center justify-between bg-slate-50/30">
                            <h3 class="text-[10px] font-bold uppercase tracking-[0.2em] text-slate-400">Riwayat Penawaran</h3>
                            <span class="w-2 h-2 bg-blue-500 rounded-full"></span>
                        </div>

                        <div class="max-h-[340px] overflow-y-auto scrollbar-hide">
                            @forelse($auction->bids()->latest()->get() as $bid)
                                <div class="flex justify-between items-center px-8 py-5 border-b border-slate-50 last:border-0 hover:bg-slate-50 transition-colors group">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 font-bold text-xs uppercase">
                                            {{ substr($bid->user->name, 0, 1) }}
                                        </div>
                                        <div class="space-y-0.5">
                                            <p class="text-xs font-bold text-slate-900 uppercase tracking-tight group-hover:text-blue-600 transition-colors">{{ $bid->user->name }}</p>
                                            <p class="text-[10px] text-slate-400 font-semibold">{{ $bid->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-extrabold text-slate-900 tracking-tight">Rp{{ number_format($bid->penawaran_harga, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <div class="py-16 text-center">
                                    <svg class="w-12 h-12 text-slate-100 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">Belum ada penawaran</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    /* Menghilangkan scrollbar tapi tetap bisa scroll */
    .scrollbar-hide::-webkit-scrollbar { display: none; }
    .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endsection
