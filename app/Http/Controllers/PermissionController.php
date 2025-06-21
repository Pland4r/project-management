<?php

namespace App\Http\Controllers;

use App\Models\ProjectPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    // Assign edit permission to a user for an essai/messure
    public function assign(Request $request)
    {
        $request->validate([
            'user_id' => 'required|integer',
            'essai_messure_id' => 'required|integer',
            'project_id' => 'required|integer',
            'permission_type' => 'required|in:edit,view',
        ]);
        ProjectPermission::updateOrCreate([
            'user_id' => $request->user_id,
            'essai_messure_id' => $request->essai_messure_id,
            'project_id' => $request->project_id,
        ], [
            'permission_type' => $request->permission_type,
        ]);
        return back()->with('success', 'Permission assigned.');
    }

    // Check if user has edit permission
    public function check($essaiMessureId)
    {
        $userId = Auth::id();
        $canEdit = ProjectPermission::canEdit($userId, $essaiMessureId);
        return response()->json(['can_edit' => $canEdit]);
    }
} 