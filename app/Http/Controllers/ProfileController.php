<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function updatePassword(Request $request)
{
    $request->validate([
        'current_password' => ['required', 'current_password'],
        'new_password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $user = Auth::user();
    $user->update([
        'password' => Hash::make($request->new_password)
    ]);

    return redirect()->route('dashboard')->with('success', 'Password updated successfully!');
}
}