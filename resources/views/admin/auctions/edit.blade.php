@extends('layouts.app')

@section('header', 'Edit Sesi Lelang')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <h3 class="font-bold text-gray-800 text-lg mb-6">Ubah Pengaturan Lelang: {{ $auction->item->nama }}</h3>
        
        <form action="{{ route('admin.auctions.update', $auction->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Batas Waktu Baru</label>
                <input type="datetime-local" name="tgl_akhir" 
                       value="{{ \Carbon\Carbon::parse($auction->tgl_akhir)->format('Y-m-d\TH:i') }}"
                       class="w-full border-gray-200 rounded-lg p-2.5 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                <select name="status" class="w-full border-gray-200 rounded-lg p-2.5">
                    <option value="dibuka" {{ $auction->status == 'dibuka' ? 'selected' : '' }}>Dibuka</option>
                    <option value="ditutup" {{ $auction->status == 'ditutup' ? 'selected' : '' }}>Ditutup</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('admin.auctions.index') }}" class="px-4 py-2 text-gray-500 font-bold">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection