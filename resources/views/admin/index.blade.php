@extends('layouts.app') {{-- Ini menghubungkan ke file layout yang Anda kirim --}}

@section('content')
<div class="space-y-8">
    {{-- Header Dashboard --}}
    <div>
        <h2 class="text-2xl font-bold text-gray-800">Ringkasan Statistik</h2>
        <p class="text-gray-500 text-sm">Pantau aktivitas lelang hari ini.</p>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Barang</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $stats['total_barang'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-green-50 text-green-600 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Lelang Aktif</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $stats['lelang_active'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-orange-50 text-orange-600 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total Bid</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $stats['total_bid'] }}</h3>
                </div>
            </div>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition">
            <div class="flex items-center gap-4">
                <div class="p-3 bg-purple-50 text-purple-600 rounded-xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-xs text-gray-400 font-bold uppercase tracking-wider">Total User</p>
                    <h3 class="text-2xl font-black text-gray-800">{{ $stats['total_user'] }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel Monitoring Cepat --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h3 class="font-bold text-gray-800">5 Lelang Terakhir</h3>
            <a href="{{ route('admin.auctions.index') }}" class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-gray-400 text-[10px] uppercase font-bold tracking-widest">
                    <tr>
                        <th class="px-6 py-4">Barang</th>
                        <th class="px-6 py-4">Harga Akhir</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @foreach(\App\Models\Auction::latest()->take(5)->get() as $auction)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-bold text-gray-700">{{ $auction->item->nama }}</td>
                        <td class="px-6 py-4 font-mono text-blue-600 font-bold">Rp {{ number_format($auction->harga_akhir ?? $auction->item->harga_awal, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase {{ $auction->status == 'dibuka' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                                {{ $auction->status }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
