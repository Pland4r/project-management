@extends('layouts.app')
@section('content')
<div class="container">
    <div class="page-header">
        <h1 class="page-title">All Projects</h1>
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i>
            Create New Project
        </a>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-container">
                <table class="modern-table">
                    <thead>
                        <tr>
                            <th style="width: 25%;">
                                <i class="fas fa-folder"></i>
                                Name
                            </th>
                            <th style="width: 25%;">
                                <i class="fas fa-user"></i>
                                Person
                            </th>
                            <th style="width: 30%;">
                                <i class="fas fa-tag"></i>
                                Reference
                            </th>
                            <th style="width: 20%;">
                                <i class="fas fa-cogs"></i>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>
                                    <div class="project-name">
                                        <i class="fas fa-folder-open project-icon"></i>
                                        <span class="name-text">{{ $project->project_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="person-info">
                                        <i class="fas fa-user-circle person-icon"></i>
                                        <span class="person-text">{{ $project->person_name }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="reference-container">
                                        <span class="reference-badge">{{ $project->reference }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div class="actions-container">
                                        <a href="{{ route('admin.projects.files', $project) }}" 
                                           class="btn btn-success btn-sm action-btn">
                                            <i class="fas fa-file-alt"></i>
                                            Manage Files
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="empty-state">
                                    <div class="empty-content">
                                        <i class="fas fa-folder-open empty-icon"></i>
                                        <h3>No Projects Found</h3>
                                        <p>Create your first project to get started!</p>
                                        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">
                                            <i class="fas fa-plus"></i>
                                            Create Project
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
/* Use existing CSS variables from app.blade.php - no dark mode redefinition needed */

/* Page Header */
.page-header {
    display: flex;
    flex-direction: column;
    gap: var(--space-lg);
    margin-bottom: var(--space-2xl);
    align-items: center;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    text-align: center;
    margin: 0;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.02em;
}

/* Enhanced Alert */
.alert-success {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    background: var(--success-gradient);
    color: white;
    border: none;
    border-radius: var(--radius-xl);
    padding: var(--space-lg) var(--space-xl);
    font-weight: 600;
    box-shadow: var(--shadow-lg);
    animation: slideInDown 0.5s ease-out;
}

@keyframes slideInDown {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Enhanced Create Button */
.btn-primary {
    background: var(--primary-gradient);
    border: none;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    padding: var(--space-lg) var(--space-xl);
    border-radius: var(--radius-xl);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-md);
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
}

.btn-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn-primary:hover {
    transform: translateY(-3px) scale(1.02);
    box-shadow: var(--shadow-2xl);
    color: white;
    text-decoration: none;
}

.btn-primary:hover::before {
    left: 100%;
}

/* Fixed Table Structure */
.table-container {
    background: transparent;
    border-radius: 0;
    overflow: auto;
    width: 100%;
    max-width: 100%;
    -webkit-overflow-scrolling: touch;
}

.modern-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.95rem;
    background: transparent;
    table-layout: fixed; /* Fixed layout for consistent column widths */
}

/* Enhanced Table Header */
.modern-table thead {
    background: var(--primary-gradient);
    position: sticky;
    top: 0;
    z-index: 10;
}

.modern-table th {
    padding: var(--space-lg) var(--space-md);
    color: white;
    font-weight: 700;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    border: none;
    text-align: left;
    white-space: nowrap;
    position: relative;
    vertical-align: middle;
}

.modern-table th:first-child {
    border-radius: var(--radius-lg) 0 0 0;
}

.modern-table th:last-child {
    border-radius: 0 var(--radius-lg) 0 0;
}

.modern-table th i {
    margin-right: var(--space-sm);
    opacity: 0.9;
}

/* Enhanced Table Body */
.modern-table tbody tr {
    background: var(--card-bg);
    transition: all var(--transition-fast);
    border-bottom: 1px solid var(--border-secondary);
}

.modern-table tbody tr:nth-child(even) {
    background: var(--bg-secondary);
}

.modern-table tbody tr:hover {
    background: var(--bg-tertiary);
    transform: translateX(4px);
    box-shadow: var(--shadow-md);
    border-left: 4px solid var(--stellantis-primary);
}

.modern-table tbody tr:last-child {
    border-bottom: none;
}

.modern-table tbody tr:last-child td:first-child {
    border-radius: 0 0 0 var(--radius-lg);
}

.modern-table tbody tr:last-child td:last-child {
    border-radius: 0 0 var(--radius-lg) 0;
}

/* Enhanced Table Cells */
.modern-table td {
    padding: var(--space-lg) var(--space-md);
    border: none;
    vertical-align: middle;
    color: var(--text-primary);
    transition: all var(--transition-normal);
    word-wrap: break-word;
    overflow-wrap: break-word;
}

/* Project Name Styling */
.project-name {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.project-icon {
    color: var(--stellantis-gold);
    font-size: 1.2rem;
    flex-shrink: 0;
}

.name-text {
    font-weight: 700;
    font-size: 1.1rem;
    color: var(--text-primary);
}

/* Person Info Styling */
.person-info {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.person-icon {
    color: var(--stellantis-primary);
    font-size: 1.1rem;
    flex-shrink: 0;
}

.person-text {
    font-style: italic;
    color: var(--text-secondary);
    font-weight: 500;
}

/* Reference Badge Styling */
.reference-container {
    display: flex;
    justify-content: flex-start;
    align-items: center;
}

.reference-badge {
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    background: var(--bg-tertiary);
    color: var(--text-muted);
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: var(--radius-lg);
    padding: var(--space-md) var(--space-lg);
    border: 1px solid var(--border-secondary);
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-normal);
    display: inline-block;
    max-width: 100%;
    word-break: break-all;
}

.modern-table tbody tr:hover .reference-badge {
    background: var(--primary-gradient);
    color: white;
    transform: scale(1.05);
    box-shadow: var(--shadow-md);
}

/* Actions Container */
.actions-container {
    display: flex;
    justify-content: center;
    align-items: center;
}

.action-btn {
    background: var(--success-gradient);
    border: none;
    color: white;
    font-weight: 600;
    font-size: 0.875rem;
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.action-btn:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: var(--shadow-xl);
    color: white;
    text-decoration: none;
}

.action-btn:hover::before {
    left: 100%;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-3xl) var(--space-xl);
}

.empty-content {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-lg);
}

.empty-icon {
    font-size: 4rem;
    color: var(--text-muted);
    opacity: 0.5;
}

.empty-content h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-secondary);
    margin: 0;
}

.empty-content p {
    color: var(--text-muted);
    font-size: 1rem;
    margin: 0;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .modern-table {
        font-size: 0.9rem;
    }
    
    .modern-table th,
    .modern-table td {
        padding: var(--space-md) var(--space-sm);
    }
}

@media (max-width: 768px) {
    .page-header {
        gap: var(--space-md);
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .btn-primary {
        width: 100%;
        justify-content: center;
        padding: var(--space-lg);
    }
    
    .modern-table {
        font-size: 0.85rem;
    }
    
    .modern-table th,
    .modern-table td {
        padding: var(--space-md) var(--space-xs);
    }
    
    .project-name,
    .person-info {
        flex-direction: column;
        gap: var(--space-xs);
        align-items: flex-start;
    }
    
    .project-icon,
    .person-icon {
        display: none;
    }
    
    .reference-badge {
        font-size: 0.75rem;
        padding: var(--space-sm) var(--space-md);
    }
    
    .action-btn {
        font-size: 0.75rem;
        padding: var(--space-sm) var(--space-md);
    }
    
    .action-btn i {
        display: none;
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.75rem;
    }
    
    .modern-table th,
    .modern-table td {
        padding: var(--space-sm);
    }
    
    .name-text {
        font-size: 1rem;
    }
    
    .reference-badge {
        font-size: 0.7rem;
        padding: var(--space-xs) var(--space-sm);
        word-break: break-all;
    }
    
    .action-btn {
        font-size: 0.7rem;
        padding: var(--space-xs) var(--space-sm);
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

.modern-table tbody tr {
    animation: fadeInUp 0.5s ease-out;
    animation-fill-mode: both;
}

.modern-table tbody tr:nth-child(1) { animation-delay: 0.1s; }
.modern-table tbody tr:nth-child(2) { animation-delay: 0.2s; }
.modern-table tbody tr:nth-child(3) { animation-delay: 0.3s; }
.modern-table tbody tr:nth-child(4) { animation-delay: 0.4s; }
.modern-table tbody tr:nth-child(5) { animation-delay: 0.5s; }

/* Focus States for Accessibility */
.action-btn:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}

.modern-table tbody tr:focus-within {
    background: var(--bg-tertiary);
    outline: 2px solid var(--stellantis-primary);
    outline-offset: -2px;
}

/* Print Styles */
@media print {
    .btn-primary,
    .action-btn {
        display: none;
    }
    
    .modern-table {
        box-shadow: none;
        border: 1px solid #000;
    }
    
    .modern-table th,
    .modern-table td {
        border: 1px solid #000;
        color: #000;
        background: #fff;
    }
    
    .reference-badge {
        background: #f5f5f5;
        color: #000;
        border: 1px solid #000;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced button interactions with ripple effect
    const buttons = document.querySelectorAll('.btn');
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
            
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // Keyboard navigation for table rows
    const tableRows = document.querySelectorAll('.modern-table tbody tr');
    tableRows.forEach((row, index) => {
        row.setAttribute('tabindex', '0');
        
        row.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                const button = this.querySelector('.action-btn');
                if (button) {
                    button.click();
                }
            }
            
            // Arrow key navigation
            if (e.key === 'ArrowDown' && index < tableRows.length - 1) {
                tableRows[index + 1].focus();
            }
            if (e.key === 'ArrowUp' && index > 0) {
                tableRows[index - 1].focus();
            }
        });
    });
    
    // Copy reference to clipboard functionality
    const referenceBadges = document.querySelectorAll('.reference-badge');
    referenceBadges.forEach(badge => {
        badge.style.cursor = 'pointer';
        badge.title = 'Click to copy reference';
        
        badge.addEventListener('click', function() {
            const text = this.textContent;
            navigator.clipboard.writeText(text).then(() => {
                // Show temporary feedback
                const originalText = this.textContent;
                this.textContent = 'Copied!';
                this.style.background = 'var(--success-gradient)';
                this.style.color = 'white';
                
                setTimeout(() => {
                    this.textContent = originalText;
                    this.style.background = '';
                    this.style.color = '';
                }, 1500);
            });
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