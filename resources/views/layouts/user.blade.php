<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LELANG PRO')</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">

    {{-- Navbar: Dibuat Transparan dengan Efek Blur --}}
    <nav class="bg-slate-800/90 backdrop-blur-md sticky top-0 z-50 shadow-lg border-b border-white/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                {{-- Logo --}}
                <a href="{{ route('user.index') }}" class="flex items-center gap-3 group transition">
                    <div class="bg-blue-600 p-2 rounded-xl group-hover:bg-blue-500 transition-colors">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span class="text-xl font-black text-white uppercase tracking-tighter italic">LELANG <span class="text-blue-400">PRO</span></span>
                </a>

                {{-- Menu Navigation --}}
                <div class="hidden md:flex items-center gap-8">
                    @php
                        $linkClass = "text-[11px] font-bold uppercase tracking-[0.2em] transition-all duration-300";
                        $activeClass = "text-blue-400";
                        $inactiveClass = "text-gray-300 hover:text-white";
                    @endphp

                    <a href="{{ route('user.index') }}" class="{{ $linkClass }} {{ request()->routeIs('user.index') ? $activeClass : $inactiveClass }}">
                        Daftar Lelang
                    </a>
                    <a href="{{ route('user.history.bid') }}" class="{{ $linkClass }} {{ request()->routeIs('user.history.bid') ? $activeClass : $inactiveClass }}">
                        History Bid
                    </a>
                    <a href="{{ route('user.winners') }}" class="{{ $linkClass }} {{ request()->routeIs('user.winners') ? $activeClass : $inactiveClass }}">
                        Daftar Pemenang
                    </a>
                </div>

                {{-- User Profile / Auth Section --}}
                <div class="flex items-center">
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-3 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-2xl transition border border-white/10 group">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <span class="text-white font-bold text-xs uppercase">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-semibold text-xs hidden sm:block">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform group-hover:text-white" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu: Ikut Transparan --}}
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             class="absolute right-0 mt-3 w-56 bg-slate-800/95 backdrop-blur-lg rounded-2xl shadow-2xl border border-white/10 py-2 overflow-hidden"
                             style="display: none;">

                            <div class="px-4 py-3 border-b border-white/10 bg-white/5 mb-2">
                                <p class="text-gray-300 text-[10px] uppercase font-bold tracking-widest leading-none mb-1">Signed in as</p>
                                <p class="text-white text-xs font-semibold truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-xs font-medium text-gray-200 hover:text-white hover:bg-blue-600 transition mx-2 rounded-xl">
                                <span>Profil Saya</span>
                            </a>

                            <div class="my-2 border-t border-white/10"></div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-[calc(100%-1rem)] flex items-center gap-3 px-4 py-2 text-xs font-bold text-red-300 hover:bg-red-500/20 transition mx-2 rounded-xl text-left">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="flex items-center gap-4">
                        <a href="{{ route('login') }}" class="text-xs font-bold text-gray-300 hover:text-white transition uppercase tracking-widest">Login</a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2.5 rounded-xl font-bold text-xs uppercase tracking-widest hover:bg-blue-500 transition shadow-lg shadow-blue-500/20">Register</a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="flex-grow">
        @yield('content')
    </main>

    {{-- Footer: Transparan (Hanya warna latar belakang, tidak sticky) --}}
    <footer class="bg-slate-800/95 border-t border-white/10 text-white pt-16 pb-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xl font-black uppercase italic mb-6">LELANG <span class="text-blue-400">PRO</span></h3>
                    <p class="text-gray-300 text-sm font-light max-w-sm leading-relaxed italic">
                        Platform lelang terpercaya dengan kurasi barang eksklusif untuk kolektor profesional.
                    </p>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-8 font-black">Navigasi</h4>
                    <ul class="space-y-4 text-[11px] font-bold text-gray-200 uppercase tracking-widest">
                        <li><a href="{{ route('user.index') }}" class="hover:text-blue-400 transition">Katalog</a></li>
                        <li><a href="{{ route('user.history.bid') }}" class="hover:text-blue-400 transition">History Bid</a></li>
                        <li><a href="{{ route('user.winners') }}" class="hover:text-blue-400 transition">Daftar Pemenang</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-[10px] font-bold uppercase tracking-[0.3em] text-gray-400 mb-8 font-black">Hubungi Kami</h4>
                    <ul class="space-y-3 text-[11px] font-medium text-gray-300 tracking-widest uppercase">
                        <li>info@lelangpro.com</li>
                        <li>Garut, Indonesia</li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-center">
                <p class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">
                    © {{ date('Y') }} LELANG PRO Studio. All Rights Reserved.
                </p>
                <div class="flex gap-8">
                    <span class="text-[10px] font-bold text-gray-500 hover:text-white cursor-pointer transition uppercase tracking-widest">Privacy</span>
                    <span class="text-[10px] font-bold text-gray-500 hover:text-white cursor-pointer transition uppercase tracking-widest">Terms</span>
                </div>
            </div>
        </div>
    </footer>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
