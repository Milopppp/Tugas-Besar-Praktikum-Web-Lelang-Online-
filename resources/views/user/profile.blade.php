@extends('layouts.user')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-16">
    <div class="bg-white rounded-3xl shadow-2xl p-12 border border-gray-100">
<<<<<<< HEAD

=======
        
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
        <h1 class="text-4xl font-black text-gray-900 uppercase italic mb-2">Profil Saya</h1>
        <p class="text-gray-500 mb-8">Kelola informasi akun Anda</p>

        {{-- Alert Success --}}
        @if(session('status') === 'profile-updated')
            <div class="bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 p-4 mb-6 rounded-r-xl font-bold">
                Profil berhasil diupdate!
            </div>
        @endif

        {{-- Form Update Profile --}}
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PATCH')

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Nama Lengkap</label>
<<<<<<< HEAD
                <input
                    type="text"
                    name="name"
=======
                <input 
                    type="text" 
                    name="name" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                    value="{{ old('name', $user->name) }}"
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition @error('name') border-red-500 @enderror"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Email</label>
<<<<<<< HEAD
                <input
                    type="email"
                    name="email"
=======
                <input 
                    type="email" 
                    name="email" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                    value="{{ old('email', $user->email) }}"
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition @error('email') border-red-500 @enderror"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                @enderror
<<<<<<< HEAD

=======
                
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                @if($user->email_verified_at === null)
                    <p class="text-amber-600 text-sm mt-2 font-semibold">⚠️ Email belum diverifikasi.</p>
                @endif
            </div>

<<<<<<< HEAD
            {{-- Nomor HP --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                    Nomor HP
                </label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3
                           focus:border-teal-600 focus:ring-0 transition
                           @error('phone') border-red-500 @enderror"
                    placeholder="Contoh: 0812xxxxxxx"
                >
                @error('phone')
                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

            {{-- Alamat Lengkap --}}
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">
                    Alamat Lengkap
                </label>
                <textarea
                    name="address"
                    rows="3"
                    class="w-full border-2 border-gray-200 rounded-xl px-4 py-3
                           focus:border-teal-600 focus:ring-0 transition
                           @error('address') border-red-500 @enderror"
                    placeholder="Tulis alamat lengkap untuk pengiriman / konfirmasi"
                >{{ old('address', $user->address) }}</textarea>
                @error('address')
                    <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                @enderror
            </div>

=======
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
            <hr class="border-gray-200">

            {{-- Info Role --}}
            <div class="bg-teal-50 p-4 rounded-xl">
                <p class="text-xs text-teal-600 font-bold uppercase mb-1">Role Akun</p>
                <p class="text-teal-800 font-black text-lg uppercase">{{ $user->role ?? 'User' }}</p>
            </div>

            {{-- Buttons --}}
            <div class="flex gap-4">
<<<<<<< HEAD
                <button
                    type="submit"
=======
                <button 
                    type="submit" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                    class="flex-1 bg-teal-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-teal-700 shadow-lg transition transform active:scale-95"
                >
                    Simpan Perubahan
                </button>
<<<<<<< HEAD

                <a
                    href="{{ route('user.index') }}"
=======
                
                <a 
                    href="{{ route('user.index') }}" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                    class="flex-1 bg-gray-200 text-gray-700 font-black py-4 rounded-xl uppercase tracking-widest hover:bg-gray-300 transition text-center flex items-center justify-center"
                >
                    Batal
                </a>
            </div>
        </form>

        {{-- Update Password Section --}}
        <div class="mt-12 pt-12 border-t-2 border-gray-100">
            <h2 class="text-2xl font-black text-gray-900 uppercase mb-6">Ubah Password</h2>
<<<<<<< HEAD

=======
            
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
            <form action="{{ route('password.update') }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                {{-- Current Password --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Password Saat Ini</label>
<<<<<<< HEAD
                    <input
                        type="password"
                        name="current_password"
=======
                    <input 
                        type="password" 
                        name="current_password" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition @error('current_password', 'updatePassword') border-red-500 @enderror"
                        required
                    >
                    @error('current_password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- New Password --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Password Baru</label>
<<<<<<< HEAD
                    <input
                        type="password"
                        name="password"
=======
                    <input 
                        type="password" 
                        name="password" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition @error('password', 'updatePassword') border-red-500 @enderror"
                        required
                    >
                    @error('password', 'updatePassword')
                        <p class="text-red-500 text-sm mt-1 font-semibold">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Confirm Password --}}
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2 uppercase tracking-wide">Konfirmasi Password Baru</label>
<<<<<<< HEAD
                    <input
                        type="password"
                        name="password_confirmation"
=======
                    <input 
                        type="password" 
                        name="password_confirmation" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                        class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:border-teal-600 focus:ring-0 transition"
                        required
                    >
                </div>

<<<<<<< HEAD
                <button
                    type="submit"
=======
                <button 
                    type="submit" 
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
                    class="w-full bg-amber-600 text-white font-black py-4 rounded-xl uppercase tracking-widest hover:bg-amber-700 shadow-lg transition transform active:scale-95"
                >
                    Update Password
                </button>
            </form>
        </div>

    </div>
</div>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> e5bb699c675c6a38838ff727ce6e89181db2ee63
