<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TrackActiveUsers
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            $userId = Auth::id();
            $userName = Auth::user()->name;
            $activeUsers = Cache::get('active_users', []);
            
            // Update user's last activity
            $activeUsers[$userId] = [
                'id' => $userId,
                'name' => $userName,
                'last_seen' => now(),
                'page' => $request->path(),
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ];
            
            // Store in cache for 5 minutes
            Cache::put('active_users', $activeUsers, now()->addMinutes(5));
        }
        
        return $next($request);
    }
}
