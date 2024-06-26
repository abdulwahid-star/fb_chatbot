<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\VerifyBot;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(VerifyBot::class);
        $middleware->validateCsrfTokens(except: [
            'https://fbchatbot-production.up.railway.app/webhook' // <-- exclude this route
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
