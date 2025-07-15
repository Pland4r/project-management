@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="alert alert-primary text-center">
        <div class="dashboard-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <h2>Welcome to the Admin Dashboard</h2>
        <p>Here you can manage users, projects, and files efficiently.</p>
        <div class="mt-4">
            <a href="{{ route('admin.users.pending') }}" class="btn btn-info m-2">
                <i class="fas fa-users"></i>
                <span>Pending Users</span>
            </a>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-info m-2">
                <i class="fas fa-folder-open"></i>
                <span>Manage Projects</span>
            </a>
        </div>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">24</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">156</div>
                <div class="stat-label">Active Users</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">42</div>
                <div class="stat-label">Projects</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">98%</div>
                <div class="stat-label">Uptime</div>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');

:root {
    --primary-color: #4f46e5;
    --primary-light: #6366f1;
    --secondary-color: #06b6d4;
    --success-color: #10b981;
    --warning-color: #f59e0b;
    --text-dark: #1f2937;
    --text-light: #6b7280;
    --bg-light: #f8fafc;
    --white: #ffffff;
    --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
}

body {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    min-height: 100vh;
}

.container {
    max-width: 1000px;
    margin: 0 auto;
}

.alert.alert-primary {
    background: var(--white);
    border: none;
    border-radius: var(--border-radius);
    padding: 3rem 2rem;
    box-shadow: var(--shadow-lg);
    position: relative;
    overflow: hidden;
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.alert.alert-primary::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
}

.dashboard-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    box-shadow: var(--shadow);
}

.dashboard-icon i {
    font-size: 2rem;
    color: var(--white);
}

.alert h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    letter-spacing: -0.025em;
}

.alert p {
    font-size: 1.125rem;
    color: var(--text-light);
    margin-bottom: 2.5rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

.mt-4 {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-bottom: 3rem;
}

.btn.btn-info {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-light));
    border: none;
    color: var(--white);
    font-weight: 600;
    font-size: 1rem;
    padding: 1rem 2rem;
    border-radius: var(--border-radius);
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    transition: var(--transition);
    box-shadow: var(--shadow);
    min-width: 180px;
    justify-content: center;
}

.btn.btn-info:nth-child(2) {
    background: linear-gradient(135deg, var(--secondary-color), #0891b2);
}

.btn.btn-info:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
    text-decoration: none;
    color: var(--white);
}

.btn.btn-info:active {
    transform: translateY(0);
}

.btn.btn-info i {
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
    gap: 1.5rem;
    max-width: 600px;
    margin: 0 auto;
}

.stat-item {
    background: var(--bg-light);
    padding: 1.5rem 1rem;
    border-radius: var(--border-radius);
    text-align: center;
    border: 1px solid #e5e7eb;
    transition: var(--transition);
}

.stat-item:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow);
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--text-light);
    font-weight: 500;
}

/* Responsive Design */
@media (max-width: 768px) {
    .alert.alert-primary {
        padding: 2rem 1.5rem;
    }
    
    .alert h2 {
        font-size: 2rem;
    }
    
    .alert p {
        font-size: 1rem;
    }
    
    .mt-4 {
        flex-direction: column;
        align-items: center;
    }
    
    .btn.btn-info {
        width: 100%;
        max-width: 280px;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
}

@media (max-width: 480px) {
    .dashboard-icon {
        width: 60px;
        height: 60px;
    }
    
    .dashboard-icon i {
        font-size: 1.5rem;
    }
    
    .alert h2 {
        font-size: 1.75rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr 1fr;
    }
}

/* Focus states for accessibility */
.btn.btn-info:focus {
    outline: none;
    box-shadow: var(--shadow-lg), 0 0 0 3px rgba(79, 70, 229, 0.3);
}

/* Loading animation */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}

.btn.btn-info.loading {
    pointer-events: none;
    animation: pulse 1.5s ease-in-out infinite;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.btn.btn-info');
    
    // Add click feedback
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
            // Add loading state
            this.classList.add('loading');
            
            // Create ripple effect
            const ripple = document.createElement('span');
            const rect = this.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            const x = e.clientX - rect.left - size / 2;
            const y = e.clientY - rect.top - size / 2;
            
            ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple 0.6s ease-out;
                pointer-events: none;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            
            setTimeout(() => {
                ripple.remove();
                this.classList.remove('loading');
            }, 600);
        });
    });
    
    // Add smooth scroll animation for stats
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);
    
    // Animate stats on scroll
    document.querySelectorAll('.stat-item').forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateY(20px)';
        item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(item);
    });
});
</script>

<style>
@keyframes ripple {
    to {
        transform: scale(4);
        opacity: 0;
    }
}

/* Smooth scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
    background: var(--primary-color);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--primary-light);
}
</style>

@endsection