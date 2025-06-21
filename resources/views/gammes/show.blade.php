@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="card mb-4">
        <div class="card-header">
            <div>
                <h1 class="mb-0" style="display: flex; align-items: center; gap: 15px;">
                    <a href="{{ route('gammes.index') }}" class="btn btn-outline-primary" style="margin-right: 10px;">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <i class="fas fa-folder-open" style="color: var(--stellantis-gold); font-size: 2.5rem;"></i>
                    <span>{{ $gamme->display_name }} Files</span>
                </h1>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    Access and download files for the {{ $gamme->display_name }} product line
                </p>
            </div>
            <div class="d-flex gap-2">
                <span class="badge bg-primary">
                    <i class="fas fa-file me-2"></i>
                    {{ $gamme->files->count() }} Files
                </span>
                <span class="badge bg-success">
                    <i class="fas fa-hdd me-2"></i>
                    {{ number_format($gamme->files->sum('size') / 1024 / 1024, 1) }} MB
                </span>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="stats-card stats-card-primary">
                <div class="stats-card-background"></div>
                <div class="stats-card-content">
                    <div class="stats-icon-container">
                        <div class="stats-icon">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="stats-pulse"></div>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number" data-target="{{ $gamme->files->count() }}">0</div>
                        <div class="stats-label">Total Files</div>
                        <div class="stats-trend">
                            <i class="fas fa-check-circle"></i>
                            <span>Available</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card stats-card-success">
                <div class="stats-card-background"></div>
                <div class="stats-card-content">
                    <div class="stats-icon-container">
                        <div class="stats-icon">
                            <i class="fas fa-hdd"></i>
                        </div>
                        <div class="stats-pulse"></div>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number" data-target="{{ round($gamme->files->sum('size') / 1024 / 1024) }}">0</div>
                        <div class="stats-label">Total Size (MB)</div>
                        <div class="stats-trend">
                            <i class="fas fa-database"></i>
                            <span>Storage</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card stats-card-warning">
                <div class="stats-card-background"></div>
                <div class="stats-card-content">
                    <div class="stats-icon-container">
                        <div class="stats-icon">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="stats-pulse"></div>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number" data-target="0">0</div>
                        <div class="stats-label">Downloads</div>
                        <div class="stats-trend">
                            <i class="fas fa-chart-line"></i>
                            <span>Today</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-3">
            <div class="stats-card stats-card-danger">
                <div class="stats-card-background"></div>
                <div class="stats-card-content">
                    <div class="stats-icon-container">
                        <div class="stats-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stats-pulse"></div>
                    </div>
                    <div class="stats-info">
                        <div class="stats-number" data-target="{{ $gamme->files->where('updated_at', '>=', now()->subDays(7))->count() }}">0</div>
                        <div class="stats-label">Recent Updates</div>
                        <div class="stats-trend">
                            <i class="fas fa-calendar"></i>
                            <span>This week</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Files Table -->
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-table me-2"></i>
                    File Repository
                </h3>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    {{ $gamme->files->count() }} files available for download
                </p>
            </div>
            <div class="d-flex gap-2">
                <button class="btn btn-outline-primary" onclick="downloadAll()">
                    <i class="fas fa-download me-2"></i>
                    Download All
                </button>
                <button class="btn btn-outline-primary" onclick="refreshFiles()">
                    <i class="fas fa-sync-alt me-2"></i>
                    Refresh
                </button>
            </div>
        </div>

        <div class="card-body">
            @if($gamme->files->isEmpty())
                <div class="alert alert-info text-center" style="margin: 2rem;">
                    <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 1rem; display: block; color: var(--stellantis-primary);"></i>
                    <h4>No Files Available</h4>
                    <p>There are currently no files available for the {{ $gamme->display_name }} gamme.</p>
                    <a href="{{ route('gammes.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>Back to Gammes
                    </a>
                </div>
            @else
                <div style="overflow-x: auto; width: 100%;">
                    <table class="modern-table" style="min-width: 100%;">
                        <thead>
                            <tr>
                                <th><i class="fas fa-file"></i> File Name</th>
                                <th><i class="fas fa-tag"></i> Type</th>
                                <th><i class="fas fa-hdd"></i> Size</th>
                                <th><i class="fas fa-calendar"></i> Modified</th>
                                <th><i class="fas fa-download"></i> Downloads</th>
                                <th><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gamme->files as $file)
                                <tr class="file-row" data-file-id="{{ $file->id }}">
                                    <td>
                                        <div class="file-info">
                                            <div class="file-icon">
                                                <i class="fas fa-{{ 
                                                    pathinfo($file->original_name, PATHINFO_EXTENSION) == 'pdf' ? 'file-pdf' : 
                                                    (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? 'file-image' : 
                                                    (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['doc', 'docx']) ? 'file-word' : 
                                                    (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['xls', 'xlsx']) ? 'file-excel' : 
                                                    (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['zip', 'rar']) ? 'file-archive' : 'file-alt'))))
                                                }}"></i>
                                            </div>
                                            <div class="file-details">
                                                <div class="file-name">{{ $file->original_name }}</div>
                                                <div class="file-path">{{ Str::limit($file->path ?? 'Root directory', 50) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ 
                                            pathinfo($file->original_name, PATHINFO_EXTENSION) == 'pdf' ? 'danger' : 
                                            (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif']) ? 'warning' : 
                                            (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['doc', 'docx']) ? 'primary' : 
                                            (in_array(pathinfo($file->original_name, PATHINFO_EXTENSION), ['xls', 'xlsx']) ? 'success' : 'secondary')))
                                        }}">
                                            {{ strtoupper(pathinfo($file->original_name, PATHINFO_EXTENSION) ?: 'FILE') }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="file-size">
                                            {{ $file->size ? number_format($file->size / 1024, 1) . ' KB' : 'Unknown' }}
                                        </span>
                                    </td>
                                    <td>
                                        <time datetime="{{ $file->updated_at }}">
                                            {{ $file->updated_at ? $file->updated_at->format('d/m/Y H:i') : 'Unknown' }}
                                        </time>
                                    </td>
                                    <td>
                                        <span class="download-count">
                                            <i class="fas fa-download me-1"></i>
                                            {{ $file->download_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('files.download', $file->id) }}" 
                                               class="btn btn-sm btn-success download-btn"
                                               data-file-id="{{ $file->id }}"
                                               title="Download {{ $file->original_name }}">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-primary preview-btn" 
                                                    data-file-id="{{ $file->id }}"
                                                    title="Preview {{ $file->original_name }}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-primary info-btn" 
                                                    data-file-id="{{ $file->id }}"
                                                    title="File Information">
                                                <i class="fas fa-info-circle"></i>
                                            </button>
                                        </div>
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

<style>
/* File Table Enhancements */
.file-info {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.file-icon {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-lg);
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    flex-shrink: 0;
}

.file-details {
    flex: 1;
    min-width: 0;
}

.file-name {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.file-path {
    font-size: 0.75rem;
    color: var(--text-muted);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.file-size {
    font-family: 'Courier New', monospace;
    font-weight: 600;
    color: var(--text-secondary);
}

.download-count {
    display: flex;
    align-items: center;
    color: var(--text-secondary);
    font-weight: 500;
}

.action-buttons {
    display: flex;
    gap: var(--space-sm);
    align-items: center;
}

.download-btn {
    background: var(--success-gradient);
    border: none;
    color: white;
}

.download-btn:hover {
    background: var(--primary-gradient);
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.preview-btn, .info-btn {
    border: 2px solid var(--border-primary);
    color: var(--stellantis-primary);
    background: rgba(5, 150, 105, 0.1);
}

.preview-btn:hover, .info-btn:hover {
    background: var(--primary-gradient);
    color: white;
    border-color: transparent;
}

/* File row hover effects */
.file-row {
    transition: all var(--transition-normal);
}

.file-row:hover {
    background: linear-gradient(135deg, rgba(5, 150, 105, 0.05) 0%, rgba(16, 185, 129, 0.05) 100%);
    transform: translateX(4px);
}

.file-row:hover .file-icon {
    transform: scale(1.1);
    box-shadow: var(--shadow-lg);
}

/* Stats Cards (reusing from index) */
.stats-card {
    position: relative;
    height: 180px;
    border-radius: var(--radius-2xl);
    overflow: hidden;
    cursor: pointer;
    transition: all var(--transition-normal);
    margin-bottom: var(--space-xl);
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
    transition: all var(--transition-normal);
}

.stats-card-primary .stats-card-background {
    background: var(--primary-gradient);
}

.stats-card-success .stats-card-background {
    background: var(--success-gradient);
}

.stats-card-warning .stats-card-background {
    background: var(--warning-gradient);
}

.stats-card-danger .stats-card-background {
    background: var(--danger-gradient);
}

.stats-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: var(--shadow-2xl);
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
    padding: var(--space-xl);
    color: white;
}

.stats-icon-container {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.stats-icon {
    width: 80px;
    height: 80px;
    border-radius: var(--radius-full);
    background: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    position: relative;
    z-index: 3;
    transition: all var(--transition-normal);
    border: 2px solid rgba(255, 255, 255, 0.3);
}

.stats-card:hover .stats-icon {
    transform: scale(1.1) rotate(5deg);
    background: rgba(255, 255, 255, 0.3);
    border-color: rgba(255, 255, 255, 0.5);
}

.stats-pulse {
    position: absolute;
    width: 80px;
    height: 80px;
    border-radius: var(--radius-full);
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
    margin-left: var(--space-lg);
}

.stats-number {
    font-size: 3.5rem;
    font-weight: 900;
    line-height: 1;
    margin-bottom: var(--space-sm);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    font-family: 'Inter', sans-serif;
    letter-spacing: -0.02em;
}

.stats-label {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: var(--space-xs);
    opacity: 0.95;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stats-trend {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: var(--space-xs);
    font-size: 0.85rem;
    opacity: 0.8;
    font-weight: 500;
}

.stats-trend i {
    font-size: 0.75rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-card {
        height: 140px;
        margin-bottom: var(--space-lg);
    }
    
    .stats-card-content {
        padding: var(--space-lg);
    }
    
    .stats-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .stats-pulse {
        width: 60px;
        height: 60px;
    }
    
    .stats-number {
        font-size: 2.5rem;
    }
    
    .stats-label {
        font-size: 0.9rem;
    }
    
    .stats-info {
        margin-left: var(--space-md);
    }
    
    .file-info {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-sm);
    }
    
    .action-buttons {
        flex-direction: column;
        gap: var(--space-xs);
    }
}

@media (max-width: 576px) {
    .stats-card-content {
        flex-direction: column;
        text-align: center;
        gap: var(--space-md);
    }
    
    .stats-info {
        margin-left: 0;
        text-align: center;
    }
    
    .stats-trend {
        justify-content: center;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate numbers counting up
    const numberElements = document.querySelectorAll('.stats-number');
    
    const animateNumber = (element) => {
        const target = parseInt(element.getAttribute('data-target'));
        const duration = 2000;
        const increment = target / (duration / 16);
        let current = 0;
        
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
                if (numberElement && !numberElement.hasAttribute('data-animated')) {
                    setTimeout(() => {
                        animateNumber(numberElement);
                        numberElement.setAttribute('data-animated', 'true');
                    }, Math.random() * 500);
                }
            }
        });
    }, { threshold: 0.5 });
    
    // Observe all stats cards
    document.querySelectorAll('.stats-card').forEach(card => {
        observer.observe(card);
    });
    
    // Download button click tracking
    document.querySelectorAll('.download-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fileId = this.getAttribute('data-file-id');
            
            // Add visual feedback
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.disabled = true;
            
            // Reset after 2 seconds
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-download"></i>';
                this.disabled = false;
            }, 2000);
            
            // Track download (you can implement this)
            console.log('Downloaded file ID:', fileId);
        });
    });
    
    // Preview button functionality
    document.querySelectorAll('.preview-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fileId = this.getAttribute('data-file-id');
            alert('Preview functionality for file ID: ' + fileId + ' (to be implemented)');
        });
    });
    
    // Info button functionality
    document.querySelectorAll('.info-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const fileId = this.getAttribute('data-file-id');
            alert('File information for file ID: ' + fileId + ' (to be implemented)');
        });
    });
});

// Download all functionality
function downloadAll() {
    if (confirm('Are you sure you want to download all files? This may take some time.')) {
        alert('Download all functionality to be implemented');
    }
}

// Refresh files functionality
function refreshFiles() {
    location.reload();
}
</script>
@endsection