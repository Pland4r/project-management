@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-plus-circle me-2"></i>
                    Créer un nouveau projet Stellantis
                </h3>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    Remplissez tous les champs pour créer un nouveau projet
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

            <form method="POST" action="{{ route('projects.store') }}" class="fade-in">
                @csrf

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-tag" style="color: var(--stellantis-primary);"></i>
                                Type de projet
                            </label>
                            <select name="type" class="form-select" required>
                                <option value="">Sélectionner un type</option>
                                <option value="essai" {{ old('type') == 'essai' ? 'selected' : '' }}>Essai</option>
                                <option value="messure" {{ old('type') == 'messure' ? 'selected' : '' }}>Mesure</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-project-diagram" style="color: var(--stellantis-primary);"></i>
                                Nom du projet
                            </label>
                            <input type="text" class="form-control" name="project_name" value="{{ old('project_name') }}" required placeholder="Entrez le nom du projet">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-flask" style="color: var(--stellantis-primary);"></i>
                                Nom de l'essai/mesure
                            </label>
                            <input type="text" class="form-control" name="essai_messure_name" value="{{ old('essai_messure_name') }}" required placeholder="Nom de l'essai ou mesure">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-user" style="color: var(--stellantis-primary);"></i>
                                Personne responsable
                            </label>
                            <input type="text" class="form-control" name="person_name" value="{{ old('person_name') }}" required placeholder="Nom du responsable">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-user-check" style="color: var(--stellantis-primary);"></i>
                                Nom du validateur
                            </label>
                            <input type="text" class="form-control" name="validator_name" value="{{ old('validator_name') }}" required placeholder="Nom du validateur">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-stamp" style="color: var(--stellantis-primary);"></i>
                                Contre Marque
                            </label>
                            <input type="text" class="form-control" name="contreMarque" value="{{ old('contreMarque') }}" required placeholder="Code contre marque">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-calendar-alt" style="color: var(--stellantis-primary);"></i>
                                Date de début
                            </label>
                            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ old('start_date') }}" min="{{ now()->toDateString() }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-calendar-check" style="color: var(--stellantis-primary);"></i>
                                Date de fin
                            </label>
                            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ old('end_date') }}" min="{{ now()->toDateString() }}" required>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-traffic-light" style="color: var(--stellantis-primary);"></i>
                                Statut
                            </label>
                            <select name="etat" class="form-select" required>
                                <option value="">Sélectionner un statut</option>
                                <option value="pending" {{ old('etat') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="in_progress" {{ old('etat') == 'in_progress' ? 'selected' : '' }}>En cours</option>
                                <option value="completed" {{ old('etat') == 'completed' ? 'selected' : '' }}>Terminé</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="mb-3">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-comments" style="color: var(--stellantis-primary);"></i>
                                Commentaires
                            </label>
                            <input type="text" class="form-control" name="commentaire" value="{{ old('commentaire') }}" required placeholder="Commentaires sur le projet">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="mb-4">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-exclamation-triangle" style="color: var(--stellantis-primary);"></i>
                                Issues (optionnel)
                            </label>
                            <textarea name="issues" class="form-control" rows="3" placeholder="Décrivez les problèmes ou issues rencontrés...">{{ old('issues') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-3">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save me-2"></i>Créer le projet
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-times me-2"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const startDate = document.getElementById('start_date');
    const endDate = document.getElementById('end_date');

    function updateEndMinDate() {
        endDate.min = startDate.value;
        if (endDate.value < startDate.value) {
            endDate.value = startDate.value;
        }
    }

    startDate.addEventListener('change', updateEndMinDate);
    updateEndMinDate();
    
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
});
</script>
@endsection