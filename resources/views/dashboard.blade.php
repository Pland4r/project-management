@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Card -->
    <div class="card mb-4">
        <div class="card-header">
            <div>
                <h2 class="mb-0" style="display: flex; align-items: center; gap: 10px;">
                    <img src="images/final2.png" 
                    alt="Stellantis Logo" 
                    style="width: 80px; height: auto; object-fit: contain;">
                    <span>Stellantis HUB</span>
                </h2>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    Manage and track your automotive innovation projects
                </p>
            </div>
            
            <div class="d-flex gap-3" style="flex-wrap: wrap;">
    <!-- Search Bar -->
    <div class="search-container" style="position: relative; min-width: 300px;">
        <input type="text" id="projectSearchInput" class="form-control search-input" placeholder="Search projects by name..." style="padding-left: 40px; padding-right: 40px;">
        <i class="fas fa-search search-icon"></i>
        <button type="button" id="clearSearchBtn" class="search-clear-btn" style="display: none;">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('dashboard') }}" class="d-flex gap-2" style="flex-wrap: wrap;" id="filterForm">
        <input type="hidden" name="search" id="searchHiddenInput" value="{{ request('search') }}">
        
        <select name="reference_filter" class="form-select" style="min-width: 160px;">
            <option value="">All Types</option>
            <option value="essai" {{ request('reference_filter') == 'essai' ? 'selected' : '' }}>ESS (Essai)</option>
            <option value="messure" {{ request('reference_filter') == 'messure' ? 'selected' : '' }}>MES (Mesure)</option>
        </select>

        <select name="date_sort" class="form-select" style="min-width: 160px;">
            <option value="">Sort by Date</option>
            <option value="asc" {{ request('date_sort') == 'asc' ? 'selected' : '' }}>Oldest First</option>
            <option value="desc" {{ request('date_sort') == 'desc' ? 'selected' : '' }}>Newest First</option>
        </select>

        <button type="submit" class="btn btn-primary">
            <i class="fas fa-filter"></i> Apply
        </button>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-redo"></i> Reset
        </a>
    </form>

    <!-- Action Buttons -->
    <div class="d-flex gap-2">
        <a href="{{ route('projects.export') }}" class="btn btn-outline-primary">
            <i class="fas fa-download"></i> Export
        </a>
        <a href="{{ route('projects.create') }}" class="btn btn-success">
            <i class="fas fa-plus"></i> New Project
        </a>
        <a href="{{ route('gammes.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-layer-group"></i> Gammes
        </a>
    </div>
</div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards with Real-time Users -->
    <div class="row mb-4" style="gap: 0;">
    <!-- Real-time Active Users Card -->
    <div class="col-md-2-4">
        <div class="stats-card stats-card-live">
            <div class="stats-card-background"></div>
            <div class="stats-card-content">
                <div class="stats-icon-container">
                    <div class="stats-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stats-pulse stats-pulse-live"></div>
                    <div class="live-indicator">
                        <span class="live-dot"></span>
                        <span class="live-text">LIVE</span>
                    </div>
                </div>
                <div class="stats-info">
                    <div class="stats-number" id="activeUsersCount" data-target="0">0</div>
                    <div class="stats-label">Active Users</div>
                    <div class="stats-trend">
                        <i class="fas fa-circle live-status-icon"></i>
                        <span id="lastUpdateTime">Just now</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2-4">
        <div class="stats-card stats-card-primary">
            <div class="stats-card-background"></div>
            <div class="stats-card-content">
                <div class="stats-icon-container">
                    <div class="stats-icon">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <div class="stats-pulse"></div>
                </div>
                <div class="stats-info">
                    <div class="stats-number" data-target="{{ $projects->count() }}">0</div>
                    <div class="stats-label">Total Projects</div>
                    <div class="stats-trend">
                        <i class="fas fa-arrow-up"></i>
                        <span>All time</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2-4">
        <div class="stats-card stats-card-warning">
            <div class="stats-card-background"></div>
            <div class="stats-card-content">
                <div class="stats-icon-container">
                    <div class="stats-icon">
                        <i class="fas fa-rocket"></i>
                    </div>
                    <div class="stats-pulse"></div>
                </div>
                <div class="stats-info">
                    <div class="stats-number" data-target="{{ $projects->where('etat', 'in_progress')->count() }}">0</div>
                    <div class="stats-label">Active Projects</div>
                    <div class="stats-trend">
                        <i class="fas fa-spinner fa-spin"></i>
                        <span>In progress</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2-4">
        <div class="stats-card stats-card-success">
            <div class="stats-card-background"></div>
            <div class="stats-card-content">
                <div class="stats-icon-container">
                    <div class="stats-icon">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="stats-pulse"></div>
                </div>
                <div class="stats-info">
                    <div class="stats-number" data-target="{{ $projects->where('etat', 'completed')->count() }}">0</div>
                    <div class="stats-label">Completed</div>
                    <div class="stats-trend">
                        <i class="fas fa-check-circle"></i>
                        <span>Finished</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-2-4">
        <div class="stats-card stats-card-danger">
            <div class="stats-card-background"></div>
            <div class="stats-card-content">
                <div class="stats-icon-container">
                    <div class="stats-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stats-pulse"></div>
                </div>
                <div class="stats-info">
                    <div class="stats-number" data-target="{{ $projects->whereNotNull('issues')->where('issues', '!=', '')->count() }}">0</div>
                    <div class="stats-label">Issues Found</div>
                    <div class="stats-trend">
                        <i class="fas fa-exclamation-circle"></i>
                        <span>Need attention</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Projects Table Card -->
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-table me-2"></i>
                    Active Projects
                </h3>
                <p class="mb-0 project-count-display" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    {{ $projects->count() }} projects found
                </p>
            </div>
        </div>

        <div class="card-body">
            @if($projects->isEmpty())
                <div class="alert alert-info text-center" style="margin: 2rem;">
                    <i class="fas fa-info-circle" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                    <h4>No Projects Found</h4>
                    <p>Start your innovation journey by creating your first project.</p>
                    <a href="{{ route('projects.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-2"></i>Create First Project
                    </a>
                </div>
            @else
                <!-- No Search Results Message (Hidden by default) -->
                <div id="noSearchResults" class="alert alert-warning text-center" style="margin: 2rem; display: none;">
                    <i class="fas fa-search" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: #f39c12;"></i>
                    <h4>No Projects Found</h4>
                    <p id="noResultsText">No projects match your search criteria.</p>
                    <button type="button" id="clearSearchFromResults" class="btn btn-outline-warning">
                        <i class="fas fa-times me-2"></i>Clear Search
                    </button>
                </div>

                <div style="overflow-x: auto; width: 100%;" id="projectsTableContainer">
                    <table class="modern-table" style="min-width: 100%;">
                        <thead>
                            <tr>
                                <th><i class="fas fa-cogs"></i> Acts</th>
                                <th><i class="fas fa-hashtag"></i> Ref</th>
                                <th><i class="fas fa-project-diagram"></i> Project</th>
                                <th><i class="fas fa-tag"></i> Type</th>
                                <th><i class="fas fa-stamp"></i> Mark</th>
                                <th><i class="fas fa-calendar-alt"></i> Start</th>
                                <th><i class="fas fa-calendar-check"></i> End</th>
                                <th><i class="fas fa-traffic-light"></i> Status</th>
                                <th><i class="fas fa-user"></i> Tester</th>
                                <th><i class="fas fa-user-check"></i> Validator</th>
                                <th><i class="fas fa-comments"></i> Notes</th>
                                <th><i class="fas fa-exclamation-triangle"></i> Issues</th>
                            </tr>
                        </thead>
                        <tbody id="projectsTableBody">
                            @foreach($projects as $project)
                                <tr class="project-row" data-project-name="{{ strtolower($project->name) }}">
                                    <td>
                                        @if ($project->user_id === auth()->id())
                                            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-eye"></i> View
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <strong style="font-family: 'Courier New', monospace;">
                                            {{ $project->reference }}
                                        </strong>
                                    </td>
                                    <td>
                                        <div class="expandable-content project-name-cell" title="{{ $project->name }}">
                                            {{ $project->name }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge {{ $project->type === 'essai' ? 'bg-primary' : 'bg-success' }}">
                                            <i class="fas fa-{{ $project->type === 'essai' ? 'flask' : 'ruler' }}"></i>
                                            {{ strtoupper($project->type) }}
                                        </span>
                                    </td>
                                    <td>
                                        <code style="background: rgba(102, 126, 234, 0.1); padding: 0.25rem 0.5rem; border-radius: 0.375rem; font-size: 0.75rem;">
                                            {{ $project->contreMarque }}
                                        </code>
                                    </td>
                                    <td>
                                        <time datetime="{{ $project->start_date }}">
                                            {{ \Carbon\Carbon::parse($project->start_date)->format('d/m/Y') }}
                                        </time>
                                    </td>
                                    <td>
                                        <time datetime="{{ $project->end_date }}">
                                            {{ \Carbon\Carbon::parse($project->end_date)->format('d/m/Y') }}
                                        </time>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            $project->etat === 'pending' ? 'warning' :
                                            ($project->etat === 'in_progress' ? 'primary' :
                                            ($project->etat === 'completed' ? 'success' : 'secondary'))
                                        }}">
                                            @if($project->etat === 'pending')
                                                <i class="fas fa-clock"></i> Pending
                                            @elseif($project->etat === 'in_progress')
                                                <i class="fas fa-spinner fa-spin"></i> Active
                                            @elseif($project->etat === 'completed')
                                                <i class="fas fa-check-circle"></i> Done
                                            @else
                                                {{ ucfirst($project->etat) }}
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        <div class="expandable-content" title="{{ $project->person_name }}">
                                            {{ $project->person_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="expandable-content" title="{{ $project->validator_name }}">
                                            {{ $project->validator_name }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="expandable-content" title="{{ $project->commentaire }}">
                                            {{ $project->commentaire }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($project->issues)
                                            <div class="expandable-content" title="{{ $project->issues }}" style="color: #dc2626;">
                                                <i class="fas fa-exclamation-circle"></i>
                                                {{ $project->issues }}
                                            </div>
                                        @else
                                            <span style="color: #059669; font-size: 0.75rem;">
                                                <i class="fas fa-check-circle"></i> No Issues
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- CSRF Token for JavaScript -->
<form id="csrf-form" style="display: none;">
    @csrf
</form>

<!-- Keep all your existing styles here -->
<style>
/* All your existing CSS styles remain the same */
/* Enhanced Statistics Cards */
.stats-card {
    position: relative;
    height: 140px;
    border-radius: var(--radius-xl, 0.75rem);
    overflow: hidden;
    cursor: pointer;
    transition: all var(--transition-normal, 0.3s ease);
    margin-bottom: var(--space-lg, 1.5rem);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 100%);
    z-index: 1;
}

.stats-card-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.9;
    transition: all var(--transition-normal, 0.3s ease);
}

.stats-card-primary .stats-card-background {
    background: var(--primary-gradient, linear-gradient(135deg, #667eea 0%, #764ba2 100%));
}

.stats-card-warning .stats-card-background {
    background: var(--warning-gradient, linear-gradient(135deg, #f093fb 0%, #f5576c 100%));
}

.stats-card-success .stats-card-background {
    background: var(--success-gradient, linear-gradient(135deg, #4facfe 0%, #00f2fe 100%));
}

.stats-card-danger .stats-card-background {
    background: var(--danger-gradient, linear-gradient(135deg, #fa709a 0%, #fee140 100%));
}

.stats-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: var(--shadow-2xl, 0 25px 50px -12px rgba(0, 0, 0, 0.25));
}

.stats-card:hover .stats-card-background {
    opacity: 1;
}

.stats-card-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-lg, 1.5rem);
    color: white;
}

.stats-icon-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-full, 50%);
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    position: relative;
    z-index: 3;
    transition: all var(--transition-normal, 0.3s ease);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.stats-card:hover .stats-icon {
    transform: scale(1.1) rotate(5deg);
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
}

.stats-pulse {
    position: absolute;
    width: 60px;
    height: 60px;
    border-radius: var(--radius-full, 50%);
    background: rgba(255, 255, 255, 0.1);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% {
        transform: scale(1);
        opacity: 1;
    }
    50% {
        transform: scale(1.2);
        opacity: 0.5;
    }
    100% {
        transform: scale(1.4);
        opacity: 0;
    }
}

.stats-info {
    flex: 1;
    text-align: right;
    margin-left: var(--space-md, 1rem);
}

.stats-number {
    font-size: 2.5rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: var(--space-xs, 0.25rem);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.02em;
}

.stats-label {
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: var(--space-xs, 0.25rem);
    opacity: 0.95;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stats-trend {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: var(--space-xs, 0.25rem);
    font-size: 0.75rem;
    opacity: 0.8;
    font-weight: 500;
}

.stats-trend i {
    font-size: 0.75rem;
}

/* Number Counter Animation */
@keyframes countUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.stats-number.counting {
    animation: countUp 0.6s ease-out;
}

/* Real-time Active Users Card Styles */
.stats-card-live {
    position: relative;
    height: 140px;
    border-radius: var(--radius-xl, 0.75rem);
    overflow: hidden;
    cursor: pointer;
    transition: all var(--transition-normal, 0.3s ease);
    margin-bottom: var(--space-lg, 1.5rem);
    border: 1px solid rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(20px);
}

.stats-card-live .stats-card-background {
    background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 50%, #c084fc 100%);
    animation: liveGradient 3s ease-in-out infinite;
}

@keyframes liveGradient {
    0%, 100% {
        background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 50%, #c084fc 100%);
    }
    50% {
        background: linear-gradient(135deg, #a855f7 0%, #c084fc 50%, #ddd6fe 100%);
    }
}

.stats-card-live .stats-icon {
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.stats-card-live .stats-pulse-live {
    position: absolute;
    width: 60px;
    height: 60px;
    border-radius: var(--radius-full, 50%);
    background: rgba(255, 255, 255, 0.1);
    animation: livePulse 1.5s infinite;
}

@keyframes livePulse {
    0% {
        transform: scale(1);
        opacity: 1;
        background: rgba(139, 92, 246, 0.3);
    }
    50% {
        transform: scale(1.3);
        opacity: 0.6;
        background: rgba(168, 85, 247, 0.2);
    }
    100% {
        transform: scale(1.6);
        opacity: 0;
        background: rgba(196, 132, 252, 0.1);
    }
}

.live-indicator {
    position: absolute;
    top: 6px;
    right: 6px;
    display: flex;
    align-items: center;
    gap: 3px;
    background: rgba(239, 68, 68, 0.9);
    padding: 3px 6px;
    border-radius: 10px;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    z-index: 4;
}

.live-dot {
    width: 5px;
    height: 5px;
    background: #fff;
    border-radius: 50%;
    animation: liveBlink 1s infinite;
}

@keyframes liveBlink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.3; }
}

.live-text {
    color: white;
    font-size: 0.55rem;
}

.live-status-icon {
    color: #10b981;
    animation: liveBlink 1s infinite;
    font-size: 0.6rem;
}

/* Custom 5-column grid for statistics cards */
.col-md-2-4 {
    flex: 0 0 20%;
    max-width: 20%;
    padding-right: 10px;
    padding-left: 10px;
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .col-md-2-4 {
        flex: 0 0 50%;
        max-width: 50%;
        margin-bottom: 1rem;
    }
    
    .stats-card {
        height: 120px;
    }
    
    .stats-number {
        font-size: 2rem;
    }
    
    .stats-label {
        font-size: 0.8rem;
    }
}

@media (max-width: 768px) {
    .col-md-2-4 {
        flex: 0 0 100%;
        max-width: 100%;
        margin-bottom: 1rem;
    }
    
    .stats-card {
        height: 100px;
    }
    
    .stats-card-content {
        padding: var(--space-md, 1rem);
    }
    
    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.2rem;
    }
    
    .stats-pulse, .stats-pulse-live {
        width: 50px;
        height: 50px;
    }
    
    .stats-number {
        font-size: 1.8rem;
    }
    
    .stats-label {
        font-size: 0.75rem;
    }
    
    .stats-info {
        margin-left: var(--space-sm, 0.5rem);
    }
}

@media (max-width: 576px) {
    .stats-card-content {
        flex-direction: column;
        text-align: center;
        gap: var(--space-sm, 0.5rem);
        padding: var(--space-sm, 0.5rem);
    }
    
    .stats-info {
        margin-left: 0;
        text-align: center;
    }
    
    .stats-trend {
        justify-content: center;
    }
}

/* Search Bar Styles */
.search-container {
    position: relative;
    transition: all 0.3s ease;
}

.search-input {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    transition: all 0.3s ease;
    font-size: 14px;
}

.search-input:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
    outline: none;
}

.search-icon {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6c757d;
    z-index: 2;
}

.search-clear-btn {
    position: absolute;
    right: 8px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #6c757d;
    cursor: pointer;
    padding: 4px;
    border-radius: 50%;
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    z-index: 2;
}

.search-clear-btn:hover {
    background-color: #f8f9fa;
    color: #dc3545;
}

/* Search Highlighting */
.search-highlight {
    background-color: #fff3cd;
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: 600;
    color: #856404;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get CSRF token from the hidden form
    const csrfToken = document.querySelector('#csrf-form input[name="_token"]').value;
    console.log('CSRF Token:', csrfToken ? 'Found' : 'Not found');
    
    
    // Real-time user tracking variables
    let activeUsersCount = 0;
    let updateInterval;
    let heartbeatInterval;
    let lastHeartbeat = Date.now();
    
    // Fetch active users count
    async function fetchActiveUsers() {
        try {
            console.log('Fetching active users...');
            const response = await fetch('/api/active-users');
            
            if (response.ok) {
                const data = await response.json();
                console.log('Active users response:', data);
                updateActiveUsersDisplay(data.count);
                updateLastSeenTime();
                lastHeartbeat = Date.now();
                
                // Update debug info automatically
                
            } else {
                console.error('Failed to fetch active users:', response.status, response.statusText);
                throw new Error('Failed to fetch active users');
            }
        } catch (error) {
            console.error('Error fetching active users:', error);
        }
    }
    
    // Update active users display with animation
    function updateActiveUsersDisplay(newCount) {
        const countElement = document.getElementById('activeUsersCount');
        const currentCount = parseInt(countElement.textContent) || 0;
        
        console.log(`Updating count from ${currentCount} to ${newCount}`);
        
        if (newCount !== currentCount) {
            // Animate the number change
            animateNumberChange(countElement, currentCount, newCount);
            activeUsersCount = newCount;
        }
    }
    
    // Animate number change
    function animateNumberChange(element, from, to) {
        const duration = 800;
        const steps = 20;
        const stepValue = (to - from) / steps;
        const stepDuration = duration / steps;
        let currentStep = 0;
        
        element.classList.add('counting');
        
        const timer = setInterval(() => {
            currentStep++;
            const currentValue = Math.round(from + (stepValue * currentStep));
            element.textContent = currentStep === steps ? to : currentValue;
            
            if (currentStep >= steps) {
                clearInterval(timer);
                element.classList.remove('counting');
            }
        }, stepDuration);
    }
    
    // Update last seen time
    function updateLastSeenTime() {
        const timeElement = document.getElementById('lastUpdateTime');
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false, 
            hour: '2-digit', 
            minute: '2-digit',
            second: '2-digit'
        });
        timeElement.textContent = timeString;
    }
    
    // Send heartbeat to server
    async function sendHeartbeat() {
        try {
            console.log('Sending heartbeat...');
            
            // Create a form for the POST request
            const form = new FormData();
            form.append('_token', csrfToken);
            form.append('timestamp', Date.now());
            form.append('page', 'dashboard');
            
            const response = await fetch('/api/heartbeat', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: form
            });
            
            if (response.ok) {
                const data = await response.json();
                console.log('Heartbeat response:', data);
                lastHeartbeat = Date.now();
                
                // Immediately fetch updated count after successful heartbeat
                setTimeout(fetchActiveUsers, 500);
            } else {
                console.error('Heartbeat failed:', response.status, response.statusText);
                const errorText = await response.text();
                console.error('Error details:', errorText);
            }
        } catch (error) {
            console.error('Error sending heartbeat:', error);
        }
    }
    
    // Initialize real-time tracking
    async function initializeRealTimeTracking() {
        console.log('Initializing real-time tracking...');
        
        
        
        // Send immediate heartbeat first
        await sendHeartbeat();
        
        // Wait a moment then fetch users
        setTimeout(fetchActiveUsers, 1000);
        
        // Set up intervals
        updateInterval = setInterval(fetchActiveUsers, 5000); // Update every 5 seconds
        heartbeatInterval = setInterval(sendHeartbeat, 8000); // Heartbeat every 8 seconds
    }
    
    // Cleanup on page unload
    window.addEventListener('beforeunload', function() {
        if (updateInterval) {
            clearInterval(updateInterval);
        }
        if (heartbeatInterval) {
            clearInterval(heartbeatInterval);
        }
        
        // Send final heartbeat to indicate user is leaving
        const form = new FormData();
        form.append('_token', csrfToken);
        form.append('timestamp', Date.now());
        
        navigator.sendBeacon('/api/user-offline', form);
    });
    
    // Handle visibility change (tab switching)
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            // Page is hidden, reduce update frequency
            if (updateInterval) {
                clearInterval(updateInterval);
                updateInterval = setInterval(fetchActiveUsers, 30000); // Update every 30 seconds
            }
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
                heartbeatInterval = setInterval(sendHeartbeat, 30000); // Heartbeat every 30 seconds
            }
        } else {
            // Page is visible, restore normal frequency
            if (updateInterval) {
                clearInterval(updateInterval);
                updateInterval = setInterval(fetchActiveUsers, 5000); // Update every 5 seconds
            }
            if (heartbeatInterval) {
                clearInterval(heartbeatInterval);
                heartbeatInterval = setInterval(sendHeartbeat, 8000); // Heartbeat every 8 seconds
            }
            // Immediate update when tab becomes visible
            sendHeartbeat().then(() => {
                setTimeout(fetchActiveUsers, 500);
            });
        }
    });
    
    // Initialize real-time tracking
    initializeRealTimeTracking();
    
    // Rest of your existing JavaScript code for search functionality...
    // (keeping all the existing search code)
    
    // Search functionality (existing code)
    const searchInput = document.getElementById('projectSearchInput');
    const clearBtn = document.getElementById('clearSearchBtn');
    const clearFromResults = document.getElementById('clearSearchFromResults');
    const hiddenInput = document.getElementById('searchHiddenInput');
    const projectRows = document.querySelectorAll('.project-row');
    const projectCountDisplay = document.querySelector('.project-count-display');
    const noResultsDiv = document.getElementById('noSearchResults');
    const noResultsText = document.getElementById('noResultsText');
    const tableContainer = document.getElementById('projectsTableContainer');
    
    let searchTimeout;
    const totalProjects = projectRows.length;
    
    // Initialize search from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const initialSearch = urlParams.get('search') || '';
    if (initialSearch) {
        searchInput.value = initialSearch;
        clearBtn.style.display = 'block';
        performSearch(initialSearch);
    }
    
    // Search function
    function performSearch(query) {
        const searchTerm = query.toLowerCase().trim();
        let visibleCount = 0;
        
        projectRows.forEach(row => {
            const projectNameCell = row.querySelector('.project-name-cell');
            const originalName = row.getAttribute('data-project-name');
            
            if (searchTerm === '' || originalName.includes(searchTerm)) {
                row.style.display = '';
                visibleCount++;
                
                // Highlight matching text
                if (searchTerm && projectNameCell) {
                    const originalText = projectNameCell.textContent;
                    const regex = new RegExp(`(${escapeRegExp(searchTerm)})`, 'gi');
                    const highlightedText = originalText.replace(regex, '<span class="search-highlight">$1</span>');
                    projectNameCell.innerHTML = highlightedText;
                }
            } else {
                row.style.display = 'none';
            }
        });
        
        // Update count display
        if (searchTerm) {
            projectCountDisplay.innerHTML = `${visibleCount} projects found for "<strong>${query}</strong>"`;
        } else {
            projectCountDisplay.textContent = `${totalProjects} projects found`;
        }
        
        // Show/hide no results message
        if (visibleCount === 0 && searchTerm) {
            noResultsText.textContent = `No projects match your search for "${query}"`;
            noResultsDiv.style.display = 'block';
            tableContainer.style.display = 'none';
        } else {
            noResultsDiv.style.display = 'none';
            tableContainer.style.display = 'block';
        }
        
        // Update hidden input
        hiddenInput.value = query;
        
        // Show/hide clear button
        clearBtn.style.display = query ? 'block' : 'none';
    }
    
    // Escape regex special characters
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    // Clear search function
    function clearSearch() {
        searchInput.value = '';
        performSearch('');
        searchInput.focus();
        
        // Reset all project name cells to original text
        projectRows.forEach(row => {
            const projectNameCell = row.querySelector('.project-name-cell');
            if (projectNameCell) {
                const originalName = projectNameCell.getAttribute('title');
                projectNameCell.textContent = originalName;
            }
        });
    }
    
    // Event listeners
    searchInput.addEventListener('input', function() {
        const query = this.value;
        
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });
    
    clearBtn.addEventListener('click', clearSearch);
    clearFromResults.addEventListener('click', clearSearch);
    
    // Form submission handler
    document.getElementById('filterForm').addEventListener('submit', function() {
        hiddenInput.value = searchInput.value;
    });
    
    // Keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }
        
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            clearSearch();
        }
    });
    
    // Animate numbers counting up (existing code)
    const numberElements = document.querySelectorAll('.stats-number');
    
    const animateNumber = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000; // 2 seconds
        const increment = target / (duration / 16); // 60fps
        let current = 0;
        
        element.classList.add('counting');
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current);
        }, 16);
    };
    
    // Intersection Observer for triggering animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const numberElement = entry.target.querySelector('.stats-number');
                if (numberElement && !numberElement.classList.contains('counting') && numberElement.id !== 'activeUsersCount') {
                    setTimeout(() => {
                        animateNumber(numberElement);
                    }, Math.random() * 500); // Stagger animations
                }
            }
        });
    }, { threshold: 0.5 });
    
    // Observe all stats cards
    document.querySelectorAll('.stats-card').forEach(card => {
        observer.observe(card);
    });
    
    // Add hover effects for stats cards
    document.querySelectorAll('.stats-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-12px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
});
</script>
@endsection
