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
                    <div class="flex items-center gap-2">
                        <svg class="w-8 h-8 text-teal-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                        <span class="font-black text-xl tracking-tighter uppercase italic">NGAB AUCTION</span>
                    </div>
                    <div class="hidden md:flex gap-8 text-xs font-bold uppercase tracking-widest">
                        <a href="{{ route('user.index') }}" class="hover:text-teal-300 transition {{ request()->routeIs('user.index') ? 'text-teal-300 border-b-2 border-teal-300 pb-1' : '' }}">Daftar Lelang</a>
                        <a href="#" class="hover:text-teal-300 transition">History</a>
                        <a href="#" class="hover:text-teal-300 transition">Daftar Pemenang</a>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    @auth
                        <span class="text-xs font-black bg-teal-800 px-3 py-1 rounded uppercase tracking-tighter">
                            {{ Auth::user()->name }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs font-bold text-teal-200 hover:text-white transition uppercase border-l border-teal-600 pl-4">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs font-bold uppercase tracking-widest hover:text-teal-300 transition">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-teal-800 px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest hover:bg-teal-900 transition">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-slate-500 text-center py-10 mt-20 text-[10px] uppercase font-bold tracking-[0.2em]">
        Copyright &copy; SIS LELANG ONLINE 2026 - All Rights Reserved
    </footer>
</body>
</html>