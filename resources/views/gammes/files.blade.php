@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="page-header">
                <div class="page-header-content">
                    <div class="page-title-section">
                        <a href="{{ route('gammes.index') }}" class="back-btn">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div class="page-title-info">
                            <div class="gamme-type-badge {{ strtolower($gammeType) }}-badge">
                                {{ $gammeType }}
                            </div>
                            <h1 class="page-title">{{ $gammeDisplayName }}</h1>
                            <p class="page-subtitle">Browse and download files for this product line</p>
                        </div>
                    </div>
                    <div class="page-actions">
                        <button class="btn btn-outline-primary" id="refreshBtn">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="filters-card">
                <div class="filters-header">
                    <h5 class="filters-title">
                        <i class="fas fa-filter"></i>
                        Filters & Search
                    </h5>
                    <button class="btn btn-sm btn-outline-secondary" id="clearFiltersBtn">
                        <i class="fas fa-times"></i>
                        Clear All
                    </button>
                </div>
                <div class="filters-body">
                    <div class="row g-3">
                        <!-- Search Bar -->
                        <div class="col-md-4">
                            <div class="search-group">
                                <label class="form-label">Search Files</label>
                                <div class="search-input-wrapper">
                                    <input type="text" class="form-control" id="searchInput" placeholder="Search by filename...">
                                    <i class="fas fa-search search-icon"></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- File Type Filter -->
                        <div class="col-md-3">
                            <label class="form-label">File Type</label>
                            <select class="form-select" id="fileTypeFilter">
                                <option value="">All Types</option>
                                <option value="pdf">PDF Documents</option>
                                <option value="doc,docx">Word Documents</option>
                                <option value="xls,xlsx">Excel Files</option>
                                <option value="ppt,pptx">PowerPoint</option>
                                <option value="jpg,jpeg,png,gif">Images</option>
                                <option value="zip,rar">Archives</option>
                                <option value="mp4,avi,mov">Videos</option>
                            </select>
                        </div>
                        
                        <!-- Date Filter -->
                        <div class="col-md-3">
                            <label class="form-label">Upload Date</label>
                            <select class="form-select" id="dateFilter">
                                <option value="">All Dates</option>
                                <option value="today">Today</option>
                                <option value="week">This Week</option>
                                <option value="month">This Month</option>
                                <option value="quarter">Last 3 Months</option>
                                <option value="year">This Year</option>
                            </select>
                        </div>
                        
                        <!-- Sort Options -->
                        <div class="col-md-2">
                            <label class="form-label">Sort By</label>
                            <select class="form-select" id="sortFilter">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="name_asc">Name A-Z</option>
                                <option value="name_desc">Name Z-A</option>
                                <option value="size_desc">Largest First</option>
                                <option value="size_asc">Smallest First</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="stats-row">
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-file"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" id="totalFiles">0</div>
                        <div class="stat-label">Total Files</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" id="visibleFiles">0</div>
                        <div class="stat-label">Showing</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-hdd"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" id="totalSize">0 MB</div>
                        <div class="stat-label">Total Size</div>
                    </div>
                </div>
                <div class="stat-item">
                    <div class="stat-icon">
                        <i class="fas fa-calendar"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number" id="lastUpdated">-</div>
                        <div class="stat-label">Last Updated</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Files Table Section -->
    <div class="row">
        <div class="col-12">
            <div class="files-table-card">
                <div class="files-table-header">
                    <h5 class="table-title">
                        <i class="fas fa-folder-open"></i>
                        Files Library
                    </h5>
                    <div class="table-actions">
                        <div class="view-toggle">
                            <button class="btn btn-sm btn-outline-secondary active" data-view="table">
                                <i class="fas fa-list"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" data-view="grid">
                                <i class="fas fa-th"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Loading State -->
                <div id="loadingState" class="loading-state">
                    <div class="loading-spinner">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="loading-text">Loading files...</p>
                    </div>
                </div>
                
                <!-- Table View -->
                <div id="tableView" class="table-responsive" style="display: none;">
                    <table class="files-table">
                        <thead>
                            <tr>
                                <th class="sortable" data-sort="name">
                                    <i class="fas fa-file"></i>
                                    File Name
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="sortable" data-sort="type">
                                    <i class="fas fa-tag"></i>
                                    Type
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="sortable" data-sort="size">
                                    <i class="fas fa-hdd"></i>
                                    Size
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th class="sortable" data-sort="date">
                                    <i class="fas fa-calendar"></i>
                                    Upload Date
                                    <i class="fas fa-sort sort-icon"></i>
                                </th>
                                <th>
                                    <i class="fas fa-download"></i>
                                    Download
                                </th>
                            </tr>
                        </thead>
                        <tbody id="filesTableBody">
                            <!-- Files will be loaded here -->
                        </tbody>
                    </table>
                </div>
                
                <!-- Grid View -->
                <div id="gridView" class="files-grid" style="display: none;">
                    <!-- Grid items will be loaded here -->
                </div>
                
                <!-- Empty State -->
                <div id="emptyState" class="empty-state" style="display: none;">
                    <div class="empty-icon">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h4 class="empty-title">No Files Available</h4>
                    <p class="empty-text">There are currently no files available for this product line.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Page Header Styles */
.page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 1rem;
    padding: 2rem;
    color: white;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.page-header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 2rem;
}

.page-title-section {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.back-btn {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.back-btn:hover {
    background: rgba(255, 255, 255, 0.3);
    color: white;
    transform: translateX(-5px);
}

.gamme-type-badge {
    display: inline-block;
    padding: 0.5rem 1rem;
    border-radius: 2rem;
    font-weight: 700;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 0.5rem;
}

.las-badge { background: rgba(59, 130, 246, 0.2); color: #3b82f6; }
.str-badge { background: rgba(16, 185, 129, 0.2); color: #10b981; }
.ctr-badge { background: rgba(245, 158, 11, 0.2); color: #f59e0b; }

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    line-height: 1.2;
}

.page-subtitle {
    margin: 0.5rem 0 0 0;
    opacity: 0.9;
    font-size: 1.1rem;
}

.page-actions {
    display: flex;
    gap: 1rem;
}

/* Filters Card */
.filters-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.filters-header {
    background: #f8fafc;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.filters-title {
    margin: 0;
    font-weight: 600;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.filters-body {
    padding: 2rem;
}

.search-input-wrapper {
    position: relative;
}

.search-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #6b7280;
}

/* Stats Row */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
}

.stat-item {
    background: white;
    padding: 1.5rem;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: transform 0.2s ease;
}

.stat-item:hover {
    transform: translateY(-2px);
}

.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.stat-number {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1f2937;
    line-height: 1;
}

.stat-label {
    font-size: 0.875rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

/* Files Table Card */
.files-table-card {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.files-table-header {
    background: #f8fafc;
    padding: 1.5rem 2rem;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.table-title {
    margin: 0;
    font-weight: 600;
    color: #374151;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.view-toggle {
    display: flex;
    border-radius: 0.5rem;
    overflow: hidden;
    border: 1px solid #d1d5db;
}

.view-toggle .btn {
    border-radius: 0;
    border: none;
}

.view-toggle .btn.active {
    background: #3b82f6;
    color: white;
}

/* Files Table */
.files-table {
    width: 100%;
    border-collapse: collapse;
}

.files-table th {
    background: #f8fafc;
    padding: 1rem 1.5rem;
    text-align: left;
    font-weight: 600;
    color: #374151;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.875rem;
    position: sticky;
    top: 0;
    z-index: 10;
}

.files-table th.sortable {
    cursor: pointer;
    user-select: none;
    transition: background-color 0.2s ease;
}

.files-table th.sortable:hover {
    background: #e2e8f0;
}

.sort-icon {
    margin-left: 0.5rem;
    opacity: 0.5;
    transition: opacity 0.2s ease;
}

.files-table th.sortable:hover .sort-icon {
    opacity: 1;
}

.files-table td {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    vertical-align: middle;
}

.files-table tbody tr {
    transition: background-color 0.2s ease;
}

.files-table tbody tr:hover {
    background: #f9fafb;
}

/* File Item Styles */
.file-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.file-icon {
    width: 45px;
    height: 45px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.file-info h6 {
    margin: 0;
    font-weight: 600;
    color: #1f2937;
}

.file-info small {
    color: #6b7280;
}

.file-type-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
}

/* Download Button Styles */
.btn-download {
    background: linear-gradient(135deg, #10b981 0%, #047857 100%);
    border: none;
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 0.75rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
}

.btn-download:hover {
    background: linear-gradient(135deg, #047857 0%, #065f46 100%);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.3);
    text-decoration: none;
}

.btn-download:active {
    transform: translateY(0);
}

/* Grid View */
.files-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: 1.5rem;
    padding: 2rem;
}

.file-card {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 1rem;
    padding: 1.5rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.file-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

.file-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    border-color: #3b82f6;
}

.file-card:hover::before {
    transform: scaleX(1);
}

.file-card-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    margin: 0 auto 1rem;
}

.file-card-title {
    font-size: 1rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 0.5rem;
    word-break: break-word;
}

.file-card-meta {
    color: #6b7280;
    font-size: 0.875rem;
    margin-bottom: 1rem;
}

/* Loading State */
.loading-state {
    padding: 4rem 2rem;
    text-align: center;
}

.loading-spinner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1rem;
}

.loading-text {
    color: #6b7280;
    margin: 0;
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
    text-align: center;
}

.empty-icon {
    font-size: 4rem;
    color: #d1d5db;
    margin-bottom: 1rem;
}

.empty-title {
    color: #374151;
    margin-bottom: 0.5rem;
}

.empty-text {
    color: #6b7280;
    margin-bottom: 0;
}

/* Responsive Design */
@media (max-width: 768px) {
    .page-header-content {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .page-title-section {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .stats-row {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .filters-body .row {
        --bs-gutter-x: 1rem;
    }
    
    .files-table-header {
        flex-direction: column;
        gap: 1rem;
        align-items: flex-start;
    }
    
    .files-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .stats-row {
        grid-template-columns: 1fr;
    }
    
    .filters-body .col-md-4,
    .filters-body .col-md-3,
    .filters-body .col-md-2 {
        width: 100%;
    }
    
    .file-card {
        padding: 1rem;
    }
}

/* Success Animation for Downloads */
@keyframes downloadSuccess {
    0% { transform: scale(1); }
    50% { transform: scale(1.1); }
    100% { transform: scale(1); }
}

.btn-download.downloading {
    animation: downloadSuccess 0.6s ease;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get gamme type from URL or data attribute
    const gammeType = '{{ $gammeType }}';
    const gammeId = '{{ $gammeId }}';
    
    // Initialize the page
    let allFiles = [];
    let filteredFiles = [];
    let currentView = 'table';
    
    // Load files on page load
    loadFiles();
    
    // Event Listeners
    document.getElementById('refreshBtn').addEventListener('click', loadFiles);
    document.getElementById('clearFiltersBtn').addEventListener('click', clearAllFilters);
    
    // Filter event listeners
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('fileTypeFilter').addEventListener('change', applyFilters);
    document.getElementById('dateFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
    
    // View toggle
    document.querySelectorAll('[data-view]').forEach(btn => {
        btn.addEventListener('click', function() {
            const view = this.getAttribute('data-view');
            switchView(view);
        });
    });
    
    // Load Files Function
    function loadFiles() {
        showLoading();
        
        fetch(`/gammes/files-by-type/${gammeType}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    allFiles = data.files || [];
                    filteredFiles = [...allFiles];
                    updateStats();
                    applyFilters();
                    hideLoading();
                } else {
                    showError('Failed to load files');
                }
            })
            .catch(error => {
                console.error('Error loading files:', error);
                showError('Error loading files');
            });
    }
    
    // Apply Filters Function
    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const fileType = document.getElementById('fileTypeFilter').value;
        const dateFilter = document.getElementById('dateFilter').value;
        const sortBy = document.getElementById('sortFilter').value;
        
        // Start with all files
        filteredFiles = [...allFiles];
        
        // Apply search filter
        if (searchTerm) {
            filteredFiles = filteredFiles.filter(file => 
                file.original_name.toLowerCase().includes(searchTerm)
            );
        }
        
        // Apply file type filter
        if (fileType) {
            const types = fileType.split(',');
            filteredFiles = filteredFiles.filter(file => {
                const ext = file.original_name.split('.').pop().toLowerCase();
                return types.includes(ext);
            });
        }
        
        // Apply date filter
        if (dateFilter) {
            const now = new Date();
            filteredFiles = filteredFiles.filter(file => {
                const fileDate = new Date(file.created_at);
                switch (dateFilter) {
                    case 'today':
                        return fileDate.toDateString() === now.toDateString();
                    case 'week':
                        const weekAgo = new Date(now.getTime() - 7 * 24 * 60 * 60 * 1000);
                        return fileDate >= weekAgo;
                    case 'month':
                        return fileDate.getMonth() === now.getMonth() && fileDate.getFullYear() === now.getFullYear();
                    case 'quarter':
                        const quarterAgo = new Date(now.getTime() - 90 * 24 * 60 * 60 * 1000);
                        return fileDate >= quarterAgo;
                    case 'year':
                        return fileDate.getFullYear() === now.getFullYear();
                    default:
                        return true;
                }
            });
        }
        
        // Apply sorting
        filteredFiles.sort((a, b) => {
            switch (sortBy) {
                case 'newest':
                    return new Date(b.created_at) - new Date(a.created_at);
                case 'oldest':
                    return new Date(a.created_at) - new Date(b.created_at);
                case 'name_asc':
                    return a.original_name.localeCompare(b.original_name);
                case 'name_desc':
                    return b.original_name.localeCompare(a.original_name);
                case 'size_desc':
                    return (b.size || 0) - (a.size || 0);
                case 'size_asc':
                    return (a.size || 0) - (b.size || 0);
                default:
                    return 0;
            }
        });
        
        // Update display
        updateStats();
        renderFiles();
    }
    
    // Render Files Function
    function renderFiles() {
        if (filteredFiles.length === 0) {
            showEmptyState();
            return;
        }
        
        hideEmptyState();
        
        if (currentView === 'table') {
            renderTableView();
        } else {
            renderGridView();
        }
    }
    
    // Render Table View
    function renderTableView() {
        const tbody = document.getElementById('filesTableBody');
        tbody.innerHTML = '';
        
        filteredFiles.forEach(file => {
            const row = document.createElement('tr');
            const ext = file.original_name.split('.').pop().toLowerCase();
            
            row.innerHTML = `
                <td>
                    <div class="file-item">
                        <div class="file-icon" style="background: ${getFileIconColor(ext)}">
                            <i class="fas fa-${getFileIcon(ext)}"></i>
                        </div>
                        <div class="file-info">
                            <h6>${file.original_name}</h6>
                            <small class="text-muted">${file.file_name}</small>
                        </div>
                    </div>
                </td>
                <td>
                    <span class="file-type-badge" style="background: ${getFileIconColor(ext)}20; color: ${getFileIconColor(ext)}">
                        ${ext.toUpperCase()}
                    </span>
                </td>
                <td>${file.size_formatted || 'Unknown'}</td>
                <td>
                    <div>${formatDate(file.created_at)}</div>
                    <small class="text-muted">${formatTime(file.created_at)}</small>
                </td>
                <td>
                    <a href="/gamme-files/${file.id}/download" class="btn-download" onclick="handleDownload(this)">
                        <i class="fas fa-download"></i>
                        Download
                    </a>
                </td>
            `;
            
            tbody.appendChild(row);
        });
    }
    
    // Render Grid View
    function renderGridView() {
        const grid = document.getElementById('gridView');
        grid.innerHTML = '';
        
        filteredFiles.forEach(file => {
            const ext = file.original_name.split('.').pop().toLowerCase();
            
            const card = document.createElement('div');
            card.className = 'file-card';
            card.innerHTML = `
                <div class="file-card-icon" style="background: ${getFileIconColor(ext)}">
                    <i class="fas fa-${getFileIcon(ext)}"></i>
                </div>
                <h6 class="file-card-title">${file.original_name}</h6>
                <div class="file-card-meta">
                    <div class="mb-1">${file.size_formatted || 'Unknown'}</div>
                    <div class="text-muted small">${formatDate(file.created_at)}</div>
                </div>
                <a href="/gamme-files/${file.id}/download" class="btn-download" onclick="handleDownload(this)">
                    <i class="fas fa-download"></i>
                    Download
                </a>
            `;
            
            grid.appendChild(card);
        });
    }
    
    // Update Stats Function
    function updateStats() {
        document.getElementById('totalFiles').textContent = allFiles.length;
        document.getElementById('visibleFiles').textContent = filteredFiles.length;
        
        const totalSize = allFiles.reduce((sum, file) => sum + (file.size || 0), 0);
        document.getElementById('totalSize').textContent = formatFileSize(totalSize);
        
        if (allFiles.length > 0) {
            const latestFile = allFiles.reduce((latest, file) => 
                new Date(file.created_at) > new Date(latest.created_at) ? file : latest
            );
            document.getElementById('lastUpdated').textContent = formatDate(latestFile.created_at);
        }
    }
    
    // Switch View Function
    function switchView(view) {
        currentView = view;
        
        // Update buttons
        document.querySelectorAll('[data-view]').forEach(btn => {
            btn.classList.toggle('active', btn.getAttribute('data-view') === view);
        });
        
        // Show/hide views
        document.getElementById('tableView').style.display = view === 'table' ? 'block' : 'none';
        document.getElementById('gridView').style.display = view === 'grid' ? 'block' : 'none';
        
        renderFiles();
    }
    
    // Clear All Filters
    function clearAllFilters() {
        document.getElementById('searchInput').value = '';
        document.getElementById('fileTypeFilter').value = '';
        document.getElementById('dateFilter').value = '';
        document.getElementById('sortFilter').value = 'newest';
        applyFilters();
    }
    
    // Show/Hide States
    function showLoading() {
        document.getElementById('loadingState').style.display = 'block';
        document.getElementById('tableView').style.display = 'none';
        document.getElementById('gridView').style.display = 'none';
        document.getElementById('emptyState').style.display = 'none';
    }
    
    function hideLoading() {
        document.getElementById('loadingState').style.display = 'none';
        document.getElementById('tableView').style.display = currentView === 'table' ? 'block' : 'none';
        document.getElementById('gridView').style.display = currentView === 'grid' ? 'block' : 'none';
    }
    
    function showEmptyState() {
        document.getElementById('emptyState').style.display = 'block';
        document.getElementById('tableView').style.display = 'none';
        document.getElementById('gridView').style.display = 'none';
    }
    
    function hideEmptyState() {
        document.getElementById('emptyState').style.display = 'none';
    }
    
    function showError(message) {
        hideLoading();
        // You can implement a toast notification here
        console.error(message);
    }
    
    // Helper Functions
    function getFileIcon(ext) {
        const icons = {
            pdf: 'file-pdf',
            doc: 'file-word', docx: 'file-word',
            xls: 'file-excel', xlsx: 'file-excel',
            ppt: 'file-powerpoint', pptx: 'file-powerpoint',
            jpg: 'file-image', jpeg: 'file-image', png: 'file-image', gif: 'file-image',
            zip: 'file-archive', rar: 'file-archive',
            mp4: 'file-video', avi: 'file-video', mov: 'file-video',
            mp3: 'file-audio', wav: 'file-audio',
            txt: 'file-alt', csv: 'file-csv'
        };
        return icons[ext] || 'file-alt';
    }
    
    function getFileIconColor(ext) {
        const colors = {
            pdf: '#ef4444',
            doc: '#3b82f6', docx: '#3b82f6',
            xls: '#10b981', xlsx: '#10b981',
            ppt: '#f59e0b', pptx: '#f59e0b',
            jpg: '#8b5cf6', jpeg: '#8b5cf6', png: '#8b5cf6', gif: '#8b5cf6',
            zip: '#6b7280', rar: '#6b7280',
            mp4: '#ec4899', avi: '#ec4899', mov: '#ec4899'
        };
        return colors[ext] || '#6b7280';
    }
    
    function formatDate(dateString) {
        return new Date(dateString).toLocaleDateString();
    }
    
    function formatTime(dateString) {
        return new Date(dateString).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
    }
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Handle Download with Visual Feedback
    window.handleDownload = function(button) {
        button.classList.add('downloading');
        button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Downloading...';
        
        // Reset button after a short delay
        setTimeout(() => {
            button.classList.remove('downloading');
            button.innerHTML = '<i class="fas fa-download"></i> Download';
        }, 2000);
    };
});
</script>
@endsection
