@extends('layouts.app')

@section('header', 'Buka Lelang Baru')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-800 text-lg">Buka Sesi Penawaran</h3>
            <p class="text-xs text-gray-500 mt-1">Pilih barang dan tentukan durasi lelang agar masyarakat bisa mulai menawar.</p>
        </div>

        <form action="{{ route('admin.auctions.store') }}" method="POST" class="p-8 space-y-6">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Pilih Barang yang Akan Dilelang</label>
                    <select name="item_id" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" required>
                        <option value="" disabled selected>-- Pilih Barang --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}">
                                {{ $item->nama }} (Harga Awal: Rp {{ number_format($item->harga_awal, 0, ',', '.') }})
                            </option>
                        @endforeach
                    </select>
                    @error('item_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Mulai Lelang</label>
                        <input type="datetime-local" name="tgl_lelang" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" value="{{ date('Y-m-d\TH:i') }}" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Batas Waktu Penutupan</label>
                        <input type="datetime-local" name="tgl_akhir" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5" required>
                        <p class="text-[10px] text-gray-400 mt-1 italic">*Masyarakat tidak bisa menawar setelah waktu ini habis.</p>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Status Awal</label>
                    <select name="status" class="w-full border-gray-200 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 transition p-2.5">
                        <option value="dibuka">Buka Sekarang (Masyarakat bisa langsung tawar)</option>
                        <option value="ditutup">Draft (Tutup Dahulu)</option>
                    </select>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                <a href="{{ route('admin.auctions.index') }}" class="px-6 py-2.5 text-sm font-bold text-gray-500 hover:text-gray-700 transition">Batal</a>
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-8 py-2.5 rounded-lg text-sm font-bold shadow-sm transition">Aktifkan Lelang</button>
            </div>
        </form>
    </div>
</div>
@endsection