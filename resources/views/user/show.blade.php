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

            {{-- Pesan Alert Sukses/Gagal --}}
            @if(session('success'))
                <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-xl shadow-sm text-sm font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-xl shadow-sm text-sm font-bold">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Form Penawaran --}}
            <form action="{{ route('user.bid.store', $auction->id) }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold uppercase mb-2 tracking-widest text-gray-400">Masukkan Tawaran Anda</label>
                    <input type="number" name="harga_penawaran" required class="w-full border-2 border-gray-100 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition" placeholder="Contoh: 500000">
                    <p class="text-[10px] text-gray-400 mt-2 italic">*Tawaran harus lebih tinggi dari harga awal atau penawar tertinggi sebelumnya.</p>
                </div>
                <button type="submit" class="w-full bg-teal-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-teal-700 shadow-lg transition transform active:scale-95">
                    Kirim Penawaran (Bid)
                </button>
            </form>

            <hr class="my-10 border-gray-100">

            {{-- Riwayat Penawaran --}}
            <div class="mt-8">
                <h3 class="text-lg font-black text-gray-800 uppercase tracking-tight mb-6 flex items-center gap-2">
                    <svg class="w-5 h-5 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Penawaran
                </h3>
                
                <div class="space-y-3 max-h-80 overflow-y-auto pr-2">
                    @forelse($auction->bids()->latest()->get() as $bid)
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl border border-gray-100 transition hover:bg-gray-100">
                            <div>
                                <p class="text-xs font-black text-gray-900 uppercase italic">{{ $bid->user->name }}</p>
                                <p class="text-[10px] text-gray-400 uppercase tracking-tighter">{{ $bid->created_at->diffForHumans() }}</p>
                            </div>
                            <div class="text-right">
                                <p class="font-black text-teal-700">Rp {{ number_format($bid->penawaran_harga, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-8 bg-slate-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <p class="text-gray-400 italic text-sm font-medium">Belum ada penawaran untuk barang ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>
            {{-- End Riwayat --}}

        </div>
    </div>
</div>
@endsection