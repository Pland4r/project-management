<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ActiveUsersController extends Controller
{
    private const ACTIVE_THRESHOLD = 300; // 5 minutes in seconds
    private const CACHE_KEY = 'active_users';
    
    /**
     * Get count of currently active users
     */
    public function getActiveUsers(Request $request)
    {
        $activeUsers = $this->getActiveUsersList();
        $count = count($activeUsers);
        
        return response()->json([
            'count' => $count,
            'timestamp' => now()->toISOString(),
            'users' => array_values($activeUsers),
            'debug' => [
                'current_user' => Auth::id(),
                'cache_data' => $activeUsers
            ]
        ]);
    }
    
    /**
     * Record user heartbeat
     */
    public function heartbeat(Request $request)
    {
        try {
            $userId = Auth::id();
            $userName = Auth::user()->name;
            $timestamp = now()->timestamp;
            $page = $request->input('page', 'dashboard');
            
            // Store user activity with timestamp
            $activeUsers = Cache::get(self::CACHE_KEY, []);
            $activeUsers[$userId] = [
                'user_id' => $userId,
                'id' => $userId,
                'name' => $userName,
                'last_seen' => now(),
                'page' => $page,
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent()
            ];
            
            // Store for 10 minutes
            Cache::put(self::CACHE_KEY, $activeUsers, 600);
            
            return response()->json([
                'status' => 'success',
                'message' => 'Heartbeat received',
                'timestamp' => $timestamp,
                'active_count' => count($this->getActiveUsersList()),
                'debug' => [
                    'user_id' => $userId,
                    'user_name' => $userName,
                    'total_active' => count($activeUsers)
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Mark user as offline
     */
    public function userOffline(Request $request)
    {
        $userId = Auth::id();
        $activeUsers = Cache::get(self::CACHE_KEY, []);
        
        // Remove user from active list
        unset($activeUsers[$userId]);
        
        Cache::put(self::CACHE_KEY, $activeUsers, 600);
        
        return response()->json([
            'status' => 'success',
            'message' => 'User marked as offline'
        ]);
    }
    
    /**
     * Get list of currently active users
     */
    private function getActiveUsersList()
    {
        $activeUsers = Cache::get(self::CACHE_KEY, []);
        $currentTime = now();
        $filteredUsers = [];
        
        foreach ($activeUsers as $userId => $userData) {
            $lastSeen = $userData['last_seen'];
            $timeDiff = $currentTime->diffInMinutes($lastSeen);
            
            // Consider user active if last seen within 2 minutes
            if ($timeDiff < 2) {
                $filteredUsers[$userId] = $userData;
            }
        }
        
        // Update cache with filtered list
        Cache::put(self::CACHE_KEY, $filteredUsers, 600);
        
        return $filteredUsers;
    }
    
    /**
     * Get detailed active users information (for debugging)
     */
    public function getActiveUsersDetails(Request $request)
    {
        $activeUsers = $this->getActiveUsersList();
        
        return response()->json([
            'cache_data' => $activeUsers,
            'count' => count($activeUsers),
            'current_user' => Auth::id(),
            'current_user_name' => Auth::user()->name ?? 'Not logged in'
        ]);
    }
}
