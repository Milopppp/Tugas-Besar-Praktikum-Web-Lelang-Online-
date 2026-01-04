<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Lelang Pro - Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-slate-50 font-sans text-slate-900">
    <div class="min-h-screen flex flex-col justify-center items-center p-6 py-12">
        <div class="w-full max-w-[440px]">
            {{ $slot }}
        </div>

        <p class="mt-8 text-[10px] text-slate-400 text-center uppercase tracking-[0.2em] font-bold">
            &copy; {{ date('Y') }} Lelang Online System
        </p>
    </div>
</body>
</html>
