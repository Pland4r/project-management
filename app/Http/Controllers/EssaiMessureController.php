<?php

namespace App\Http\Controllers;

use App\Models\EssaiMessure;
use App\Models\Project;
use App\Models\EssaiMessureGamme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $essaiMessure = EssaiMessure::findOrFail($id);
        $userId = Auth::id();
        $canEdit = ($userId === $essaiMessure->user_id) || \App\Models\ProjectPermission::canEdit($userId, $essaiMessure->id);
        if (!$canEdit) {
            abort(403, 'You do not have permission to edit this Essai/Messure.');
        }
        return view('essai_messures.edit', compact('essaiMessure'));
    }

    public function update(Request $request, $id)
    {
        $essaiMessure = EssaiMessure::findOrFail($id);
        $userId = Auth::id();
        $canEdit = ($userId === $essaiMessure->user_id) || \App\Models\ProjectPermission::canEdit($userId, $essaiMessure->id);
        if (!$canEdit) {
            abort(403, 'You do not have permission to update this Essai/Messure.');
        }
        $request->validate(EssaiMessure::rules());
        $essaiMessure->update($request->all());
        return redirect()->route('essai_messures.show', $essaiMessure->id)->with('success', 'Essai/Messure updated.');
    }
} 