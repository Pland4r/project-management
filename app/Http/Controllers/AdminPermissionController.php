<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\EssaiMessure;
use App\Models\ProjectPermission;
use App\Models\Project;

class AdminPermissionController extends Controller
{
    public function assign(Request $request, Project $project, EssaiMessure $essaiMessure)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        ProjectPermission::updateOrCreate(
            [
                'user_id' => $request->user_id,
                'project_id' => $project->id,
                'essai_messure_id' => $essaiMessure->id,
            ],
            [
                'permission_type' => 'edit',
            ]
        );

        return redirect()->back()->with('success', 'Edit permission granted successfully.');
    }

    public function revoke(ProjectPermission $permission)
    {
        $permission->delete();
        return redirect()->back()->with('success', 'Permission revoked successfully.');
    }
}
