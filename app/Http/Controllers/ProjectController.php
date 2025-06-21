<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectGamme;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProjectsExport;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller{


public function create()
{
    return view('create');
}


public function store(Request $request)
{
    $validated = $request->validate([
        'type' => 'required|in:essai,messure',
        'project_name' => 'required|max:255',
        'essai_messure_name' => 'required|max:255',
        'person_name' => 'required|max:255',
        'validator_name' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'etat' => 'required|max:255',
        'commentaire' => 'required',
        'contreMarque' => 'required|string|max:255',
        'issues' => 'nullable|string|max:255', // 🔹 Add this line
    ]);

    auth()->user()->projects()->create($validated);

    return redirect()->route('dashboard')->with('success', 'Project created!');
}


    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'type' => 'required|in:essai,messure',
        'project_name' => 'required|max:255',
        'essai_messure_name' => 'required|max:255',
        'person_name' => 'required|max:255',
        'validator_name' => 'required|max:255',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'etat' => 'required|max:255',
        'commentaire' => 'required',
        'contreMarque' => 'required|string|max:255',
        'issues' => 'nullable|string|max:255', // 🔹 Add this line
    ]);

    $project = Project::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    $project->update($validated);

    return redirect()->route('dashboard')->with('success', 'Project updated successfully!');
}


public function edit($id)
{
    $project = Project::where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    return view('edit', compact('project'));
}




public function index()
{
    if (auth()->user()->is_admin) {
        abort(403, 'Admins cannot access the user dashboard.');
    }
    $projects = Project::with('responsible', 'members')->get();
    return view('projects.index', compact('projects'));
}


public function show($id)
{
    $project = Project::with(['responsible', 'members', 'gammes.files', 'essaiMessures.gammes.files'])->findOrFail($id);
    return view('projects.show', compact('project'));
}


public function join($id)
{
    $project = Project::findOrFail($id);
    $user = Auth::user();
    $project->members()->syncWithoutDetaching([$user->id]);
    return redirect()->route('projects.show', $project->id)->with('success', 'You have joined the project.');
}


public function members($id)
{
    $project = Project::with('members')->findOrFail($id);
    return view('projects.members', compact('project'));
}


public function export()
    {
        return Excel::download(new ProjectsExport, 'projects.xlsx');
    }
}