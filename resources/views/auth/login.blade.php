@extends('layouts.app')

@section('content')
<div class="login-container" style="min-height: 100vh; display: flex; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
    <!-- Left Side - Stellantis Logo -->
    <div style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; position: relative; overflow: hidden;">
        <div style="text-align: center; z-index: 2; color: white;">
            <!-- Stellantis Logo Image -->
            <div class="logo-container" style="width: 200px; height: 200px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 2rem; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); border: 4px solid rgba(255, 255, 255, 0.2);">
                <img src="images/logo.png" 
                     alt="Stellantis Logo" 
                     style="width: 160px; height: auto; object-fit: contain;">
            </div>
            
            <h2 class="slide-in-text" style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; text-shadow: 0 2px 4px rgba(0,0,0,0.3);">
                Welcome Back
            </h2>
            <p class="slide-in-text" style="font-size: 1.2rem; opacity: 0.9; line-height: 1.6; max-width: 400px; margin: 0 auto 2rem; animation-delay: 0.2s;">
                Driving innovation forward with cutting-edge project management solutions
            </p>
            
            <!-- Brand Features -->
            <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                <div class="slide-in-feature" style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.1); padding: 1rem 2rem; border-radius: 50px; backdrop-filter: blur(10px); animation-delay: 0.4s;">
                    <i class="fas fa-shield-alt" style="color: #3b82f6;"></i>
                    <span>Secure & Reliable</span>
                </div>
                <div class="slide-in-feature" style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.1); padding: 1rem 2rem; border-radius: 50px; backdrop-filter: blur(10px); animation-delay: 0.6s;">
                    <i class="fas fa-globe-americas" style="color: #3b82f6;"></i>
                    <span>Global Network</span>
                </div>
            </div>
        </div>
        
        <!-- Animated Background Elements -->
        <div style="position: absolute; top: 10%; left: 10%; width: 100px; height: 100px; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 50%; animation: rotate 20s linear infinite;"></div>
        <div style="position: absolute; bottom: 20%; right: 15%; width: 60px; height: 60px; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 50%; animation: rotate 15s linear infinite reverse;"></div>
    </div>

    <!-- Right Side - Login Form -->
    <div class="login-right-side" style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; background: white; transition: background-color var(--transition-normal);">
        <div class="form-container" style="width: 100%; max-width: 400px;">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h3 style="font-size: 1.8rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem; transition: color var(--transition-normal);">
                    Sign In
                </h3>
                <p style="color: #6b7280; font-size: 0.95rem; transition: color var(--transition-normal);">
                    Access your Stellantis dashboard
                </p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div style="margin-bottom: 1.5rem;">
                    <label for="usercode" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem; transition: color var(--transition-normal);">
                        User Code
                    </label>
                    <input id="usercode" type="text"
                        class="form-control @error('usercode') is-invalid @enderror"
                        name="usercode" value="{{ old('usercode') }}"
                        required autocomplete="usercode" autofocus
                        placeholder="Enter your user code"
                        style="width: 100%; padding: 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-normal);">
                    @error('usercode')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label for="password" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.9rem; transition: color var(--transition-normal);">
                        Password
                    </label>
                    <div style="position: relative;">
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            name="password" required autocomplete="current-password"
                            placeholder="Enter your password"
                            style="width: 100%; padding: 0.75rem 3rem 0.75rem 1rem; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 0.95rem; transition: all var(--transition-normal);">
                        <span class="toggle-password" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af;">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    @error('password')
                        <div style="color: #ef4444; font-size: 0.85rem; margin-top: 0.25rem;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; color: #6b7280; transition: color var(--transition-normal);">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}
                            style="accent-color: #2563eb;">
                        Remember me
                    </label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="color: #2563eb; text-decoration: none; font-size: 0.9rem; font-weight: 500; transition: color var(--transition-normal);">
                            Forgot password?
                        </a>
                    @endif
                </div>

                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); color: white; border: none; padding: 0.875rem; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-bottom: 1.5rem;">
                    Sign In
                </button>

                <div style="text-align: center;">
                    <span style="color: #6b7280; font-size: 0.9rem; transition: color var(--transition-normal);">Don't have an account? </span>
                    <a href="{{ route('register') }}" style="color: #2563eb; text-decoration: none; font-weight: 600; transition: color var(--transition-normal);">
                        Create one
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
@keyframes rotate {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes slideUpLogo {
    0% {
        transform: translateY(100px);
        opacity: 0;
        scale: 0.8;
    }
    50% {
        transform: translateY(-10px);
        opacity: 0.8;
        scale: 1.05;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
        scale: 1;
    }
}

@keyframes slideInText {
    0% {
        transform: translateY(30px);
        opacity: 0;
    }
    100% {
        transform: translateY(0);
        opacity: 1;
    }
}

@keyframes slideInFeature {
    0% {
        transform: translateX(-50px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideInForm {
    0% {
        transform: translateX(50px);
        opacity: 0;
    }
    100% {
        transform: translateX(0);
        opacity: 1;
    }
}

.logo-container {
    animation: slideUpLogo 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
}

.slide-in-text {
    animation: slideInText 0.8s ease-out forwards;
    opacity: 0;
}

.slide-in-feature {
    animation: slideInFeature 0.6s ease-out forwards;
    opacity: 0;
}

.form-container {
    animation: slideInForm 0.8s ease-out forwards;
    animation-delay: 0.3s;
    opacity: 0;
}

/* Hover effect for logo */
.logo-container:hover {
    transform: scale(1.05) rotate(5deg);
    transition: all 0.3s ease;
}

.logo-container:hover img {
    transform: scale(1.1);
    transition: all 0.3s ease;
}

/* Dark mode specific styles will be applied via JavaScript */
html[data-theme="dark"] .login-right-side {
    background-color: var(--bg-color) !important;
}

html[data-theme="dark"] .login-right-side h3 {
    color: var(--text-color) !important;
}

html[data-theme="dark"] .login-right-side p,
html[data-theme="dark"] .login-right-side label,
html[data-theme="dark"] .login-right-side span {
    color: var(--text-secondary) !important;
}

html[data-theme="dark"] .login-right-side input {
    background-color: var(--bg-secondary) !important;
    border-color: var(--border-color) !important;
    color: var(--text-color) !important;
}

html[data-theme="dark"] .login-right-side a {
    color: var(--primary-color) !important;
}

html[data-theme="dark"] .toggle-password {
    color: var(--text-muted) !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    // Apply dark mode if it's already set
    const currentTheme = localStorage.getItem('theme') || 
                        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    if (currentTheme === 'dark') {
        const rightSide = document.querySelector('.login-right-side');
        if (rightSide) {
            rightSide.style.backgroundColor = 'var(--bg-color)';
            
            // Update text colors
            const headings = rightSide.querySelectorAll('h3, p, label, span:not(.toggle-password i)');
            headings.forEach(el => {
                if (el.tagName === 'H3') {
                    el.style.color = 'var(--text-color)';
                } else {
                    el.style.color = 'var(--text-secondary)';
                }
            });
            
            // Update form controls
            const inputs = rightSide.querySelectorAll('input');
            inputs.forEach(input => {
                input.style.backgroundColor = 'var(--bg-secondary)';
                input.style.borderColor = 'var(--border-color)';
                input.style.color = 'var(--text-color)';
            });
            
            // Update toggle password icon
            const toggleIcon = rightSide.querySelector('.toggle-password');
            if (toggleIcon) {
                toggleIcon.style.color = 'var(--text-muted)';
            }
            
            // Update links
            const links = rightSide.querySelectorAll('a');
            links.forEach(link => {
                link.style.color = 'var(--primary-color)';
            });
        }
    }
});
</script>
@endsection