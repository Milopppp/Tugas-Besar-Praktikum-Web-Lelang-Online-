<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login atau bukan admin, arahkan ke katalog utama
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            return redirect()->route('user.index')->with('error', 'Akses ditolak.');
        }

        return $next($request);
    }
}