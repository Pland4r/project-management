@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="page-header">
        <div class="breadcrumb-nav">
            <a href="{{ route('admin.dashboard') }}" class="breadcrumb-link">
                <i class="fas fa-arrow-left"></i>
                Back to Dashboard
            </a>
        </div>
        <h1 class="page-title">
            <i class="fas fa-user-clock"></i>
            Pending User Registrations
        </h1>
        <p class="page-subtitle">Review and approve new user registration requests</p>
    </div>

    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="main-card">
        <div class="card-header">
            <div class="header-info">
                <h2 class="card-title">
                    <i class="fas fa-users"></i>
                    Registration Requests
                </h2>
                <div class="stats-info">
                    <span class="pending-count">
                        <i class="fas fa-hourglass-half"></i>
                        {{ $pendingUsers->count() }} Pending
                    </span>
                </div>
            </div>
        </div>

        <div class="card-body">
            @if($pendingUsers->count() > 0)
                <div class="table-container">
                    <table class="users-table">
                        <thead>
                            <tr>
                                <th style="width: 25%;">Name</th>
                                <th style="width: 30%;">Email</th>
                                <th style="width: 20%;">User Code</th>
                                <th style="width: 15%;">Registered</th>
                                <th style="width: 10%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingUsers as $user)
                                <tr class="user-row" data-user-id="{{ $user->id }}">
                                    <td>
                                        <div class="user-info">
                                            <div class="user-avatar">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <div class="user-details">
                                                <span class="user-name">{{ $user->name }}</span>
                                                <span class="user-status">New Registration</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="user-email">{{ $user->email }}</td>
                                    <td>
                                        <span class="usercode-badge">{{ $user->usercode }}</span>
                                    </td>
                                    <td class="registration-date">
                                        {{ $user->created_at->format('M d, Y') }}
                                        <small class="time-ago">{{ $user->created_at->diffForHumans() }}</small>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('admin.users.approve', $user) }}" method="POST" class="approve-form">
                                                @csrf
                                                <button type="submit" class="btn-approve" title="Approve User">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.users.reject', $user) }}" method="POST" class="reject-form">
                                                @csrf
                                                <button type="submit" class="btn-reject" title="Reject User">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-user-check"></i>
                    <h3>No Pending Registrations</h3>
                    <p>All user registration requests have been processed.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Bulk Actions Card (if there are pending users) -->
    @if($pendingUsers->count() > 0)
        <div class="bulk-actions-card">
            <div class="bulk-header">
                <h3 class="bulk-title">
                    <i class="fas fa-tasks"></i>
                    Bulk Actions
                </h3>
                <p class="bulk-subtitle">Perform actions on multiple users at once</p>
            </div>
            <div class="bulk-content">
                <div class="bulk-controls">
                    <button type="button" class="btn-select-all">
                        <i class="fas fa-check-square"></i>
                        Select All
                    </button>
                    <button type="button" class="btn-clear-selection" disabled>
                        <i class="fas fa-square"></i>
                        Clear Selection
                    </button>
                    <div class="selected-count">
                        <span id="selected-count">0</span> users selected
                    </div>
                </div>
                <div class="bulk-actions">
                    <button type="button" class="btn-bulk-approve" disabled>
                        <i class="fas fa-check-circle"></i>
                        Approve Selected
                    </button>
                    <button type="button" class="btn-bulk-reject" disabled>
                        <i class="fas fa-times-circle"></i>
                        Reject Selected
                    </button>
                </div>
            </div>
        </div>
    @endif
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
    margin: 0 0 var(--space-sm) 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.page-title i {
    color: var(--stellantis-primary);
}

.page-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
    margin: 0;
}

/* Alert */
.alert-success {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-lg);
    font-weight: 600;
    border: none;
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
    animation: slideInDown 0.5s ease-out;
}

/* Main Card */
.main-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--card-border);
    margin-bottom: var(--space-xl);
    overflow: hidden;
    animation: fadeInUp 0.6s ease-out;
}

.card-header {
    background: var(--primary-gradient);
    color: white;
    padding: var(--space-lg) var(--space-xl);
}

.header-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.card-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.stats-info {
    display: flex;
    align-items: center;
    gap: var(--space-lg);
}

.pending-count {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    background: rgba(255, 255, 255, 0.2);
    padding: var(--space-sm) var(--space-md);
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
}

.card-body {
    padding: var(--space-xl);
}

/* Table Container */
.table-container {
    background: var(--bg-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    border: 1px solid var(--border-secondary);
}

/* Users Table */
.users-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 0.9rem;
}

.users-table thead {
    background: linear-gradient(135deg, var(--stellantis-primary), #1e40af);
}

.users-table th {
    padding: var(--space-md) var(--space-lg);
    color: white;
    font-weight: 600;
    font-size: 0.85rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    text-align: left;
    border: none;
}

.users-table tbody tr {
    background: var(--bg-primary);
    transition: all var(--transition-normal);
    border-bottom: 1px solid var(--border-secondary);
}

.users-table tbody tr:nth-child(even) {
    background: var(--bg-secondary);
}

.users-table tbody tr:hover {
    background: var(--bg-tertiary);
    transform: translateX(4px);
}

.users-table td {
    padding: var(--space-lg);
    border: none;
    vertical-align: middle;
    color: var(--text-primary);
}

/* User Info */
.user-info {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: var(--radius-full);
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1rem;
    flex-shrink: 0;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: var(--space-xs);
}

.user-name {
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.95rem;
}

.user-status {
    font-size: 0.8rem;
    color: var(--text-muted);
    font-style: italic;
}

.user-email {
    color: var(--text-secondary);
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    font-size: 0.85rem;
}

.usercode-badge {
    display: inline-block;
    padding: var(--space-xs) var(--space-sm);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-secondary);
    border-radius: var(--radius-md);
    font-family: 'Monaco', 'Menlo', 'Consolas', monospace;
    font-size: 0.8rem;
    font-weight: 600;
    color: var(--text-primary);
}

.registration-date {
    color: var(--text-secondary);
    font-size: 0.85rem;
}

.time-ago {
    display: block;
    color: var(--text-muted);
    font-size: 0.75rem;
    margin-top: var(--space-xs);
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: var(--space-sm);
}

.btn-approve,
.btn-reject {
    width: 36px;
    height: 36px;
    border-radius: var(--radius-lg);
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all var(--transition-normal);
    position: relative;
    overflow: hidden;
}

.btn-approve {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-reject {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-approve:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: var(--shadow-lg);
}

.btn-reject:hover {
    transform: translateY(-2px) scale(1.05);
    box-shadow: var(--shadow-lg);
}

.btn-approve:disabled,
.btn-reject:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-3xl);
    color: var(--text-muted);
}

.empty-state i {
    font-size: 4rem;
    margin-bottom: var(--space-lg);
    opacity: 0.5;
    color: var(--stellantis-primary);
}

.empty-state h3 {
    font-size: 1.5rem;
    font-weight: 600;
    margin-bottom: var(--space-md);
    color: var(--text-secondary);
}

.empty-state p {
    font-size: 1rem;
    margin: 0;
}

/* Bulk Actions Card */
.bulk-actions-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
    overflow: hidden;
    animation: fadeInUp 0.8s ease-out;
}

.bulk-header {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
    padding: var(--space-lg) var(--space-xl);
    text-align: center;
}

.bulk-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0 0 var(--space-sm) 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.bulk-subtitle {
    font-size: 0.9rem;
    margin: 0;
    opacity: 0.9;
}

.bulk-content {
    padding: var(--space-xl);
}

.bulk-controls {
    display: flex;
    align-items: center;
    gap: var(--space-lg);
    margin-bottom: var(--space-lg);
    padding-bottom: var(--space-lg);
    border-bottom: 1px solid var(--border-secondary);
}

.btn-select-all,
.btn-clear-selection {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    padding: var(--space-sm) var(--space-md);
    border-radius: var(--radius-lg);
    border: 2px solid var(--border-secondary);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-weight: 600;
    font-size: 0.85rem;
    cursor: pointer;
    transition: all var(--transition-normal);
}

.btn-select-all:hover,
.btn-clear-selection:hover:not(:disabled) {
    border-color: var(--stellantis-primary);
    background: var(--bg-tertiary);
    color: var(--stellantis-primary);
}

.btn-clear-selection:disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.selected-count {
    margin-left: auto;
    padding: var(--space-sm) var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.bulk-actions {
    display: flex;
    gap: var(--space-lg);
    justify-content: center;
}

.btn-bulk-approve,
.btn-bulk-reject {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    padding: var(--space-md) var(--space-xl);
    border-radius: var(--radius-lg);
    border: none;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    transition: all var(--transition-normal);
    min-width: 160px;
    justify-content: center;
}

.btn-bulk-approve {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.btn-bulk-reject {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
}

.btn-bulk-approve:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-bulk-reject:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.btn-bulk-approve:disabled,
.btn-bulk-reject:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none;
}

/* Row Selection */
.user-row.selected {
    background: rgba(37, 99, 235, 0.1) !important;
    border-left: 4px solid var(--stellantis-primary);
}

.user-row.selected .user-avatar {
    background: var(--stellantis-primary);
}

/* Responsive Design */
@media (max-width: 1200px) {
    .header-info {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-md);
    }
    
    .bulk-controls {
        flex-wrap: wrap;
        gap: var(--space-md);
    }
    
    .selected-count {
        margin-left: 0;
        order: -1;
        width: 100%;
        text-align: center;
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
    
    .card-header,
    .card-body,
    .bulk-content {
        padding: var(--space-lg);
    }
    
    .users-table {
        font-size: 0.8rem;
    }
    
    .users-table th,
    .users-table td {
        padding: var(--space-md);
    }
    
    .user-info {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-sm);
    }
    
    .user-avatar {
        width: 32px;
        height: 32px;
        font-size: 0.8rem;
    }
    
    .action-buttons {
        flex-direction: column;
    }
    
    .bulk-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-bulk-approve,
    .btn-bulk-reject {
        width: 100%;
        max-width: 300px;
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.6rem;
    }
    
    .card-header,
    .card-body,
    .bulk-content {
        padding: var(--space-md);
    }
    
    .users-table {
        font-size: 0.75rem;
    }
    
    .users-table th,
    .users-table td {
        padding: var(--space-sm);
    }
    
    .time-ago {
        display: none;
    }
}

/* Animations */
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

@keyframes ripple-effect {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Focus States for Accessibility */
.btn-approve:focus,
.btn-reject:focus,
.btn-select-all:focus,
.btn-clear-selection:focus,
.btn-bulk-approve:focus,
.btn-bulk-reject:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form submission handling
    const forms = document.querySelectorAll('.approve-form, .reject-form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button');
            const isApprove = this.classList.contains('approve-form');
            
            // Confirm action
            const action = isApprove ? 'approve' : 'reject';
            if (!confirm(`Are you sure you want to ${action} this user?`)) {
                e.preventDefault();
                return;
            }
            
            // Disable button and show loading
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            
            // Add loading class to row
            const row = this.closest('.user-row');
            row.style.opacity = '0.6';
            row.style.pointerEvents = 'none';
        });
    });
    
    // Ripple effect for buttons
    const buttons = document.querySelectorAll('.btn-approve, .btn-reject, .btn-bulk-approve, .btn-bulk-reject');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
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
    
    // Bulk selection functionality
    let selectedUsers = new Set();
    
    const selectAllBtn = document.querySelector('.btn-select-all');
    const clearSelectionBtn = document.querySelector('.btn-clear-selection');
    const selectedCountSpan = document.getElementById('selected-count');
    const bulkApproveBtn = document.querySelector('.btn-bulk-approve');
    const bulkRejectBtn = document.querySelector('.btn-bulk-reject');
    const userRows = document.querySelectorAll('.user-row');
    
    if (selectAllBtn) {
        // Row click selection
        userRows.forEach(row => {
            row.addEventListener('click', function(e) {
                // Don't select if clicking on action buttons
                if (e.target.closest('.action-buttons')) return;
                
                const userId = this.dataset.userId;
                
                if (selectedUsers.has(userId)) {
                    selectedUsers.delete(userId);
                    this.classList.remove('selected');
                } else {
                    selectedUsers.add(userId);
                    this.classList.add('selected');
                }
                
                updateBulkControls();
            });
        });
        
        // Select all button
        selectAllBtn.addEventListener('click', function() {
            userRows.forEach(row => {
                const userId = row.dataset.userId;
                selectedUsers.add(userId);
                row.classList.add('selected');
            });
            updateBulkControls();
        });
        
        // Clear selection button
        clearSelectionBtn.addEventListener('click', function() {
            selectedUsers.clear();
            userRows.forEach(row => {
                row.classList.remove('selected');
            });
            updateBulkControls();
        });
        
        // Bulk approve
        bulkApproveBtn.addEventListener('click', function() {
            if (selectedUsers.size === 0) return;
            
            if (confirm(`Are you sure you want to approve ${selectedUsers.size} user(s)?`)) {
                // Here you would implement the bulk approve functionality
                console.log('Bulk approve:', Array.from(selectedUsers));
                // For now, just show a message
                alert('Bulk approve functionality would be implemented here');
            }
        });
        
        // Bulk reject
        bulkRejectBtn.addEventListener('click', function() {
            if (selectedUsers.size === 0) return;
            
            if (confirm(`Are you sure you want to reject ${selectedUsers.size} user(s)?`)) {
                // Here you would implement the bulk reject functionality
                console.log('Bulk reject:', Array.from(selectedUsers));
                // For now, just show a message
                alert('Bulk reject functionality would be implemented here');
            }
        });
        
        function updateBulkControls() {
            const count = selectedUsers.size;
            
            selectedCountSpan.textContent = count;
            
            clearSelectionBtn.disabled = count === 0;
            bulkApproveBtn.disabled = count === 0;
            bulkRejectBtn.disabled = count === 0;
            
            // Update select all button text
            if (count === userRows.length && count > 0) {
                selectAllBtn.innerHTML = '<i class="fas fa-check-square"></i> All Selected';
            } else {
                selectAllBtn.innerHTML = '<i class="fas fa-check-square"></i> Select All';
            }
        }
    }
    
    // Auto-refresh functionality (optional)
    let autoRefreshInterval;
    
    function startAutoRefresh() {
        autoRefreshInterval = setInterval(() => {
            // Only refresh if no users are selected
            if (selectedUsers.size === 0) {
                window.location.reload();
            }
        }, 30000); // Refresh every 30 seconds
    }
    
    function stopAutoRefresh() {
        if (autoRefreshInterval) {
            clearInterval(autoRefreshInterval);
        }
    }
    
    // Start auto-refresh
    startAutoRefresh();
    
    // Stop auto-refresh when page is hidden
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            stopAutoRefresh();
        } else {
            startAutoRefresh();
        }
    });
    
    // Stop auto-refresh before page unload
    window.addEventListener('beforeunload', stopAutoRefresh);
});
</script>
@endsection