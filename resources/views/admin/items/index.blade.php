@extends('layouts.app')

@section('header', 'Manajemen Barang Lelang')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h3 class="font-bold text-gray-800 text-lg">Daftar Data Barang Lelang</h3>
            <p class="text-xs text-gray-500 mt-1">Kelola identitas fisik dan informasi dasar barang lelang Anda di sini.</p>
        </div>
        <a href="{{ route('admin.items.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg text-sm font-bold transition flex items-center gap-2 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
            Tambah Item Baru
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-bold border-b text-center">No</th>
                    <th class="px-6 py-4 font-bold border-b">Identitas Barang</th>
                    <th class="px-6 py-4 font-bold border-b">Deskripsi Barang</th>
                    <th class="px-6 py-4 font-bold border-b text-right">Harga Awal</th>
                    <th class="px-6 py-4 font-bold border-b text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($items as $index => $item)
                <tr class="hover:bg-blue-50/30 transition group">
                    <td class="px-6 py-4 text-sm text-gray-500 text-center font-medium">
                        {{ $index + 1 }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0 border-2 border-white shadow-sm group-hover:border-blue-200 transition">
                                @if($item->foto)
                                    <img src="{{ asset('images/items/' . $item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->nama) }}&background=0D8ABC&color=fff&bold=true" alt="placeholder" class="w-full h-full object-cover">
                                @endif
                            </div>
                            
                            <div>
                                <div class="font-bold text-gray-900 text-sm group-hover:text-blue-600 transition">{{ $item->nama }}</div>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-[10px] text-gray-400 font-mono bg-gray-100 px-1.5 py-0.5 rounded">ID: #{{ $item->id }}</span>
                                    <span class="text-[10px] text-blue-500 font-medium italic">Dibuat: {{ $item->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-xs text-gray-600 leading-relaxed italic">
                            {{ Str::limit($item->deskripsi_barang ?? 'Tidak ada deskripsi.', 50) }}
                        </p>
                    </td>
                    <td class="px-6 py-4 text-sm font-extrabold text-gray-800 text-right">
                        <span class="text-gray-400 font-normal mr-0.5 text-xs">Rp</span>{{ number_format($item->harga_awal, 0, ',', '.') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex justify-center gap-1.5">
                            <a href="{{ route('admin.items.show', $item->id) }}" class="p-2 text-blue-600 hover:bg-blue-600 hover:text-white rounded-lg transition-all duration-200 border border-blue-100" title="Detail">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                            </a>
                            <a href="{{ route('admin.items.edit', $item->id) }}" class="p-2 text-amber-600 hover:bg-amber-600 hover:text-white rounded-lg transition-all duration-200 border border-amber-100" title="Edit">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                            </a>
                            <form action="{{ route('admin.items.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus barang ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-600 hover:text-white rounded-lg transition-all duration-200 border border-red-100">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-6 py-12 text-center text-gray-400 italic">Gudang data masih kosong.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection