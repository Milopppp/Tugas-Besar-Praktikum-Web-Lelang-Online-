<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGAB AUCTION</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 font-sans antialiased">
    <nav class="bg-teal-700 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-10">
                    {{-- Logo --}}
                    <a href="{{ route('user.index') }}" class="flex items-center gap-2 group">
                        <svg class="w-8 h-8 text-teal-300 group-hover:scale-110 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span class="font-black text-xl tracking-tighter uppercase italic">NGAB AUCTION</span>
                    </a>

                    {{-- Menu Navigasi --}}
                    <div class="hidden md:flex gap-8 text-xs font-bold uppercase tracking-widest">
                        <a href="{{ route('user.index') }}" class="hover:text-teal-300 transition {{ request()->routeIs('user.index') ? 'text-teal-300 border-b-2 border-teal-300 pb-1' : '' }}">
                            Daftar Lelang
                        </a>
                        
                        {{-- Hanya tampilkan History & Pemenang jika sudah login --}}
                        @auth
                            <a href="#" class="hover:text-teal-300 transition">History Bid</a>
                            <a href="#" class="hover:text-teal-300 transition">Daftar Pemenang</a>
                            
                            {{-- Link Tambahan jika Admin sedang melihat tampilan User --}}
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="text-orange-400 hover:text-orange-300 transition underline underline-offset-4">
                                    Kembali Ke Panel Admin
                                </a>
                            @endif
                        @endauth
                    </div>
                </div>

                {{-- Bagian Kanan: User Profile / Login --}}
                <div class="flex items-center gap-4">
                    @auth
                        <div class="flex items-center gap-4">
                            <div class="text-right hidden sm:block">
                                <p class="text-[10px] text-teal-300 font-black uppercase tracking-tighter leading-none">Logged in as</p>
                                <p class="text-xs font-bold uppercase">{{ Auth::user()->name }}</p>
                            </div>
                            
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-xs font-bold text-white bg-teal-800 hover:bg-teal-900 px-4 py-2 rounded-lg transition uppercase tracking-widest shadow-md">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        {{-- Tampilkan jika belum login (Tamu) --}}
                        <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-widest hover:text-teal-300 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-white text-teal-700 px-4 py-2 rounded-lg text-xs font-black uppercase tracking-widest hover:bg-teal-50 transition shadow-md">
                            Daftar Akun
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="min-h-screen">
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-500 text-center py-10 mt-20 text-[10px] uppercase font-bold tracking-[0.2em] border-t border-slate-800">
        Copyright &copy; SIS LELANG ONLINE 2026 - All Rights Reserved
        <p class="mt-2 text-slate-700 normal-case italic font-medium tracking-normal">Built with Laravel 12 & Tailwind CSS</p>
    </footer>
</body>
</html>