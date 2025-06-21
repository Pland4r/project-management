// Smooth scrolling for navigation links
document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations
    initScrollAnimations();
    
    // Initialize brand interactions
    initBrandInteractions();
    
    // Initialize button interactions
    initButtonInteractions();
    
    // Initialize header scroll effect
    initHeaderScrollEffect();
});

// Scroll animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
            }
        });
    }, observerOptions);

    // Add animation classes and observe elements
    const heroContent = document.querySelector('.hero-content');
    const heroImage = document.querySelector('.hero-image');
    const aboutItems = document.querySelectorAll('.about-item');
    const brandItems = document.querySelectorAll('.brand-item');

    if (heroContent) {
        heroContent.classList.add('slide-in-right');
        observer.observe(heroContent);
    }

    if (heroImage) {
        heroImage.classList.add('slide-in-left');
        observer.observe(heroImage);
    }

    aboutItems.forEach((item, index) => {
        item.classList.add('fade-in');
        item.style.transitionDelay = `${index * 0.2}s`;
        observer.observe(item);
    });

    brandItems.forEach((item, index) => {
        item.classList.add('fade-in');
        item.style.transitionDelay = `${index * 0.1}s`;
        observer.observe(item);
    });
}

// Brand interactions
function initBrandInteractions() {
    const brandItems = document.querySelectorAll('.brand-item');
    
    brandItems.forEach(item => {
        item.addEventListener('click', function() {
            const brandName = this.querySelector('.brand-name').textContent;
            showBrandInfo(brandName);
        });

        // Add hover sound effect (optional)
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// Show brand information
function showBrandInfo(brandName) {
    const brandInfo = {
        'Peugeot': 'Founded in 1810, Peugeot is one of the oldest car manufacturers in the world, known for innovative design and French elegance.',
        'Citroën': 'Established in 1919, Citroën is renowned for its creative and unconventional approach to automotive design and technology.',
        'Fiat': 'Founded in 1899 in Turin, Italy, Fiat has been a symbol of Italian automotive excellence and innovation for over a century.',
        'Jeep': 'Born in 1941, Jeep is the most capable SUV brand, offering legendary off-road capability and adventure-ready vehicles.',
        'Opel': 'Founded in 1862, Opel represents German engineering precision and has been creating reliable, efficient vehicles for generations.',
        'Chrysler': 'Established in 1925, Chrysler embodies American automotive innovation with a focus on luxury, performance, and technology.'
    };

    alert(`${brandName}\n\n${brandInfo[brandName] || 'Learn more about this iconic automotive brand.'}`);
}

// Button interactions
function initButtonInteractions() {
    const primaryButtons = document.querySelectorAll('.btn-primary');
    const secondaryButtons = document.querySelectorAll('.btn-secondary');

    primaryButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Add ripple effect
            createRipple(this);
            
            // Handle button action
            if (this.textContent.includes('Explore')) {
                scrollToSection('.brands-section');
            }
        });
    });

    secondaryButtons.forEach(button => {
        button.addEventListener('click', function() {
            createRipple(this);
            
            if (this.textContent.includes('Learn More')) {
                scrollToSection('.about-section');
            }
        });
    });
}

// Create ripple effect
function createRipple(button) {
    const ripple = document.createElement('span');
    const rect = button.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height);
    
    ripple.style.width = ripple.style.height = size + 'px';
    ripple.style.left = (event.clientX - rect.left - size / 2) + 'px';
    ripple.style.top = (event.clientY - rect.top - size / 2) + 'px';
    ripple.classList.add('ripple');
    
    // Add ripple styles
    ripple.style.position = 'absolute';
    ripple.style.borderRadius = '50%';
    ripple.style.background = 'rgba(255, 255, 255, 0.6)';
    ripple.style.transform = 'scale(0)';
    ripple.style.animation = 'ripple 0.6s linear';
    ripple.style.pointerEvents = 'none';
    
    button.style.position = 'relative';
    button.style.overflow = 'hidden';
    button.appendChild(ripple);
    
    setTimeout(() => {
        ripple.remove();
    }, 600);
}

// Add ripple animation to CSS
const style = document.createElement('style');
style.textContent = `
    @keyframes ripple {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
`;
document.head.appendChild(style);

// Smooth scroll to section
function scrollToSection(selector) {
    const element = document.querySelector(selector);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Header scroll effect
function initHeaderScrollEffect() {
    const header = document.querySelector('.header');
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;
        
        if (currentScrollY > 100) {
            header.style.background = 'rgba(255, 255, 255, 0.95)';
            header.style.backdropFilter = 'blur(10px)';
        } else {
            header.style.background = 'white';
            header.style.backdropFilter = 'none';
        }
        
        lastScrollY = currentScrollY;
    });
}

// Parallax effect for hero image
window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const heroImg = document.querySelector('.hero-img');
    
    if (heroImg) {
        const speed = scrolled * 0.5;
        heroImg.style.transform = `translateY(${speed}px) scale(1.1)`;
    }
});

// Theme toggle functionality (bonus feature)
function initThemeToggle() {
    const themeToggle = document.createElement('button');
    themeToggle.innerHTML = '🌙';
    themeToggle.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: #059669;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 20px;
        cursor: pointer;
        z-index: 1000;
        transition: all 0.3s ease;
    `;
    
    themeToggle.addEventListener('click', () => {
        document.body.classList.toggle('dark-theme');
        themeToggle.innerHTML = document.body.classList.contains('dark-theme') ? '☀️' : '🌙';
    });
    
    document.body.appendChild(themeToggle);
}

// Initialize theme toggle
// initThemeToggle();