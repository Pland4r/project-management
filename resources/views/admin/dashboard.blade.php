@extends('layouts.app')
@section('content')
<div class="container py-5">
    <div class="alert alert-primary text-center">
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Here you can manage users, projects, and files.</p>
        <div class="mt-4">
            <a href="{{ route('admin.users.pending') }}" class="btn btn-info m-2">Pending Users</a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-info m-2">Manage Projects</a>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

:root {
    --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    --tertiary-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    --glass-bg: rgba(255, 255, 255, 0.1);
    --glass-border: rgba(255, 255, 255, 0.2);
    --text-light: rgba(255, 255, 255, 0.9);
    --text-bright: #ffffff;
    --shadow-soft: 0 8px 32px rgba(31, 38, 135, 0.37);
    --shadow-intense: 0 15px 35px rgba(31, 38, 135, 0.5);
    --blur-amount: blur(10px);
}

* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

/* Advanced Animations */
@keyframes morphBackground {
    0%, 100% { 
        background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
        transform: scale(1) rotate(0deg);
    }
    25% { 
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 50%, #667eea 100%);
        transform: scale(1.02) rotate(1deg);
    }
    50% { 
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 50%, #4facfe 100%);
        transform: scale(1.01) rotate(-0.5deg);
    }
    75% { 
        background: linear-gradient(135deg, #764ba2 0%, #667eea 50%, #f5576c 100%);
        transform: scale(1.03) rotate(0.5deg);
    }
}

@keyframes floatingElements {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    25% { transform: translateY(-10px) rotate(1deg); }
    50% { transform: translateY(-5px) rotate(-1deg); }
    75% { transform: translateY(-15px) rotate(0.5deg); }
}

@keyframes glowPulse {
    0%, 100% { 
        box-shadow: 0 0 20px rgba(102, 126, 234, 0.4),
                    0 0 40px rgba(118, 75, 162, 0.3),
                    0 0 60px rgba(240, 147, 251, 0.2);
    }
    50% { 
        box-shadow: 0 0 30px rgba(102, 126, 234, 0.6),
                    0 0 60px rgba(118, 75, 162, 0.5),
                    0 0 90px rgba(240, 147, 251, 0.4);
    }
}

@keyframes slideInMagic {
    0% {
        opacity: 0;
        transform: translateY(100px) scale(0.8) rotateX(30deg);
        filter: blur(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1) rotateX(0deg);
        filter: blur(0px);
    }
}

@keyframes textShimmer {
    0% { background-position: -200% center; }
    100% { background-position: 200% center; }
}

@keyframes buttonMagic {
    0% {
        transform: translateY(0) scale(1);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
    }
    50% {
        transform: translateY(-8px) scale(1.05);
        box-shadow: 0 15px 35px rgba(79, 172, 254, 0.6);
    }
    100% {
        transform: translateY(0) scale(1);
        box-shadow: 0 5px 15px rgba(79, 172, 254, 0.3);
    }
}

@keyframes particleFloat {
    0%, 100% { transform: translateY(0px) translateX(0px) rotate(0deg); opacity: 0.7; }
    25% { transform: translateY(-20px) translateX(10px) rotate(90deg); opacity: 1; }
    50% { transform: translateY(-10px) translateX(-5px) rotate(180deg); opacity: 0.8; }
    75% { transform: translateY(-30px) translateX(15px) rotate(270deg); opacity: 0.9; }
}

/* Container with perspective */
.container {
    max-width: 1100px;
    perspective: 1000px;
    animation: slideInMagic 1.2s cubic-bezier(0.23, 1, 0.32, 1);
}

/* Revolutionary Alert Design */
.alert.alert-primary {
    background: transparent;
    border: none;
    padding: 4rem 3rem;
    border-radius: 30px;
    position: relative;
    overflow: hidden;
    backdrop-filter: var(--blur-amount);
    -webkit-backdrop-filter: var(--blur-amount);
    animation: morphBackground 8s ease-in-out infinite,
               glowPulse 4s ease-in-out infinite;
    transform-style: preserve-3d;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Floating particles background */
.alert.alert-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 20% 20%, rgba(255,255,255,0.3) 2px, transparent 2px),
        radial-gradient(circle at 80% 80%, rgba(255,255,255,0.2) 1px, transparent 1px),
        radial-gradient(circle at 40% 60%, rgba(255,255,255,0.1) 1px, transparent 1px),
        radial-gradient(circle at 60% 30%, rgba(255,255,255,0.2) 2px, transparent 2px),
        radial-gradient(circle at 90% 10%, rgba(255,255,255,0.1) 1px, transparent 1px);
    background-size: 100px 100px, 150px 150px, 80px 80px, 120px 120px, 90px 90px;
    animation: particleFloat 15s linear infinite;
    pointer-events: none;
}

/* Glassmorphism overlay */
.alert.alert-primary::after {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 30px;
    pointer-events: none;
}

/* Spectacular Typography */
.alert h2 {
    font-size: 3.5rem;
    font-weight: 900;
    margin-bottom: 1.5rem;
    background: linear-gradient(45deg, #ffffff, #f0f9ff, #e0f2fe, #ffffff);
    background-size: 400% 400%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: textShimmer 3s ease-in-out infinite;
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
    position: relative;
    z-index: 2;
    letter-spacing: -0.02em;
    line-height: 1.1;
}

.alert p {
    font-size: 1.4rem;
    font-weight: 400;
    color: var(--text-light);
    margin-bottom: 2.5rem;
    position: relative;
    z-index: 2;
    max-width: 600px;
    line-height: 1.6;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
    animation: floatingElements 6s ease-in-out infinite;
}

/* Button Container */
.alert .mt-4 {
    position: relative;
    z-index: 2;
    display: flex;
    gap: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

/* Next-Level Button Design */
.btn.btn-info {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border: none;
    color: var(--text-bright);
    font-weight: 700;
    font-size: 1.1rem;
    padding: 1.2rem 2.5rem;
    border-radius: 50px;
    text-decoration: none;
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
    text-transform: uppercase;
    letter-spacing: 1px;
    min-width: 200px;
    backdrop-filter: blur(10px);
    box-shadow: 
        0 8px 32px rgba(79, 172, 254, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    animation: floatingElements 4s ease-in-out infinite;
}

.btn.btn-info:nth-child(1) {
    animation-delay: -1s;
}

.btn.btn-info:nth-child(2) {
    animation-delay: -2s;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}

/* Holographic effect */
.btn.btn-info::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.4), 
        transparent);
    transition: left 0.6s ease;
}

.btn.btn-info::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: all 0.4s ease;
}

.btn.btn-info:hover {
    transform: translateY(-10px) scale(1.05);
    box-shadow: 
        0 20px 40px rgba(79, 172, 254, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.3);
    color: var(--text-bright);
    text-decoration: none;
    animation: buttonMagic 0.6s ease-in-out;
}

.btn.btn-info:hover::before {
    left: 100%;
}

.btn.btn-info:hover::after {
    width: 100px;
    height: 100px;
}

.btn.btn-info:active {
    transform: translateY(-5px) scale(1.02);
    transition: all 0.1s ease;
}

/* Focus states for accessibility */
.btn.btn-info:focus {
    outline: none;
    box-shadow: 
        0 20px 40px rgba(79, 172, 254, 0.4),
        0 0 0 3px rgba(255, 255, 255, 0.3);
}

/* Add premium icons */
.btn.btn-info:first-of-type::before {
    content: '👥';
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    z-index: 1;
}

.btn.btn-info:last-of-type::before {
    content: '📊';
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 1.2rem;
    z-index: 1;
}

/* Responsive Design */
@media (max-width: 768px) {
    .alert.alert-primary {
        padding: 3rem 2rem;
        min-height: 350px;
    }
    
    .alert h2 {
        font-size: 2.5rem;
    }
    
    .alert p {
        font-size: 1.2rem;
    }
    
    .alert .mt-4 {
        flex-direction: column;
        align-items: center;
        gap: 1.5rem;
    }
    
    .btn.btn-info {
        width: 100%;
        max-width: 300px;
        font-size: 1rem;
        padding: 1rem 2rem;
    }
}

@media (max-width: 480px) {
    .alert.alert-primary {
        padding: 2rem 1.5rem;
        min-height: 300px;
    }
    
    .alert h2 {
        font-size: 2rem;
    }
    
    .alert p {
        font-size: 1.1rem;
    }
}

/* Loading states */
.btn.btn-info.loading {
    pointer-events: none;
    opacity: 0.8;
}

.btn.btn-info.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid transparent;
    border-top: 2px solid #ffffff;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Hover effect for entire alert */
.alert.alert-primary:hover {
    transform: translateY(-5px) rotateX(2deg);
    transition: all 0.4s ease;
}

/* Premium cursor effects */
.btn.btn-info {
    cursor: pointer;
}

.btn.btn-info:hover {
    cursor: pointer;
}

/* Add subtle noise texture */
.alert.alert-primary {
    background-image: 
        url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='0.05'/%3E%3C/svg%3E");
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn.btn-info');
    
    // Advanced ripple effect
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state
            this.classList.add('loading');
            
            // Create multiple ripples for premium effect
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height) * (1 + i * 0.3);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;
                    
                    ripple.style.cssText = `
                        position: absolute;
                        width: ${size}px;
                        height: ${size}px;
                        left: ${x}px;
                        top: ${y}px;
                        background: radial-gradient(circle, rgba(255,255,255,${0.3 - i * 0.1}) 0%, transparent 70%);
                        border-radius: 50%;
                        transform: scale(0);
                        animation: ripple-premium 0.8s ease-out;
                        pointer-events: none;
                        z-index: 1000;
                    `;
                    
                    this.appendChild(ripple);
                    
                    setTimeout(() => ripple.remove(), 800);
                }, i * 100);
            }
            
            // Remove loading state
            setTimeout(() => {
                this.classList.remove('loading');
            }, 1200);
        });
        
        // Add magnetic effect
        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            this.style.transform = `translateY(-10px) scale(1.05) rotateX(${y * 0.1}deg) rotateY(${x * 0.1}deg)`;
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
    
    // Add parallax effect to background elements
    document.addEventListener('mousemove', function(e) {
        const alert = document.querySelector('.alert.alert-primary');
        const x = (e.clientX / window.innerWidth) * 100;
        const y = (e.clientY / window.innerHeight) * 100;
        
        alert.style.backgroundPosition = `${x}% ${y}%`;
    });
    
    // Add scroll-triggered animations
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animationPlayState = 'running';
            }
        });
    });
    
    observer.observe(document.querySelector('.alert.alert-primary'));
});
</script>

<style>
@keyframes ripple-premium {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Add premium scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.1);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}
</style>
@endsection