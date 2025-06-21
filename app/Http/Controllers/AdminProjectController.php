<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\EssaiMessure;
use App\Models\GammeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $users = \App\Models\User::where('is_admin', 0)->where('registration_status', 'approved')->get();
        return view('admin.projects.create', compact('users'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'person_name' => 'required|string|max:255',
            'team_members' => 'nullable|array',
            'team_members.*' => 'exists:users,id',
        ]);
        $data['reference'] = strtoupper(uniqid('PRJ'));
        $data['user_id'] = auth()->id();
        $project = Project::create($data);
        if (!empty($data['team_members'])) {
            $project->members()->sync($data['team_members']);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('admin.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project)
    {
        $data = $request->validate([
            'project_name' => 'required|string|max:255',
            'person_name' => 'required|string|max:255',
            'reference' => 'required|string|max:255',
        ]);
        $project->update($data);
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully.');
    }

    public function files(Project $project)
    {
        $project->load(['gammes.files', 'essaiMessures.gammes.files']);
        return view('admin.projects.files', compact('project'));
    }

    public function uploadSpecification(Request $request, Project $project)
    {
        $request->validate([
            'type' => 'required|in:CTR,STR,LAS',
            'file' => 'required|file|max:10240', // 10MB max
            'description' => 'nullable|string|max:500',
        ]);

        $gamme = \App\Models\Gamme::where('type', $request->type)->firstOrFail();
        $projectGamme = \App\Models\ProjectGamme::where('project_id', $project->id)
            ->where('type', $request->type)
            ->firstOrFail();

        $file = $request->file('file');
        $path = $file->store('project-specifications/' . $project->id . '/' . $request->type);

        GammeFile::create([
            'gamme_id' => $gamme->id,
            'project_gamme_id' => $projectGamme->id,
            'file_name' => basename($path),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Specification file uploaded successfully.');
    }

    public function uploadEssaiMessureFile(Request $request, Project $project, EssaiMessure $essaiMessure)
    {
        $request->validate([
            'type' => 'required|in:CTR,STR,LAS',
            'file' => 'required|file|max:10240', // 10MB max
            'description' => 'nullable|string|max:500',
        ]);

        $gamme = \App\Models\Gamme::where('type', $request->type)->firstOrFail();
        $essaiMessureGamme = \App\Models\EssaiMessureGamme::where('essai_messure_id', $essaiMessure->id)
            ->where('type', $request->type)
            ->firstOrFail();

        $file = $request->file('file');
        $path = $file->store('essai-messures/' . $essaiMessure->id . '/' . $request->type);

        GammeFile::create([
            'gamme_id' => $gamme->id,
            'essai_messure_gamme_id' => $essaiMessureGamme->id,
            'file_name' => basename($path),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Essai/Messure file uploaded successfully.');
    }
} 