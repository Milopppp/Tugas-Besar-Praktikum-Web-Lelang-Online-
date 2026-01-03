@extends('layouts.app')

@section('header', 'Detail Aktivitas Lelang')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 bg-gray-100">
                @if($auction->item->foto)
                    <img src="{{ asset('images/items/' . $auction->item->foto) }}" class="w-full h-full object-cover">
                @else
                    <div class="flex items-center justify-center h-48 text-gray-400">Tidak ada foto</div>
                @endif
            </div>
            <div class="p-6 md:w-2/3 space-y-3">
                <div class="flex justify-between items-start">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800">{{ $auction->item->nama }}</h2>
                        <p class="text-sm text-gray-500">Status: 
                            <span class="font-bold uppercase {{ $auction->status == 'dibuka' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $auction->status }}
                            </span>
                        </p>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 uppercase font-bold tracking-wider">Harga Awal</p>
                        <p class="text-xl font-bold text-blue-600">Rp {{ number_format($auction->item->harga_awal, 0, ',', '.') }}</p>
                    </div>
                </div>
                <hr class="border-gray-100">
                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400">Waktu Dibuka:</p>
                        <p class="font-semibold">{{ \Carbon\Carbon::parse($auction->tgl_lelang)->format('d M Y, H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400">Batas Penutupan:</p>
                        <p class="font-semibold text-red-600">{{ \Carbon\Carbon::parse($auction->tgl_akhir)->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800 flex items-center gap-2">
                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                Peringkat 10 Penawar Tertinggi
            </h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="text-xs uppercase text-gray-400 bg-gray-50/50">
                        <th class="px-6 py-3 font-bold">Rank</th>
                        <th class="px-6 py-3 font-bold">Nama Penawar</th>
                        <th class="px-6 py-3 font-bold">Waktu Bid</th>
                        <th class="px-6 py-3 font-bold text-right">Harga Tawaran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($auction->bids as $index => $bid)
                    <tr class="{{ $index == 0 ? 'bg-amber-50/50' : '' }} hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            @if($index == 0)
                                <span class="flex items-center justify-center w-6 h-6 bg-amber-400 text-white rounded-full text-xs font-bold">1</span>
                            @else
                                <span class="text-gray-500 font-medium">{{ $index + 1 }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800">{{ $bid->user->name }}</div>
                            <div class="text-[10px] text-gray-400">{{ $bid->user->email }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            {{ $bid->created_at->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="font-bold {{ $index == 0 ? 'text-amber-600 text-lg' : 'text-gray-700' }}">
                                Rp {{ number_format($bid->penawaran_harga, 0, ',', '.') }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">Belum ada penawaran untuk barang ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="flex justify-start">
        <a href="{{ route('admin.auctions.index') }}" class="text-sm font-bold text-gray-500 hover:text-gray-800 flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar Lelang
        </a>
    </div>
</div>
@endsection