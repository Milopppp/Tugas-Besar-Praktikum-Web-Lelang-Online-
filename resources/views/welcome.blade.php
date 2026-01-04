<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang - LELANG PRO</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-gray-900 via-blue-900 to-gray-900 min-h-screen">
    
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="text-center max-w-4xl">
            
            {{-- Logo/Icon --}}
            <div class="mb-8">
                <svg class="w-32 h-32 mx-auto text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

            {{-- Title --}}
            <h1 class="text-7xl md:text-8xl font-black text-white mb-4 uppercase tracking-tight">
                LELANG <span class="text-blue-400">PRO</span>
            </h1>
            
            <p class="text-2xl md:text-3xl text-gray-300 mb-4 font-semibold">
                Platform Lelang Online Terpercaya
            </p>
            
            <p class="text-blue-300 mb-12 max-w-2xl mx-auto text-lg">
                Temukan barang berkualitas dengan harga terbaik melalui sistem lelang yang aman dan transparan
            </p>

            {{-- Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                <a href="{{ route('login') }}" 
                   class="w-full sm:w-auto bg-blue-600 text-white px-12 py-5 rounded-xl font-black text-lg uppercase tracking-wide hover:bg-blue-500 transition shadow-2xl transform hover:scale-105">
                    Login
                </a>
                
                <a href="{{ route('register') }}" 
                   class="w-full sm:w-auto bg-gray-800 text-white px-12 py-5 rounded-xl font-black text-lg uppercase tracking-wide hover:bg-gray-700 transition shadow-2xl transform hover:scale-105 border-2 border-gray-700">
                    Register
                </a>
            </div>

            {{-- Features --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white/5 backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-5xl mb-4">🔒</div>
                    <h3 class="text-white font-bold mb-3 text-lg">Aman & Terpercaya</h3>
                    <p class="text-gray-400 text-sm">Transaksi dilindungi sistem keamanan tingkat tinggi</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-5xl mb-4">⚡</div>
                    <h3 class="text-white font-bold mb-3 text-lg">Proses Cepat</h3>
                    <p class="text-gray-400 text-sm">Sistem lelang real-time yang responsif</p>
                </div>
                
                <div class="bg-white/5 backdrop-blur-sm p-8 rounded-2xl border border-white/10 hover:bg-white/10 transition">
                    <div class="text-5xl mb-4">💎</div>
                    <h3 class="text-white font-bold mb-3 text-lg">Barang Berkualitas</h3>
                    <p class="text-gray-400 text-sm">Produk terverifikasi dan berkualitas terjamin</p>
                </div>
            </div>

        </div>
    </div>

</body>
</html>