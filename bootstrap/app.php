<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
            'agent' => \App\Http\Middleware\AgentMiddleware::class,
            'user' => \App\Http\Middleware\UserMiddleware::class,
        ]);
    })->withProviders([
    App\Providers\AuthServiceProvider::class,
    App\Providers\DashboardServiceProvider::class,
    App\Providers\PropertyServiceProvider::class,
    App\Providers\UserServiceProvider::class,
    App\Providers\BookingServiceProvider::class,
    App\Providers\FeedbackServiceProvider::class,
    App\Providers\FaqServiceProvider::class,
    App\Providers\SettingServiceProvider::class,
    
])
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();
