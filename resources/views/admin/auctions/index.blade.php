@extends('layouts.app')

@section('header', 'Data Lelang Aktif')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    {{-- Header Tabel --}}
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h3 class="font-bold text-gray-800 text-lg">Manajemen Sesi Lelang</h3>
            <p class="text-xs text-gray-500 mt-1">Buka atau tutup sesi penawaran barang di sini.</p>
        </div>
        <a href="{{ route('admin.auctions.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Buka Lelang Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-bold border-b">Barang</th>
                    <th class="px-6 py-4 font-bold border-b">Batas Waktu</th>
                    <th class="px-6 py-4 font-bold border-b text-right">Harga Tertinggi</th>
                    <th class="px-6 py-4 font-bold border-b text-center">Status</th>
                    <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($auctions as $auction)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-900">{{ $auction->item->nama }}</div>
                        <div class="text-[10px] text-gray-400 font-medium uppercase">Awal: Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 font-medium">
                        {{ \Carbon\Carbon::parse($auction->tgl_akhir)->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-right font-black text-blue-600">
                        Rp {{ number_format($auction->harga_akhir ?? $auction->item->harga_awal, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $auction->status == 'dibuka' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                            {{ $auction->status }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex justify-center gap-2">
                            {{-- Fitur Laporan PDF (Perbaikan: diletakkan di dalam loop) --}}
                            <a href="{{ route('admin.auctions.report', $auction->id) }}" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" title="Cetak Laporan PDF">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 9h1.5m1.5 0H13m-4 4h4m-4 4h4"/></svg>
                            </a>

                            <a href="{{ route('admin.auctions.show', $auction->id) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Lihat Detail Penawar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>

                            <a href="{{ route('admin.auctions.edit', $auction->id) }}" class="p-2 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Ubah Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </a>

                            <form action="{{ route('admin.auctions.destroy', $auction->id) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition" onclick="return confirm('Hapus sesi lelang ini?')" title="Hapus">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <svg class="w-12 h-12 text-gray-200 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                            <p class="text-gray-400 font-medium">Belum ada sesi lelang yang aktif.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection