@extends('layouts.user')

@section('content')
<div class="bg-[#F8FAFC] min-h-screen">
    {{-- Top Header Section --}}
    <div class="bg-white border-b border-gray-200 px-8 py-6 mb-8 text-center">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold text-[#1E293B] tracking-tight">Pengaturan Profil</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola informasi identitas dan keamanan akun Anda secara terpusat.</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-8 pb-20">

        @if(session('status') === 'profile-updated')
            <div class="mb-8 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 text-sm font-bold rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                Profil Anda berhasil diperbarui.
            </div>
        @endif

        {{-- Container Utama Form (Berada di Tengah) --}}
        <div class="space-y-8">

            {{-- KARTU 1: Informasi Dasar --}}
            <div id="info-dasar" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-bold text-[#1E293B] text-sm uppercase tracking-wider">Informasi Umum</h3>
                    <span class="text-[10px] font-black bg-white border border-gray-200 px-2 py-1 rounded text-gray-400 uppercase">Wajib Diisi</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Nama Lengkap</label>
                            <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition" required>
                            @error('name') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Alamat Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition" required>
                        </div>

                        <div class="md:col-span-1">
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition" placeholder="0812...">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Alamat Domisili</label>
                        <textarea name="address" rows="3"
                            class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition resize-none">{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div class="flex justify-center md:justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="w-full md:w-auto bg-[#1E293B] text-white px-10 py-3.5 rounded-xl text-xs font-bold uppercase tracking-[0.2em] hover:bg-blue-600 transition-all shadow-lg shadow-gray-200 active:scale-95">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

            {{-- KARTU 2: Keamanan --}}
            <div id="keamanan" class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                    <h3 class="font-bold text-[#1E293B] text-sm uppercase tracking-wider">Keamanan Akun</h3>
                </div>

                <form action="{{ route('password.update') }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Kata Sandi Saat Ini</label>
                            <input type="password" name="current_password" class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                            @error('current_password', 'updatePassword') <p class="text-red-500 text-[10px] mt-2 font-bold">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Kata Sandi Baru</label>
                                <input type="password" name="password" class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-wide">Konfirmasi Sandi Baru</label>
                                <input type="password" name="password_confirmation" class="w-full bg-[#F8FAFC] border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-gray-900 focus:ring-2 focus:ring-blue-500 focus:bg-white outline-none transition">
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center md:justify-end pt-4 border-t border-gray-100">
                        <button type="submit" class="w-full md:w-auto bg-blue-600 text-white px-10 py-3.5 rounded-xl text-xs font-bold uppercase tracking-[0.2em] hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 active:scale-95">
                            Perbarui Sandi
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

{{-- Script Smooth Scroll --}}
<style>
    html { scroll-behavior: smooth; }
    input:focus, textarea:focus { border-color: #3b82f6 !important; }
</style>
@endsection
