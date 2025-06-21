@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <div>
                <h3 class="mb-0">
                    <i class="fas fa-user-circle me-2"></i>
                    User Profile
                </h3>
                <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                    Manage your account information and security
                </p>
            </div>
        </div>

        <div class="card-body" style="padding: var(--space-xl);">
            <!-- Personal Information Section -->
            <div class="fade-in" style="animation-delay: 0.1s;">
                <h4 style="font-weight: 600; color: var(--gray-700); margin-bottom: var(--space-lg); display: flex; align-items: center; gap: var(--space-sm);">
                    <i class="fas fa-info-circle" style="color: var(--stellantis-primary);"></i>
                    Personal Information
                </h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div style="margin-bottom: var(--space-lg);">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-user" style="color: var(--stellantis-primary);"></i>
                                Name
                            </label>
                            <div>
                                <input type="text" 
                                       class="form-control" 
                                       value="{{ $user->name }}" 
                                       readonly
                                       style="background: rgba(255, 255, 255, 0.5); cursor: not-allowed; padding: var(--space-md) var(--space-lg);">
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div style="margin-bottom: var(--space-lg);">
                            <label class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                <i class="fas fa-envelope" style="color: var(--stellantis-primary);"></i>
                                Email
                            </label>
                            <div>
                                <input type="email" 
                                       class="form-control" 
                                       value="{{ $user->email }}" 
                                       readonly
                                       style="background: rgba(255, 255, 255, 0.5); cursor: not-allowed; padding: var(--space-md) var(--space-lg);">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="alert alert-info" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-md);">
                    <i class="fas fa-info-circle" style="font-size: 1.5rem; color: #1e40af;"></i>
                    <div>
                        <p class="mb-0">Contact administrator to update your personal information.</p>
                    </div>
                </div>
            </div>

            <hr style="border: none; height: 1px; background: rgba(255, 255, 255, 0.2); margin: var(--space-xl) 0;">

            <!-- Password Change Section -->
            <div class="fade-in" style="animation-delay: 0.3s;">
                <h4 style="font-weight: 600; color: var(--gray-700); margin-bottom: var(--space-lg); display: flex; align-items: center; gap: var(--space-sm);">
                    <i class="fas fa-key" style="color: var(--stellantis-primary);"></i>
                    Change Password
                </h4>
                
                @if(session('success'))
                    <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-md);">
                        <i class="fas fa-check-circle" style="font-size: 1.5rem; color: #10b981;"></i>
                        <div>
                            <p class="mb-0">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger" style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl);">
                        <h6 style="font-weight: 600; display: flex; align-items: center; gap: var(--space-sm); margin-bottom: var(--space-md);">
                            <i class="fas fa-exclamation-triangle" style="color: #dc2626;"></i>
                            Please fix the following errors:
                        </h6>
                        <ul style="margin-bottom: 0; padding-left: var(--space-xl);">
                            @foreach($errors->all() as $error)
                                <li style="margin-bottom: var(--space-sm);">{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update-password') }}">
                    @csrf
                    
                    <div style="margin-bottom: var(--space-lg);">
                        <label for="current_password" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-lock" style="color: var(--stellantis-primary);"></i>
                            Current Password
                        </label>
                        <div style="position: relative;">
                            <input type="password" 
                                   class="form-control" 
                                   id="current_password" 
                                   name="current_password" 
                                   required
                                   placeholder="Enter current password"
                                   style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-md);">
                            <span class="toggle-password" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <div style="margin-bottom: var(--space-lg);">
                        <label for="new_password" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-key" style="color: var(--stellantis-primary);"></i>
                            New Password
                        </label>
                        <div style="position: relative;">
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password" 
                                   name="new_password" 
                                   required
                                   placeholder="Enter new password"
                                   style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-md);">
                            <span class="toggle-password" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div style="margin-top: var(--space-sm); font-size: 0.8rem; color: var(--gray-500);">
                            Minimum 8 characters with at least one uppercase, one lowercase, one number and one special character
                        </div>
                        
                        <!-- Password Strength Meter -->
                        <div id="password-strength" style="margin-top: var(--space-md); height: 4px; border-radius: var(--radius-full); background: var(--gray-200); overflow: hidden;">
                            <div id="password-strength-bar" style="height: 100%; width: 0%; transition: width 0.3s ease;"></div>
                        </div>
                        <div id="password-strength-text" style="margin-top: var(--space-sm); font-size: 0.8rem; font-weight: 500;"></div>
                    </div>

                    <div style="margin-bottom: var(--space-xl);">
                        <label for="new_password_confirmation" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-check-circle" style="color: var(--stellantis-primary);"></i>
                            Confirm New Password
                        </label>
                        <div style="position: relative;">
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   required
                                   placeholder="Confirm new password"
                                   style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-md);">
                            <span class="toggle-password" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div id="password-match" style="margin-top: var(--space-sm); font-size: 0.8rem; font-weight: 500; display: none;">
                            <i class="fas fa-check-circle" style="color: #10b981;"></i> Passwords match
                        </div>
                        <div id="password-mismatch" style="margin-top: var(--space-sm); font-size: 0.8rem; font-weight: 500; display: none;">
                            <i class="fas fa-times-circle" style="color: #ef4444;"></i> Passwords do not match
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" id="update-password-btn">
                        <i class="fas fa-save me-2"></i>Update Password
                    </button>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left me-2"></i>Retour au tableau de bord
                    </a>
                </form>
            </div>
            
            <!-- Security Section -->
            <div class="fade-in" style="animation-delay: 0.5s; margin-top: var(--space-2xl);">
                <h4 style="font-weight: 600; color: var(--gray-700); margin-bottom: var(--space-lg); display: flex; align-items: center; gap: var(--space-sm);">
                    <i class="fas fa-shield-alt" style="color: var(--stellantis-primary);"></i>
                    Security Recommendations
                </h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div style="background: rgba(255, 255, 255, 0.5); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg); border: 1px solid rgba(255, 255, 255, 0.3);">
                            <div style="display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-md);">
                                <div style="width: 40px; height: 40px; border-radius: var(--radius-full); background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-fingerprint" style="color: var(--stellantis-primary); font-size: 1.25rem;"></i>
                                </div>
                                <h5 style="margin: 0; font-weight: 600;">Use Strong Passwords</h5>
                            </div>
                            <p style="margin: 0; color: var(--gray-600);">
                                Create unique passwords for all your accounts. Use a mix of letters, numbers, and symbols.
                            </p>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div style="background: rgba(255, 255, 255, 0.5); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-lg); border: 1px solid rgba(255, 255, 255, 0.3);">
                            <div style="display: flex; align-items: center; gap: var(--space-md); margin-bottom: var(--space-md);">
                                <div style="width: 40px; height: 40px; border-radius: var(--radius-full); background: rgba(59, 130, 246, 0.1); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-sync-alt" style="color: var(--stellantis-primary); font-size: 1.25rem;"></i>
                                </div>
                                <h5 style="margin: 0; font-weight: 600;">Regular Updates</h5>
                            </div>
                            <p style="margin: 0; color: var(--gray-600);">
                                Change your password regularly, at least every 90 days, to maintain account security.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(function(el) {
            el.addEventListener('click', function() {
                const input = this.parentElement.querySelector('input');
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });

        // Password strength indicator
        const passwordInput = document.getElementById('new_password');
        const strengthBar = document.getElementById('password-strength-bar');
        const strengthText = document.getElementById('password-strength-text');
        
        if (passwordInput) {
            passwordInput.addEventListener('input', function() {
                const password = this.value;
                let strength = 0;
                let message = '';
                
                // Calculate password strength
                if (password.length >= 8) strength += 20;
                if (password.match(/[a-z]+/)) strength += 20;
                if (password.match(/[A-Z]+/)) strength += 20;
                if (password.match(/[0-9]+/)) strength += 20;
                if (password.match(/[^a-zA-Z0-9]+/)) strength += 20;
                
                // Update strength bar
                strengthBar.style.width = strength + '%';
                
                // Set color based on strength
                if (strength <= 20) {
                    strengthBar.style.background = '#ef4444'; // Red
                    message = 'Very Weak';
                } else if (strength <= 40) {
                    strengthBar.style.background = '#f59e0b'; // Orange
                    message = 'Weak';
                } else if (strength <= 60) {
                    strengthBar.style.background = '#fbbf24'; // Yellow
                    message = 'Medium';
                } else if (strength <= 80) {
                    strengthBar.style.background = '#10b981'; // Green
                    message = 'Strong';
                } else {
                    strengthBar.style.background = 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)'; // Blue gradient
                    message = 'Very Strong';
                }
                
                strengthText.textContent = message ? message + ' Password' : '';
                strengthText.style.color = strengthBar.style.background;
            });
        }
        
        // Password match indicator
        const confirmInput = document.getElementById('new_password_confirmation');
        const matchIndicator = document.getElementById('password-match');
        const mismatchIndicator = document.getElementById('password-mismatch');
        
        if (confirmInput && passwordInput) {
            function checkPasswordMatch() {
                const password = passwordInput.value;
                const confirm = confirmInput.value;
                
                if (confirm.length === 0) {
                    matchIndicator.style.display = 'none';
                    mismatchIndicator.style.display = 'none';
                } else if (password === confirm) {
                    matchIndicator.style.display = 'block';
                    mismatchIndicator.style.display = 'none';
                } else {
                    matchIndicator.style.display = 'none';
                    mismatchIndicator.style.display = 'block';
                }
            }
            
            confirmInput.addEventListener('input', checkPasswordMatch);
            passwordInput.addEventListener('input', checkPasswordMatch);
        }
        
        // Form validation with animation
        const form = document.querySelector('form');
        const updateBtn = document.getElementById('update-password-btn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredInputs = form.querySelectorAll('input[required]');
                
                requiredInputs.forEach(input => {
                    if (input.value.trim() === '') {
                        isValid = false;
                        input.style.borderColor = '#ef4444';
                        input.style.background = 'rgba(239, 68, 68, 0.05)';
                        
                        // Add shake animation
                        input.classList.add('shake-animation');
                        setTimeout(() => {
                            input.classList.remove('shake-animation');
                        }, 500);
                    }
                });
                
                // Check if passwords match
                const password = passwordInput.value;
                const confirm = confirmInput.value;
                
                if (password !== confirm) {
                    isValid = false;
                    confirmInput.style.borderColor = '#ef4444';
                    confirmInput.style.background = 'rgba(239, 68, 68, 0.05)';
                    
                    // Add shake animation
                    confirmInput.classList.add('shake-animation');
                    setTimeout(() => {
                        confirmInput.classList.remove('shake-animation');
                    }, 500);
                }
                
                if (!isValid) {
                    e.preventDefault();
                } else {
                    // Show loading state
                    updateBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Updating...';
                    updateBtn.disabled = true;
                }
            });
        }
        
        // Focus effects for inputs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            if (!input.readOnly) {
                input.addEventListener('focus', function() {
                    this.style.boxShadow = '0 0 0 4px rgba(102, 126, 234, 0.1)';
                    this.style.borderColor = '#667eea';
                });
                
                input.addEventListener('blur', function() {
                    this.style.boxShadow = 'none';
                    
                    if (this.hasAttribute('required') && this.value.trim() === '') {
                        this.style.borderColor = '#ef4444';
                        this.style.background = 'rgba(239, 68, 68, 0.05)';
                    } else {
                        this.style.borderColor = '#e2e8f0';
                        this.style.background = 'rgba(255, 255, 255, 0.9)';
                    }
                });
            }
        });
    });
</script>
@endsection