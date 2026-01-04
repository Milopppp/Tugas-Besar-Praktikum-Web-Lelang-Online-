<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">
            LELANG <span class="text-indigo-600">PRO</span>
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Buat akun untuk mulai melelang</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-10">
        <form method="POST" action="{{ route('register') }}" class="space-y-5">
            @csrf

            {{-- Nama --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Nama Lengkap
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                       placeholder="Nama Lengkap Anda">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            {{-- Email --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Email Address
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                       placeholder="nama@email.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            {{-- Phone --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Nomor HP
                </label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" required autocomplete="tel"
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                       placeholder="08xxxxxxxxxx">
                <x-input-error :messages="$errors->get('phone')" class="mt-2" />
            </div>

            {{-- Address --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Alamat
                </label>
                <textarea id="address" name="address" required
                          class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                          placeholder="Alamat lengkap">{{ old('address') }}</textarea>
                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Password
                </label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            {{-- Konfirmasi Password --}}
            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">
                    Konfirmasi Password
                </label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none placeholder:text-slate-300"
                       placeholder="••••••••">
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <button type="submit"
                    class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all duration-300 transform active:scale-[0.97] mt-4">
                {{ __('Daftar Sekarang') }}
            </button>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-sm text-slate-500 font-medium">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:text-indigo-700 transition-colors">
                Login di sini
            </a>
        </p>
    </div>
</x-guest-layout>
