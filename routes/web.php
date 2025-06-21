<?php

use App\Http\Controllers\ActiveUsersController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GammeController;
use App\Http\Controllers\GammeFileController;
use App\Exports\ProjectsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\EssaiMessureController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\AdminEssaiMessureController;
use App\Http\Controllers\AdminDashboardController;

Route::get('/', function () {
    return view('welcome');
});

// Active Users API routes (moved from api.php to web.php for easier auth)
Route::middleware('auth')->group(function () {
    Route::get('/api/active-users', [ActiveUsersController::class, 'getActiveUsers']);
    Route::post('/api/heartbeat', [ActiveUsersController::class, 'heartbeat']);
    Route::post('/api/user-offline', [ActiveUsersController::class, 'userOffline']);
    Route::get('/debug/active-users', [ActiveUsersController::class, 'getActiveUsersDetails']);
});

Auth::routes();

Route::get('/restart-session', function () {
    Session::flush();
    return redirect()->route('login');
})->name('restart.session');

Route::middleware(['auth'])->group(function () {
    // Session management routes
    Route::post('/logout-silent', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        
        Cookie::queue(Cookie::forget('laravel_session'));
        return response()->noContent();
    });

    Route::post('/keep-alive', function () {
        request()->session()->put('last_activity', now());
        request()->session()->save();
        return response()->noContent();
    });
    
    // Project routes
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::get('/dashboard', [ProjectController::class, 'index'])->name('dashboard');
    Route::get('projects/export', [ProjectController::class, 'export'])->name('projects.export');
    
    // Gamme routes
    Route::get('/gammes', [GammeController::class, 'index'])->name('gammes.index');
    Route::get('/gammes/count/{type}', [GammeController::class, 'getFileCount']);
    Route::get('/gammes/files-by-type/{type}', [GammeController::class, 'getFilesByType']);
    Route::post('/gammes/upload-files', [GammeController::class, 'uploadFiles']);

    Route::get('/gammes/{type}/files', function($type) {
        $gammeTypes = [
            'LAS' => 'Light Automotive Systems',
            'STR' => 'Structural Systems', 
            'CTR' => 'Control Systems'
        ];
        
        if (!array_key_exists($type, $gammeTypes)) {
            abort(404);
        }
        
        $gamme = \App\Models\Gamme::firstOrCreate(
            ['type' => $type],
            ['display_name' => $gammeTypes[$type]]
        );
        
        return view('gammes.files', [
            'gammeType' => $type,
            'gammeDisplayName' => $gammeTypes[$type],
            'gammeId' => $gamme->id
        ]);
    })->name('gammes.files');

    // File management routes
    Route::get('/gamme-files/{file}/download', [GammeFileController::class, 'download'])->name('gamme-files.download');
    Route::delete('/gamme-files/{file}', [GammeFileController::class, 'destroy'])->name('gamme-files.destroy');
    
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Projects
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/projects/{id}', [ProjectController::class, 'show'])->name('projects.show');
    Route::post('/projects/{id}/join', [ProjectController::class, 'join'])->name('projects.join');
    Route::get('/projects/{id}/members', [ProjectController::class, 'members'])->name('projects.members');

    // Essai/Messure
    Route::get('/projects/{projectId}/essai-messures', [EssaiMessureController::class, 'index'])->name('essai_messures.index');
    Route::get('/projects/{projectId}/essai-messures/create', [EssaiMessureController::class, 'create'])->name('essai_messures.create');
    Route::post('/projects/{projectId}/essai-messures', [EssaiMessureController::class, 'store'])->name('essai_messures.store');
    Route::get('/essai-messures/{id}', [EssaiMessureController::class, 'show'])->name('essai_messures.show');
    Route::get('/essai-messures/{id}/edit', [EssaiMessureController::class, 'edit'])->name('essai_messures.edit');
    Route::put('/essai-messures/{id}', [EssaiMessureController::class, 'update'])->name('essai_messures.update');

    // File upload/download
    Route::post('/files/upload', [FileController::class, 'upload'])->name('files.upload');
    Route::get('/files/{id}/download', [FileController::class, 'download'])->name('files.download');

    // Permissions
    Route::post('/permissions/assign', [PermissionController::class, 'assign'])->name('permissions.assign');
    Route::get('/permissions/{essaiMessureId}/check', [PermissionController::class, 'check'])->name('permissions.check');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminDashboardController::class, 'index'])->name('dashboard');
    // User management
    Route::get('/users/pending', [AdminController::class, 'pendingUsers'])->name('users.pending');
    Route::post('/users/{user}/approve', [AdminController::class, 'approveUser'])->name('users.approve');
    Route::post('/users/{user}/reject', [AdminController::class, 'rejectUser'])->name('users.reject');
    // Project management
    Route::resource('projects', AdminProjectController::class);
    Route::get('/projects/{project}/files', [AdminProjectController::class, 'files'])->name('projects.files');
    Route::post('/projects/{project}/specifications/upload', [AdminProjectController::class, 'uploadSpecification'])->name('projects.specifications.upload');
    Route::post('/projects/{project}/essai-messures/{essaiMessure}/files/upload', [AdminProjectController::class, 'uploadEssaiMessureFile'])->name('projects.essai-messures.files.upload');

    // Permission management
    Route::post('/projects/{project}/essai-messures/{essaiMessure}/permissions/assign', [\App\Http\Controllers\AdminPermissionController::class, 'assign'])->name('permissions.assign');
    Route::delete('/permissions/{permission}/revoke', [\App\Http\Controllers\AdminPermissionController::class, 'revoke'])->name('permissions.revoke');

    // Essai/Messure file/spec management
    Route::post('/essai-messures/{id}/add-spec', [AdminEssaiMessureController::class, 'addSpec'])->name('essai_messures.add_spec');
});
