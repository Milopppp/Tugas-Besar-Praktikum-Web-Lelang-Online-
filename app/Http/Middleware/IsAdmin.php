<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Jika user belum login, biarkan Laravel menangani lewat middleware 'auth'
        if (!auth()->check()) {
            return $next($request);
        }

        // 2. Jika user adalah ADMIN
        if (auth()->user()->role === 'admin') {
            // Jika admin mencoba akses halaman katalog user atau dashboard default,
            // paksa pindah ke Dashboard Admin
            if ($request->is('katalog') || $request->is('dashboard') || $request->is('/')) {
                return redirect()->route('admin.dashboard');
            }
            return $next($request);
        }

        // 3. Jika user adalah USER (Bukan Admin)
        // Jika user mencoba akses rute yang diawali dengan 'admin/*', tendang ke katalog
        if ($request->is('admin') || $request->is('admin/*')) {
            return redirect()->route('user.index')->with('error', 'Anda tidak memiliki akses admin.');
        }

        return $next($request);
    }
}