<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Vercel berjalan di belakang proxy/load balancer. Percayai
        // header X-Forwarded-* dari proxy agar skema (https) dan URL
        // yang dihasilkan aplikasi benar saat diakses lewat Vercel.
        // Cara Laravel 12: trustProxies(at: '*').
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
