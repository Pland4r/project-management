<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckActiveSession
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            // Check if session should expire
            if ($request->session()->has('last_activity')) {
                $lastActivity = $request->session()->get('last_activity');
                if (now()->diffInMinutes($lastActivity) > config('session.lifetime')) {
                    Auth::logout();
                    $request->session()->invalidate();
                    return redirect('/login');
                }
            }
            
            $request->session()->put('last_activity', now());
        }

        return $next($request);
    }
}