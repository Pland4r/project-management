@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <!-- Main Content -->
    <div class="pending-container">
        <!-- Status Card -->
        <div class="status-card">
            <div class="status-icon">
                <div class="icon-wrapper">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="pulse-rings">
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                    <div class="pulse-ring"></div>
                </div>
            </div>
            
            <div class="status-content">
                <h1 class="status-title">Registration Pending</h1>
                <p class="status-message">
                    Your registration request has been successfully submitted and is currently under review.
                </p>
                
                <div class="status-details">
                    <div class="detail-item">
                        <i class="fas fa-paper-plane"></i>
                        <span>Request sent to administrators</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-envelope"></i>
                        <span>Email notification will be sent upon approval</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-shield-alt"></i>
                        <span>Your information is secure and protected</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Information Card -->
        <div class="info-card">
            <div class="info-header">
                <h2 class="info-title">
                    <i class="fas fa-info-circle"></i>
                    What Happens Next?
                </h2>
            </div>
            
            <div class="info-content">
                <div class="timeline">
                    <div class="timeline-item completed">
                        <div class="timeline-marker">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h3>Registration Submitted</h3>
                            <p>Your registration form has been successfully submitted with all required information.</p>
                            <span class="timeline-time">Just now</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item pending">
                        <div class="timeline-marker">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div class="timeline-content">
                            <h3>Admin Review</h3>
                            <p>Our administrators will review your registration request and verify your information.</p>
                            <span class="timeline-time">In progress</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item future">
                        <div class="timeline-marker">
                            <i class="fas fa-envelope-open"></i>
                        </div>
                        <div class="timeline-content">
                            <h3>Email Notification</h3>
                            <p>You'll receive an email notification once your account has been approved or if additional information is needed.</p>
                            <span class="timeline-time">Soon</span>
                        </div>
                    </div>
                    
                    <div class="timeline-item future">
                        <div class="timeline-marker">
                            <i class="fas fa-user-check"></i>
                        </div>
                        <div class="timeline-content">
                            <h3>Account Activation</h3>
                            <p>Once approved, you can log in and start using all the features of the platform.</p>
                            <span class="timeline-time">Final step</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Help Card -->
        <div class="help-card">
            <div class="help-content">
                <div class="help-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="help-text">
                    <h3>Need Help?</h3>
                    <p>If you have any questions about your registration or need assistance, please don't hesitate to contact our support team.</p>
                </div>
                <div class="help-actions">
                    <a href="mailto:support@company.com" class="help-btn primary">
                        <i class="fas fa-envelope"></i>
                        Contact Support
                    </a>
                    <a href="{{ route('login') }}" class="help-btn secondary">
                        <i class="fas fa-sign-in-alt"></i>
                        Back to Login
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="footer-info">
            <p>
                <i class="fas fa-clock"></i>
                Registration requests are typically reviewed within 24-48 hours during business days.
            </p>
        </div>
    </div>
</div>

<style>
/* Use existing CSS variables from app.blade.php */

/* Container */
.container-fluid {
    min-height: 100vh;
    background: linear-gradient(135deg, var(--bg-primary) 0%, var(--bg-secondary) 100%);
    padding: var(--space-xl) var(--space-lg);
    display: flex;
    align-items: center;
    justify-content: center;
}

.pending-container {
    max-width: 800px;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: var(--space-xl);
    animation: fadeInUp 0.8s ease-out;
}

/* Status Card */
.status-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    padding: var(--space-3xl);
    text-align: center;
    box-shadow: var(--shadow-xl);
    border: 1px solid var(--card-border);
    position: relative;
    overflow: hidden;
}

.status-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: var(--primary-gradient);
}

.status-icon {
    position: relative;
    display: inline-block;
    margin-bottom: var(--space-xl);
}

.icon-wrapper {
    width: 80px;
    height: 80px;
    border-radius: var(--radius-full);
    background: var(--primary-gradient);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2rem;
    position: relative;
    z-index: 2;
}

.pulse-rings {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
}

.pulse-ring {
    position: absolute;
    width: 80px;
    height: 80px;
    border: 2px solid var(--stellantis-primary);
    border-radius: var(--radius-full);
    opacity: 0;
    animation: pulse 2s infinite;
}

.pulse-ring:nth-child(2) {
    animation-delay: 0.5s;
}

.pulse-ring:nth-child(3) {
    animation-delay: 1s;
}

.status-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0 0 var(--space-md) 0;
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.status-message {
    font-size: 1.2rem;
    color: var(--text-secondary);
    margin: 0 0 var(--space-xl) 0;
    line-height: 1.6;
}

.status-details {
    display: flex;
    flex-direction: column;
    gap: var(--space-md);
    max-width: 500px;
    margin: 0 auto;
}

.detail-item {
    display: flex;
    align-items: center;
    gap: var(--space-md);
    padding: var(--space-md);
    background: var(--bg-secondary);
    border-radius: var(--radius-lg);
    border: 1px solid var(--border-secondary);
    transition: all var(--transition-normal);
}

.detail-item:hover {
    background: var(--bg-tertiary);
    transform: translateX(4px);
}

.detail-item i {
    color: var(--stellantis-primary);
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

.detail-item span {
    color: var(--text-primary);
    font-weight: 500;
}

/* Info Card */
.info-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
    overflow: hidden;
}

.info-header {
    background: var(--primary-gradient);
    color: white;
    padding: var(--space-lg) var(--space-xl);
    text-align: center;
}

.info-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-md);
}

.info-content {
    padding: var(--space-xl);
}

/* Timeline */
.timeline {
    position: relative;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--border-secondary);
}

.timeline-item {
    position: relative;
    padding-left: var(--space-3xl);
    margin-bottom: var(--space-xl);
}

.timeline-item:last-child {
    margin-bottom: 0;
}

.timeline-marker {
    position: absolute;
    left: 0;
    top: 0;
    width: 40px;
    height: 40px;
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
    font-weight: 600;
    border: 3px solid var(--bg-primary);
    z-index: 2;
}

.timeline-item.completed .timeline-marker {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.timeline-item.pending .timeline-marker {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
    animation: pulse-marker 2s infinite;
}

.timeline-item.future .timeline-marker {
    background: var(--bg-secondary);
    color: var(--text-muted);
    border-color: var(--border-secondary);
}

.timeline-content h3 {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 var(--space-sm) 0;
}

.timeline-content p {
    color: var(--text-secondary);
    margin: 0 0 var(--space-sm) 0;
    line-height: 1.5;
}

.timeline-time {
    font-size: 0.85rem;
    color: var(--text-muted);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.timeline-item.pending .timeline-time {
    color: #f59e0b;
    font-weight: 600;
}

/* Help Card */
.help-card {
    background: var(--card-bg);
    border-radius: var(--radius-2xl);
    box-shadow: var(--shadow-lg);
    border: 1px solid var(--card-border);
    overflow: hidden;
}

.help-content {
    padding: var(--space-xl);
    display: flex;
    align-items: center;
    gap: var(--space-lg);
}

.help-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--radius-full);
    background: linear-gradient(135deg, #6b7280, #4b5563);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    flex-shrink: 0;
}

.help-text {
    flex: 1;
}

.help-text h3 {
    font-size: 1.2rem;
    font-weight: 600;
    color: var(--text-primary);
    margin: 0 0 var(--space-sm) 0;
}

.help-text p {
    color: var(--text-secondary);
    margin: 0;
    line-height: 1.5;
}

.help-actions {
    display: flex;
    flex-direction: column;
    gap: var(--space-sm);
}

.help-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-sm);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    transition: all var(--transition-normal);
    min-width: 160px;
}

.help-btn.primary {
    background: var(--primary-gradient);
    color: white;
}

.help-btn.secondary {
    background: var(--bg-secondary);
    color: var(--text-primary);
    border: 2px solid var(--border-secondary);
}

.help-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    text-decoration: none;
}

.help-btn.primary:hover {
    color: white;
}

.help-btn.secondary:hover {
    background: var(--bg-tertiary);
    border-color: var(--stellantis-primary);
    color: var(--stellantis-primary);
}

/* Footer Info */
.footer-info {
    text-align: center;
    padding: var(--space-lg);
    background: var(--bg-secondary);
    border-radius: var(--radius-xl);
    border: 1px solid var(--border-secondary);
}

.footer-info p {
    margin: 0;
    color: var(--text-secondary);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-sm);
}

.footer-info i {
    color: var(--stellantis-primary);
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-fluid {
        padding: var(--space-lg) var(--space-md);
    }
    
    .status-card {
        padding: var(--space-xl);
    }
    
    .status-title {
        font-size: 2rem;
    }
    
    .status-message {
        font-size: 1.1rem;
    }
    
    .help-content {
        flex-direction: column;
        text-align: center;
        gap: var(--space-md);
    }
    
    .help-actions {
        flex-direction: row;
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .timeline-item {
        padding-left: var(--space-2xl);
    }
    
    .timeline::before {
        left: 15px;
    }
    
    .timeline-marker {
        width: 30px;
        height: 30px;
        font-size: 0.8rem;
    }
}

@media (max-width: 576px) {
    .status-title {
        font-size: 1.8rem;
    }
    
    .status-details {
        gap: var(--space-sm);
    }
    
    .detail-item {
        padding: var(--space-sm);
        font-size: 0.9rem;
    }
    
    .help-actions {
        flex-direction: column;
    }
    
    .help-btn {
        width: 100%;
    }
    
    .footer-info p {
        flex-direction: column;
        gap: var(--space-xs);
        text-align: center;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.8;
    }
    50% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0.4;
    }
    100% {
        transform: translate(-50%, -50%) scale(2);
        opacity: 0;
    }
}

@keyframes pulse-marker {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.1);
    }
}

/* Focus States for Accessibility */
.help-btn:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add entrance animations with staggered delays
    const cards = document.querySelectorAll('.status-card, .info-card, .help-card, .footer-info');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.2}s`;
    });
    
    // Timeline items animation
    const timelineItems = document.querySelectorAll('.timeline-item');
    timelineItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = 'all 0.6s ease-out';
        item.style.transitionDelay = `${0.8 + (index * 0.2)}s`;
        
        setTimeout(() => {
            item.style.opacity = '1';
            item.style.transform = 'translateX(0)';
        }, 100);
    });
    
    // Add ripple effect to buttons
    const buttons = document.querySelectorAll('.help-btn');
    buttons.forEach(button => {
        button.addEventListener('click', function(e) {
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
                background: radial-gradient(circle, rgba(255,255,255,0.6) 0%, transparent 70%);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple-effect 0.6s ease-out;
                pointer-events: none;
                z-index: 1000;
            `;
            
            this.style.position = 'relative';
            this.style.overflow = 'hidden';
            this.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });
    
    // Auto-refresh page every 5 minutes to check for updates
    let refreshInterval = setInterval(() => {
        // Only refresh if the user hasn't interacted recently
        if (document.hidden === false) {
            window.location.reload();
        }
    }, 300000); // 5 minutes
    
    // Clear interval when page is hidden
    document.addEventListener('visibilitychange', function() {
        if (document.hidden) {
            clearInterval(refreshInterval);
        } else {
            // Restart interval when page becomes visible again
            refreshInterval = setInterval(() => {
                if (document.hidden === false) {
                    window.location.reload();
                }
            }, 300000);
        }
    });
    
    // Add hover effects to detail items
    const detailItems = document.querySelectorAll('.detail-item');
    detailItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(8px) scale(1.02)';
        });
        
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0) scale(1)';
        });
    });
});
</script>

<style>
@keyframes ripple-effect {
    to {
        transform: scale(4);
        opacity: 0;
    }
}
</style>
@endsection