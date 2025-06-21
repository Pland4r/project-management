@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 500px;">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center;">
                    <h3 class="mb-0">
                        <i class="fas fa-key me-2"></i>
                        {{ __('Reset Password') }}
                    </h3>
                    <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                        Enter your email to receive a reset link
                    </p>
                </div>
            </div>

            <div class="card-body" style="padding: var(--space-xl);">
                @if (session('status'))
                    <div class="alert alert-success" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-md);">
                        <i class="fas fa-check-circle" style="font-size: 1.5rem; color: #3b82f6; flex-shrink: 0;"></i>
                        <div>
                            <p class="mb-0">{{ session('status') }}</p>
                        </div>
                    </div>
                @endif

                <div style="text-align: center; margin-bottom: var(--space-xl);">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-lg);">
                        <i class="fas fa-envelope" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4 style="color: var(--gray-700); margin-bottom: var(--space-md);">Forgot Your Password?</h4>
                    <p style="color: var(--gray-600); line-height: 1.6;">
                        No problem. Just let us know your email address and we will email you a password reset link.
                    </p>
                </div>

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div style="margin-bottom: var(--space-lg);">
                        <label for="email" class="form-label" style="font-weight: 600; margin-bottom: var(--space-sm); display: flex; align-items: center; gap: var(--space-sm);">
                            <i class="fas fa-envelope" style="color: #2563eb;"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input id="email" type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}"
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

                    <div style="margin-bottom: var(--space-lg);">
                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: var(--space-lg);">
                            <i class="fas fa-paper-plane me-2"></i>
                            {{ __('Send Password Reset Link') }}
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
