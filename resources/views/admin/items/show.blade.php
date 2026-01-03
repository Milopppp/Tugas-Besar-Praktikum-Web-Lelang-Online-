@extends('layouts.app') {{-- Sesuaikan dengan layout admin Anda --}}

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4">
    <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
        <div class="bg-teal-700 p-6">
            <h2 class="text-white text-2xl font-bold uppercase tracking-wider">Detail Barang</h2>
        </div>
        
        <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-10">
            {{-- Foto Barang --}}
            <div>
                @if($item->foto)
                    <img src="{{ asset('images/items/' . $item->foto) }}" class="w-full rounded-xl shadow-md border">
                @else
                    <img src="https://via.placeholder.com/400" class="w-full rounded-xl opacity-50">
                @endif
            </div>

            {{-- Informasi Barang --}}
            <div class="space-y-4">
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Nama Barang</label>
                    <p class="text-xl font-bold text-gray-800">{{ $item->nama_barang }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Harga Awal</label>
                    <p class="text-lg font-bold text-teal-600">Rp {{ number_format($item->harga_awal, 0, ',', '.') }}</p>
                </div>
                <div>
                    <label class="text-[10px] font-black uppercase text-gray-400 tracking-widest">Deskripsi</label>
                    <p class="text-gray-600 leading-relaxed italic">{{ $item->deskripsi_barang }}</p>
                </div>
                
                <div class="pt-6">
                    <a href="{{ route('admin.items.index') }}" class="bg-gray-800 text-white px-6 py-2 rounded-lg text-xs font-bold uppercase hover:bg-black transition">
                        Kembali ke Daftar
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection