<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LELANG PRO')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    {{-- Navbar --}}
    <nav class="bg-gray-800 shadow-2xl sticky top-0 z-50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                
                {{-- Logo --}}
                <a href="{{ route('user.index') }}" class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-2xl font-black text-white uppercase tracking-tight">LELANG <span class="text-blue-400">PRO</span></span>
                </a>

                {{-- Menu Navigation --}}
                <div class="flex items-center gap-6">
                    <a href="{{ route('user.index') }}" class="text-gray-300 hover:text-white font-semibold uppercase text-sm tracking-wide transition {{ request()->routeIs('user.index') ? 'text-blue-400 border-b-2 border-blue-400' : '' }}">
                        Daftar Lelang
                    </a>
                    <a href="{{ route('user.history.bid') }}" class="text-gray-300 hover:text-white font-semibold uppercase text-sm tracking-wide transition {{ request()->routeIs('user.history.bid') ? 'text-blue-400 border-b-2 border-blue-400' : '' }}">
                        History Bid
                    </a>
                    <a href="{{ route('user.winners') }}" class="text-gray-300 hover:text-white font-semibold uppercase text-sm tracking-wide transition {{ request()->routeIs('user.winners') ? 'text-blue-400 border-b-2 border-blue-400' : '' }}">
                        Daftar Pemenang
                    </a>

                    {{-- User Profile Dropdown --}}
                    @auth
                    <div class="relative" x-data="{ open: false }">
                        {{-- Profile Button --}}
                        <button @click="open = !open" class="flex items-center gap-2 bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded-lg transition border border-gray-600">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <span class="text-white font-semibold text-sm">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-400 transition-transform" :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        {{-- Dropdown Menu --}}
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 mt-2 w-64 bg-gray-800 rounded-xl shadow-2xl border border-gray-700 overflow-hidden"
                             style="display: none;">
                            
                            {{-- Header --}}
                            <div class="bg-gray-700 px-4 py-3 border-b border-gray-600">
                                <p class="text-gray-400 text-xs uppercase tracking-wide font-bold mb-1">Pengaturan Akun</p>
                                <p class="text-white text-sm font-semibold">{{ auth()->user()->name }}</p>
                                <p class="text-gray-400 text-xs">{{ auth()->user()->email }}</p>
                            </div>

                            {{-- Menu Items --}}
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-700 transition group">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="text-gray-300 font-semibold text-sm group-hover:text-white transition">Profil Saya</span>
                                </a>

                                <hr class="my-2 border-gray-700">

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-red-900/20 transition group">
                                        <svg class="w-5 h-5 text-gray-400 group-hover:text-red-400 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                        </svg>
                                        <span class="text-gray-300 font-semibold text-sm group-hover:text-red-400 transition">Logout / Keluar</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    {{-- Jika belum login --}}
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}" class="bg-gray-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-600 transition border border-gray-600">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-500 transition">
                            Register
                        </a>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <main class="min-h-screen">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-800 text-white py-8 border-t border-gray-700">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                {{-- Kolom 1 --}}
                <div>
                    <h3 class="text-xl font-black uppercase mb-4">LELANG <span class="text-blue-400">PRO</span></h3>
                    <p class="text-gray-400 text-sm">Platform lelang online terpercaya untuk barang berkualitas dengan harga terbaik.</p>
                </div>
                
                {{-- Kolom 2 --}}
                <div>
                    <h4 class="font-bold uppercase mb-4 text-sm text-gray-300">Menu</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ route('user.index') }}" class="text-gray-400 hover:text-blue-400 transition">Daftar Lelang</a></li>
                        <li><a href="{{ route('user.history.bid') }}" class="text-gray-400 hover:text-blue-400 transition">History Bid</a></li>
                        <li><a href="{{ route('user.winners') }}" class="text-gray-400 hover:text-blue-400 transition">Daftar Pemenang</a></li>
                    </ul>
                </div>
                
                {{-- Kolom 3 --}}
                <div>
                    <h4 class="font-bold uppercase mb-4 text-sm text-gray-300">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>Email: info@lelangpro.com</li>
                        <li>Telp: (021) 1234-5678</li>
                        <li>Alamat: Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            
            <hr class="border-gray-700 mb-4">
            
            <div class="text-center">
                <p class="text-gray-400 text-sm">© {{ date('Y') }} <span class="font-bold">LELANG PRO</span>. All rights reserved.</p>
            </div>
        </div>
    </footer>

    {{-- Alpine.js for Dropdown --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>