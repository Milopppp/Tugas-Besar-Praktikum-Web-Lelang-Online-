<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100" x-data="{ sidebarOpen: true }">
    <div class="flex min-h-screen">
        
        <aside 
            :class="sidebarOpen ? 'w-64' : 'w-20'" 
            class="bg-slate-900 text-white transition-all duration-300 flex-shrink-0 flex flex-col shadow-xl z-50">
            
            <div class="h-16 flex items-center justify-between px-4 bg-slate-950 border-b border-slate-800">
                <span x-show="sidebarOpen" x-transition.opacity class="font-bold text-lg overflow-hidden whitespace-nowrap tracking-wider">
                    LELANG <span class="text-blue-500">PRO</span>
                </span>
                <button @click="sidebarOpen = !sidebarOpen" class="p-2 hover:bg-slate-800 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <nav class="flex-1 mt-4 space-y-1 px-2">
                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-4 whitespace-nowrap font-medium">Dashboard</span>
                </a>

                <a href="{{ route('admin.items.index') }}" 
                   class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 transition-all duration-200 {{ request()->routeIs('admin.items.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-4 whitespace-nowrap font-medium">Data Barang</span>
                </a>

                <a href="{{ route('admin.auctions.index') }}" 
                   class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 transition-all duration-200 {{ request()->routeIs('admin.auctions.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-4 whitespace-nowrap font-medium">Data Lelang</span>
                </a>

                <a href="{{ route('admin.users.index') }}" 
                   class="flex items-center py-3 px-4 rounded-lg hover:bg-slate-800 transition-all duration-200 {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 text-white shadow-lg' : 'text-slate-400' }}">
                    <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <span x-show="sidebarOpen" class="ml-4 whitespace-nowrap font-medium">Data Pengguna</span>
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800" x-show="sidebarOpen">
                <div class="bg-slate-800 rounded-lg p-3 text-[10px] text-slate-400 text-center">
                    &copy; 2026 Lelang Online System
                </div>
            </div>
        </aside>

        <div class="flex-1 flex flex-col min-w-0">
            
            <header class="h-16 bg-white shadow-sm flex items-center justify-between px-8 border-b border-gray-100">
                <div class="text-sm text-gray-400 font-medium">
                    <span class="text-gray-600 font-bold uppercase tracking-wider text-[11px]">{{ date('l, d F Y') }}</span> 
                    <span class="mx-2 text-gray-300">|</span> 
                    <span id="clock" class="text-blue-600 font-mono font-bold"></span>
                </div>

                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center gap-3 focus:outline-none group">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-bold text-gray-800 leading-none group-hover:text-blue-600 transition">{{ Auth::user()->name }}</p>
                            <p class="text-[10px] text-blue-500 font-bold uppercase tracking-tighter">Administrator</p>
                        </div>
                        <img class="h-10 w-10 rounded-full border-2 border-blue-500 p-0.5 group-hover:scale-105 transition duration-200" 
                             src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3b82f6&color=fff" alt="Profile">
                    </button>

                    <div x-show="open" 
                         @click.away="open = false" 
                         x-transition:enter="transition ease-out duration-100"
                         x-transition:enter-start="transform opacity-0 scale-95"
                         x-transition:enter-end="transform opacity-100 scale-100"
                         class="absolute right-0 mt-3 w-52 bg-white border border-gray-100 rounded-xl shadow-2xl py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-50 mb-1">
                            <p class="text-[10px] text-gray-400 uppercase font-bold">Pengaturan Akun</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profil Saya
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition font-bold">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Logout / Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <main class="p-8 flex-1 overflow-y-auto">
                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded-lg shadow-sm flex items-center gap-3 animate-pulse">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="text-sm font-bold">{{ session('success') }}</span>
                    </div>
                @endif

                @isset($header)
                    <div class="mb-8 border-b border-gray-200 pb-4">
                        <h2 class="text-3xl font-black text-gray-800 tracking-tight">{{ $header }}</h2>
                    </div>
                @endisset

                <div class="animate-in fade-in duration-500">
                    {{ $slot ?? '' }}
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { hour12: false });
            document.getElementById('clock').innerText = timeString;
        }
        setInterval(updateClock, 1000);
        updateClock();
    </script>
</body>
</html>