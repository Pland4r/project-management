<?php

use Illuminate\Console\Scheduling\Schedule;
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
        // Add the active users tracking middleware to web group
        $middleware->web(append: [
            \App\Http\Middleware\TrackActiveUsers::class,
        ]);
        
        // You can also add it to specific routes if preferred
        $middleware->alias([
            'track.users' => \App\Http\Middleware\TrackActiveUsers::class,
            'check.session' => \App\Http\Middleware\CheckActiveSession::class,
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })
    ->withCommands([
        \App\Console\Commands\SendProjectReminders::class,
    ])
    ->withSchedule(function (Schedule $schedule) {
        $schedule->command('reminders:send')->hourly();
    })
    ->create();
