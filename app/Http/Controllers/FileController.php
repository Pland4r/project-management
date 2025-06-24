<?php

namespace App\Http\Controllers;

use App\Models\GammeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class FileController extends Controller
{
    // Handle file upload
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'type' => 'required|in:CTR,STR,LAS',
            'context' => 'required|in:project,essai_messure',
            'context_id' => 'required|integer',
        ]);
        $file = $request->file('file');
        $path = $file->store('uploads');
        $data = [
            'file_name' => $file->hashName(),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'type' => $request->type,
            'description' => $request->description,
        ];
        if ($request->context === 'project') {
            $data['project_gamme_id'] = $request->context_id;
        } else {
            $data['essai_messure_gamme_id'] = $request->context_id;
        }
        GammeFile::create($data);
        return back()->with('success', 'File uploaded successfully.');
    }

    // Download file
    public function download($id)
    {
        $file = GammeFile::findOrFail($id);
        return Storage::download($file->file_path, $file->original_name);
    }

    public function preview($id)
    {
        $file = GammeFile::findOrFail($id);
        $path = storage_path('app/private/' . $file->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        $mime = File::mimeType($path);

        // For PDFs and images, show inline; for others, force download
        $disposition = in_array($mime, ['application/pdf', 'image/png', 'image/jpeg', 'image/gif', 'image/webp', 'image/bmp'])
            ? 'inline'
            : 'attachment';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => $disposition . '; filename="' . $file->original_name . '"'
        ]);
    }
} 