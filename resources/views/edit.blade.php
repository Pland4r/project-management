@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-edit me-2"></i>
                    Modifier le projet : {{ $project->project_name }}
                </h3>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    Référence: <strong>{{ $project->reference }}</strong>
                </p>
            </div>
        </div>
        
        <div class="card-body" style="padding: var(--space-xl);">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h6><i class="fas fa-exclamation-triangle me-2"></i>Erreurs de validation :</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('projects.update', $project->id) }}" method="POST" class="fade-in">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-project-diagram" style="color: var(--stellantis-primary);"></i>
                                Nom du projet
                            </label>
                            <input type="text" name="project_name" class="form-control" value="{{ old('project_name', $project->project_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-tag" style="color: var(--stellantis-primary);"></i>
                                Type
                            </label>
                            <select name="type" id="type" class="form-select">
                                <option value="essai" {{ $project->type == 'essai' ? 'selected' : '' }}>Essai</option>
                                <option value="messure" {{ $project->type == 'messure' ? 'selected' : '' }}>Mesure</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-flask" style="color: var(--stellantis-primary);"></i>
                                Nom de l'essai
                            </label>
                            <input type="text" name="essai_messure_name" class="form-control" value="{{ old('essai_messure_name', $project->essai_messure_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-user" style="color: var(--stellantis-primary);"></i>
                                Nom personne
                            </label>
                            <input type="text" name="person_name" class="form-control" value="{{ old('person_name', $project->person_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-calendar-alt" style="color: var(--stellantis-primary);"></i>
                                Date début
                            </label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $project->start_date) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-user-check" style="color: var(--stellantis-primary);"></i>
                                Validateur
                            </label>
                            <input type="text" name="validator_name" class="form-control" value="{{ old('validator_name', $project->validator_name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-calendar-check" style="color: var(--stellantis-primary);"></i>
                                Date fin
                            </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date', $project->end_date) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-traffic-light" style="color: var(--stellantis-primary);"></i>
                                État
                            </label>
                            <select name="etat" id="etat" class="form-select">
                                <option value="pending" {{ $project->etat === 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="in_progress" {{ $project->etat === 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ $project->etat === 'completed' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-stamp" style="color: var(--stellantis-primary);"></i>
                                Contre Marque
                            </label>
                            <input type="text" name="contreMarque" class="form-control" value="{{ old('contreMarque', $project->contreMarque) }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-comments" style="color: var(--stellantis-primary);"></i>
                                Commentaire
                            </label>
                            <textarea name="commentaire" class="form-control" rows="2" required>{{ old('commentaire', $project->commentaire) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-exclamation-triangle" style="color: var(--stellantis-primary);"></i>
                                Issues
                            </label>
                            <textarea name="issues" class="form-control" rows="2">{{ old('issues', $project->issues) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-4 d-flex gap-3">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Mettre à jour
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation feedback with modern styling
    const form = document.querySelector('form');
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    
    inputs.forEach(input => {
        // Add focus effects
        input.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 4px rgba(102, 126, 234, 0.1)';
            this.style.borderColor = '#667eea';
        });
        
        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
            
            if (this.value.trim() === '') {
                this.style.borderColor = '#ef4444';
                this.style.background = 'rgba(239, 68, 68, 0.05)';
                
                // Add shake animation for empty required fields
                this.classList.add('shake-animation');
                setTimeout(() => {
                    this.classList.remove('shake-animation');
                }, 500);
            } else {
                this.style.borderColor = '#10b981';
                this.style.background = 'rgba(16, 185, 129, 0.05)';
            }
        });
        
        input.addEventListener('input', function() {
            this.style.borderColor = '#e2e8f0';
            this.style.background = 'rgba(255, 255, 255, 0.9)';
        });
    });
    
    // Add this style for the shake animation
    const style = document.createElement('style');
    style.textContent = `
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        .shake-animation {
            animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }
    `;
    document.head.appendChild(style);
    
    // Date validation
    const startDate = document.querySelector('#start_date');
    const endDate = document.querySelector('#end_date');
    
    function validateDates() {
        if (startDate.value && endDate.value) {
            if (new Date(endDate.value) < new Date(startDate.value)) {
                endDate.setCustomValidity('La date de fin doit être postérieure à la date de début');
                endDate.style.borderColor = '#ef4444';
                endDate.style.background = 'rgba(239, 68, 68, 0.05)';
            } else {
                endDate.setCustomValidity('');
                endDate.style.borderColor = '#10b981';
                endDate.style.background = 'rgba(16, 185, 129, 0.05)';
            }
        }
    }
    
    startDate.addEventListener('change', validateDates);
    endDate.addEventListener('change', validateDates);
    
    // Initial validation
    validateDates();
});
</script>
@endsection