<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserApprovedMail;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function pendingUsers()
    {
        $pendingUsers = User::where('registration_status', 'pending')->get();
        return view('admin.users.pending', compact('pendingUsers'));
    }

    public function approveUser(Request $request, User $user)
    {
        $user->registration_status = 'approved';
        $user->approved_at = Carbon::now();
        $user->save();
        // Send approval email
        Mail::to($user->email)->send(new UserApprovedMail($user));
        return redirect()->back()->with('success', 'User approved and notified.');
    }

    public function rejectUser(Request $request, User $user)
    {
        $user->registration_status = 'rejected';
        $user->save();
        return redirect()->back()->with('success', 'User rejected.');
    }
} 