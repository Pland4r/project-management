@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Project Details Card -->
    <div class="modern-card mb-5 custom-card">
        <div class="modern-card-header">
            <i class="fas fa-project-diagram fa-lg animated-icon"></i>
            <span class="modern-card-title">Project Details</span>
        </div>
        <div class="modern-card-body">
            <h1 class="project-title">{{ $project->project_name }}</h1>
            <div class="project-meta">
                <span class="meta-label">Responsible:</span>
                <span class="meta-value highlight-text">{{ $project->person_name }}</span>
                <span class="meta-label">Members:</span>
                <span class="meta-value highlight-text">{{ $project->members->pluck('name')->join(', ') }}</span>
            </div>
        </div>
    </div>
        
    <!-- Specifications Card -->
    <div class="modern-card mb-5 centered-spec-card custom-card">
        <div class="modern-card-header">
            <i class="fas fa-cogs fa-lg animated-icon"></i>
            <span class="modern-card-title">Specifications</span>
        </div>
        <div class="modern-card-body">
            <ul class="spec-tree">
                @foreach($project->gammes as $gamme)
                    <li class="spec-branch animated-branch">
                        <span class="branch-icon"><i class="fas fa-code-branch"></i></span>
                        <span class="branch-label">{{ $gamme->type }}</span>
                        <ul class="spec-leaves">
                            @foreach($gamme->files as $file)
                                <li class="spec-leaf animated-leaf">
                                    <span class="leaf-icon"><i class="fas fa-file-alt"></i></span>
                                    <a href="{{ route('files.download', $file->id) }}" class="file-link">{{ $file->original_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
        
    <!-- Essais/Messures Card -->
    <div class="modern-card custom-card">
        <div class="modern-card-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="d-flex align-items-center" style="gap: 0.7rem;">
                <i class="fas fa-vial fa-lg animated-icon"></i>
                <span class="modern-card-title">Essais/Messures</span>
            </div>
            <a href="{{ route('essai_messures.create', $project->id) }}" class="modern-create-btn pulse-btn">
                <i class="fas fa-plus"></i> Create New Essai/Messure
            </a>
        </div>
        <div class="modern-table-wrapper">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th class="col-type sortable-header" data-column="type">Type <i class="fas fa-sort sort-icon"></i></th>
                        <th class="col-name sortable-header" data-column="name">Name <i class="fas fa-sort sort-icon"></i></th>
                        <th class="col-person">Person</th>
                        <th class="col-person">Validator</th>
                        <th class="col-date">Start Date</th>
                        <th class="col-date">End Date</th>
                        <th class="col-comment">Commentaire</th>
                        <th class="col-comment">Issues</th>
                        <th class="col-status">Etat</th>
                        <th class="col-actions">Actions</th>
                        <th class="col-editors">Editors</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($project->essaiMessures as $essai)
                        @php
                            $canEdit = (auth()->id() === $essai->user_id) || \App\Models\ProjectPermission::canEdit(auth()->id(), $essai->id);
                            $isOwner = auth()->id() === $essai->user_id;
                        @endphp
                        <tr class="table-row-animated" data-status="{{ strtolower($essai->etat) }}">
                            <td class="col-type">{{ $essai->type }}</td>
                            <td class="col-name">
                                <a href="{{ route('essai_messures.show', $essai->id) }}" class="essai-link">{{ $essai->name }}</a>
                            </td>
                            <td class="col-person">{{ $essai->person_name ?? 'N/A' }}</td>
                            <td class="col-person">{{ $essai->validator_name ?? 'N/A' }}</td>
                            <td class="col-date">{{ $essai->start_date ?? 'N/A' }}</td>
                            <td class="col-date">{{ $essai->end_date ?? 'N/A' }}</td>
                            <td class="col-comment">
                                <div class="comment-cell" title="{{ $essai->commentaire }}">
                                    {!! $essai->commentaire ? e($essai->commentaire) : '<span class="null-value">no comment</span>' !!}
                                </div>
                            </td>
                            <td class="col-comment">
                                <div class="comment-cell" title="{{ $essai->issues }}">
                                    {!! $essai->issues ? e($essai->issues) : '<span class="null-value">no issues</span>' !!}
                                </div>
                            </td>
                            <td class="col-status">
                                <span class="etat-badge etat-{{ strtolower($essai->etat) }} animated-badge">{{ ucfirst($essai->etat) }}</span>
                            </td>
                            <td class="col-actions">
                                @if($canEdit)
                                    <a href="{{ route('essai_messures.edit', $essai->id) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                @else
                                    <span class="text-muted">No access</span>
                                @endif
                            </td>
                            <td class="col-editors">
                                @if($isOwner)
                                    <button class="btn btn-info btn-sm manage-editors-btn" data-essai-id="{{ $essai->id }}">
                                        <i class="fas fa-users"></i> Manage
                                    </button>
                                @else
                                    <div class="editors-display">
                                        @if($essai->editors && $essai->editors->count())
                                            @foreach($essai->editors as $editor)
                                                <span class="badge badge-info">{{ $editor->name }}</span>
                                                @if(!$loop->last), @endif
                                            @endforeach
                                        @else
                                            <span class="text-muted">No editors</span>
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modals Container (Outside of table) -->
<div id="modals-container">
    @foreach($project->essaiMessures as $essai)
        @if(auth()->id() === $essai->user_id)
            <div id="editors-modal-{{ $essai->id }}" class="modal" data-essai-id="{{ $essai->id }}">
                <div class="modal-backdrop" onclick="hideEditorsModal({{ $essai->id }})"></div>
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fas fa-users"></i>
                            Manage Editors for "{{ $essai->name }}"
                        </h5>
                        <button type="button" class="modal-close" onclick="hideEditorsModal({{ $essai->id }})">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('essai_messures.update_editors', $essai->id) }}" class="editors-form">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="editors-{{ $essai->id }}" class="form-label">
                                    <i class="fas fa-user-plus"></i>
                                    Select editors who can modify this essai:
                                </label>
                                <div class="editors-select-container">
                                    <select name="editors[]" id="editors-{{ $essai->id }}" multiple class="editors-select">
                                        @foreach($users->where('id', '!=', $essai->user_id) as $user)
                                            <option value="{{ $user->id }}" 
                                                {{ $essai->editors && $essai->editors->contains($user->id) ? 'selected' : '' }}>
                                                {{ $user->name }} ({{ $user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <small class="form-text">Hold Ctrl/Cmd to select multiple editors</small>
                            </div>
                            
                            @if($essai->editors && $essai->editors->count())
                                <div class="current-editors">
                                    <h6><i class="fas fa-users-cog"></i> Current Editors:</h6>
                                    <div class="editors-list">
                                        @foreach($essai->editors as $editor)
                                            <span class="editor-badge">
                                                <i class="fas fa-user"></i>
                                                {{ $editor->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" onclick="hideEditorsModal({{ $essai->id }})" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Cancel
                            </button>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endif
    @endforeach
</div>

<style>
/* Previous CSS remains the same... */
/* Dark Mode Compatible CSS Variables */
:root {
    /* Light mode colors */
    --card-bg: #ffffff;
    --card-border: #e5e7eb;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-muted: #9ca3af;
    --text-inverse: #ffffff;
    --bg-primary: #ffffff;
    --bg-secondary: #f9fafb;
    --bg-tertiary: #f3f4f6;
    --border-muted: #d1d5db;
    --table-header-bg: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    --table-row-hover: #f8fafc;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    --body-bg: linear-gradient(135deg, #f4f8fb 0%, #e8f4f8 100%);
}

/* Dark mode colors */
[data-theme="dark"] {
    --card-bg: #1f2937;
    --card-border: #374151;
    --text-primary: #f9fafb;
    --text-secondary: #d1d5db;
    --text-muted: #9ca3af;
    --text-inverse: #1f2937;
    --bg-primary: #111827;
    --bg-secondary: #1f2937;
    --bg-tertiary: #374151;
    --border-muted: #4b5563;
    --table-header-bg: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
    --table-row-hover: #374151;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
    --body-bg: linear-gradient(135deg, #111827 0%, #1f2937 100%);
}

/* Auto dark mode detection */
@media (prefers-color-scheme: dark) {
    :root:not([data-theme="light"]) {
        --card-bg: #1f2937;
        --card-border: #374151;
        --text-primary: #f9fafb;
        --text-secondary: #d1d5db;
        --text-muted: #9ca3af;
        --text-inverse: #1f2937;
        --bg-primary: #111827;
        --bg-secondary: #1f2937;
        --bg-tertiary: #374151;
        --border-muted: #4b5563;
        --table-header-bg: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%);
        --table-row-hover: #374151;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.3), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.3), 0 4px 6px -2px rgba(0, 0, 0, 0.2);
        --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.4), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
        --body-bg: linear-gradient(135deg, #111827 0%, #1f2937 100%);
    }
}

/* Common CSS Variables */
:root {
    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;
    --radius-2xl: 1.5rem;
    --radius-full: 9999px;
    --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
    --primary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
    --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    --danger-gradient: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    --stellantis-primary: #2563eb;
    --stellantis-accent: #4f8cff;
    --stellantis-secondary: #6366f1;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --danger-color: #ef4444;
    --glow-color: rgba(37, 99, 235, 0.3);
}

/* Base Styles */
body {
    background: var(--body-bg);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.container {
    max-width: 100%;
    padding: 0 1rem;
}

.py-5 {
    padding-top: 3rem;
    padding-bottom: 3rem;
}

.mb-5 {
    margin-bottom: 3rem;
}

.d-flex {
    display: flex;
}

.justify-content-between {
    justify-content: space-between;
}

.align-items-center {
    align-items: center;
}

.flex-wrap {
    flex-wrap: wrap;
}

/* Enhanced Project Title */
.project-title {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 0.5rem;
    letter-spacing: -1px;
    display: flex;
    align-items: center;
    gap: 0.7rem;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: titleGlow 3s ease-in-out infinite alternate;
    transition: all 0.3s ease;
}

@keyframes titleGlow {
    0% { filter: drop-shadow(0 0 5px var(--glow-color)); }
    100% { filter: drop-shadow(0 0 15px var(--glow-color)); }
}

.project-meta {
    font-size: 1.1rem;
    margin-top: 0.5rem;
    display: flex;
    flex-wrap: wrap;
    gap: 1.5rem;
    align-items: center;
}

.meta-label {
    font-weight: 600;
    opacity: 0.85;
    margin-right: 0.3rem;
    color: var(--text-secondary);
}

.meta-value {
    font-weight: 500;
    margin-right: 1.2rem;
    color: var(--text-primary);
}

.highlight-text {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 600;
}

/* Enhanced Modern Card */
.modern-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
    padding: 2rem;
    margin-bottom: 2.5rem;
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modern-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 2px;
    background: var(--primary-gradient);
    transition: left 0.5s ease;
}

.modern-card:hover::before {
    left: 0;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.modern-card-header {
    display: flex;
    align-items: center;
    gap: 0.7rem;
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 1.2rem;
}

.modern-card-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--text-primary);
}

.modern-card-body {
    color: var(--text-primary);
}

/* Animated Icons */
.animated-icon {
    color: var(--stellantis-primary);
    transition: all 0.3s ease;
    animation: iconPulse 2s ease-in-out infinite;
}

@keyframes iconPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.animated-icon:hover {
    transform: rotate(360deg) scale(1.2);
    filter: drop-shadow(0 0 10px var(--glow-color));
}

/* Enhanced Create Button */
.modern-create-btn {
    background: var(--success-gradient);
    color: var(--text-inverse);
    border-radius: var(--radius-full);
    font-weight: 700;
    font-size: 1.08rem;
    padding: 0.6em 2em;
    box-shadow: var(--shadow-md);
    border: none;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.7rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

.modern-create-btn:hover {
    background: var(--primary-gradient);
    box-shadow: var(--shadow-xl);
    transform: translateY(-3px) scale(1.05);
    color: var(--text-inverse);
    text-decoration: none;
}

.pulse-btn {
    animation: buttonPulse 2s ease-in-out infinite;
}

@keyframes buttonPulse {
    0%, 100% { box-shadow: var(--shadow-md); }
    50% { box-shadow: 0 0 20px var(--glow-color); }
}

/* Enhanced Table Styles */
.modern-table-wrapper {
    overflow-x: auto;
    border-radius: var(--radius-xl);
    background: var(--bg-secondary);
    margin-top: 1rem;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.modern-table {
    width: 100%;
    min-width: 1400px;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
    background: var(--card-bg);
    border-radius: var(--radius-xl);
    overflow: hidden;
    color: var(--text-primary);
    table-layout: fixed;
}

/* Column Widths */
.modern-table .col-type { width: 8%; }
.modern-table .col-name { width: 15%; }
.modern-table .col-date { width: 12%; }
.modern-table .col-person { width: 10%; }
.modern-table .col-comment { width: 15%; }
.modern-table .col-status { width: 8%; }
.modern-table .col-actions { width: 10%; }
.modern-table .col-editors { width: 12%; }

.modern-table th, .modern-table td {
    padding: 1rem 0.8rem;
    text-align: left;
    font-weight: 600;
    border: none;
    background: none;
    color: var(--text-primary);
    font-size: 0.95rem;
    vertical-align: middle;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
    transition: all 0.3s ease;
}

.modern-table th {
    background: var(--table-header-bg);
    color: var(--text-inverse);
    font-weight: 700;
    letter-spacing: 0.04em;
    position: sticky;
    top: 0;
    z-index: 2;
    white-space: nowrap;
    font-size: 0.9rem;
    text-transform: uppercase;
}

/* Comment cells */
.comment-cell {
    max-width: 200px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    cursor: help;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.comment-cell:hover {
    overflow: visible;
    white-space: normal;
    word-wrap: break-word;
    background: var(--bg-tertiary);
    padding: 0.5rem;
    border-radius: var(--radius-sm);
    position: relative;
    z-index: 10;
    box-shadow: var(--shadow-lg);
    color: var(--text-primary);
}

.sortable-header {
    cursor: pointer;
    user-select: none;
    position: relative;
    transition: all 0.3s ease;
}

.sortable-header:hover {
    filter: brightness(1.1);
}

.sort-icon {
    opacity: 0.5;
    margin-left: 0.5rem;
    transition: all 0.3s ease;
    font-size: 0.8rem;
}

.sortable-header:hover .sort-icon {
    opacity: 1;
    transform: scale(1.1);
}

.modern-table tr {
    border-bottom: 1px solid var(--border-muted);
    transition: all 0.3s ease;
}

.table-row-animated {
    animation: slideInUp 0.5s ease forwards;
    opacity: 0;
    transform: translateY(20px);
}

@keyframes slideInUp {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.modern-table tbody tr:hover td {
    background: var(--table-row-hover);
}

.modern-table tr[data-status="approved"]:hover td {
    background: rgba(16, 185, 129, 0.1);
}

.modern-table tr[data-status="pending"]:hover td {
    background: rgba(245, 158, 11, 0.1);
}

.modern-table tr[data-status="rejected"]:hover td {
    background: rgba(239, 68, 68, 0.1);
}

/* Enhanced Badges */
.etat-badge {
    display: inline-block;
    padding: 0.4em 1em;
    border-radius: 1em;
    font-size: 0.85em;
    font-weight: 700;
    background: var(--bg-tertiary);
    color: var(--stellantis-primary);
    text-transform: capitalize;
    transition: all 0.3s ease;
    white-space: nowrap;
    min-width: 80px;
    text-align: center;
}

.animated-badge {
    animation: badgeGlow 3s ease-in-out infinite alternate;
}

@keyframes badgeGlow {
    0% { box-shadow: 0 0 5px rgba(0, 0, 0, 0.1); }
    100% { box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); }
}

.etat-pending {
    background: var(--warning-gradient);
    color: var(--text-inverse);
    animation: pendingPulse 2s ease-in-out infinite;
}

@keyframes pendingPulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.etat-approved {
    background: var(--success-gradient);
    color: var(--text-inverse);
}

.etat-rejected {
    background: var(--danger-gradient);
    color: var(--text-inverse);
}

.etat-badge:hover {
    transform: scale(1.1);
    box-shadow: var(--shadow-md);
}

/* Enhanced Links */
.essai-link {
    color: var(--stellantis-primary);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    display: inline-block;
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.essai-link::after {
    content: '';
    position: absolute;
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    background: var(--stellantis-accent);
    transition: width 0.3s ease;
}

.essai-link:hover::after {
    width: 100%;
}

.essai-link:hover {
    color: var(--stellantis-accent);
    transform: scale(1.05);
    text-decoration: none;
}

.null-value {
    color: var(--text-muted);
    font-style: italic;
    opacity: 0.7;
    animation: fadeInOut 3s ease-in-out infinite;
}

@keyframes fadeInOut {
    0%, 100% { opacity: 0.7; }
    50% { opacity: 0.4; }
}

/* Button Styles */
.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.5rem 1rem;
    border-radius: var(--radius-md);
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 0.875rem;
}

.btn-primary {
    background: var(--stellantis-primary);
    color: var(--text-inverse);
}

.btn-primary:hover {
    background: var(--stellantis-accent);
    color: var(--text-inverse);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-info {
    background: #17a2b8;
    color: var(--text-inverse);
}

.btn-info:hover {
    background: #138496;
    color: var(--text-inverse);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-success {
    background: var(--success-color);
    color: var(--text-inverse);
}

.btn-success:hover {
    background: #059669;
    color: var(--text-inverse);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-secondary {
    background: #6c757d;
    color: var(--text-inverse);
}

.btn-secondary:hover {
    background: #5a6268;
    color: var(--text-inverse);
    text-decoration: none;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.8rem;
}

/* Badge Styles */
.badge {
    display: inline-block;
    padding: 0.25em 0.5em;
    font-size: 0.75em;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: 0.375rem;
}

.badge-info {
    background-color: #17a2b8;
    color: var(--text-inverse);
}

.text-muted {
    color: var(--text-muted);
}

/* Specifications Tree Styles */
.centered-spec-card {
    margin-left: auto;
    margin-right: auto;
    max-width: 600px;
}

.spec-tree {
    list-style: none;
    padding-left: 0;
    margin-bottom: 0;
    margin-top: 1.2rem;
}

.spec-branch {
    margin-bottom: 1.5rem;
    position: relative;
    padding-left: 2.2rem;
}

.animated-branch {
    animation: slideInLeft 0.6s ease forwards;
    opacity: 0;
    transform: translateX(-20px);
}

@keyframes slideInLeft {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.branch-icon {
    position: absolute;
    left: 0;
    top: 0.1rem;
    color: var(--stellantis-primary);
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.spec-branch:hover .branch-icon {
    color: var(--stellantis-accent);
    transform: rotate(90deg) scale(1.2);
}

.branch-label {
    font-weight: 700;
    font-size: 1.13rem;
    color: var(--stellantis-accent);
    margin-bottom: 0.3rem;
    display: inline-block;
    transition: all 0.3s ease;
}

.spec-branch:hover .branch-label {
    color: var(--stellantis-primary);
    transform: translateX(5px);
}

.spec-leaves {
    list-style: none;
    margin-left: 1.5rem;
    margin-top: 0.5rem;
    padding-left: 1.2rem;
    border-left: 2px solid var(--border-muted);
    transition: border-color 0.3s ease;
}

.spec-branch:hover .spec-leaves {
    border-left-color: var(--stellantis-primary);
}

.spec-leaf {
    display: flex;
    align-items: center;
    margin-bottom: 0.5rem;
    position: relative;
    color: var(--text-primary);
    transition: all 0.3s ease;
}

.animated-leaf {
    animation: leafFloat 0.8s ease forwards;
    opacity: 0;
    transform: translateY(10px);
}

@keyframes leafFloat {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.spec-leaf:hover {
    transform: translateX(10px);
    background: var(--bg-tertiary);
    border-radius: var(--radius-md);
    padding: 0.2rem 0.5rem;
}

.leaf-icon {
    color: var(--stellantis-secondary);
    margin-right: 0.6rem;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.spec-leaf:hover .leaf-icon {
    color: var(--stellantis-primary);
    transform: scale(1.2);
}

.file-link {
    color: var(--stellantis-primary);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
}

.file-link::before {
    content: '';
    position: absolute;
    width: 0;
    height: 1px;
    bottom: -1px;
    left: 0;
    background: var(--stellantis-accent);
    transition: width 0.3s ease;
}

.file-link:hover::before {
    width: 100%;
}

.file-link:hover {
    color: var(--stellantis-accent);
    transform: scale(1.05);
    text-decoration: none;
}

/* Enhanced Modal Styles */
.modal {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    z-index: 9999;
    align-items: center;
    justify-content: center;
    animation: modalFadeIn 0.3s ease;
}

.modal.active {
    display: flex !important;
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.modal-backdrop {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--card-border);
    max-width: 500px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
    z-index: 10;
    animation: modalSlideIn 0.3s ease;
}

@keyframes modalSlideIn {
    from {
        transform: translateY(-50px) scale(0.9);
        opacity: 0;
    }
    to {
        transform: translateY(0) scale(1);
        opacity: 1;
    }
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem 2rem 1rem;
    border-bottom: 1px solid var(--border-muted);
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.2rem;
    color: var(--text-muted);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: var(--radius-md);
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: var(--bg-tertiary);
    color: var(--text-primary);
    transform: scale(1.1);
}

.modal-body {
    padding: 1.5rem 2rem;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1rem 2rem 1.5rem;
    border-top: 1px solid var(--border-muted);
}

/* Form Styles */
.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-label i {
    margin-right: 0.5rem;
    color: var(--stellantis-primary);
}

.editors-select-container {
    position: relative;
}

.editors-select {
    width: 100%;
    min-height: 120px;
    padding: 0.75rem;
    border: 2px solid var(--border-muted);
    border-radius: var(--radius-md);
    background: var(--bg-secondary);
    color: var(--text-primary);
    font-size: 0.9rem;
    transition: all 0.3s ease;
    resize: vertical;
}

.editors-select:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.editors-select option {
    padding: 0.5rem;
    background: var(--card-bg);
    color: var(--text-primary);
}

.editors-select option:checked {
    background: var(--stellantis-primary);
    color: var(--text-inverse);
}

.form-text {
    font-size: 0.8rem;
    color: var(--text-muted);
    margin-top: 0.25rem;
    display: block;
}

.current-editors {
    margin-top: 1rem;
    padding: 1rem;
    background: var(--bg-tertiary);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-muted);
}

.current-editors h6 {
    margin: 0 0 0.75rem 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.current-editors h6 i {
    color: var(--stellantis-primary);
}

.editors-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.editor-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    padding: 0.375rem 0.75rem;
    background: var(--stellantis-primary);
    color: var(--text-inverse);
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
}

.editor-badge:hover {
    background: var(--stellantis-accent);
    transform: scale(1.05);
}

.editors-display {
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    align-items: center;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .modern-table {
        min-width: 1200px;
    }
    .modern-table th,
    .modern-table td {
        padding: 0.8rem 0.6rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 991px) {
    .container {
        padding: 0 0.5rem;
    }
    .modern-card {
        padding: 1.5rem 1rem;
    }
    .modern-table {
        min-width: 1000px;
    }
    .modern-table th,
    .modern-table td {
        padding: 0.7rem 0.5rem;
        font-size: 0.85rem;
    }
    .project-title {
        font-size: 2rem;
    }
    .modern-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    .modal-content {
        width: 95%;
        margin: 1rem;
    }
    .modal-header,
    .modal-body,
    .modal-footer {
        padding-left: 1rem;
        padding-right: 1rem;
    }
}

@media (max-width: 768px) {
    .modern-card {
        padding: 1rem 0.5rem;
    }
    .modern-card-header {
        font-size: 1.1rem;
    }
    .modern-card-title {
        font-size: 1.1rem;
    }
    .modern-table {
        min-width: 800px;
    }
    .project-title {
        font-size: 1.8rem;
    }
    .modern-create-btn {
        font-size: 0.9rem;
        padding: 0.5em 1.5em;
    }
    .modal-content {
        width: 98%;
        margin: 0.5rem;
    }
}

@media (max-width: 576px) {
    .modern-card {
        padding: 0.8rem 0.3rem;
    }
    .modern-table {
        min-width: 700px;
    }
    .project-title {
        font-size: 1.6rem;
    }
    .modal-footer {
        flex-direction: column;
        gap: 0.5rem;
    }
    .modal-footer .btn {
        width: 100%;
        justify-content: center;
    }
}

/* Print Styles */
@media print {
    body {
        background: white !important;
        color: black !important;
    }
    
    .modern-card {
        background: white !important;
        border: 1px solid #ccc !important;
        box-shadow: none !important;
    }
    
    .modern-table th {
        background: #f5f5f5 !important;
        color: black !important;
    }
    
    .animated-icon,
    .modern-create-btn,
    .modal {
        display: none !important;
    }
}

/* High Contrast Mode */
@media (prefers-contrast: high) {
    :root {
        --card-border: #000000;
        --text-primary: #000000;
        --text-secondary: #333333;
        --border-muted: #000000;
    }
    
    [data-theme="dark"] {
        --card-border: #ffffff;
        --text-primary: #ffffff;
        --text-secondary: #cccccc;
        --border-muted: #ffffff;
    }
}

/* Reduced Motion */
@media (prefers-reduced-motion: reduce) {
    *,
    *::before,
    *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced card hover effect
    document.querySelectorAll('.custom-card').forEach(function(card) {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
            this.style.boxShadow = '0 20px 40px -8px rgba(37, 99, 235, 0.25)';
            this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
            this.style.boxShadow = '';
            this.style.transition = 'all 0.4s cubic-bezier(0.4, 0, 0.2, 1)';
        });
    });

    // Animate table rows on load
    document.querySelectorAll('.table-row-animated').forEach(function(row, index) {
        setTimeout(function() {
            row.style.animationDelay = (index * 0.1) + 's';
            row.classList.add('animate');
        }, 100);
    });

    // Animate spec branches on load
    document.querySelectorAll('.animated-branch').forEach(function(branch, index) {
        setTimeout(function() {
            branch.style.animationDelay = (index * 0.2) + 's';
        }, 200);
    });

    // Animate spec leaves on load
    document.querySelectorAll('.animated-leaf').forEach(function(leaf, index) {
        setTimeout(function() {
            leaf.style.animationDelay = (index * 0.1 + 0.3) + 's';
        }, 300);
    });

    // Enhanced button click effect
    document.querySelectorAll('.modern-create-btn, .btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.position = 'absolute';
            ripple.style.borderRadius = '50%';
            ripple.style.background = 'rgba(255, 255, 255, 0.6)';
            ripple.style.transform = 'scale(0)';
            ripple.style.animation = 'ripple 0.6s linear';
            ripple.style.pointerEvents = 'none';
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Enhanced manage editors button functionality
    document.querySelectorAll('.manage-editors-btn').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const essaiId = this.dataset.essaiId;
            showEditorsModal(essaiId);
        });
    });

    // Table sorting functionality
    document.querySelectorAll('.sortable-header').forEach(function(header) {
        header.addEventListener('click', function() {
            const column = this.dataset.column;
            const table = this.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const icon = this.querySelector('.sort-icon');
            
            // Reset all other sort icons
            document.querySelectorAll('.sort-icon').forEach(function(otherIcon) {
                if (otherIcon !== icon) {
                    otherIcon.className = 'fas fa-sort sort-icon';
                }
            });
            
            // Toggle sort direction
            let ascending = true;
            if (icon.classList.contains('fa-sort-up')) {
                ascending = false;
                icon.className = 'fas fa-sort-down sort-icon';
            } else {
                icon.className = 'fas fa-sort-up sort-icon';
            }
            
            // Sort rows
            rows.sort(function(a, b) {
                let aVal = a.cells[getColumnIndex(column)].textContent.trim();
                let bVal = b.cells[getColumnIndex(column)].textContent.trim();
                
                // Handle dates
                if (column === 'created' || column === 'updated') {
                    aVal = new Date(aVal);
                    bVal = new Date(bVal);
                }
                
                if (ascending) {
                    return aVal > bVal ? 1 : -1;
                } else {
                    return aVal < bVal ? 1 : -1;
                }
            });
            
            // Re-append sorted rows
            rows.forEach(function(row) {
                tbody.appendChild(row);
            });
            
            // Re-animate rows
            rows.forEach(function(row, index) {
                row.style.animation = 'none';
                setTimeout(function() {
                    row.style.animation = 'slideInUp 0.3s ease forwards';
                    row.style.animationDelay = (index * 0.05) + 's';
                }, 10);
            });
        });
    });
    
    function getColumnIndex(column) {
        const columnMap = {
            'type': 0,
            'name': 1,
            'created': 2,
            'updated': 3
        };
        return columnMap[column] || 0;
    }

    // Enhanced link interactions
    document.querySelectorAll('.file-link, .essai-link').forEach(function(link) {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px) scale(1.05)';
            this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
        
        link.addEventListener('click', function(e) {
            // Add click animation
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 150);
        });
    });

    // Intersection Observer for animations
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    // Observe all animated elements
    document.querySelectorAll('.animated-branch, .animated-leaf, .table-row-animated').forEach(function(el) {
        observer.observe(el);
    });

    // Theme detection and persistence
    function detectTheme() {
        const savedTheme = localStorage.getItem('theme');
        const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        if (savedTheme) {
            document.documentElement.setAttribute('data-theme', savedTheme);
        } else if (systemPrefersDark) {
            document.documentElement.setAttribute('data-theme', 'dark');
        } else {
            document.documentElement.setAttribute('data-theme', 'light');
        }
    }

    // Initialize theme
    detectTheme();

    // Listen for system theme changes
    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
        if (!localStorage.getItem('theme')) {
            document.documentElement.setAttribute('data-theme', e.matches ? 'dark' : 'light');
        }
    });

    // Close modal when clicking outside
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('modal-backdrop')) {
            const modal = e.target.closest('.modal');
            if (modal) {
                const essaiId = modal.dataset.essaiId;
                hideEditorsModal(essaiId);
            }
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const activeModal = document.querySelector('.modal.active');
            if (activeModal) {
                const essaiId = activeModal.dataset.essaiId;
                hideEditorsModal(essaiId);
            }
        }
    });
});

// Enhanced Modal Functions
function showEditorsModal(id) {
    const modal = document.getElementById('editors-modal-' + id);
    if (modal) {
        modal.classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent background scrolling
        
        // Focus on the select element for better UX
        setTimeout(() => {
            const select = modal.querySelector('.editors-select');
            if (select) {
                select.focus();
            }
        }, 300);
    }
}

function hideEditorsModal(id) {
    const modal = document.getElementById('editors-modal-' + id);
    if (modal) {
        modal.classList.remove('active');
        document.body.style.overflow = ''; // Restore scrolling
    }
}

// Add ripple animation CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);
</script>
@endsection
