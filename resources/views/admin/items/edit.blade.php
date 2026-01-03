@extends('layouts.app')

@section('header', 'Edit Barang Lelang')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-lg">Edit Identitas Barang</h3>
            <p class="text-xs text-gray-500 mt-1">Ubah informasi fisik atau foto barang di bawah ini.</p>
        </div>

        <form action="{{ route('admin.items.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div x-data="{ photoPreview: null }">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Barang</label>
                    <div class="flex flex-col items-center justify-center w-full">
                        <div class="mb-4 relative w-full h-64 border rounded-xl overflow-hidden shadow-sm bg-gray-100">
                            <template x-if="photoPreview">
                                <img :src="photoPreview" class="w-full h-full object-contain">
                            </template>
                            
                            <template x-if="!photoPreview">
                                @if($item->foto)
                                    <img src="{{ asset('images/items/' . $item->foto) }}" class="w-full h-full object-contain">
                                @else
                                    <div class="flex items-center justify-center h-full text-gray-400 font-bold uppercase italic">Belum ada foto</div>
                                @endif
                            </template>
                        </div>

                        <label class="w-full flex justify-center items-center px-4 py-2 bg-white text-blue-700 rounded-lg border border-blue-700 hover:bg-blue-50 cursor-pointer transition text-sm font-bold shadow-sm">
                            <span>Ganti Foto Barang</span>
                            <input type="file" name="foto" x-ref="photoInput" class="hidden" accept="image/*" 
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = (e) => { photoPreview = e.target.result; };
                                        reader.readAsDataURL(file);
                                    }
                                " />
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Barang</label>
                    <input type="text" name="nama" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" value="{{ old('nama', $item->nama) }}" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Awal</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm font-bold">Rp</span>
                        <input type="number" step="0.01" name="harga_awal" class="w-full pl-10 border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" value="{{ old('harga_awal', $item->harga_awal) }}" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Barang</label>
                    <textarea name="deskripsi" rows="6" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5">{{ old('deskripsi', $item->deskripsi_barang) }}</textarea>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.items.index') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition">
                    Batal
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg text-sm font-bold shadow-sm transition">
                    Perbarui Barang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection