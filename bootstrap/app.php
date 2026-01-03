<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        $middleware->redirectTo(
            // Hapus atau ganti rute pengalihan tamu agar tidak otomatis ke /login
            guests: '/login', 
            users: function ($request) {
                if ($request->user()->role === 'admin') {
                    return '/admin/dashboard';
                }
                return '/'; // User biasa kembali ke katalog utama
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();