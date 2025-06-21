@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center;">
                    <h3 class="mb-0">
                        <i class="fas fa-lock-open me-2"></i>
                        {{ __('Reset Password') }}
                    </h3>
                    <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                        Create a new password for your account
                    </p>
                </div>
            </div>

            <div class="card-body" style="padding: var(--space-xl);">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">

                    <div style="margin-bottom: var(--space-lg);">
                        <label for="email" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-envelope" style="color: #2563eb;"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ $email ?? old('email') }}"
                            required autocomplete="email" autofocus
                            placeholder="Enter your email address"
                            style="padding: var(--space-md) var(--space-lg);">
                        @error('email')
                            <div class="invalid-feedback" style="display: block; margin-top: var(--space-sm); color: #ef4444;">
                                <i class="fas fa-exclamation-circle me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div style="margin-bottom: var(--space-lg);">
                                <label for="password" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                    <i class="fas fa-lock" style="color: #2563eb;"></i>
                                    {{ __('New Password') }}
                                </label>
                                <div style="position: relative;">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror"
                                        name="password" required autocomplete="new-password"
                                        placeholder="Create new password"
                                        style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-lg);">
                                    <span class="toggle-password" data-target="password" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
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
                        </div>

                        <div class="col-md-6">
                            <div style="margin-bottom: var(--space-lg);">
                                <label for="password-confirm" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                                    <i class="fas fa-check-circle" style="color: #2563eb;"></i>
                                    {{ __('Confirm Password') }}
                                </label>
                                <div style="position: relative;">
                                    <input id="password-confirm" type="password"
                                        class="form-control"
                                        name="password_confirmation" required autocomplete="new-password"
                                        placeholder="Confirm new password"
                                        style="padding: var(--space-md) var(--space-3xl) var(--space-md) var(--space-lg);">
                                    <span class="toggle-password" data-target="password-confirm" style="position: absolute; right: var(--space-lg); top: 50%; transform: translateY(-50%); cursor: pointer; color: var(--gray-500);">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: var(--space-lg);">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: var(--space-lg);">
                            <i class="fas fa-save me-2"></i>
                            {{ __('Reset Password') }}
                        </button>
                    </div>

                    <div style="text-align: center;">
                        <a href="{{ route('login') }}" style="color: #2563eb; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-arrow-left"></i>
                            {{ __('Back to Login') }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    document.querySelectorAll('.toggle-password').forEach(function(toggle) {
        toggle.addEventListener('click', function() {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
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
