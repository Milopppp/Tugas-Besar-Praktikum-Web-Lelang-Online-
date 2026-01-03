@extends('layouts.user')

@section('content')
<div class="bg-teal-600 py-24 text-center text-white relative overflow-hidden">
    <div class="relative z-10 animate-in fade-in zoom-in duration-700">
        <h1 class="text-5xl font-black mb-4 uppercase tracking-[0.2em] italic shadow-sm">Selamat Datang di NGAB AUCTION</h1>
        <p class="text-teal-100 text-lg font-medium opacity-80 italic">Disini menyediakan barang lelang yang bagus dan berkualitas</p>
    </div>
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0 100 L100 0 L100 100 Z" fill="white"/></svg>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($auctions as $auction)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100">
            <div class="h-64 bg-slate-200 relative overflow-hidden">
                <img src="https://via.placeholder.com/600x400" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                <div class="absolute top-4 left-4">
                    <span class="bg-emerald-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Aktif</span>
                </div>
            </div>

            <div class="p-8">
                <h3 class="font-black text-xl text-gray-800 mb-3 uppercase tracking-tight group-hover:text-teal-600 transition">{{ $auction->item->nama }}</h3>
                <p class="text-gray-500 text-sm mb-6 leading-relaxed line-clamp-2 italic">{{ $auction->item->deskripsi }}</p>
                
                <div class="flex justify-between items-center border-t border-gray-50 pt-6">
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Mulai Dari</p>
                        <p class="text-lg font-black text-gray-900 tracking-tighter">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
                    </div>
                    <a href="{{ route('user.show', $auction->id) }}" 
                       class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest shadow-md transition transform active:scale-95">
                        Lihat Barang
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-white rounded-2xl border-2 border-dashed border-gray-200">
            <p class="text-gray-400 font-medium italic">Saat ini tidak ada barang yang sedang dilelang.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection