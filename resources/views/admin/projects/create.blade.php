@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="page-header">
        <div class="header-content">
            <div class="breadcrumb-nav">
                <a href="{{ route('admin.projects.index') }}" class="breadcrumb-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to Projects
                </a>
            </div>
            <h1 class="page-title">
                <i class="fas fa-plus-circle title-icon"></i>
                Create New Project
            </h1>
        </div>
    </div>

    <div class="form-container">
        <div class="card form-card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-project-diagram"></i>
                    Project Details
                </h3>
                <p class="card-subtitle">Fill out the information below to create your new project</p>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger error-alert">
                        <div class="error-header">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Please fix the following errors:</strong>
                        </div>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.projects.store') }}" method="POST" class="project-form" id="projectForm">
                    @csrf
                    
                    <div class="form-grid">
                        <!-- Project Name -->
                        <div class="form-group">
                            <label for="project_name" class="form-label">
                                <i class="fas fa-folder-open label-icon"></i>
                                Project Name
                                <span class="required-indicator">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text" 
                                       name="project_name" 
                                       id="project_name" 
                                       class="form-control modern-input" 
                                       placeholder="Enter project name..."
                                       value="{{ old('project_name') }}"
                                       required>
                                <div class="input-focus-border"></div>
                            </div>
                        </div>

                        <!-- Responsible Person -->
                        <div class="form-group">
                            <label for="person_name" class="form-label">
                                <i class="fas fa-user-tie label-icon"></i>
                                Responsible Person
                                <span class="required-indicator">*</span>
                            </label>
                            <div class="select-wrapper">
                                <select name="person_name" 
                                        id="person_name" 
                                        class="form-control modern-select" 
                                        required>
                                    <option value="">Select responsible person...</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->name }}" 
                                                {{ old('person_name') == $user->name ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->usercode }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="select-arrow">
                                    <i class="fas fa-chevron-down"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Team Members -->
                        <div class="form-group team-members-group">
                            <label for="team_members" class="form-label">
                                <i class="fas fa-users label-icon"></i>
                                Team Members
                                <span class="optional-indicator">(Optional)</span>
                            </label>
                            <div class="multi-select-wrapper">
                                <select name="team_members[]" 
                                        id="team_members" 
                                        class="form-control modern-multi-select" 
                                        multiple>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" 
                                                {{ in_array($user->id, old('team_members', [])) ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->usercode }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="multi-select-help">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Hold <kbd>Ctrl</kbd> (Windows) or <kbd>⌘</kbd> (Mac) to select multiple members</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success btn-create">
                            <i class="fas fa-rocket"></i>
                            <span class="btn-text">Create Project</span>
                            <div class="btn-loader">
                                <i class="fas fa-spinner fa-spin"></i>
                            </div>
                        </button>
                        <a href="{{ route('admin.projects.index') }}" class="btn btn-outline-primary btn-cancel">
                            <i class="fas fa-times"></i>
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Use existing CSS variables from app.blade.php - no dark mode redefinition needed */

/* Full Width Container */
.container-fluid {
    max-width: 95%;
    margin: 0 auto;
    padding: 0 var(--space-lg);
}

/* Compact Page Header */
.page-header {
    margin-bottom: var(--space-lg);
    text-align: center;
}

.header-content {
    max-width: 100%;
    margin: 0 auto;
}

.breadcrumb-nav {
    margin-bottom: var(--space-sm);
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
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    letter-spacing: -0.02em;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.title-icon {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Full Width Form Container */
.form-container {
    max-width: 100%;
    margin: 0 auto;
}

.form-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--card-border);
    overflow: hidden;
    transition: all var(--transition-normal);
}

.form-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-2xl);
}

.card-header {
    background: var(--primary-gradient);
    color: white;
    padding: var(--space-lg) var(--space-xl);
    border-bottom: none;
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

.card-subtitle {
    font-size: 0.9rem;
    margin: 0;
    opacity: 0.9;
    font-weight: 400;
}

.card-body {
    padding: var(--space-xl);
}

/* Compact Error Alert */
.error-alert {
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(220, 38, 38, 0.1));
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: var(--radius-lg);
    padding: var(--space-md) var(--space-lg);
    margin-bottom: var(--space-lg);
    animation: shake 0.5s ease-in-out;
}

.error-header {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin-bottom: var(--space-sm);
    color: #dc2626;
    font-weight: 600;
    font-size: 0.9rem;
}

.error-list {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-md);
}

.error-list li {
    color: #dc2626;
    font-weight: 500;
    font-size: 0.85rem;
    position: relative;
    padding-left: var(--space-md);
}

.error-list li::before {
    content: '•';
    position: absolute;
    left: 0;
    color: #dc2626;
    font-weight: bold;
}

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-3px); }
    20%, 40%, 60%, 80% { transform: translateX(3px); }
}

/* Horizontal Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1.2fr;
    gap: var(--space-xl);
    align-items: start;
}

.form-group {
    position: relative;
}

.team-members-group {
    grid-column: span 1;
}

.form-label {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-primary);
    margin-bottom: var(--space-sm);
    white-space: nowrap;
}

.label-icon {
    color: var(--stellantis-primary);
    font-size: 0.9rem;
    flex-shrink: 0;
}

.required-indicator {
    color: #dc2626;
    font-weight: 700;
}

.optional-indicator {
    color: var(--text-muted);
    font-weight: 500;
    font-size: 0.8rem;
}

/* Form Controls */
.input-wrapper {
    position: relative;
}

.modern-input {
    width: 100%;
    padding: var(--space-md) var(--space-lg);
    border: 2px solid var(--border-secondary);
    border-radius: var(--radius-lg);
    font-size: 0.95rem;
    font-weight: 500;
    transition: all var(--transition-normal);
    background: var(--bg-primary);
    color: var(--text-primary);
    position: relative;
    z-index: 1;
}

.modern-input:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.input-focus-border {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border: 2px solid transparent;
    border-radius: var(--radius-lg);
    background: var(--primary-gradient);
    opacity: 0;
    transition: opacity var(--transition-normal);
    z-index: 0;
}

.modern-input:focus + .input-focus-border {
    opacity: 0.1;
}

/* Select Styling */
.select-wrapper {
    position: relative;
}

.modern-select {
    width: 100%;
    padding: var(--space-md) var(--space-lg);
    padding-right: 2.5rem;
    border: 2px solid var(--border-secondary);
    border-radius: var(--radius-lg);
    font-size: 0.95rem;
    font-weight: 500;
    transition: all var(--transition-normal);
    background: var(--bg-primary);
    color: var(--text-primary);
    appearance: none;
    cursor: pointer;
}

.modern-select:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-1px);
}

.select-arrow {
    position: absolute;
    right: var(--space-md);
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    pointer-events: none;
    transition: all var(--transition-normal);
}

.modern-select:focus + .select-arrow {
    color: var(--stellantis-primary);
    transform: translateY(-50%) rotate(180deg);
}

/* Multi-Select */
.multi-select-wrapper {
    position: relative;
}

.modern-multi-select {
    width: 100%;
    height: 120px;
    padding: var(--space-md);
    border: 2px solid var(--border-secondary);
    border-radius: var(--radius-lg);
    font-size: 0.9rem;
    font-weight: 500;
    transition: all var(--transition-normal);
    background: var(--bg-primary);
    color: var(--text-primary);
    resize: none;
}

.modern-multi-select:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
}

.modern-multi-select option {
    padding: var(--space-sm);
    background: var(--bg-primary);
    color: var(--text-primary);
}

.modern-multi-select option:checked {
    background: var(--primary-gradient);
    color: white;
}

.multi-select-help {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    margin-top: var(--space-sm);
    padding: var(--space-sm) var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-md);
    font-size: 0.75rem;
    color: var(--text-secondary);
}

.multi-select-help kbd {
    background: var(--bg-tertiary);
    color: var(--text-primary);
    padding: 0.1rem 0.25rem;
    border-radius: 0.2rem;
    font-size: 0.7rem;
    font-weight: 600;
    border: 1px solid var(--border-secondary);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: var(--space-lg);
    margin-top: var(--space-xl);
    padding-top: var(--space-lg);
    border-top: 1px solid var(--border-secondary);
    justify-content: center;
}

.btn-create {
    background: var(--success-gradient);
    border: none;
    color: white;
    font-weight: 700;
    font-size: 1rem;
    padding: var(--space-md) var(--space-2xl);
    border-radius: var(--radius-lg);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    transition: all var(--transition-normal);
    box-shadow: var(--shadow-md);
    position: relative;
    overflow: hidden;
}

.btn-create::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.5s ease;
}

.btn-create:hover {
    transform: translateY(-2px) scale(1.02);
    box-shadow: var(--shadow-lg);
    color: white;
    text-decoration: none;
}

.btn-create:hover::before {
    left: 100%;
}

.btn-loader {
    display: none;
}

.btn-create.loading .btn-text {
    opacity: 0;
}

.btn-create.loading .btn-loader {
    display: block;
    position: absolute;
}

.btn-cancel {
    background: transparent;
    border: 2px solid var(--border-primary);
    color: var(--text-secondary);
    font-weight: 600;
    font-size: 0.95rem;
    padding: var(--space-md) var(--space-xl);
    border-radius: var(--radius-lg);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: var(--space-sm);
    transition: all var(--transition-normal);
    backdrop-filter: blur(10px);
}

.btn-cancel:hover {
    background: var(--primary-gradient);
    color: white;
    border-color: transparent;
    transform: translateY(-1px);
    text-decoration: none;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .form-grid {
        grid-template-columns: 1fr 1fr;
        gap: var(--space-lg);
    }
    
    .team-members-group {
        grid-column: span 2;
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
    
    .card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-sm);
    }
    
    .card-body {
        padding: var(--space-lg);
    }
    
    .form-grid {
        grid-template-columns: 1fr;
        gap: var(--space-md);
    }
    
    .team-members-group {
        grid-column: span 1;
    }
    
    .form-actions {
        flex-direction: column;
        align-items: center;
    }
    
    .btn-create,
    .btn-cancel {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .multi-select-help {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-xs);
    }
}

@media (max-width: 576px) {
    .page-title {
        font-size: 1.6rem;
    }
    
    .card-header,
    .card-body {
        padding: var(--space-md);
    }
    
    .modern-input,
    .modern-select {
        padding: var(--space-sm) var(--space-md);
    }
    
    .modern-multi-select {
        height: 100px;
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

.form-card {
    animation: fadeInUp 0.5s ease-out;
}

/* Focus States for Accessibility */
.btn-create:focus,
.btn-cancel:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}

.modern-input:focus,
.modern-select:focus,
.modern-multi-select:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('projectForm');
    const submitBtn = document.querySelector('.btn-create');
    
    // Enhanced form submission with loading state
    form.addEventListener('submit', function(e) {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
        
        // Re-enable if form validation fails
        setTimeout(() => {
            if (!form.checkValidity()) {
                submitBtn.classList.remove('loading');
                submitBtn.disabled = false;
            }
        }, 100);
    });
    
    // Enhanced form validation
    const inputs = form.querySelectorAll('input[required], select[required]');
    inputs.forEach(input => {
        input.addEventListener('blur', function() {
            if (!this.value.trim()) {
                this.style.borderColor = '#dc2626';
                this.style.boxShadow = '0 0 0 3px rgba(220, 38, 38, 0.1)';
            } else {
                this.style.borderColor = '';
                this.style.boxShadow = '';
            }
        });
        
        input.addEventListener('input', function() {
            if (this.value.trim()) {
                this.style.borderColor = '#059669';
                this.style.boxShadow = '0 0 0 3px rgba(5, 150, 105, 0.1)';
            }
        });
    });
    
    // Multi-select enhancement
    const multiSelect = document.getElementById('team_members');
    if (multiSelect) {
        multiSelect.addEventListener('change', function() {
            const selectedCount = this.selectedOptions.length;
            const helpText = this.parentNode.querySelector('.multi-select-help span');
            
            if (selectedCount > 0) {
                helpText.innerHTML = `${selectedCount} member${selectedCount > 1 ? 's' : ''} selected. Hold <kbd>Ctrl</kbd> (Windows) or <kbd>⌘</kbd> (Mac) to select more.`;
            } else {
                helpText.innerHTML = 'Hold <kbd>Ctrl</kbd> (Windows) or <kbd>⌘</kbd> (Mac) to select multiple members';
            }
        });
    }
    
    // Auto-focus first input
    const firstInput = document.getElementById('project_name');
    if (firstInput) {
        setTimeout(() => firstInput.focus(), 300);
    }
    
    // Enhanced button interactions
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            if (this.classList.contains('btn-create') || this.classList.contains('btn-cancel')) {
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
            }
        });
    });
    
    // Form auto-save to localStorage (optional)
    const formInputs = form.querySelectorAll('input, select');
    formInputs.forEach(input => {
        // Load saved values
        const savedValue = localStorage.getItem(`form_${input.name}`);
        if (savedValue && !input.value) {
            if (input.type === 'checkbox') {
                input.checked = savedValue === 'true';
            } else {
                input.value = savedValue;
            }
        }
        
        // Save values on change
        input.addEventListener('change', function() {
            if (this.type === 'checkbox') {
                localStorage.setItem(`form_${this.name}`, this.checked);
            } else {
                localStorage.setItem(`form_${this.name}`, this.value);
            }
        });
    });
    
    // Clear saved form data on successful submission
    form.addEventListener('submit', function() {
        formInputs.forEach(input => {
            localStorage.removeItem(`form_${input.name}`);
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