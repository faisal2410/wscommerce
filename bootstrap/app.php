<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Middleware\RoleMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(

        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    then: function () {
        Route::middleware('web')->group(base_path('routes/web.php'));
        Route::middleware(['web', 'auth', 'role:admin'])
            ->prefix('admin')
            ->name('admin.')
            ->group(base_path('routes/admin.php'));

        Route::middleware('web')
            ->prefix('auth')
            ->name('auth.')
            ->group(base_path('routes/auth.php'));

        Route::middleware(['web', 'auth', 'role:vendor'])
            ->prefix('vendor')
            ->name('vendor.')
            ->group(base_path('routes/vendor.php'));


    },
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
