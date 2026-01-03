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
            guests: '/login', // Ini hanya berlaku jika rute dibungkus middleware 'auth'
            users: function ($request) {
                // Jika user sudah login dan mencoba akses rute guest (seperti /login)
                if ($request->user()->role === 'admin') {
                    return '/admin/dashboard';
                }
                return '/';
            }
        );
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();