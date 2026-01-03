@extends('layouts.user')

@section('content')

<div class="absolute top-4 right-4 z-50">
    @guest
        <a href="{{ route('login') }}" class="text-white bg-teal-800 px-4 py-2 rounded-lg">Admin / User Login</a>
    @else
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-white bg-red-600 px-4 py-2 rounded-lg">Logout ({{ Auth::user()->name }})</button>
        </form>
    @endguest
</div>

<div class="bg-teal-600 py-24 text-center text-white relative overflow-hidden">
    <div class="relative z-10">
        <h1 class="text-5xl font-black mb-4 uppercase tracking-[0.2em] italic shadow-sm">NGAB AUCTION</h1>
        <p class="text-teal-100 text-lg font-medium opacity-80 italic">Katalog Barang Lelang Berkualitas</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($auctions as $auction)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden group hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 border border-gray-100">
            <div class="h-64 bg-slate-200 relative overflow-hidden">
                {{-- Gunakan foto dari database jika ada --}}
                @if($auction->item->foto)
                    <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                @else
                    <img src="https://via.placeholder.com/600x400" class="w-full h-full object-cover">
                @endif
                
                <div class="absolute top-4 left-4">
                    <span class="bg-emerald-500 text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-lg">Aktif</span>
                </div>
            </div>

            <div class="p-8">
                {{-- Revisi: nama menjadi nama_barang --}}
                <h3 class="font-black text-xl text-gray-800 mb-3 uppercase tracking-tight group-hover:text-teal-600 transition">
                    {{ $auction->item->nama_barang }}
                </h3>
                <p class="text-gray-500 text-sm mb-6 leading-relaxed line-clamp-2 italic">
                    {{ $auction->item->deskripsi_barang }}
                </p>
                
                <div class="flex justify-between items-center border-t border-gray-50 pt-6">
                    <div>
                        <p class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Mulai Dari</p>
                        {{-- Revisi: harga_awal --}}
                        <p class="text-lg font-black text-gray-900 tracking-tighter">
                            Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}
                        </p>
                    </div>

                    {{-- LOGIKA REVISI: Cek Auth --}}
                    @auth
                        <a href="{{ route('user.show', $auction->id) }}" 
                           class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest shadow-md transition transform active:scale-95">
                            Tawar Sekarang
                        </a>
                    @else
                        <a href="{{ route('login') }}" 
                           onclick="return confirm('Anda harus login terlebih dahulu untuk melihat detail dan melakukan penawaran.')"
                           class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2.5 rounded-lg font-black text-xs uppercase tracking-widest shadow-md transition">
                            Login & Tawar
                        </a>
                    @endauth
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