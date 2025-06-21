@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 500px;">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center;">
                    <h3 class="mb-0">
                        <i class="fas fa-shield-alt me-2"></i>
                        {{ __('Confirm Password') }}
                    </h3>
                    <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                        Please confirm your password before continuing
                    </p>
                </div>
            </div>

            <div class="card-body" style="padding: var(--space-xl);">
                <div style="background: rgba(37, 99, 235, 0.1); border: 1px solid rgba(37, 99, 235, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); text-align: center;">
                    <i class="fas fa-info-circle" style="color: #2563eb; font-size: 1.5rem; margin-bottom: var(--space-sm);"></i>
                    <p style="margin: 0; color: #2563eb;">
                        {{ __('Please confirm your password before continuing.') }}
                    </p>
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div style="margin-bottom: var(--space-lg);">
                        <label for="password" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-lock" style="color: #2563eb;"></i>
                            {{ __('Password') }}
                        </label>
                        <div style="position: relative;">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password"
                                placeholder="Enter your password"
                                style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-lg);">
                            <span class="toggle-password" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div class="invalid-feedback" style="display: block; margin-top: var(--space-sm); color: #ef4444;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div style="margin-bottom: var(--space-lg);">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: var(--space-lg);">
                            <i class="fas fa-check me-2"></i>
                            {{ __('Confirm Password') }}
                        </button>
                    </div>

                    @if (Route::has('password.request'))
                        <div style="text-align: center;">
                            <a href="{{ route('password.request') }}" style="color: #2563eb; text-decoration: none; font-weight: 500;">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePassword = document.querySelector('.toggle-password');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const input = document.getElementById('password');
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
    }

    // Focus effects for inputs
    const inputs = document.querySelectorAll('.form-control');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 0 4px rgba(37, 99, 235, 0.1)';
            this.style.borderColor = '#2563eb';
        });
        
        input.addEventListener('blur', function() {
            this.style.boxShadow = 'none';
            this.style.borderColor = '#e2e8f0';
        });
    });
});
</script>
@endsection
