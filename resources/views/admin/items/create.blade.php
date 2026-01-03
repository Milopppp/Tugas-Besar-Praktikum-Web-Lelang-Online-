@extends('layouts.app')

@section('header', 'Tambah Barang Lelang')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-lg">Identitas Fisik Barang</h3>
            <p class="text-xs text-gray-500 mt-1">Lengkapi foto dan deskripsi barang di sini.</p>
        </div>

        <form action="{{ route('admin.items.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="space-y-4">
                <div x-data="{ photoPreview: null }">
                    <label class="block text-sm font-bold text-gray-700 mb-2">Foto Barang</label>
                    
                    <div class="flex flex-col items-center justify-center w-full">
                        <template x-if="photoPreview">
                            <div class="mb-4 relative w-full h-64 border rounded-xl overflow-hidden shadow-sm bg-gray-100">
                                <img :src="photoPreview" class="w-full h-full object-contain">
                                <button type="button" @click="photoPreview = null; $refs.photoInput.value = ''" 
                                    class="absolute top-2 right-2 bg-red-600 text-white p-1.5 rounded-full shadow-lg hover:bg-red-700 transition">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </template>

                        <label x-show="!photoPreview" class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-xs text-gray-500 font-bold">Klik untuk unggah gambar</p>
                                <p class="text-[10px] text-gray-400 mt-1">JPG, PNG (Maks. 2MB)</p>
                            </div>
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
                    @error('foto') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Nama Barang</label>
                    <input type="text" name="nama" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" placeholder="Contoh: Honda CBR 2021" value="{{ old('nama') }}" required>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Harga Awal</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-sm font-bold">Rp</span>
                        <input type="number" step="0.01" name="harga_awal" class="w-full pl-10 border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" placeholder="0" value="{{ old('harga_awal') }}" required>
                    </div>
                    @error('harga_awal') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Deskripsi Barang</label>
                    <textarea name="deskripsi" rows="6" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" placeholder="Tuliskan spesifikasi lengkap barang...">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.items.index') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg text-sm font-bold shadow-sm transition">Simpan Identitas Barang</button>
            </div>
        </form>
    </div>
</div>
@endsection