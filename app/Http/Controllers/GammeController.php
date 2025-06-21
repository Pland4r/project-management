<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use App\Models\GammeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GammeController extends Controller
{
    /**
     * Display a listing of the gammes.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Just return the view - we'll load data via AJAX
        return view('gammes.index');
    }

    /**
     * Get file count for a specific gamme type.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function getFileCount($type)
    {
        $gamme = Gamme::where('type', $type)->first();
        
        if (!$gamme) {
            return response()->json([
                'success' => true,
                'count' => 0
            ]);
        }
        
        $count = $gamme->files()->count();
        
        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Get gamme ID by type.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function getGammeIdByType($type)
    {
        $gamme = Gamme::where('type', $type)->first();
        
        if (!$gamme) {
            return response()->json([
                'success' => false,
                'message' => 'Gamme not found'
            ]);
        }
        
        return response()->json([
            'success' => true,
            'gamme_id' => $gamme->id
        ]);
    }

    /**
     * Get files for a specific gamme type.
     *
     * @param  string  $type
     * @return \Illuminate\Http\Response
     */
    public function getFilesByType($type)
    {
        $gamme = Gamme::where('type', $type)->first();
        
        if (!$gamme) {
            return response()->json([
                'success' => true,
                'files' => []
            ]);
        }
        
        $files = $gamme->files()->latest()->get()->map(function ($file) {
            // Add file size information
            $file->size = Storage::exists($file->file_path) ? Storage::size($file->file_path) : 0;
            $file->size_formatted = $this->formatFileSize($file->size);
            return $file;
        });
        
        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }

    /**
     * Store a newly created gamme in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:LAS,STR,CTR|unique:gammes,type',
            'display_name' => 'required|string|max:255',
        ]);

        $gamme = Gamme::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Gamme created successfully',
            'gamme' => $gamme
        ]);
    }

    /**
     * Get files for a specific gamme.
     *
     * @param  \App\Models\Gamme  $gamme
     * @return \Illuminate\Http\Response
     */
    public function getFiles(Gamme $gamme)
    {
        $files = $gamme->files()->latest()->get()->map(function ($file) {
            // Add file size information
            $file->size = Storage::exists($file->file_path) ? Storage::size($file->file_path) : 0;
            $file->size_formatted = $this->formatFileSize($file->size);
            return $file;
        });
        
        return response()->json([
            'success' => true,
            'files' => $files
        ]);
    }

    /**
     * Upload files to a gamme.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function uploadFiles(Request $request)
    {
        $request->validate([
            'gamme_id' => 'required|exists:gammes,id',
            'files' => 'required|array',
            'files.*' => 'file|max:10240', // 10MB max per file
        ]);

        $gammeId = $request->input('gamme_id');
        $uploadedFiles = [];

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $uploadedFile) {
                // Generate unique file name to avoid conflicts
                $originalName = $uploadedFile->getClientOriginalName();
                $fileName = time() . '_' . Str::random(10) . '_' . $originalName;
                $filePath = $uploadedFile->storeAs('gamme-files/' . $gammeId, $fileName);
                
                $file = GammeFile::create([
                    'gamme_id' => $gammeId,
                    'file_name' => $fileName,
                    'file_path' => $filePath,
                    'original_name' => $originalName,
                ]);
                
                $uploadedFiles[] = $file;
            }
        }

        return response()->json([
            'success' => true,
            'message' => count($uploadedFiles) . ' files uploaded successfully',
            'files' => $uploadedFiles
        ]);
    }
    
    /**
     * Format file size to human readable format.
     *
     * @param  int  $bytes
     * @return string
     */
    private function formatFileSize($bytes)
    {
        if ($bytes === 0) {
            return '0 Bytes';
        }
        
        $k = 1024;
        $sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        $i = floor(log($bytes) / log($k));
        
        return round($bytes / pow($k, $i), 2) . ' ' . $sizes[$i];
    }
}
