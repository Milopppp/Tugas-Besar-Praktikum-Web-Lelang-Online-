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
        // --- TAMBAHKAN ALIAS DI SINI ---
        $middleware->alias([
            'admin' => \App\Http\Middleware\IsAdmin::class,
        ]);

        $middleware->redirectTo(
            guests: '/login',
            users: function ($request) {
                // Gunakan 'role' sesuai kolom database Anda
                if ($request->user()->role === 'admin') { 
                    return '/admin/dashboard';
                }
                return '/katalog';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();