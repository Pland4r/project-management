<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Show the login form.
     */
    public function showLoginForm()
    {
        return view('auth.login'); // Ensure the 'auth.login' view exists
    }

    /**
     * Handle a login request.
     */
    public function login(Request $request)
    {
        // Validate login data
        $credentials = $request->validate([
            'usercode' => 'required|string',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->registration_status !== 'approved') {
                Auth::logout();
                return back()->withErrors([
                    'usercode' => 'Your registration is pending approval by the admin.'
                ])->onlyInput('usercode');
            }
            $request->session()->regenerate();
            if ($user->is_admin) {
                return redirect()->route('admin.dashboard'); // Admin dashboard
            }
            return redirect()->route('dashboard'); // User dashboard
        }

        // Authentication failed
        return back()->withErrors([
            'usercode' => 'Invalid credentials.',
        ])->onlyInput('usercode');
    }

    /**
     * Specify the username field.
     */
    public function username()
    {
        return 'usercode';
    }

    /**
     * Optional custom validation (already used above).
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
    }

    /**
     * Logout the authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Missing in your original code

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function redirectTo()
    {
        $user = Auth::user();
        if ($user && $user->is_admin) {
            return route('admin.dashboard');
        }
        return route('dashboard');
    }
}
