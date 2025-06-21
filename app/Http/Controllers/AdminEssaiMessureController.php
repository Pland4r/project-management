<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EssaiMessure;
use App\Models\GammeFile;

class AdminEssaiMessureController extends Controller
{
    public function addSpec(Request $request, $id)
    {
        $essaiMessure = EssaiMessure::findOrFail($id);
        $data = $request->validate([
            'type' => 'required|in:CTR,STR,LAS',
            'file' => 'required|file',
            'description' => 'nullable|string',
        ]);
        // Store file
        $path = $request->file('file')->store('essai-messure/' . $essaiMessure->id . '/' . $data['type']);
        $file = new GammeFile();
        $file->gamme_id = null; // Set if needed
        $file->essai_messure_gamme_id = null; // Set if needed
        $file->file_name = basename($path);
        $file->file_path = $path;
        $file->original_name = $request->file('file')->getClientOriginalName();
        $file->size = $request->file('file')->getSize();
        $file->type = $data['type'];
        $file->description = $data['description'] ?? null;
        $file->save();
        return redirect()->back()->with('success', 'Specification file added successfully.');
    }
} 