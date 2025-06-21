@extends('layouts.app')

@section('content')
<div class="container" style="display: flex; justify-content: center; align-items: center; min-height: calc(100vh - 200px);">
    <div style="width: 100%; max-width: 600px;">
        <div class="card">
            <div class="card-header">
                <div style="text-align: center;">
                    <h3 class="mb-0">
                        <i class="fas fa-check-circle me-2" style="color: #3b82f6;"></i>
                        {{ __('Registration Successful') }}
                    </h3>
                    <p class="mb-0" style="opacity: 0.8; font-size: 0.9rem; margin-top: 0.5rem;">
                        Welcome to the Stellantis Project Hub!
                    </p>
                </div>
            </div>

            <div class="card-body" style="padding: var(--space-xl);">
                <div class="alert alert-success" style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl); display: flex; align-items: center; gap: var(--space-md);">
                    <i class="fas fa-user-check" style="font-size: 2rem; color: #3b82f6; flex-shrink: 0;"></i>
                    <div>
                        <h5 style="margin: 0; color: #3b82f6; font-weight: 600;">Account Created Successfully!</h5>
                        <p style="margin: 0; margin-top: var(--space-sm);">Your usercode is: <strong style="color: #2563eb; font-size: 1.1rem;">{{ Auth::user()->usercode }}</strong></p>
                    </div>
                </div>
                
                <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: var(--radius-xl); padding: var(--space-lg); margin-bottom: var(--space-xl);">
                    <h6 style="color: #1d4ed8; font-weight: 600; margin-bottom: var(--space-md); display: flex; align-items: center; gap: var(--space-sm);">
                        <i class="fas fa-info-circle"></i>
                        Important Information
                    </h6>
                    <ul style="margin: 0; padding-left: var(--space-lg); color: #1d4ed8;">
                        <li style="margin-bottom: var(--space-sm);">Please save your usercode for future logins</li>
                        <li style="margin-bottom: var(--space-sm);">You will need this usercode to access your account</li>
                        <li>Keep this information secure and confidential</li>
                    </ul>
                </div>

                <div style="text-align: center;">
                    <a href="{{ route('dashboard') }}" class="btn btn-primary" style="padding: var(--space-lg) var(--space-2xl); font-size: 1.1rem; width: 100%; max-width: 300px;">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Continue to Dashboard') }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
