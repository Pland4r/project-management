@extends('layouts.app')
@section('content')
<div class="container py-4">
    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav mb-3 fade-in">
        <a href="{{ route('projects.index') }}" class="breadcrumb-link">
            <i class="fas fa-home"></i> Projects
        </a>
        <span>/</span>
        <a href="{{ route('essai_messures.show', $essaiMessure->id) }}" class="breadcrumb-link">
            {{ $essaiMessure->name }}
        </a>
        <span>/</span>
        <span class="breadcrumb-current">Edit</span>
    </nav>

    <!-- Header -->
    <div class="page-header slide-up">
        <div class="header-left">
            <div class="header-icon pulse-icon">
                <i class="fas fa-edit"></i>
            </div>
            <div class="header-info">
                <h1 class="page-title">Edit Essai/Messure</h1>
                <p class="page-subtitle">{{ $essaiMessure->name }}</p>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card slide-up delay-1">
        <form action="{{ route('essai_messures.update', $essaiMessure->id) }}" method="POST" class="compact-form">
            @csrf
            @method('PUT')
            
            <!-- Basic Info Section -->
            <div class="form-section animated-section">
                <h3 class="section-title">
                    <i class="fas fa-info-circle"></i>
                    Basic Information
                </h3>
                <div class="form-grid">
                    <div class="form-group animated-input">
                        <label for="type">Type *</label>
                        <select name="type" id="type" class="form-control hover-input" required>
                            <option value="essai" {{ $essaiMessure->type == 'essai' ? 'selected' : '' }}>Essai</option>
                            <option value="messure" {{ $essaiMessure->type == 'messure' ? 'selected' : '' }}>Messure</option>
                        </select>
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="name">Name *</label>
                        <input type="text" name="name" id="name" class="form-control hover-input" 
                               value="{{ old('name', $essaiMessure->name) }}" required>
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="etat">Status</label>
                        <select name="etat" id="etat" class="form-control hover-input">
                            <option value="pending" {{ $essaiMessure->etat == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="approved" {{ $essaiMessure->etat == 'approved' ? 'selected' : '' }}>Approved</option>
                            <option value="rejected" {{ $essaiMessure->etat == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>

            <!-- People Section -->
            <div class="form-section animated-section">
                <h3 class="section-title">
                    <i class="fas fa-users"></i>
                    People
                </h3>
                <div class="form-grid">
                    <div class="form-group animated-input">
                        <label for="person_name">Responsible Person</label>
                        <input type="text" name="person_name" id="person_name" class="form-control hover-input" 
                               value="{{ old('person_name', $essaiMessure->person_name) }}">
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="validator_name">Validator</label>
                        <input type="text" name="validator_name" id="validator_name" class="form-control hover-input" 
                               value="{{ old('validator_name', $essaiMessure->validator_name) }}">
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="editors">Editors (can edit this Essai/Messure)</label>
                        <select name="editors[]" id="editors" class="form-control hover-input" multiple>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ in_array($user->id, old('editors', $essaiMessure->editors->pluck('id')->toArray() ?? [])) ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Hold Ctrl (Windows) or Command (Mac) to select multiple users.</small>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Timeline Section -->
            <div class="form-section animated-section">
                <h3 class="section-title">
                    <i class="fas fa-calendar"></i>
                    Timeline
                </h3>
                <div class="form-grid">
                    <div class="form-group animated-input">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control hover-input" 
                               value="{{ old('start_date', $essaiMessure->start_date) }}">
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control hover-input" 
                               value="{{ old('end_date', $essaiMessure->end_date) }}">
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Additional Info Section -->
            <div class="form-section animated-section">
                <h3 class="section-title">
                    <i class="fas fa-comment"></i>
                    Additional Information
                </h3>
                <div class="form-grid">
                    <div class="form-group animated-input">
                        <label for="commentaire">Comments</label>
                        <textarea name="commentaire" id="commentaire" class="form-control hover-input" rows="3" 
                                  placeholder="Add any relevant comments...">{{ old('commentaire', $essaiMessure->commentaire) }}</textarea>
                        <div class="input-glow"></div>
                    </div>
                    <div class="form-group animated-input">
                        <label for="issues">Issues</label>
                        <textarea name="issues" id="issues" class="form-control hover-input" rows="3" 
                                  placeholder="Describe any issues...">{{ old('issues', $essaiMessure->issues) }}</textarea>
                        <div class="input-glow"></div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <button type="submit" class="btn btn-success hover-lift">
                    <i class="fas fa-save"></i> 
                    <span>Sauvegarder</span>
                    <div class="btn-shine"></div>
                    <div class="btn-ripple"></div>
                </button>
                <a href="{{ route('essai_messures.show', $essaiMessure->id) }}" class="btn btn-secondary hover-lift">
                    <i class="fas fa-times"></i> 
                    <span>Annuler</span>
                    <div class="btn-shine"></div>
                </a>
            </div>
        </form>
    </div>
</div>

<style>
/* Enhanced Form Animations */
.container {
    max-width: 900px;
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

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes shine {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

@keyframes ripple {
    0% { transform: scale(0); opacity: 1; }
    100% { transform: scale(4); opacity: 0; }
}

@keyframes inputGlow {
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

.pulse-icon {
    animation: pulse 2s ease-in-out infinite;
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
    align-items: center;
    margin-bottom: 2rem;
    padding: 1.5rem;
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--card-border);
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
    width: 50px;
    height: 50px;
    background: var(--warning-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.page-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.page-subtitle {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin: 0.25rem 0 0 0;
}

/* Form Card */
.form-card {
    background: var(--card-bg);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--card-border);
    padding: 2rem;
    transition: all 0.3s ease;
}

.form-card:hover {
    box-shadow: var(--shadow-md);
}

/* Form Sections */
.form-section {
    margin-bottom: 2rem;
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.6s ease-out forwards;
}

.form-section:nth-child(1) { animation-delay: 0.1s; }
.form-section:nth-child(2) { animation-delay: 0.2s; }
.form-section:nth-child(3) { animation-delay: 0.3s; }
.form-section:nth-child(4) { animation-delay: 0.4s; }

.form-section:last-of-type {
    margin-bottom: 0;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 1px solid var(--border-muted);
    transition: all 0.3s ease;
}

.section-title:hover {
    color: var(--stellantis-primary);
    transform: translateX(5px);
}

.section-title i {
    color: var(--stellantis-primary);
    transition: all 0.3s ease;
}

.section-title:hover i {
    transform: rotate(360deg);
}

/* Form Grid */
.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
}

.form-group {
    display: flex;
    flex-direction: column;
    position: relative;
}

.animated-input {
    opacity: 0;
    transform: translateY(15px);
    animation: slideUp 0.5s ease-out forwards;
}

.animated-input:nth-child(1) { animation-delay: 0.1s; }
.animated-input:nth-child(2) { animation-delay: 0.2s; }
.animated-input:nth-child(3) { animation-delay: 0.3s; }

.form-group label {
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.form-group:hover label {
    color: var(--stellantis-primary);
    transform: translateY(-2px);
}

.form-control {
    padding: 0.75rem;
    border: 2px solid var(--border-muted);
    border-radius: var(--radius-md);
    background: var(--bg-primary);
    color: var(--text-primary);
    font-size: 0.95rem;
    transition: all 0.3s ease;
    position: relative;
}

.hover-input:hover {
    border-color: var(--stellantis-primary);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
}

.form-control:focus {
    outline: none;
    border-color: var(--stellantis-primary);
    box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    transform: translateY(-2px);
}

.input-glow {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    border-radius: var(--radius-md);
    background: radial-gradient(circle, rgba(37, 99, 235, 0.1), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.form-control:focus + .input-glow {
    animation: inputGlow 2s ease-in-out infinite;
}

.form-control::placeholder {
    color: var(--text-muted);
    transition: color 0.3s ease;
}

.form-control:focus::placeholder {
    color: var(--stellantis-primary);
}

select.form-control {
    cursor: pointer;
}

textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: 1rem;
    justify-content: flex-end;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid var(--border-muted);
    opacity: 0;
    transform: translateY(20px);
    animation: slideUp 0.6s ease-out 0.5s forwards;
}

.btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.875rem 2rem;
    border-radius: var(--radius-lg);
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    border: none;
    cursor: pointer;
    font-size: 1rem;
    position: relative;
    overflow: hidden;
    min-width: 140px;
    justify-content: center;
}

.btn-success {
    background: var(--success-gradient);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-secondary {
    background: var(--bg-secondary);
    color: var(--text-secondary);
    border: 2px solid var(--border-muted);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.hover-lift:hover {
    transform: translateY(-4px) scale(1.02);
}

.btn-success:hover {
    background: var(--success-gradient);
    filter: brightness(1.1);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    color: white;
}

.btn-secondary:hover {
    background: var(--bg-tertiary);
    color: var(--text-primary);
    border-color: var(--stellantis-primary);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
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

.btn-ripple {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.6);
    transform: scale(0);
    pointer-events: none;
}

.btn:active .btn-ripple {
    animation: ripple 0.6s ease-out;
}

/* Responsive */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .page-header {
        text-align: center;
    }
    
    .btn {
        width: 100%;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Enhanced button click effects
    document.querySelectorAll('.btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            // Create ripple effect
            const ripple = document.createElement('div');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.width = ripple.style.height = size + 'px';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.classList.add('btn-ripple');
            
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    });

    // Form validation with animations
    const form = document.querySelector('.compact-form');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                field.style.borderColor = 'var(--danger-color)';
                field.style.animation = 'shake 0.5s ease-in-out';
                isValid = false;
                
                setTimeout(() => {
                    field.style.animation = '';
                    field.style.borderColor = 'var(--border-muted)';
                }, 500);
            }
        });
        
        if (!isValid) {
            e.preventDefault();
        }
    });

    // Date validation and logic
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    // Set min for start_date to today
    const today = new Date();
    const yyyy = today.getFullYear();
    const mm = String(today.getMonth() + 1).padStart(2, '0');
    const dd = String(today.getDate()).padStart(2, '0');
    const todayStr = `${yyyy}-${mm}-${dd}`;
    startDateInput.setAttribute('min', todayStr);

    startDateInput.addEventListener('change', function() {
        // If start_date is set, set end_date to next day and set min
        if (this.value) {
            const start = new Date(this.value);
            const nextDay = new Date(start);
            nextDay.setDate(start.getDate() + 1);
            const nY = nextDay.getFullYear();
            const nM = String(nextDay.getMonth() + 1).padStart(2, '0');
            const nD = String(nextDay.getDate()).padStart(2, '0');
            const nextDayStr = `${nY}-${nM}-${nD}`;
            endDateInput.value = nextDayStr;
            endDateInput.setAttribute('min', nextDayStr);
        } else {
            endDateInput.value = '';
            endDateInput.removeAttribute('min');
        }
    });

    endDateInput.addEventListener('change', function() {
        if (startDateInput.value && this.value < startDateInput.value) {
            startDateInput.value = this.value;
        }
        // Ensure end_date is not before next day after start_date
        if (startDateInput.value) {
            const start = new Date(startDateInput.value);
            const nextDay = new Date(start);
            nextDay.setDate(start.getDate() + 1);
            const nY = nextDay.getFullYear();
            const nM = String(nextDay.getMonth() + 1).padStart(2, '0');
            const nD = String(nextDay.getDate()).padStart(2, '0');
            const nextDayStr = `${nY}-${nM}-${nD}`;
            if (this.value < nextDayStr) {
                this.value = nextDayStr;
            }
            this.setAttribute('min', nextDayStr);
        }
    });
});

// Add shake animation
const style = document.createElement('style');
style.textContent = `
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
`;
document.head.appendChild(style);
</script>
@endsection
