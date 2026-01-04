<x-guest-layout>
    <div class="text-center mb-8">
        <h1 class="text-3xl font-black text-slate-900 tracking-tight">
            LELANG <span class="text-indigo-600">PRO</span>
        </h1>
        <p class="text-slate-500 mt-2 font-medium">Silakan masuk untuk mengelola lelang</p>
    </div>

    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 border border-slate-100 p-8 md:p-10">
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Email Address</label>
                <input id="email" type="email" name="email" :value="old('email')" required autofocus
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-300"
                    placeholder="nama@email.com">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <div class="flex justify-between mb-2 ml-1">
                    <label class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">Password</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-[11px] font-bold text-indigo-600 hover:text-indigo-700 transition-colors">Lupa Password?</a>
                    @endif
                </div>
                <input id="password" type="password" name="password" required
                    class="w-full px-5 py-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all duration-200 outline-none placeholder:text-slate-300"
                    placeholder="••••••••">
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center ml-1">
                <input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500/20 transition-all">
                <label for="remember_me" class="ml-3 text-sm font-semibold text-slate-600 cursor-pointer">Ingat saya</label>
            </div>

            <button type="submit" class="w-full bg-slate-900 hover:bg-indigo-600 text-white font-bold py-4 rounded-2xl shadow-lg shadow-indigo-200 transition-all duration-300 transform active:scale-[0.97]">
                Masuk Sekarang
            </button>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-sm text-slate-500 font-medium">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:text-indigo-700 transition-colors">Daftar Sekarang</a>
        </p>
    </div>
</x-guest-layout>
