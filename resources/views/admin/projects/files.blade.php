@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Compact Header -->
    <div class="page-header">
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.projects.index') }}" class="breadcrumb-link">
                <i class="fas fa-arrow-left"></i>
                Back to Projects
            </a>
        </div>
        <h1 class="page-title">
            <i class="fas fa-folder-open"></i>
            File Management - {{ $project->project_name }}
        </h1>
    </div>

    <!-- Alerts -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    <!-- Specifications Section -->
    <div class="main-section">
        <div class="section-header">
            <div class="section-info">
                <h2 class="section-title">
                    <i class="fas fa-file-alt"></i>
                    Specifications
                </h2>
                <p class="section-subtitle">Upload and manage specification files</p>
            </div>
        </div>

        <!-- Upload Forms Row -->
        <div class="upload-row">
            <!-- CTR Upload -->
            <div class="upload-column">
                <div class="upload-card ctr-card">
                    <div class="upload-header">
                        <i class="fas fa-file-code"></i>
                        <span>CTR Files</span>
                    </div>
                    <form action="{{ route('admin.projects.specifications.upload', $project) }}" method="POST" enctype="multipart/form-data" class="upload-form">
                        @csrf
                        <input type="hidden" name="type" value="CTR">
                        <div class="file-input-group">
                            <input type="file" class="file-input" id="ctr_file" name="file" required>
                            <label for="ctr_file" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose CTR File
                            </label>
                        </div>
                        <textarea class="description-input" name="description" placeholder="Description (optional)" rows="2"></textarea>
                        <button type="submit" class="upload-btn ctr-btn">
                            <i class="fas fa-upload"></i>
                            Upload CTR
                        </button>
                    </form>
                </div>
            </div>

            <!-- STR Upload -->
            <div class="upload-column">
                <div class="upload-card str-card">
                    <div class="upload-header">
                        <i class="fas fa-file-alt"></i>
                        <span>STR Files</span>
                    </div>
                    <form action="{{ route('admin.projects.specifications.upload', $project) }}" method="POST" enctype="multipart/form-data" class="upload-form">
                        @csrf
                        <input type="hidden" name="type" value="STR">
                        <div class="file-input-group">
                            <input type="file" class="file-input" id="str_file" name="file" required>
                            <label for="str_file" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose STR File
                            </label>
                        </div>
                        <textarea class="description-input" name="description" placeholder="Description (optional)" rows="2"></textarea>
                        <button type="submit" class="upload-btn str-btn">
                            <i class="fas fa-upload"></i>
                            Upload STR
                        </button>
                    </form>
                </div>
            </div>

            <!-- LAS Upload -->
            <div class="upload-column">
                <div class="upload-card las-card">
                    <div class="upload-header">
                        <i class="fas fa-file-archive"></i>
                        <span>LAS Files</span>
                    </div>
                    <form action="{{ route('admin.projects.specifications.upload', $project) }}" method="POST" enctype="multipart/form-data" class="upload-form">
                        @csrf
                        <input type="hidden" name="type" value="LAS">
                        <div class="file-input-group">
                            <input type="file" class="file-input" id="las_file" name="file" required>
                            <label for="las_file" class="file-label">
                                <i class="fas fa-cloud-upload-alt"></i>
                                Choose LAS File
                            </label>
                        </div>
                        <textarea class="description-input" name="description" placeholder="Description (optional)" rows="2"></textarea>
                        <button type="submit" class="upload-btn las-btn">
                            <i class="fas fa-upload"></i>
                            Upload LAS
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Files Table -->
        <div class="files-table-section">
            <h3 class="table-title">
                <i class="fas fa-list"></i>
                Existing Specification Files
            </h3>
            <div class="table-wrapper">
                <table class="files-table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>File Name</th>
                            <th>Description</th>
                            <th>Size</th>
                            <th>Uploaded</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($project->gammes as $projectGamme)
                            @foreach($projectGamme->files as $file)
                            <tr>
                                <td>
                                    <span class="file-badge {{ strtolower($file->type) }}-badge">
                                        {{ $file->type }}
                                    </span>
                                </td>
                                <td class="file-name">{{ $file->original_name }}</td>
                                <td class="file-desc">{{ $file->description ?? 'No description' }}</td>
                                <td class="file-size">{{ number_format($file->size / 1024, 2) }} KB</td>
                                <td class="file-date">{{ $file->created_at->format('M d, Y') }}</td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="empty-row">
                                    <i class="fas fa-folder-open"></i>
                                    No specification files uploaded yet
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Essai/Messure Section -->
    <div class="main-section">
        <div class="section-header">
            <div class="section-info">
                <h2 class="section-title">
                    <i class="fas fa-flask"></i>
                    Essai/Messure Files
                </h2>
                <p class="section-subtitle">Upload files for each essai/messure record</p>
            </div>
        </div>

        @if($project->essaiMessures->count() > 0)
            @foreach($project->essaiMessures as $essaiMessure)
            <div class="essai-item">
                <div class="essai-item-header">
                    <div class="essai-info">
                        <h3 class="essai-name">{{ $essaiMessure->name }}</h3>
                        <div class="essai-meta">
                            <span class="essai-badge {{ $essaiMessure->type }}-badge">
                                {{ ucfirst($essaiMessure->type) }}
                            </span>
                            <span class="essai-creator">Created by: {{ $essaiMessure->user->name ?? 'Unknown' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Upload Row for this Essai/Messure -->
                <div class="upload-row compact">
                    <!-- CTR Upload -->
                    <div class="upload-column compact">
                        <div class="upload-card compact ctr-card">
                            <div class="upload-header compact">
                                <i class="fas fa-file-code"></i>
                                <span>CTR</span>
                            </div>
                            <form action="{{ route('admin.projects.essai-messures.files.upload', [$project, $essaiMessure]) }}" method="POST" enctype="multipart/form-data" class="upload-form compact">
                                @csrf
                                <input type="hidden" name="type" value="CTR">
                                <div class="file-input-group compact">
                                    <input type="file" class="file-input" name="file" required>
                                    <label class="file-label compact">
                                        <i class="fas fa-plus"></i>
                                        Choose File
                                    </label>
                                </div>
                                <textarea class="description-input compact" name="description" placeholder="Description" rows="1"></textarea>
                                <button type="submit" class="upload-btn compact ctr-btn">
                                    <i class="fas fa-upload"></i>
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- STR Upload -->
                    <div class="upload-column compact">
                        <div class="upload-card compact str-card">
                            <div class="upload-header compact">
                                <i class="fas fa-file-alt"></i>
                                <span>STR</span>
                            </div>
                            <form action="{{ route('admin.projects.essai-messures.files.upload', [$project, $essaiMessure]) }}" method="POST" enctype="multipart/form-data" class="upload-form compact">
                                @csrf
                                <input type="hidden" name="type" value="STR">
                                <div class="file-input-group compact">
                                    <input type="file" class="file-input" name="file" required>
                                    <label class="file-label compact">
                                        <i class="fas fa-plus"></i>
                                        Choose File
                                    </label>
                                </div>
                                <textarea class="description-input compact" name="description" placeholder="Description" rows="1"></textarea>
                                <button type="submit" class="upload-btn compact str-btn">
                                    <i class="fas fa-upload"></i>
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- LAS Upload -->
                    <div class="upload-column compact">
                        <div class="upload-card compact las-card">
                            <div class="upload-header compact">
                                <i class="fas fa-file-archive"></i>
                                <span>LAS</span>
                            </div>
                            <form action="{{ route('admin.projects.essai-messures.files.upload', [$project, $essaiMessure]) }}" method="POST" enctype="multipart/form-data" class="upload-form compact">
                                @csrf
                                <input type="hidden" name="type" value="LAS">
                                <div class="file-input-group compact">
                                    <input type="file" class="file-input" name="file" required>
                                    <label class="file-label compact">
                                        <i class="fas fa-plus"></i>
                                        Choose File
                                    </label>
                                </div>
                                <textarea class="description-input compact" name="description" placeholder="Description" rows="1"></textarea>
                                <button type="submit" class="upload-btn compact las-btn">
                                    <i class="fas fa-upload"></i>
                                    Upload
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Permissions -->
                    <div class="upload-column compact">
                        <div class="permissions-card">
                            <div class="permissions-header">
                                <i class="fas fa-user-shield"></i>
                                <span>Permissions</span>
                            </div>
                            <div class="permissions-content">
                                <form action="{{ route('admin.permissions.assign', [$project, $essaiMessure]) }}" method="POST" class="permission-form">
                                    @csrf
                                    @php
                                        $creatorId = $essaiMessure->user_id;
                                        $existingPermissions = \App\Models\ProjectPermission::where('essai_messure_id', $essaiMessure->id)->pluck('user_id')->toArray();
                                        $excludedUserIds = array_merge([$creatorId], $existingPermissions);
                                        $assignableUsers = \App\Models\User::where('is_admin', 0)->whereNotIn('id', $excludedUserIds)->get();
                                    @endphp
                                    <select name="user_id" class="user-select" required>
                                        <option value="">Select User...</option>
                                        @foreach($assignableUsers as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="grant-btn" @if($assignableUsers->isEmpty()) disabled @endif>
                                        <i class="fas fa-plus"></i>
                                        Grant
                                    </button>
                                </form>
                                
                                <div class="granted-list">
                                    <!-- Display Creator -->
                                    <div class="permission-item creator">
                                        <span>
                                            <i class="fas fa-crown"></i> 
                                            {{ $essaiMessure->user->name ?? 'Creator' }}
                                        </span>
                                        <span class="owner-tag">Owner</span>
                                    </div>
                                    
                                    <!-- Display Granted Permissions -->
                                    @php
                                        $permissions = \App\Models\ProjectPermission::where('essai_messure_id', $essaiMessure->id)->with('user')->get();
                                    @endphp
                                    @foreach($permissions as $permission)
                                        <div class="permission-item">
                                            <span>{{ $permission->user->name ?? 'Unknown' }} ({{ $permission->user->usercode ?? 'N/A' }})</span>
                                            <form action="{{ route('admin.permissions.revoke', $permission) }}" method="POST" class="revoke-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="revoke-btn" title="Revoke Permission">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                    @if($permissions->isEmpty())
                                        <div class="permission-item-empty">
                                            <span>No additional editors assigned.</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Files Table for this Essai/Messure -->
                <div class="files-table-section compact">
                    <h4 class="table-title compact">
                        <i class="fas fa-list"></i>
                        Files for {{ $essaiMessure->name }}
                    </h4>
                    <div class="table-wrapper compact">
                        <table class="files-table compact">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>File Name</th>
                                    <th>Description</th>
                                    <th>Size</th>
                                    <th>Uploaded</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($essaiMessure->gammes as $essaiMessureGamme)
                                    @foreach($essaiMessureGamme->files as $file)
                                    <tr>
                                        <td>
                                            <span class="file-badge {{ strtolower($file->type) }}-badge">
                                                {{ $file->type }}
                                            </span>
                                        </td>
                                        <td class="file-name">{{ $file->original_name }}</td>
                                        <td class="file-desc">{{ $file->description ?? 'No description' }}</td>
                                        <td class="file-size">{{ number_format($file->size / 1024, 2) }} KB</td>
                                        <td class="file-date">{{ $file->created_at->format('M d, Y') }}</td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="5" class="empty-row">
                                            <i class="fas fa-folder-open"></i>
                                            No files uploaded yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-info-circle"></i>
                <h3>No Essai/Messure Records Found</h3>
                <p>Users need to create essai/messure records first before files can be uploaded.</p>
            </div>
        @endif
    </div>
</div>

<style>
/* Use existing CSS variables from app.blade.php */

/* Container */
.container-fluid {
    max-width: 95%;
    margin: 0 auto;
    padding: 0 var(--space-lg);
}

/* Page Header */
.page-header {
    margin-bottom: var(--space-xl);
    text-align: center;
}

.breadcrumb-nav {
    margin-bottom: var(--space-md);
}

.breadcrumb-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    color: var(--text-secondary);
    text-decoration: none;
    font-weight: 500;
    padding: var(--space-sm) var(--space-md);
    border-radius: var(--radius-lg);
    transition: all var(--transition-normal);
    background: var(--bg-secondary);
    border: 1px solid var(--border-secondary);
}

.breadcrumb-link:hover {
    color: var(--stellantis-primary);
    background: var(--bg-tertiary);
    transform: translateX(-4px);
    text-decoration: none;
}

.page-title {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.page-title i {
    color: var(--stellantis-primary);
}

/* Alerts */
.alert {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-lg);
    font-weight: 600;
    border: none;
}

.alert-success {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.alert-danger {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

/* Main Sections */
.main-section {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    padding: var(--space-xl);
    margin-bottom: var(--space-xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
}

.section-header {
    margin-bottom: var(--space-xl);
    text-align: center;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 var(--space-sm) 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.section-title i {
    color: var(--stellantis-primary);
}

.section-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
    margin: 0;
}

/* Upload Row */
.upload-row {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-lg);
    margin-bottom: var(--space-xl);
}

.upload-row.compact {
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-md);
    margin-bottom: var(--space-lg);
}

.upload-column {
    display: flex;
    flex-direction: column;
}

/* Upload Cards */
.upload-card {
    background: var(--bg-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    border: 2px solid var(--border-secondary);
    transition: all var(--transition-normal);
    height: 100%;
}

.upload-card.compact {
    padding: var(--space-md);
}

.upload-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.upload-header {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin-bottom: var(--space-lg);
    font-weight: 600;
    font-size: 1rem;
    color: var(--text-primary);
}

.upload-header.compact {
    margin-bottom: var(--space-md);
    font-size: 0.9rem;
}

.ctr-card { border-color: var(--stellantis-primary); }
.str-card { border-color: #10b981; }
.las-card { border-color: #f59e0b; }

.ctr-card .upload-header i { color: var(--stellantis-primary); }
.str-card .upload-header i { color: #10b981; }
.las-card .upload-header i { color: #f59e0b; }

/* Upload Forms */
.upload-form {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    height: 100%;
}

.upload-form.compact {
    gap: var(--space-sm);
}

/* File Input */
.file-input-group {
    position: relative;
}

.file-input {
    position: absolute;
    opacity: 0;
    width: 100%;
    height: 100%;
    cursor: pointer;
}

.file-label {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-sm);
    padding: var(--space-lg);
    border: 2px dashed var(--border-secondary);
    border-radius: var(--radius-lg);
    background: var(--bg-secondary);
    color: var(--text-secondary);
    font-weight: 500;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.file-label.compact {
    padding: var(--space-md);
    font-size: 0.85rem;
}

.file-label:hover {
    border-color: var(--stellantis-primary);
    background: var(--bg-tertiary);
    color: var(--stellantis-primary);
}

.file-input:focus + .file-label {
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Description Input */
.description-input {
    width: 100%;
    padding: var(--space-md);
    border: 2px solid var(--border-secondary);
    border-radius: var(--radius-lg);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.9rem;
    resize: vertical;
    transition: all var(--transition-normal);
}

.description-input.compact {
    padding: var(--space-sm);
    font-size: 0.85rem;
}

.description-input:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

/* Upload Buttons */
.upload-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-sm);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
    border: none;
    cursor: pointer;
    transition: all var(--transition-normal);
    margin-top: auto;
}

.upload-btn.compact {
    padding: var(--space-sm) var(--space-md);
    font-size: 0.8rem;
}

.ctr-btn {
    background: var(--stellantis-primary);
    color: white;
}

.str-btn {
    background: #10b981;
    color: white;
}

.las-btn {
    background: #f59e0b;
    color: white;
}

.upload-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
}

.upload-btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Files Table Section */
.files-table-section {
    margin-top: var(--space-xl);
}

.files-table-section.compact {
    margin-top: var(--space-lg);
}

.table-title {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: var(--space-lg);
}

.table-title.compact {
    font-size: 1rem;
    margin-bottom: var(--space-md);
}

.table-title i {
    color: var(--stellantis-primary);
}

.table-wrapper {
    background: var(--bg-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-secondary);
}

.table-wrapper.compact {
    border-radius: var(--radius-lg);
}

/* Files Table */
.files-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.9rem;
}

.files-table.compact {
    font-size: 0.85rem;
}

.files-table thead {
    background: linear-gradient(135deg, var(--stellantis-primary), #1e40af);
}

.files-table th {
    padding: var(--space-md) var(--space-lg);
    color: white;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-align: left;
    border: none;
}

.files-table.compact th {
    padding: var(--space-sm) var(--space-md);
    font-size: 0.8rem;
}

.files-table tbody tr {
    background: var(--bg-primary);
    transition: all var(--transition-fast);
    border-bottom: 1px solid var(--border-secondary);
}

.files-table tbody tr:nth-child(even) {
    background: var(--bg-secondary);
}

.files-table tbody tr:hover {
    background: var(--bg-tertiary);
    transform: translateX(2px);
}

.files-table td {
    padding: var(--space-md) var(--space-lg);
    border: none;
    vertical-align: middle;
    color: var(--text-primary);
}

.files-table.compact td {
    padding: var(--space-sm) var(--space-md);
}

/* File Badges */
.file-badge {
    display: inline-block;
    padding: var(--space-xs) var(--space-sm);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.ctr-badge {
    background: var(--stellantis-primary);
    color: white;
}

.str-badge {
    background: #10b981;
    color: white;
}

.las-badge {
    background: #f59e0b;
    color: white;
}

/* Table Content */
.file-name {
    font-weight: 600;
    color: var(--text-primary);
}

.file-desc {
    color: var(--text-secondary);
    font-style: italic;
}

.file-size {
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    color: var(--text-muted);
    font-size: 0.85rem;
}

.file-date {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.download-link {
    display: inline-flex;
    align-items: center;
    gap: var(--space-xs);
    padding: var(--space-xs) var(--space-sm);
    border-radius: var(--radius-md);
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--stellantis-primary);
    text-decoration: none;
    transition: all var(--transition-normal);
    border: 1px solid var(--stellantis-primary);
}

.download-link:hover {
    background: var(--stellantis-primary);
    color: white;
    text-decoration: none;
    transform: translateY(-1px);
}

.empty-row {
    text-align: center;
    padding: var(--space-2xl);
    color: var(--text-muted);
    font-style: italic;
}

.empty-row i {
    font-size: 2rem;
    margin-bottom: var(--space-md);
    opacity: 0.5;
    display: block;
}

/* Essai Items */
.essai-item {
    background: var(--bg-secondary);
    border-radius: var(--radius-xl);
    padding: var(--space-lg);
    margin-bottom: var(--space-lg);
    border: 1px solid var(--border-secondary);
}

.essai-item-header {
    margin-bottom: var(--space-lg);
}

.essai-name {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 var(--space-sm) 0;
}

.essai-meta {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.essai-badge {
    padding: var(--space-xs) var(--space-sm);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

.essai-badge {
    background: var(--stellantis-primary);
    color: white;
}

.messure-badge {
    background: #6b7280;
    color: white;
}

.essai-creator {
    color: var(--text-secondary);
    font-size: 0.9rem;
    font-style: italic;
}

/* Permissions Card */
.permissions-card {
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
    padding: var(--space-md);
    border: 1px solid var(--border-secondary);
    height: 100%;
}

.permissions-header {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin-bottom: var(--space-md);
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-primary);
}

.permissions-header i {
    color: var(--stellantis-primary);
}

.permission-form {
    display: flex;
    flex-direction: column;
    gap: var(--space-sm);
    margin-bottom: var(--space-sm);
}

.user-select {
    width: 100%;
    padding: var(--space-sm);
    border: 2px solid var(--border-secondary);
    border-radius: var(--radius-md);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.85rem;
}

.user-select:focus {
    outline: none;
    border-color: var(--stellantis-primary);
}

.grant-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-xs);
    padding: var(--space-sm);
    border-radius: var(--radius-md);
    font-size: 0.8rem;
    font-weight: 600;
    background: var(--stellantis-primary);
    color: white;
    border: none;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.grant-btn:hover:not(:disabled) {
    background: #1e40af;
    transform: translateY(-1px);
}

.grant-btn:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.granted-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-xs);
}

.permission-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-xs) var(--space-sm);
    background: var(--bg-primary);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-secondary);
    font-size: 0.85rem;
}

.permission-item.creator {
    background: var(--bg-tertiary);
    font-weight: 600;
}

.permission-item.creator .fa-crown {
    color: var(--stellantis-gold);
    margin-right: var(--space-xs);
}

.owner-tag {
    background: var(--stellantis-gold);
    color: white;
    font-size: 0.7rem;
    font-weight: 700;
    padding: 2px 6px;
    border-radius: var(--radius-sm);
    text-transform: uppercase;
}

.permission-item-empty {
    padding: var(--space-xs) var(--space-sm);
    font-size: 0.8rem;
    color: var(--text-muted);
    font-style: italic;
    text-align: center;
}

.revoke-form {
    margin: 0;
}

.revoke-btn {
    padding: var(--space-xs);
    border-radius: var(--radius-sm);
    background: #dc2626;
    color: white;
    border: none;
    cursor: pointer;
    transition: all var(--transition-normal);
    font-size: 0.7rem;
}

.revoke-btn:hover {
    background: #b91c1c;
    transform: scale(1.1);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-3xl);
    color: var(--text-muted);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: var(--space-lg);
    opacity: 0.5;
}

.empty-state h3 {
    font-size: 1.3rem;
    font-weight: 600;
    margin-bottom: var(--space-md);
    color: var(--text-secondary);
}

.empty-state p {
    font-size: 1rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .upload-row {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .upload-row.compact {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .container-fluid {
        max-width: 100%;
        padding: 0 var(--space-md);
    }
    
    .page-title {
        font-size: 1.8rem;
        flex-direction: column;
        gap: var(--space-sm);
    }
    
    .upload-row,
    .upload-row.compact {
        grid-template-columns: 1fr;
        gap: var(--space-md);
    }
    
    .main-section {
        padding: var(--space-lg);
    }
    
    .files-table {
        font-size: 0.8rem;
    }
    
    .files-table th,
    .files-table td {
        padding: var(--space-sm);
    }
    
    .permission-form {
        flex-direction: column;
    }
    
    .essai-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-sm);
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.6rem;
    }
    
    .main-section {
        padding: var(--space-md);
    }
    
    .essai-item {
        padding: var(--space-md);
    }
    
    .files-table {
        font-size: 0.75rem;
    }
}

/* Loading Animation */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.main-section {
    animation: fadeInUp 0.6s ease-out;
}

.essai-item {
    animation: fadeInUp 0.6s ease-out;
}

/* Focus States for Accessibility */
.upload-btn:focus,
.download-link:focus,
.grant-btn:focus,
.revoke-btn:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}

.file-input:focus,
.description-input:focus,
.user-select:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced form interactions
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn && !submitBtn.disabled) {
                submitBtn.disabled = true;
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Uploading...';
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }, 5000);
            }
        });
    });
    
    // File input enhancements
    const fileInputs = document.querySelectorAll('.file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const label = this.nextElementSibling;
            const fileName = this.files[0]?.name;
            
            if (fileName) {
                const icon = label.querySelector('i');
                const text = label.querySelector('span') || label.childNodes[label.childNodes.length - 1];
                
                icon.className = 'fas fa-check';
                if (text.nodeType === Node.TEXT_NODE) {
                    text.textContent = fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName;
                } else {
                    text.textContent = fileName.length > 20 ? fileName.substring(0, 20) + '...' : fileName;
                }
                
                label.style.borderColor = 'var(--stellantis-primary)';
                label.style.backgroundColor = 'rgba(37, 99, 235, 0.1)';
                label.style.color = 'var(--stellantis-primary)';
            }
        });
    });
    
    // Enhanced button interactions with ripple effect
    const buttons = document.querySelectorAll('.upload-btn, .grant-btn, .revoke-btn, .download-link');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, transparent 70%);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple-effect 0.6s ease-out;
                pointer-events: none;
                z-index: 1000;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // Auto-resize textareas
    const textareas = document.querySelectorAll('.description-input');
    textareas.forEach(textarea => {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    });
    
    // Table row hover effects
    const tableRows = document.querySelectorAll('.files-table tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
});
</script>

<style>
@keyframes ripple-effect {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
</style>
@endsection