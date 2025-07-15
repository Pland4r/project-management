@extends('layouts.app')
@section('content')
@php
    use App\Models\ProjectPermission;
    $canEdit = (auth()->id() === $essaiMessure->user_id) || ProjectPermission::canEdit(auth()->id(), $essaiMessure->id);
    
    // Helper function to get file extension icon
    function getFileIcon($filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $icons = [
            'pdf' => 'fas fa-file-pdf',
            'doc' => 'fas fa-file-word',
            'docx' => 'fas fa-file-word',
            'xls' => 'fas fa-file-excel',
            'xlsx' => 'fas fa-file-excel',
            'ppt' => 'fas fa-file-powerpoint',
            'pptx' => 'fas fa-file-powerpoint',
            'jpg' => 'fas fa-file-image',
            'jpeg' => 'fas fa-file-image',
            'png' => 'fas fa-file-image',
            'gif' => 'fas fa-file-image',
            'zip' => 'fas fa-file-archive',
            'rar' => 'fas fa-file-archive',
            'txt' => 'fas fa-file-alt',
            'csv' => 'fas fa-file-csv',
            'mp4' => 'fas fa-file-video',
            'avi' => 'fas fa-file-video',
            'mp3' => 'fas fa-file-audio',
            'wav' => 'fas fa-file-audio',
        ];
        return $icons[$extension] ?? 'fas fa-file';
    }
    
    // Helper function to get file type color
    function getFileTypeColor($filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $colors = [
            'pdf' => '#e74c3c',
            'doc' => '#2980b9',
            'docx' => '#2980b9',
            'xls' => '#27ae60',
            'xlsx' => '#27ae60',
            'ppt' => '#e67e22',
            'pptx' => '#e67e22',
            'jpg' => '#9b59b6',
            'jpeg' => '#9b59b6',
            'png' => '#9b59b6',
            'gif' => '#9b59b6',
            'zip' => '#34495e',
            'rar' => '#34495e',
            'txt' => '#95a5a6',
            'csv' => '#f39c12',
            'mp4' => '#e91e63',
            'avi' => '#e91e63',
            'mp3' => '#ff5722',
            'wav' => '#ff5722',
        ];
        return $colors[$extension] ?? '#7f8c8d';
    }
@endphp

<div class="container py-4">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav mb-3 fade-in">
        <a href="{{ route('projects.index') }}" class="breadcrumb-link">
            <i class="fas fa-home"></i> Projects
        </a>
        <span>/</span>
        <a href="{{ route('projects.show', $essaiMessure->project_id) }}" class="breadcrumb-link">
            Project Details
        </a>
        <span>/</span>
        <span class="breadcrumb-current">{{ $essaiMessure->name }}</span>
    </nav>

    <!-- Header -->
    <div class="page-header slide-up">
        <div class="header-left">
            <div class="header-icon pulse-icon">
                <i class="fas fa-vial"></i>
            </div>
            <div class="header-info">
                <h1 class="page-title">{{ $essaiMessure->name }}</h1>
                <div class="header-badges">
                    <span class="badge badge-type badge-{{ strtolower($essaiMessure->type) }} bounce-in">
                        {{ ucfirst($essaiMessure->type) }}
                    </span>
                    <span class="badge badge-status badge-{{ strtolower($essaiMessure->etat) }} bounce-in delay-1">
                        {{ ucfirst($essaiMessure->etat) }}
                    </span>
                </div>
            </div>
        </div>
        @if($canEdit)
        <div class="header-actions">
            <a href="{{ route('essai_messures.edit', $essaiMessure->id) }}" class="btn btn-primary hover-lift">
                <i class="fas fa-edit"></i> Edit
                <div class="btn-shine"></div>
            </a>
        </div>
        @endif
    </div>

    <!-- Content Tabs -->
    <div class="content-tabs slide-up delay-2">
        <div class="tab-nav">
            <button class="tab-btn active" data-tab="details">
                <i class="fas fa-info-circle"></i> Details
                <div class="tab-indicator"></div>
            </button>
            <button class="tab-btn" data-tab="files">
                <i class="fas fa-folder"></i> Files & Branches
                <span class="tab-count">{{ $essaiMessure->gammes->sum(function($branch) { return $branch->files->count(); }) }}</span>
                <div class="tab-indicator"></div>
            </button>
        </div>

        <!-- Details Tab -->
        <div class="tab-content active" id="details">
            <div class="details-grid">
                <div class="detail-card hover-card">
                    <div class="detail-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Person</div>
                        <div class="detail-value">{{ $essaiMessure->person_name ?: 'Not assigned' }}</div>
                    </div>
                    <div class="card-glow"></div>
                </div>

                <div class="detail-card hover-card">
                    <div class="detail-icon">
                        <i class="fas fa-user-check"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Validator</div>
                        <div class="detail-value">{{ $essaiMessure->validator_name ?: 'Not assigned' }}</div>
                    </div>
                    <div class="card-glow"></div>
                </div>

                <div class="detail-card hover-card">
                    <div class="detail-icon">
                        <i class="fas fa-users-cog"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Editors</div>
                        <div class="detail-value">
                            @if($essaiMessure->editors && $essaiMessure->editors->count())
                                @foreach($essaiMessure->editors as $editor)
                                    <span class="badge badge-info">{{ $editor->name }}</span>@if(!$loop->last), @endif
                                @endforeach
                            @else
                                <span class="text-muted">No editors assigned</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-glow"></div>
                </div>

                <div class="detail-card hover-card">
                    <div class="detail-icon">
                        <i class="fas fa-calendar-alt"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Start Date</div>
                        <div class="detail-value">
                            {{ $essaiMessure->start_date ? \Carbon\Carbon::parse($essaiMessure->start_date)->format('M d, Y') : 'Not set' }}
                        </div>
                    </div>
                    <div class="card-glow"></div>
                </div>

                <div class="detail-card hover-card">
                    <div class="detail-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">End Date</div>
                        <div class="detail-value">
                            {{ $essaiMessure->end_date ? \Carbon\Carbon::parse($essaiMessure->end_date)->format('M d, Y') : 'Not set' }}
                        </div>
                    </div>
                    <div class="card-glow"></div>
                </div>
            </div>

            @if($essaiMessure->commentaire || $essaiMessure->issues)
            <div class="additional-info">
                @if($essaiMessure->commentaire)
                <div class="info-section hover-card">
                    <h3><i class="fas fa-comment-alt"></i> Comments</h3>
                    <p>{{ $essaiMessure->commentaire }}</p>
                    <div class="card-glow"></div>
                </div>
                @endif

                @if($essaiMessure->issues)
                <div class="info-section issues hover-card">
                    <h3><i class="fas fa-exclamation-triangle"></i> Issues</h3>
                    <p>{{ $essaiMessure->issues }}</p>
                    <div class="card-glow"></div>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Files Tab -->
        <div class="tab-content" id="files">
            @if($essaiMessure->gammes->count() > 0)
                <div class="branches-container">
                    @foreach($essaiMessure->gammes as $branch)
                    <div class="branch-section">
                        <div class="branch-header">
                            <div class="branch-info">
                                <div class="branch-icon">
                                    <i class="fas fa-code-branch"></i>
                                </div>
                                <div class="branch-details">
                                    <h3 class="branch-title">{{ $branch->type }}</h3>
                                    <span class="file-count">{{ $branch->files->count() }} files</span>
                                </div>
                            </div>
                            @if($branch->files->count() > 0)
                            <div class="branch-actions">
                                <form action="" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="download-all-btn">
                                        <i class="fas fa-download"></i>
                                        Download All
                                    </button>
                                </form>
                            </div>
                            @endif
                        </div>
                        
                        @if($branch->files->count() > 0)
                        <div class="files-container">
                            @foreach($branch->files as $file)
                            <div class="file-item">
                                <div class="file-icon" style="color: {{ getFileTypeColor($file->original_name) }}">
                                    <i class="{{ getFileIcon($file->original_name) }}"></i>
                                </div>
                                <div class="file-info">
                                    <div class="file-name" title="{{ $file->original_name }}">
                                        {{ $file->original_name }}
                                    </div>
                                    <div class="file-meta">
                                        <span class="file-size">{{ number_format($file->size / 1024, 1) }} KB</span>
                                        <span class="file-type">{{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION)) }}</span>
                                    </div>
                                </div>
                                <div class="file-actions">
                                    <a href="{{ route('files.download', $file->id) }}" 
                                       class="download-btn" 
                                       target="_blank">
                                        <i class="fas fa-download"></i>
                                        Download
                                    </a>
                                    <a href="{{ url('files/' . $file->id . '/preview') }}" class="preview-btn" target="_blank">
                                        <i class="fas fa-eye"></i>
                                        Preview
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="no-files">
                            <i class="fas fa-folder-open"></i>
                            <span>No files in this branch</span>
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open floating-icon"></i>
                    <h3>No branches found</h3>
                    <p>This essai/messure doesn't have any associated branches or files yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal for file preview -->
<div id="filePreviewModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close" onclick="closePreviewModal()">&times;</span>
        <div id="filePreviewBody" style="min-height:400px;"></div>
    </div>
</div>

<style>
:root {
    --stellantis-primary: #2563eb;
    --stellantis-secondary: #1d4ed8;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-muted: #9ca3af;
    --bg-primary: #ffffff;
    --bg-secondary: #f9fafb;
    --bg-tertiary: #f3f4f6;
    --card-bg: #ffffff;
    --card-border: #e5e7eb;
    --border-muted: #e5e7eb;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --primary-gradient: linear-gradient(135deg, #2563eb, #1d4ed8);
}

/* Enhanced Animations and Hover Effects */
.container {
    max-width: 1200px;
}

/* Keyframe Animations */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes bounceIn {
    0% { opacity: 0; transform: scale(0.3); }
    50% { opacity: 1; transform: scale(1.05); }
    70% { transform: scale(0.9); }
    100% { opacity: 1; transform: scale(1); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes shine {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes glow {
    0%, 100% { opacity: 0; }
    50% { opacity: 0.3; }
}

/* Animation Classes */
.fade-in {
    animation: fadeIn 0.6s ease-out;
}

.slide-up {
    animation: slideUp 0.8s ease-out;
}

.slide-up.delay-1 {
    animation-delay: 0.2s;
    animation-fill-mode: both;
}

.slide-up.delay-2 {
    animation-delay: 0.4s;
    animation-fill-mode: both;
}

.bounce-in {
    animation: bounceIn 0.8s ease-out;
}

.bounce-in.delay-1 {
    animation-delay: 0.3s;
    animation-fill-mode: both;
}

.pulse-icon {
    animation: pulse 2s ease-in-out infinite;
}

.floating-icon {
    animation: float 3s ease-in-out infinite;
}

/* Breadcrumb */
.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.breadcrumb-link {
    color: var(--text-secondary);
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 0.25rem 0.5rem;
    border-radius: var(--radius-sm);
}

.breadcrumb-link:hover {
    color: var(--stellantis-primary);
    background: var(--bg-secondary);
    transform: translateY(-1px);
}

.breadcrumb-current {
    color: var(--text-primary);
    font-weight: 600;
}

/* Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--card-border);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.page-header:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-2px);
}

.header-left {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    position: relative;
    overflow: hidden;
}

.page-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.5rem 0;
    transition: color 0.3s ease;
}

.header-badges {
    display: flex;
    gap: 0.5rem;
}

.badge {
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.badge:hover {
    transform: scale(1.05);
}

.badge-essai { background: var(--success-color); color: white; }
.badge-messure { background: var(--warning-color); color: white; }
.badge-approved { background: var(--success-color); color: white; }
.badge-pending { background: var(--warning-color); color: white; }
.badge-rejected { background: var(--danger-color); color: white; }

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    border: none;
    cursor: pointer;
}

.btn-primary {
    background: var(--stellantis-primary);
    color: white;
}

.hover-lift:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(37, 99, 235, 0.3);
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn:hover .btn-shine {
    animation: shine 0.6s ease;
}

/* Content Tabs */
.content-tabs {
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--card-border);
    overflow: hidden;
    transition: all 0.3s ease;
}

.content-tabs:hover {
    box-shadow: var(--shadow-md);
}

.tab-nav {
    display: flex;
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-muted);
}

.tab-btn {
    flex: 1;
    padding: 1rem 1.5rem;
    background: none;
    border: none;
    color: var(--text-secondary);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    position: relative;
}

.tab-btn:hover {
    color: var(--stellantis-primary);
    background: var(--bg-tertiary);
    transform: translateY(-1px);
}

.tab-btn.active {
    color: var(--stellantis-primary);
    background: var(--card-bg);
}

.tab-indicator {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 2px;
    background: var(--stellantis-primary);
    transition: width 0.3s ease;
}

.tab-btn.active .tab-indicator {
    width: 100%;
}

.tab-count {
    background: var(--stellantis-primary);
    color: white;
    padding: 0.125rem 0.5rem;
    border-radius: 10px;
    font-size: 0.7rem;
    transition: all 0.3s ease;
}

.tab-btn:hover .tab-count {
    transform: scale(1.1);
}

.tab-content {
    display: none;
    padding: 2rem;
}

.tab-content.active {
    display: block;
    animation: fadeIn 0.5s ease-out;
}

/* Details Grid */
.details-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.detail-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem;
    background: var(--bg-secondary);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-muted);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
    border-color: var(--stellantis-primary);
}

.card-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at center, rgba(37, 99, 235, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.hover-card:hover .card-glow {
    animation: glow 2s ease-in-out infinite;
}

.detail-icon {
    width: 40px;
    height: 40px;
    background: var(--stellantis-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.hover-card:hover .detail-icon {
    transform: rotate(360deg) scale(1.1);
}

.detail-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    font-weight: 600;
    margin-bottom: 0.25rem;
    transition: color 0.3s ease;
}

.detail-value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 600;
    transition: color 0.3s ease;
}

.hover-card:hover .detail-label {
    color: var(--stellantis-primary);
}

/* Additional Info */
.additional-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 1.5rem;
}

.info-section {
    padding: 1.5rem;
    background: var(--bg-secondary);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-muted);
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.info-section.issues {
    border-left: 4px solid var(--danger-color);
}

.info-section h3 {
    font-size: 1rem;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: color 0.3s ease;
}

.hover-card:hover h3 {
    color: var(--stellantis-primary);
}

.info-section p {
    color: var(--text-primary);
    line-height: 1.5;
    margin: 0;
    transition: color 0.3s ease;
}

/* Enhanced Files Section */
.branches-container {
    display: flex;
    flex-direction: column;
    gap: 2rem;
}

.branch-section {
    background: var(--card-bg);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
}

.branch-section:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.branch-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-muted);
}

.branch-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.branch-icon {
    width: 50px;
    height: 50px;
    background: var(--stellantis-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
}

.branch-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0 0 0.25rem 0;
}

.file-count {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.download-all-btn {
    background: var(--stellantis-primary);
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: var(--radius-md);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.download-all-btn:hover {
    background: var(--stellantis-secondary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.files-container {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.file-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem;
    background: var(--bg-primary);
    border: 1px solid var(--border-muted);
    border-radius: var(--radius-md);
    transition: all 0.3s ease;
}

.file-item:hover {
    background: var(--bg-secondary);
    border-color: var(--stellantis-primary);
    transform: translateX(5px);
    box-shadow: var(--shadow-sm);
}

.file-icon {
    font-size: 2rem;
    min-width: 40px;
    text-align: center;
    transition: all 0.3s ease;
}

.file-item:hover .file-icon {
    transform: scale(1.1);
}

.file-info {
    flex: 1;
    min-width: 0;
}

.file-name {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.25rem;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.file-meta {
    display: flex;
    gap: 1rem;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.file-type {
    background: var(--bg-secondary);
    padding: 0.125rem 0.5rem;
    border-radius: 12px;
    font-weight: 600;
}

.file-actions {
    display: flex;
    gap: 0.5rem;
    flex-shrink: 0;
}

.download-btn, .preview-btn {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--radius-sm);
    text-decoration: none;
    font-size: 0.85rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    white-space: nowrap;
}

.download-btn {
    background: var(--stellantis-primary);
    color: white;
}

.download-btn:hover {
    background: var(--stellantis-secondary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    color: white;
    text-decoration: none;
}

.preview-btn {
    background: var(--bg-secondary);
    color: var(--text-primary);
    border: 1px solid var(--border-muted);
}

.preview-btn:hover {
    background: var(--bg-tertiary);
    border-color: var(--stellantis-primary);
    color: var(--stellantis-primary);
    transform: translateY(-2px);
    box-shadow: var(--shadow-sm);
}

.no-files, .empty-state {
    text-align: center;
    padding: 3rem;
    color: var(--text-muted);
}

.empty-state i {
    font-size: 3rem;
    margin-bottom: 1rem;
    opacity: 0.5;
    color: var(--stellantis-primary);
}

.empty-state h3 {
    color: var(--text-secondary);
    margin-bottom: 0.5rem;
}

/* Responsive */
@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        gap: 1rem;
        text-align: center;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .additional-info {
        grid-template-columns: 1fr;
    }
    
    .tab-nav {
        flex-direction: column;
    }
    
    .branch-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .file-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .file-actions {
        width: 100%;
        justify-content: space-between;
    }
}

.modal { position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background: rgba(0,0,0,0.5);}
.modal-content { background: #fff; margin: 5% auto; padding: 20px; border-radius: 8px; width: 80%; max-width: 800px; position: relative;}
.close { position: absolute; right: 20px; top: 10px; font-size: 2rem; cursor: pointer;}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const targetTab = this.dataset.tab;
            
            // Remove active class from all tabs and contents
            tabBtns.forEach(b => b.classList.remove('active'));
            tabContents.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked tab and corresponding content
            this.classList.add('active');
            document.getElementById(targetTab).classList.add('active');
        });
    });
});

function previewFile(filename, fileId) {
    const modal = document.getElementById('filePreviewModal');
    const body = document.getElementById('filePreviewBody');
    // Support PDF and images
    const ext = filename.split('.').pop().toLowerCase();
    let content = '';
    if (['pdf'].includes(ext)) {
        content = `<iframe src="{{ url('files') }}/${fileId}/preview" style="width:100%;height:600px;" frameborder="0"></iframe>`;
    } else if (['png','jpg','jpeg','gif','bmp','webp'].includes(ext)) {
        content = `<img src="{{ url('files') }}/${fileId}/preview" style="max-width:100%;max-height:600px;" />`;
    } else {
        content = `<a href="{{ url('files') }}/${fileId}/download" target="_blank">Download file</a>`;
    }
    body.innerHTML = content;
    modal.style.display = 'block';
}

function closePreviewModal() {
    document.getElementById('filePreviewModal').style.display = 'none';
    document.getElementById('filePreviewBody').innerHTML = '';
}

window.onclick = function(event) {
    const modal = document.getElementById('filePreviewModal');
    if (event.target == modal) closePreviewModal();
}
</script>
@endsection