@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center;">
                    <h3 class="mb-0">
                        <i class="fas fa-envelope-open me-2"></i>
                        {{ __('Verify Your Email Address') }}
                    </h3>
                    <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                        Please check your email to complete registration
                    </p>
                </div>
            </div>

            <div class="card-body" style="padding: var(--space-xl);">
                @if (session('resent'))
                    <div class="alert alert-success" style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-md);">
                        <i class="fas fa-check-circle" style="font-size: 1.5rem; color: #10b981; flex-shrink: 0;"></i>
                        <div>
                            <p class="mb-0">{{ __('A fresh verification link has been sent to your email address.') }}</p>
                        </div>
                    </div>
                @endif

                <div style="text-align: center; margin-bottom: var(--space-xl);">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #059669 0%, #10b981 100%); border-radius: var(--radius-full); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-lg);">
                        <i class="fas fa-envelope" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4 style="color: var(--gray-700); margin-bottom: var(--space-md);">Check Your Email</h4>
                    <p style="color: var(--gray-600); line-height: 1.6;">
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                    </p>
                </div>

                <div style="background: rgba(255, 255, 255, 0.5); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); text-align: center;">
                    <p style="margin-bottom: var(--space-md); color: var(--gray-600);">
                        {{ __('If you did not receive the email') }}, you can request a new one below.
                    </p>
                    <form method="POST" action="{{ route('verification.resend') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary" style="width: 100%; max-width: 300px;">
                            <i class="fas fa-paper-plane me-2"></i>
                            {{ __('Resend Verification Email') }}
                        </button>
                    </form>
                </div>

                <div style="text-align: center;">
                    <a href="{{ route('login') }}" style="color: #059669; text-decoration: none; font-weight: 500; display: inline-flex; align-items: center; gap: var(--space-sm);">
                        <i class="fas fa-arrow-left"></i>
                        {{ __('Back to Login') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection