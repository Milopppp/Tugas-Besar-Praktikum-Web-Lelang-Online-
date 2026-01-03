@extends('layouts.user')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-16">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 grid grid-cols-1 md:grid-cols-2">
        {{-- Gambar Barang --}}
        <div class="bg-slate-100 p-8 flex items-center justify-center">
            @if($auction->item->foto)
                <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full rounded-2xl shadow-lg">
            @else
                <img src="https://via.placeholder.com/600x400" class="w-full rounded-2xl opacity-50">
            @endif
        </div>

        {{-- Detail Bid --}}
        <div class="p-12">
            <h1 class="text-4xl font-black text-gray-900 uppercase italic mb-4">{{ $auction->item->nama }}</h1>
            <p class="text-gray-500 italic mb-8 leading-relaxed">{{ $auction->item->deskripsi_barang }}</p>

            <div class="bg-teal-50 p-6 rounded-2xl mb-8">
                <p class="text-[10px] text-teal-600 font-black uppercase tracking-widest mb-1">Harga Awal</p>
                <p class="text-3xl font-black text-teal-800 tracking-tighter">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
            </div>

            {{-- Form Penawaran --}}
            <form action="#" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase mb-2 tracking-widest text-gray-400">Masukkan Tawaran Anda</label>
                    <input type="number" name="price" class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition" placeholder="Contoh: 500000">
                </div>
                <button type="submit" class="w-full bg-teal-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-teal-700 shadow-lg transition transform active:scale-95">
                    Kirim Penawaran (Bid)
                </button>
            </form>
        </div>
    </div>
</div>
@endsection