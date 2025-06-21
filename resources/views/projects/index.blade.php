@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <!-- Header Card -->
    <div class="header-card mb-4 animated-header">
        <div class="header-card-background"></div>
        <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
            <div class="header-content">
                <h2 class="header-title mb-0">
                    <img src="/images/final2.png" alt="Stellantis Logo" class="logo-image">
                    <span class="title-text">Stellantis HUB</span>
                    <div class="title-glow"></div>
                </h2>
                <p class="header-subtitle mb-0">
                    <i class="fas fa-rocket subtitle-icon"></i>
                    Manage and track your automotive innovation projects
                </p>
            </div>
            <!-- Enhanced Search Bar -->
            <div class="search-container enhanced-search">
                <div class="search-wrapper">
                    <i class="fas fa-search search-icon"></i>
                    <input type="text" id="projectSearchInput" class="form-control search-input" placeholder="Search projects by name..." autocomplete="off">
                    <button type="button" id="clearSearchBtn" class="search-clear-btn">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="row mb-4 stats-row">
        <div class="col-md-6 mb-3">
            <div class="stats-card stats-card-live enhanced-stats">
                <div class="stats-card-background"></div>
                <div class="stats-particles"></div>
                <div class="stats-card-content">
                    <div class="stats-icon-container">
                        <div class="stats-icon">
                            <i class="fas fa-users"></i>
                            <!-- Live indicator moved to the icon -->
                            <div class="live-indicator-icon">
                                <span class="live-dot"></span>
                                <span class="live-text">LIVE</span>
                            </div>
                        </div>
                        <div class="stats-pulse stats-pulse-live"></div>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number" id="activeUsersCount" data-target="{{ $activeUsersCount ?? 0 }}">{{ $activeUsersCount ?? 0 }}</div>
                        <div class="stats-label">Active Users</div>
                        <div class="stats-trend">
                            <i class="fas fa-circle live-status-icon"></i>
                            <span id="lastUpdateTime">Just now</span>
                        </div>
                    </div>
                </div>
                <div class="stats-overlay"></div>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="stats-card stats-card-primary enhanced-stats">
                <div class="stats-card-background"></div>
                <div class="stats-particles"></div>
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
                            <i class="fas fa-arrow-up trend-icon"></i>
                            <span>All time</span>
                        </div>
                    </div>
                </div>
                <div class="stats-overlay"></div>
            </div>
        </div>
    </div>

    <!-- Enhanced Projects Table Card -->
    <div class="table-container">
        <div class="table-card enhanced-table-card">
            <div class="table-header">
                <h2 class="table-title">
                    <i class="fas fa-table table-icon"></i> 
                    All Projects
                    <span class="project-count-badge" id="projectCountBadge">{{ $projects->count() }}</span>
                </h2>
                <div class="table-controls">
                    <button class="control-btn" id="refreshBtn" title="Refresh">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                    <button class="control-btn" id="exportBtn" title="Export">
                        <i class="fas fa-download"></i>
                    </button>
                    <button class="control-btn" id="filterBtn" title="Filter">
                        <i class="fas fa-filter"></i>
                    </button>
                </div>
            </div>
            <div class="table-wrapper">
                <table class="custom-table enhanced-table" id="projectsTable">
                    <thead>
                        <tr>
                            <th class="sortable-column" data-column="name">
                                NAME 
                                <i class="fas fa-sort sort-indicator"></i>
                            </th>
                            <th class="sortable-column" data-column="responsible">
                                RESPONSIBLE 
                                <i class="fas fa-sort sort-indicator"></i>
                            </th>
                            <th class="sortable-column members-column" data-column="members">
                                MEMBERS 
                                <i class="fas fa-sort sort-indicator"></i>
                            </th>
                            <th class="sortable-column" data-column="reference">
                                REFERENCE 
                                <i class="fas fa-sort sort-indicator"></i>
                            </th>
                            <th class="actions-column">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($projects as $index => $project)
                        <tr class="project-row animated-row" data-project-id="{{ $project->id }}" data-index="{{ $index }}">
                            <td class="project-name-cell" data-project-name="{{ strtolower($project->project_name) }}">
                                <div class="cell-content">
                                    <div class="project-avatar">{{ substr($project->project_name, 0, 1) }}</div>
                                    <span class="project-name">{{ $project->project_name }}</span>
                                </div>
                            </td>
                            <td class="responsible-cell">
                                <div class="responsible-info">
                                    <i class="fas fa-user-tie responsible-icon"></i>
                                    <span>{{ $project->person_name ? $project->person_name : 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="members-cell">
                                <div class="members-display">
                                    @if($project->members->count() > 0)
                                        <div class="members-list-text">
                                            @foreach($project->members as $index => $member)
                                                <span class="member-name">{{ $member->name }}</span>@if(!$loop->last)<span class="member-separator">, </span>@endif
                                            @endforeach
                                        </div>
                                        <div class="members-count-badge">
                                            {{ $project->members->count() }} member{{ $project->members->count() > 1 ? 's' : '' }}
                                        </div>
                                    @else
                                        <span class="no-members">No members assigned</span>
                                    @endif
                                </div>
                            </td>
                            <td class="reference-cell">
                                <div class="reference-badge">
                                    <i class="fas fa-hashtag"></i>
                                    {{ $project->reference }}
                                </div>
                            </td>
                            <td class="actions-cell">
                                <a href="{{ route('projects.show', $project->id) }}" class="animated-btn-view enhanced-view-btn" data-project-id="{{ $project->id }}">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                    <div class="btn-ripple"></div>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Enhanced CSS Variables - Compatible with app.blade.php dark mode */
:root {
    /* Use existing variables from app.blade.php */
    --enhanced-primary: var(--stellantis-primary);
    --enhanced-secondary: var(--stellantis-secondary);
    --enhanced-accent: var(--stellantis-accent);
    --enhanced-success: #10b981;
    --enhanced-warning: var(--stellantis-gold);
    --enhanced-danger: #ef4444;
    
    /* Enhanced gradients that work with both themes */
    --enhanced-gradient-primary: var(--primary-gradient);
    --enhanced-gradient-success: linear-gradient(135deg, #10b981 0%, #059669 100%);
    --enhanced-gradient-live: linear-gradient(135deg, #8b5cf6 0%, #a855f7 50%, #c084fc 100%);
}

/* Dark mode specific enhancements */
html[data-theme="dark"] {
    --enhanced-gradient-live: linear-gradient(135deg, #a855f7 0%, #c084fc 50%, #ddd6fe 100%);
}

body {
    background: var(--bg-gradient);
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: var(--text-primary);
}

/* Enhanced Header Card */
.header-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(20px);
}

.animated-header {
    animation: slideInDown 0.8s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.header-card-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--enhanced-gradient-primary);
    transition: height 0.3s ease;
}

.header-card:hover .header-card-background {
    height: 6px;
}

.header-content {
    position: relative;
}

.header-title {
    display: flex;
    align-items: center;
    gap: 15px;
    position: relative;
    font-weight: 800;
    font-size: 2rem;
    color: var(--text-primary);
}

.logo-image {
    width: 60px;
    height: auto;
    object-fit: contain;
    transition: transform 0.3s ease;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.1));
}

.header-title:hover .logo-image {
    transform: rotate(360deg) scale(1.1);
}

.title-text {
    background: var(--enhanced-gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    position: relative;
}

.title-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--enhanced-gradient-primary);
    opacity: 0;
    filter: blur(20px);
    transition: opacity 0.3s ease;
    z-index: -1;
}

.header-title:hover .title-glow {
    opacity: 0.3;
}

.header-subtitle {
    opacity: 0.8;
    font-size: 1rem;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 8px;
    color: var(--text-secondary);
}

.subtitle-icon {
    color: var(--enhanced-primary);
    animation: rocketFloat 3s ease-in-out infinite;
}

@keyframes rocketFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
}

/* Enhanced Search Container */
.enhanced-search {
    position: relative;
    min-width: 350px;
}

.search-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.search-icon {
    position: absolute;
    left: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    z-index: 2;
    transition: color 0.3s ease;
}

.search-input {
    width: 100%;
    border-radius: var(--radius-2xl);
    border: 2px solid var(--border-muted);
    font-size: 1rem;
    padding: 12px 50px 12px 45px;
    box-shadow: var(--shadow-sm);
    outline: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: var(--bg-primary);
    color: var(--text-primary);
    backdrop-filter: blur(10px);
}

.search-input:focus {
    border-color: var(--enhanced-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: scale(1.02);
}

.search-input:focus + .search-icon {
    color: var(--enhanced-primary);
}

.search-clear-btn {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-muted);
    cursor: pointer;
    padding: 6px;
    border-radius: 50%;
    width: 28px;
    height: 28px;
    display: none;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
    z-index: 2;
}

.search-clear-btn:hover {
    background-color: var(--enhanced-danger);
    color: white;
    transform: translateY(-50%) scale(1.1);
}

/* Enhanced Statistics Cards */
.stats-row {
    gap: 0;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.enhanced-stats {
    position: relative;
    height: 160px;
    border-radius: var(--radius-xl);
    overflow: hidden;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    margin-bottom: 1.5rem;
    border: 1px solid var(--card-border);
    backdrop-filter: blur(20px);
}

.stats-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: var(--glass-bg);
    z-index: 1;
}

.stats-card-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    opacity: 0.9;
    transition: all 0.4s ease;
}

.stats-card-primary .stats-card-background {
    background: var(--enhanced-gradient-primary);
}

.stats-card-live .stats-card-background {
    background: var(--enhanced-gradient-live);
    animation: liveGradient 4s ease-in-out infinite;
}

@keyframes liveGradient {
    0%, 100% { background: var(--enhanced-gradient-live); }
    50% { 
        background: linear-gradient(135deg, #a855f7 0%, #c084fc 50%, #ddd6fe 100%); 
    }
}

.stats-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    z-index: 1;
}

.stats-particles::before,
.stats-particles::after {
    content: '';
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    animation: floatParticles 6s ease-in-out infinite;
}

.stats-particles::before {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.stats-particles::after {
    top: 60%;
    right: 30%;
    animation-delay: 3s;
}

@keyframes floatParticles {
    0%, 100% { transform: translateY(0px) scale(1); opacity: 0.3; }
    50% { transform: translateY(-20px) scale(1.2); opacity: 0.8; }
}

.stats-card-content {
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 2rem;
    color: white;
}

.stats-icon-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-icon {
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    position: relative;
    z-index: 3;
    transition: all 0.4s ease;
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.live-indicator-icon {
    position: absolute;
    top: -8px;
    right: -8px;
    display: flex;
    align-items: center;
    gap: 3px;
    background: rgba(239, 68, 68, 0.95);
    padding: 3px 6px;
    border-radius: 10px;
    font-size: 0.6rem;
    font-weight: 700;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.3);
    z-index: 5;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
}

.live-dot {
    width: 5px;
    height: 5px;
    background: #fff;
    border-radius: 50%;
    animation: liveBlink 1.2s infinite;
}

@keyframes liveBlink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.3; }
}

.live-text {
    color: white;
    font-size: 0.55rem;
}

.stats-pulse {
    position: absolute;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: pulse 2.5s infinite;
}

@keyframes pulse {
    0% { transform: scale(1); opacity: 1; }
    50% { transform: scale(1.3); opacity: 0.5; }
    100% { transform: scale(1.6); opacity: 0; }
}

.stats-pulse-live {
    position: absolute;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: livePulse 1.8s infinite;
}

@keyframes livePulse {
    0% { transform: scale(1); opacity: 1; background: rgba(139, 92, 246, 0.3); }
    50% { transform: scale(1.4); opacity: 0.6; background: rgba(168, 85, 247, 0.2); }
    100% { transform: scale(1.8); opacity: 0; background: rgba(196, 132, 252, 0.1); }
}

.stats-info {
    flex: 1;
    text-align: right;
    margin-left: 1.5rem;
}

.stats-number {
    font-size: 3rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.02em;
    animation: numberGlow 2s ease-in-out infinite alternate;
}

@keyframes numberGlow {
    0% { text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3); }
    100% { text-shadow: 0 4px 8px rgba(0, 0, 0, 0.4), 0 0 20px rgba(255, 255, 255, 0.2); }
}

.stats-label {
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    opacity: 0.95;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stats-trend {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 0.5rem;
    font-size: 0.85rem;
    opacity: 0.9;
    font-weight: 500;
}

.trend-icon {
    animation: trendBounce 2s ease-in-out infinite;
}

@keyframes trendBounce {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-3px); }
}

.live-status-icon {
    color: #10b981;
    animation: liveBlink 1.2s infinite;
    font-size: 0.7rem;
}

.stats-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
    z-index: 2;
}

.enhanced-stats:hover {
    transform: translateY(-15px) scale(1.03);
    box-shadow: var(--shadow-2xl);
}

.enhanced-stats:hover .stats-card-background {
    opacity: 1;
}

.enhanced-stats:hover .stats-overlay {
    transform: translateX(100%);
}

.enhanced-stats:hover .stats-icon {
    transform: scale(1.1) rotate(5deg);
}

/* Enhanced Table Container */
.table-container {
    padding: 2rem;
    animation: fadeInUp 0.8s ease-out 0.4s both;
}

.enhanced-table-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-xl);
    padding: 0;
    width: 100%;
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(20px);
    border: 1px solid var(--card-border);
}

.enhanced-table-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--enhanced-gradient-success);
    z-index: 1;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 2rem 2rem 1rem 2rem;
    border-top-left-radius: var(--radius-2xl);
    border-top-right-radius: var(--radius-2xl);
    background: var(--bg-secondary);
    position: relative;
}

.table-title {
    font-weight: 800;
    color: var(--text-primary);
    margin: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 1.5rem;
}

.table-icon {
    color: var(--enhanced-success);
    animation: tableIconSpin 4s ease-in-out infinite;
}

@keyframes tableIconSpin {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(5deg); }
    75% { transform: rotate(-5deg); }
}

.project-count-badge {
    background: var(--enhanced-gradient-success);
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    margin-left: 8px;
    animation: badgePulse 2s ease-in-out infinite;
}

@keyframes badgePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

.table-controls {
    display: flex;
    gap: 8px;
}

.control-btn {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    background: var(--bg-primary);
    color: var(--text-secondary);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border-secondary);
}

.control-btn:hover {
    background: var(--enhanced-primary);
    color: white;
    transform: scale(1.1) rotate(5deg);
    box-shadow: var(--shadow-md);
}

.table-wrapper {
    padding: 0 2rem 2rem 2rem;
}

/* Enhanced Table Styles */
.enhanced-table {
    width: 100%;
    table-layout: fixed;
    border-collapse: separate;
    border-spacing: 0;
    background: var(--bg-primary);
    font-size: 1rem;
    box-shadow: var(--shadow-lg);
    border-radius: var(--radius-xl);
    overflow: hidden;
    position: relative;
}

.enhanced-table th:nth-child(1) { width: 20%; }
.enhanced-table th:nth-child(2) { width: 18%; }
.enhanced-table th:nth-child(3) { width: 30%; }
.enhanced-table th:nth-child(4) { width: 17%; }
.enhanced-table th:nth-child(5) { width: 15%; }

.enhanced-table th,
.enhanced-table td {
    padding: 1.5rem 1.2rem;
    text-align: left;
    font-weight: 600;
    border: none;
    background: none;
    color: var(--text-primary);
    font-size: 1rem;
    vertical-align: middle;
}

.enhanced-table th {
    background: var(--enhanced-gradient-primary);
    color: white;
    font-weight: 700;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    font-size: 0.9rem;
    position: relative;
}

.sortable-column {
    cursor: pointer;
    user-select: none;
    transition: all 0.3s ease;
    position: relative;
}

.sortable-column:hover {
    background: var(--secondary-gradient);
    transform: scale(1.02);
}

.sort-indicator {
    opacity: 0.5;
    margin-left: 8px;
    transition: all 0.3s ease;
    font-size: 0.8rem;
}

.sortable-column:hover .sort-indicator {
    opacity: 1;
    transform: scale(1.2);
}

.enhanced-table th:first-child {
    border-top-left-radius: var(--radius-xl);
}

.enhanced-table th:last-child {
    border-top-right-radius: var(--radius-xl);
}

.animated-row {
    border-bottom: 1px solid var(--border-muted);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    animation: slideInRow 0.6s ease-out both;
    background: var(--bg-primary);
}

.animated-row:nth-child(even) {
    background: var(--bg-secondary);
}

@keyframes slideInRow {
    from {
        opacity: 0;
        transform: translateX(-20px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.animated-row:hover {
    background: var(--bg-tertiary);
    transform: scale(1.01);
    box-shadow: var(--shadow-md);
    z-index: 2;
}

.enhanced-table tbody tr:last-child td:first-child {
    border-bottom-left-radius: var(--radius-xl);
}

.enhanced-table tbody tr:last-child td:last-child {
    border-bottom-right-radius: var(--radius-xl);
}

/* Enhanced Cell Styles */
.cell-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.project-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--enhanced-gradient-primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.1rem;
    text-transform: uppercase;
    box-shadow: var(--shadow-sm);
}

.project-name {
    font-weight: 600;
    color: var(--text-primary);
}

.responsible-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.responsible-icon {
    color: var(--enhanced-primary);
    font-size: 0.9rem;
}

.members-display {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.members-list-text {
    display: flex;
    flex-wrap: wrap;
    gap: 2px;
    line-height: 1.4;


}

.members-list-text {
    display: flex;
    flex-wrap: wrap;
    gap: 2px;
    line-height: 1.4;
}

.member-name {
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.9rem;
    background: var(--bg-secondary);
    padding: 2px 8px;
    border-radius: 12px;
    border: 1px solid var(--border-muted);
    white-space: nowrap;
}

.member-separator {
    color: var(--text-muted);
    margin: 0 2px;
}

.members-count-badge {
    display: inline-flex;
    align-items: center;
    background: var(--enhanced-gradient-success);
    color: white;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
    width: fit-content;
    margin-top: 2px;
}

.no-members {
    color: var(--text-muted);
    font-style: italic;
    font-size: 0.9rem;
}

.reference-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--bg-secondary);
    color: var(--text-secondary);
    padding: 6px 12px;
    border-radius: var(--radius-md);
    font-weight: 600;
    font-size: 0.9rem;
    border: 1px solid var(--border-muted);
}

/* Enhanced View Button */
.enhanced-view-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    font-size: 0.9rem;
    font-weight: 700;
    border-radius: var(--radius-xl);
    border: 2px solid var(--enhanced-primary);
    background: var(--bg-primary);
    color: var(--enhanced-primary);
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    z-index: 1;
}

.enhanced-view-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--enhanced-gradient-primary);
    transition: left 0.3s ease;
    z-index: -1;
}

.enhanced-view-btn:hover::before {
    left: 0;
}

.enhanced-view-btn:hover {
    color: white;
    border-color: var(--enhanced-accent);
    transform: scale(1.05) translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    animation: ripple 0.6s linear;
    pointer-events: none;
}

@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Search Highlight */
.search-highlight {
    background-color: var(--enhanced-warning);
    padding: 2px 4px;
    border-radius: 3px;
    font-weight: 700;
    color: var(--text-inverse);
}

/* Dark mode specific search highlight */
html[data-theme="dark"] .search-highlight {
    background-color: var(--stellantis-gold);
    color: var(--text-inverse);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .enhanced-stats {
        height: 140px;
    }
    .stats-number {
        font-size: 2.5rem;
    }
    .stats-label {
        font-size: 0.9rem;
    }
}

@media (max-width: 991px) {
    .header-card .card-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    .enhanced-search {
        min-width: auto;
        width: 100%;
    }
    .enhanced-stats {
        height: 120px;
    }
    .stats-card-content {
        padding: 1.5rem;
    }
    .stats-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    .stats-pulse,
    .stats-pulse-live {
        width: 60px;
        height: 60px;
    }
    .stats-number {
        font-size: 2.2rem;
    }
    .table-container {
        padding: 1rem;
    }
    .enhanced-table th,
    .enhanced-table td {
        padding: 1rem 0.8rem;
        font-size: 0.9rem;
    }
    .members-list-text {
        flex-direction: column;
    }
}

@media (max-width: 768px) {
    .enhanced-stats {
        height: 100px;
    }
    .stats-card-content {
        padding: 1rem;
    }
    .stats-icon {
        width: 50px;
        height: 50px;
        font-size: 1.3rem;
    }
    .stats-pulse,
    .stats-pulse-live {
        width: 50px;
        height: 50px;
    }
    .stats-number {
        font-size: 2rem;
    }
    .stats-label {
        font-size: 0.8rem;
    }
    .stats-info {
        margin-left: 1rem;
    }
    .table-header {
        flex-direction: column;
        gap: 1rem;
        align-items: stretch;
    }
    .table-controls {
        justify-content: center;
    }
    .member-name {
        font-size: 0.8rem;
        padding: 1px 6px;
    }
}

@media (max-width: 576px) {
    .header-title {
        font-size: 1.5rem;
    }
    .logo-image {
        width: 50px;
    }
    .enhanced-stats {
        height: 90px;
    }
    .stats-card-content {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
        padding: 0.8rem;
    }
    .stats-info {
        margin-left: 0;
        text-align: center;
    }
    .stats-trend {
        justify-content: center;
    }
    .enhanced-table {
        font-size: 0.8rem;
    }
    .enhanced-table th,
    .enhanced-table td {
        padding: 0.8rem 0.5rem;
    }
    .cell-content {
        flex-direction: column;
        gap: 4px;
        text-align: center;
    }
    .project-avatar {
        width: 30px;
        height: 30px;
        font-size: 0.9rem;
    }
    .members-list-text {
        justify-content: center;
    }
}

/* Pop-out animation for navigation */
@keyframes popOut {
    0% {
        transform: scale(1) translateX(0);
        opacity: 1;
        z-index: 1;
    }
    60% {
        transform: scale(1.08) translateX(20px);
        opacity: 1;
        z-index: 2;
        box-shadow: var(--shadow-xl);
    }
    100% {
        transform: scale(1.12) translateX(120vw);
        opacity: 0.2;
        z-index: 2;
    }
}

.pop-out-animate {
    animation: popOut 0.8s cubic-bezier(0.23, 1, 0.32, 1) forwards;
}

/* Dark mode specific enhancements */
html[data-theme="dark"] .stats-card-content {
    color: white;
}

html[data-theme="dark"] .enhanced-table th {
    background: var(--enhanced-gradient-primary);
    color: white;
}

html[data-theme="dark"] .animated-row:hover {
    background: var(--bg-tertiary);
    box-shadow: var(--shadow-lg);
}

html[data-theme="dark"] .control-btn {
    background: var(--bg-secondary);
    border-color: var(--border-secondary);
}

html[data-theme="dark"] .search-input {
    background: var(--bg-secondary);
    border-color: var(--border-muted);
    color: var(--text-primary);
}

html[data-theme="dark"] .search-input:focus {
    border-color: var(--enhanced-primary);
    background: var(--bg-primary);
}

/* Theme transition animations */
* {
    transition: background-color var(--transition-normal), 
                color var(--transition-normal), 
                border-color var(--transition-normal),
                box-shadow var(--transition-normal);
}

/* Accessibility improvements for dark mode */
html[data-theme="dark"] .member-name {
    background: var(--bg-tertiary);
    border-color: var(--border-secondary);
    color: var(--text-primary);
}

html[data-theme="dark"] .reference-badge {
    background: var(--bg-tertiary);
    border-color: var(--border-secondary);
    color: var(--text-secondary);
}

/* Enhanced focus states for accessibility */
.search-input:focus,
.enhanced-view-btn:focus,
.control-btn:focus {
    outline: 2px solid var(--enhanced-primary);
    outline-offset: 2px;
}

/* Print styles for both themes */
@media print {
    .enhanced-stats,
    .stats-card-background,
    .stats-particles,
    .stats-overlay {
        background: white !important;
        color: black !important;
        box-shadow: none !important;
    }
    
    .enhanced-table th {
        background: #f5f5f5 !important;
        color: black !important;
    }
    
    .animated-row {
        background: white !important;
        color: black !important;
    }
    
    .member-name,
    .reference-badge {
        background: #f5f5f5 !important;
        color: black !important;
        border-color: #ddd !important;
    }
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get CSRF token from the hidden form
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
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
            } else {
                console.error('Failed to fetch active users:', response.status, response.statusText);
                throw new Error('Failed to fetch active users');
            }
        } catch (error) {
            console.error('Error fetching active users:', error);
            // Fallback to simulated count
            simulateActiveUsers();
        }
    }
    
    // Simulate active users if API is not available
    function simulateActiveUsers() {
        const baseCount = 1;
        const variation = Math.floor(Math.random() * 7) + 1;
        const newCount = baseCount + variation;
        updateActiveUsersDisplay(newCount);
        updateLastSeenTime();
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
            
            const response = await fetch('/api/heartbeat', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    timestamp: Date.now(),
                    page: 'dashboard'
                })
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
        navigator.sendBeacon('/api/user-offline', JSON.stringify({
            timestamp: Date.now()
        }));
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

    // Enhanced Stats Animation
    const numberElements = document.querySelectorAll('.stats-number');
    
    const animateNumber = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2500;
        const increment = target / (duration / 16);
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

    // Enhanced Intersection Observer
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const numberElement = entry.target.querySelector('.stats-number');
                if (numberElement && !numberElement.classList.contains('counting') && numberElement.id !== 'activeUsersCount') {
                    setTimeout(() => {
                        animateNumber(numberElement);
                    }, Math.random() * 800);
                }
            }
        });
    }, { threshold: 0.3 });

    document.querySelectorAll('.enhanced-stats').forEach(card => {
        observer.observe(card);
    });

    // Enhanced Search Functionality
    const searchInput = document.getElementById('projectSearchInput');
    const clearBtn = document.getElementById('clearSearchBtn');
    const projectRows = document.querySelectorAll('.project-row');
    const projectCountBadge = document.getElementById('projectCountBadge');
    let searchTimeout;

    const totalProjects = projectRows.length;

    function performSearch(query) {
        const searchTerm = query.toLowerCase().trim();
        let visibleCount = 0;

        projectRows.forEach((row, index) => {
            const projectNameCell = row.querySelector('.project-name');
            const originalName = row.getAttribute('data-project-name') || projectNameCell.textContent.toLowerCase();
            
            if (searchTerm === '' || originalName.includes(searchTerm)) {
                row.style.display = '';
                row.style.animationDelay = (index * 0.1) + 's';
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

        // Update count badge
        projectCountBadge.textContent = visibleCount;
        
        // Show/hide clear button
        clearBtn.style.display = query ? 'flex' : 'none';
    }

    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function clearSearch() {
        searchInput.value = '';
        performSearch('');
        searchInput.focus();
        
        // Reset highlighted text
        projectRows.forEach(row => {
            const projectNameCell = row.querySelector('.project-name');
            if (projectNameCell) {
                const originalText = projectNameCell.textContent.replace(/<[^>]*>/g, '');
                projectNameCell.textContent = originalText;
            }
        });
    }

    searchInput.addEventListener('input', function() {
        const query = this.value;
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            performSearch(query);
        }, 300);
    });

    clearBtn.addEventListener('click', clearSearch);

    // Enhanced Stats Card Interactions
    document.querySelectorAll('.enhanced-stats').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-15px) scale(1.03)';
            this.style.boxShadow = '0 30px 60px -12px rgba(0, 0, 0, 0.25)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
            this.style.boxShadow = '';
        });
    });

    // Enhanced Table Sorting
    document.querySelectorAll('.sortable-column').forEach(header => {
        header.addEventListener('click', function() {
            const column = this.dataset.column;
            const table = this.closest('table');
            const tbody = table.querySelector('tbody');
            const rows = Array.from(tbody.querySelectorAll('tr'));
            const icon = this.querySelector('.sort-indicator');
            
            // Reset all other sort icons
            document.querySelectorAll('.sort-indicator').forEach(otherIcon => {
                if (otherIcon !== icon) {
                    otherIcon.className = 'fas fa-sort sort-indicator';
                }
            });
            
            // Toggle sort direction
            let ascending = true;
            if (icon.classList.contains('fa-sort-up')) {
                ascending = false;
                icon.className = 'fas fa-sort-down sort-indicator';
            } else {
                icon.className = 'fas fa-sort-up sort-indicator';
            }
            
            // Sort rows
            rows.sort((a, b) => {
                let aVal = getColumnValue(a, column);
                let bVal = getColumnValue(b, column);
                
                if (ascending) {
                    return aVal > bVal ? 1 : -1;
                } else {
                    return aVal < bVal ? 1 : -1;
                }
            });
            
            // Re-append sorted rows with animation
            rows.forEach((row, index) => {
                row.style.animation = 'none';
                tbody.appendChild(row);
                setTimeout(() => {
                    row.style.animation = 'slideInRow 0.4s ease-out both';
                    row.style.animationDelay = (index * 0.05) + 's';
                }, 10);
            });
        });
    });

    function getColumnValue(row, column) {
        const columnMap = {
            'name': 0,
            'responsible': 1,
            'members': 2,
            'reference': 3
        };
        const cellIndex = columnMap[column] || 0;
        return row.cells[cellIndex].textContent.trim().toLowerCase();
    }

    // Enhanced Button Interactions
    document.querySelectorAll('.enhanced-view-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('btn-ripple');
            
            this.appendChild(ripple);
            
            // Pop-out animation
            const row = this.closest('tr');
            row.classList.add('pop-out-animate');
            
            setTimeout(() => {
                window.location.href = this.href;
            }, 700);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Control Button Interactions
    document.getElementById('refreshBtn').addEventListener('click', function() {
        this.style.transform = 'scale(0.9) rotate(180deg)';
        setTimeout(() => {
            this.style.transform = '';
            // Refresh active users count
            fetchActiveUsers();
        }, 300);
    });

    document.getElementById('exportBtn').addEventListener('click', function() {
        this.style.transform = 'scale(0.9) translateY(-5px)';
        setTimeout(() => {
            this.style.transform = '';
            exportTableData();
        }, 300);
    });

    document.getElementById('filterBtn').addEventListener('click', function() {
        this.style.transform = 'scale(0.9)';
        setTimeout(() => {
            this.style.transform = '';
            toggleAdvancedFilters();
        }, 300);
    });

    // Export functionality
    function exportTableData() {
        const table = document.getElementById('projectsTable');
        const rows = table.querySelectorAll('tr');
        let csvContent = '';
        
        rows.forEach(row => {
            const cells = row.querySelectorAll('th, td');
            const rowData = Array.from(cells).map(cell => {
                return '"' + cell.textContent.trim().replace(/"/g, '""') + '"';
            });
            csvContent += rowData.join(',') + '\n';
        });
        
        const blob = new Blob([csvContent], { type: 'text/csv' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'projects_export.csv';
        a.click();
        window.URL.revokeObjectURL(url);
    }

    // Advanced filters toggle
    function toggleAdvancedFilters() {
        console.log('Advanced filters toggled');
    }

    // Animate table rows on load
    document.querySelectorAll('.animated-row').forEach((row, index) => {
        row.style.animationDelay = (index * 0.1) + 's';
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

    // Initialize real-time tracking
    initializeRealTimeTracking();

    // Parallax effect for cards
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const cards = document.querySelectorAll('.enhanced-stats');
        
        cards.forEach((card, index) => {
            const rate = scrolled * -0.3;
            card.style.transform = `translateY(${rate * (index + 1) * 0.1}px)`;
        });
    });
});
</script>

@endsection
