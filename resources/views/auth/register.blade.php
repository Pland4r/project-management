@extends('layouts.app')

@section('content')
<div class="register-container" style="min-height: 100vh; display: flex; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);">
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
                Join Stellantis
            </h2>
            <p class="slide-in-text" style="font-size: 1.2rem; opacity: 0.9; line-height: 1.6; max-width: 400px; margin: 0 auto 2rem; animation-delay: 0.2s;">
                Be part of our innovative community and drive the future of mobility
            </p>
            
            <!-- Brand Values -->
            <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center;">
                <div class="slide-in-feature" style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.1); padding: 0.75rem 1.5rem; border-radius: 50px; backdrop-filter: blur(10px); animation-delay: 0.4s;">
                    <i class="fas fa-leaf" style="color: #3b82f6;"></i>
                    <span style="font-size: 0.9rem;">Sustainable Future</span>
                </div>
                <div class="slide-in-feature" style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.1); padding: 0.75rem 1.5rem; border-radius: 50px; backdrop-filter: blur(10px); animation-delay: 0.6s;">
                    <i class="fas fa-rocket" style="color: #3b82f6;"></i>
                    <span style="font-size: 0.9rem;">Innovation First</span>
                </div>
                <div class="slide-in-feature" style="display: inline-flex; align-items: center; gap: 1rem; background: rgba(255, 255, 255, 0.1); padding: 0.75rem 1.5rem; border-radius: 50px; backdrop-filter: blur(10px); animation-delay: 0.8s;">
                    <i class="fas fa-users" style="color: #3b82f6;"></i>
                    <span style="font-size: 0.9rem;">Global Community</span>
                </div>
            </div>
        </div>
        
        <!-- Animated Background Elements -->
        <div style="position: absolute; top: 15%; left: 15%; width: 80px; height: 80px; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 50%; animation: rotate 25s linear infinite;"></div>
        <div style="position: absolute; bottom: 25%; right: 20%; width: 60px; height: 60px; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 50%; animation: rotate 20s linear infinite reverse;"></div>
        <div style="position: absolute; top: 60%; left: 5%; width: 40px; height: 40px; border: 2px solid rgba(255, 255, 255, 0.1); border-radius: 50%; animation: rotate 30s linear infinite;"></div>
    </div>

    <!-- Right Side - Register Form -->
    <div class="register-right-side" style="flex: 1; display: flex; align-items: center; justify-content: center; padding: 2rem; background: white; overflow-y: auto; transition: background-color var(--transition-normal);">
        <div class="form-container" style="width: 100%; max-width: 450px;">
            <div style="text-align: center; margin-bottom: 1.5rem;">
                <h3 style="font-size: 1.8rem; font-weight: 700; color: #1f2937; margin-bottom: 0.5rem; transition: color var(--transition-normal);">
                    Create Account
                </h3>
                <p style="color: #6b7280; font-size: 0.95rem; transition: color var(--transition-normal);">
                    Join the Stellantis community
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.25rem;">
                    <div>
                        <label for="name" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.85rem; transition: color var(--transition-normal);">
                            Full Name
                        </label>
                        <input id="name" type="text" 
                            class="form-control @error('name') is-invalid @enderror" 
                            name="name" value="{{ old('name') }}" 
                            required autocomplete="name" autofocus
                            placeholder="Your name"
                            style="width: 100%; padding: 0.625rem 0.75rem; border: 2px solid #e5e7eb; border-radius: 6px; font-size: 0.9rem; transition: all var(--transition-normal);">
                        @error('name')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="email" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.85rem; transition: color var(--transition-normal);">
                            Email Address
                        </label>
                        <input id="email" type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            name="email" value="{{ old('email') }}" 
                            required autocomplete="email"
                            placeholder="your@email.com"
                            style="width: 100%; padding: 0.625rem 0.75rem; border: 2px solid #e5e7eb; border-radius: 6px; font-size: 0.9rem; transition: all var(--transition-normal);">
                        @error('email')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label for="password" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.85rem; transition: color var(--transition-normal);">
                            Password
                        </label>
                        <div style="position: relative;">
                            <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" required autocomplete="new-password"
                                placeholder="Password"
                                style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.75rem; border: 2px solid #e5e7eb; border-radius: 6px; font-size: 0.9rem; transition: all var(--transition-normal);">
                            <span class="toggle-password" data-target="password" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; font-size: 0.85rem;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                        @error('password')
                            <div style="color: #ef4444; font-size: 0.8rem; margin-top: 0.25rem;">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="password-confirm" style="display: block; font-weight: 600; color: #374151; margin-bottom: 0.5rem; font-size: 0.85rem; transition: color var(--transition-normal);">
                            Confirm Password
                        </label>
                        <div style="position: relative;">
                            <input id="password-confirm" type="password" 
                                class="form-control" 
                                name="password_confirmation" required autocomplete="new-password"
                                placeholder="Confirm"
                                style="width: 100%; padding: 0.625rem 2.5rem 0.625rem 0.75rem; border: 2px solid #e5e7eb; border-radius: 6px; font-size: 0.9rem; transition: all var(--transition-normal);">
                            <span class="toggle-password" data-target="password-confirm" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); cursor: pointer; color: #9ca3af; font-size: 0.85rem;">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%); color: white; border: none; padding: 0.875rem; border-radius: 8px; font-size: 1rem; font-weight: 600; cursor: pointer; transition: all 0.2s; margin-bottom: 1.5rem;">
                    Create Account
                </button>

                <div style="text-align: center;">
                    <span style="color: #6b7280; font-size: 0.9rem; transition: color var(--transition-normal);">Already have an account? </span>
                    <a href="{{ route('login') }}" style="color: #2563eb; text-decoration: none; font-weight: 600; transition: color var(--transition-normal);">
                        Sign in
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
html[data-theme="dark"] .register-right-side {
    background-color: var(--bg-color) !important;
}

html[data-theme="dark"] .register-right-side h3 {
    color: var(--text-color) !important;
}

html[data-theme="dark"] .register-right-side p,
html[data-theme="dark"] .register-right-side label,
html[data-theme="dark"] .register-right-side span {
    color: var(--text-secondary) !important;
}

html[data-theme="dark"] .register-right-side input {
    background-color: var(--bg-secondary) !important;
    border-color: var(--border-color) !important;
    color: var(--text-color) !important;
}

html[data-theme="dark"] .register-right-side a {
    color: var(--primary-color) !important;
}

html[data-theme="dark"] .toggle-password {
    color: var(--text-muted) !important;
}

@media (max-width: 768px) {
    .container > div:first-child {
        display: none;
    }
    .container > div:last-child {
        flex: 1;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
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
    
    // Apply dark mode if it's already set
    const currentTheme = localStorage.getItem('theme') || 
                        (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
    
    if (currentTheme === 'dark') {
        const rightSide = document.querySelector('.register-right-side');
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
            const toggleIcons = rightSide.querySelectorAll('.toggle-password');
            toggleIcons.forEach(icon => {
                icon.style.color = 'var(--text-muted)';
            });
            
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