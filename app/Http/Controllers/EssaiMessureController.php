<?php

namespace App\Http\Controllers;

use App\Models\EssaiMessure;
use App\Models\Project;
use App\Models\EssaiMessureGamme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ProjectPermission;

class EssaiMessureController extends Controller
{
    // List all essai/messure for a project
    public function index($projectId)
    {
        $project = Project::with('essaiMessures.gammes.files')->findOrFail($projectId);
        return view('essai_messures.index', compact('project'));
    }

    // Show form to create new essai/messure
    public function create($projectId)
    {
        $project = Project::findOrFail($projectId);
        return view('essai_messures.create', compact('project'));
    }

    // Store new essai/messure
    public function store(Request $request, $projectId)
    {
        $request->validate(EssaiMessure::rules());
        $essaiMessure = EssaiMessure::create([
            'project_id' => $projectId,
            'user_id' => Auth::id(),
            'type' => $request->type,
            'name' => $request->name,
            'person_name' => $request->person_name,
            'validator_name' => $request->validator_name,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'commentaire' => $request->commentaire,
            'issues' => $request->issues,
            'etat' => $request->etat,
        ]);
        // Assign edit permission to creator
        \App\Models\ProjectPermission::create([
            'user_id' => Auth::id(),
            'project_id' => $projectId,
            'essai_messure_id' => $essaiMessure->id,
            'permission_type' => 'edit',
        ]);
        // Create three branches (CTR, STR, LAS)
        foreach(['CTR', 'STR', 'LAS'] as $type) {
            EssaiMessureGamme::create([
                'essai_messure_id' => $essaiMessure->id,
                'type' => $type,
            ]);
        }
        return redirect()->route('projects.show', $projectId)->with('success', 'Essai/Messure created.');
    }

    // Show details of an essai/messure
    public function show($id)
    {
        $essaiMessure = EssaiMessure::with('gammes.files', 'user', 'project')->findOrFail($id);
        return view('essai_messures.show', compact('essaiMessure'));
    }

    public function edit($id)
    {
        $essaiMessure = EssaiMessure::with('editors')->findOrFail($id);
        $userId = Auth::id();
        $canEdit = ($userId === $essaiMessure->user_id) || $essaiMessure->editors->contains('id', $userId);
        if (!$canEdit) {
            abort(403, 'You do not have permission to edit this Essai/Messure.');
        }
        $users = User::where('is_admin', 0)->get();
        return view('essai_messures.edit', compact('essaiMessure', 'users'));
    }

    public function update(Request $request, $id)
    {
        $essaiMessure = EssaiMessure::with('editors')->findOrFail($id);
        $userId = Auth::id();
        $canEdit = ($userId === $essaiMessure->user_id) || $essaiMessure->editors->contains('id', $userId);
        if (!$canEdit) {
            abort(403, 'You do not have permission to update this Essai/Messure.');
        }
        $request->validate(EssaiMessure::rules());
        $essaiMessure->update($request->all());
        // Sync editors
        $editors = $request->input('editors', []);
        foreach ($editors as $editorId) {
            ProjectPermission::updateOrCreate([
                'user_id' => $editorId,
                'project_id' => $essaiMessure->project_id,
                'essai_messure_id' => $essaiMessure->id,
            ], [
                'permission_type' => 'edit',
            ]);
        }
        // Remove permissions for users not in the list
        ProjectPermission::where('essai_messure_id', $essaiMessure->id)
            ->where('permission_type', 'edit')
            ->whereNotIn('user_id', $editors)
            ->delete();
        return redirect()->route('essai_messures.show', $essaiMessure->id)->with('success', 'Essai/Messure updated.');
    }

    public function updateEditors(Request $request, $id)
    {
        $essaiMessure = \App\Models\EssaiMessure::findOrFail($id);
        // Only the owner can update editors
        if (auth()->id() !== $essaiMessure->user_id) {
            abort(403);
        }
        $editors = $request->input('editors', []);
        foreach ($editors as $editorId) {
            \App\Models\ProjectPermission::updateOrCreate([
                'user_id' => $editorId,
                'project_id' => $essaiMessure->project_id,
                'essai_messure_id' => $essaiMessure->id,
            ], [
                'permission_type' => 'edit',
            ]);
        }
        \App\Models\ProjectPermission::where('essai_messure_id', $essaiMessure->id)
            ->where('permission_type', 'edit')
            ->whereNotIn('user_id', $editors)
            ->delete();
        return redirect()->back()->with('success', 'Editors updated.');
    }
} 