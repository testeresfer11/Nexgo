<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
        apiPrefix: 'api'
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
          'setLocal' => \App\Http\Middleware\SetLocale::class,
        ]);

        // ✅ Aliases
        $middleware->alias([
            'CustomSanctumMiddleware' => \App\Http\Middleware\CustomSanctumMiddleware::class,
        ]);

        // ✅ If needed, stateful API setup
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

