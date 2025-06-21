<?php

namespace App\Http\Controllers;

use App\Models\GammeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GammeFileController extends Controller
{
    /**
     * Download a file.
     *
     * @param  \App\Models\GammeFile  $file
     * @return \Illuminate\Http\Response
     */
    public function download(GammeFile $file)
    {
        if (!Storage::exists($file->file_path)) {
            abort(404, 'File not found');
        }
        
        // Return file for download
        return Storage::download($file->file_path, $file->original_name);
    }

    /**
     * Delete a file.
     *
     * @param  \App\Models\GammeFile  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(GammeFile $file)
    {
        // Delete the physical file
        if (Storage::exists($file->file_path)) {
            Storage::delete($file->file_path);
        }

        // Delete the database record
        $file->delete();

        return response()->json([
            'success' => true,
            'message' => 'File deleted successfully'
        ]);
    }

    /**
     * Get file information.
     *
     * @param  \App\Models\GammeFile  $file
     * @return \Illuminate\Http\Response
     */
    public function show(GammeFile $file)
    {
        // Add file size information
        $file->size = Storage::exists($file->file_path) ? Storage::size($file->file_path) : 0;
        $file->size_formatted = $this->formatFileSize($file->size);
        
        return response()->json([
            'success' => true,
            'file' => $file->load('gamme')
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
