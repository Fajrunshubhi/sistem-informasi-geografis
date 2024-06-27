<?php

use App\Http\Middleware\CheckDesa;
use App\Http\Middleware\IsSuperAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is_SuperAdmin' => IsSuperAdmin::class,
            'check_desa' => CheckDesa::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
