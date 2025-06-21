@extends('layouts.app')

@section('content')
<div class="ultra-professional-container">
    <!-- Animated Background -->
    <div class="animated-background">
        <div class="floating-shapes">
            <div class="shape shape-1"></div>
            <div class="shape shape-2"></div>
            <div class="shape shape-3"></div>
            <div class="shape shape-4"></div>
            <div class="shape shape-5"></div>
        </div>
        <div class="grid-overlay"></div>
    </div>

    <!-- Navigation Breadcrumb -->
    <div class="breadcrumb-section">
        <div class="breadcrumb-container">
            <nav class="breadcrumb-nav">
                <a href="{{ route('dashboard') }}" class="breadcrumb-item">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
                <div class="breadcrumb-separator">
                    <i class="fas fa-chevron-right"></i>
                </div>
                <div class="breadcrumb-item active">
                    <i class="fas fa-layer-group"></i>
                    <span>Gammes</span>
                </div>
            </nav>
        </div>
    </div>

    <!-- Hero Section with Advanced Design -->
    <div class="hero-section">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge-container">
                    <div class="hero-badge">
                        <div class="badge-icon">
                            <i class="fas fa-layer-group"></i>
                        </div>
                        <div class="badge-text">
                            <span class="badge-label">Stellantis</span>
                            <span class="badge-title">Gammes</span>
                        </div>
                        <div class="badge-pulse"></div>
                    </div>
                </div>
                
                <h1 class="hero-title">
                    <span class="title-line">Stellantis</span>
                    <span class="title-line highlight">Documentation Hub</span>
                </h1>
                
                <p class="hero-description">
                    Access comprehensive technical documentation, specifications, and resources 
                    for our cutting-edge automotive product lines and systems.
                </p>

                <div class="hero-metrics">
                    <div class="metric-item">
                        <div class="metric-value" id="totalFilesMetric">0</div>
                        <div class="metric-label">Technical Files</div>
                        <div class="metric-trend">
                            <i class="fas fa-arrow-up"></i>
                            <span>+12%</span>
                        </div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value">3</div>
                        <div class="metric-label">Product Lines</div>
                        <div class="metric-trend">
                            <i class="fas fa-check"></i>
                            <span>Active</span>
                        </div>
                    </div>
                    <div class="metric-item">
                        <div class="metric-value" id="lastUpdateMetric">Today</div>
                        <div class="metric-label">Last Updated</div>
                        <div class="metric-trend">
                            <i class="fas fa-clock"></i>
                            <span>Live</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="hero-visual">
                <div class="visual-container">
                    <div class="central-orb">
                        <div class="orb-core"></div>
                        <div class="orb-ring ring-1"></div>
                        <div class="orb-ring ring-2"></div>
                        <div class="orb-ring ring-3"></div>
                    </div>
                    <div class="connection-lines">
                        <div class="line line-1"></div>
                        <div class="line line-2"></div>
                        <div class="line line-3"></div>
                    </div>
                    <div class="satellite-nodes">
                        <div class="node node-las">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="node node-str">
                            <i class="fas fa-truck"></i>
                        </div>
                        <div class="node node-ctr">
                            <i class="fas fa-cogs"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Advanced Stats Dashboard -->
    <div class="stats-dashboard">
        <div class="dashboard-container">
            <div class="dashboard-header">
                <h2 class="dashboard-title">System Overview</h2>
                <div class="dashboard-controls">
                    <button class="control-btn active" data-period="today">Today</button>
                    <button class="control-btn" data-period="week">Week</button>
                    <button class="control-btn" data-period="month">Month</button>
                </div>
            </div>
            
            <div class="stats-grid">
                <div class="stat-card premium-card">
                    <div class="card-header">
                        <div class="card-icon las-theme">
                            <i class="fas fa-file-alt"></i>
                        </div>
                        <div class="card-menu">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="stat-value" id="totalDocuments">0</div>
                        <div class="stat-label">Total Documents</div>
                        <div class="stat-chart">
                            <div class="chart-bar" style="height: 60%"></div>
                            <div class="chart-bar" style="height: 80%"></div>
                            <div class="chart-bar" style="height: 45%"></div>
                            <div class="chart-bar" style="height: 90%"></div>
                            <div class="chart-bar" style="height: 75%"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="trend-indicator positive">
                            <i class="fas fa-arrow-up"></i>
                            +15.3%
                        </span>
                        <span class="trend-text">vs last month</span>
                    </div>
                </div>

                <div class="stat-card premium-card">
                    <div class="card-header">
                        <div class="card-icon str-theme">
                            <i class="fas fa-download"></i>
                        </div>
                        <div class="card-menu">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="stat-value" id="downloadsValue">2.4K</div>
                        <div class="stat-label">Downloads Today</div>
                        <div class="progress-ring">
                            <svg class="progress-svg" width="60" height="60">
                                <circle cx="30" cy="30" r="25" class="progress-bg"></circle>
                                <circle cx="30" cy="30" r="25" class="progress-fill" style="stroke-dasharray: 157; stroke-dashoffset: 47;"></circle>
                            </svg>
                            <div class="progress-text">70%</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="trend-indicator positive">
                            <i class="fas fa-arrow-up"></i>
                            +8.2%
                        </span>
                        <span class="trend-text">vs yesterday</span>
                    </div>
                </div>

                <div class="stat-card premium-card">
                    <div class="card-header">
                        <div class="card-icon ctr-theme">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="card-menu">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="stat-value" id="usersValue">847</div>
                        <div class="stat-label">Active Users</div>
                        <div class="user-avatars">
                            <div class="avatar avatar-1"></div>
                            <div class="avatar avatar-2"></div>
                            <div class="avatar avatar-3"></div>
                            <div class="avatar avatar-more">+12</div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="trend-indicator neutral">
                            <i class="fas fa-minus"></i>
                            +2.1%
                        </span>
                        <span class="trend-text">vs last week</span>
                    </div>
                </div>

                <div class="stat-card premium-card">
                    <div class="card-header">
                        <div class="card-icon premium-theme">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="card-menu">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="stat-value">98.7%</div>
                        <div class="stat-label">System Uptime</div>
                        <div class="uptime-indicator">
                            <div class="uptime-bar">
                                <div class="uptime-fill" style="width: 98.7%"></div>
                            </div>
                            <div class="uptime-status">
                                <span class="status-dot online"></span>
                                <span>All Systems Operational</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="trend-indicator positive">
                            <i class="fas fa-check"></i>
                            Excellent
                        </span>
                        <span class="trend-text">performance</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ultra-Premium Product Lines Section -->
    <div class="product-lines-section">
        <div class="section-container">
            <div class="section-header">
                <div class="header-content">
                    <h2 class="section-title">Product Line Access</h2>
                    <p class="section-subtitle">Select your target product line to access specialized documentation and technical resources</p>
                </div>
                <div class="header-actions">
                    <div class="view-toggle">
                        <button class="toggle-btn active" data-view="cards">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="toggle-btn" data-view="list">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="product-lines-grid" id="productLinesGrid">
                <!-- LAS Product Line -->
                <div class="product-line-card las-card" data-product="LAS">
                    <div class="card-background">
                        <div class="bg-pattern"></div>
                        <div class="bg-gradient las-gradient"></div>
                        <div class="bg-mesh"></div>
                    </div>
                    
                    <div class="card-glow las-glow"></div>
                    
                    <div class="card-content">
                        <div class="card-header">
                            <div class="product-badge las-badge">
                                <span class="badge-text">LAS</span>
                                <div class="badge-indicator"></div>
                            </div>
                            <div class="card-status">
                                <div class="status-dot active"></div>
                                <span>Active</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="product-icon las-icon">
                                <i class="fas fa-car"></i>
                                <div class="icon-glow"></div>
                            </div>
                            
                            <h3 class="product-title">Light Automotive Systems</h3>
                            <p class="product-description">
                                Advanced lighting solutions, electronic control units, and intelligent 
                                automotive systems for next-generation vehicles.
                            </p>

                            <div class="product-stats">
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number" id="las-file-count">0</span>
                                        <span class="stat-label">Documents</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">2h</span>
                                        <span class="stat-label">Ago</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">1.2K</span>
                                        <span class="stat-label">Views</span>
                                    </div>
                                </div>
                            </div>

                            <div class="technology-tags">
                                <span class="tech-tag">LED Systems</span>
                                <span class="tech-tag">ECU</span>
                                <span class="tech-tag">Sensors</span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('gammes.files', 'LAS') }}" class="access-button las-button">
                                <span class="button-text">Access Documentation</span>
                                <div class="button-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="button-glow"></div>
                            </a>
                        </div>
                    </div>

                    <div class="card-particles">
                        <div class="particle particle-1"></div>
                        <div class="particle particle-2"></div>
                        <div class="particle particle-3"></div>
                    </div>
                </div>

                <!-- STR Product Line -->
                <div class="product-line-card str-card" data-product="STR">
                    <div class="card-background">
                        <div class="bg-pattern"></div>
                        <div class="bg-gradient str-gradient"></div>
                        <div class="bg-mesh"></div>
                    </div>
                    
                    <div class="card-glow str-glow"></div>
                    
                    <div class="card-content">
                        <div class="card-header">
                            <div class="product-badge str-badge">
                                <span class="badge-text">STR</span>
                                <div class="badge-indicator"></div>
                            </div>
                            <div class="card-status">
                                <div class="status-dot active"></div>
                                <span>Active</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="product-icon str-icon">
                                <i class="fas fa-truck"></i>
                                <div class="icon-glow"></div>
                            </div>
                            
                            <h3 class="product-title">Structural Systems</h3>
                            <p class="product-description">
                                High-performance structural components, chassis systems, and safety 
                                frameworks ensuring vehicle integrity and durability.
                            </p>

                            <div class="product-stats">
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number" id="str-file-count">0</span>
                                        <span class="stat-label">Documents</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">4h</span>
                                        <span class="stat-label">Ago</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">890</span>
                                        <span class="stat-label">Views</span>
                                    </div>
                                </div>
                            </div>

                            <div class="technology-tags">
                                <span class="tech-tag">Chassis</span>
                                <span class="tech-tag">Safety</span>
                                <span class="tech-tag">Materials</span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('gammes.files', 'STR') }}" class="access-button str-button">
                                <span class="button-text">Access Documentation</span>
                                <div class="button-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="button-glow"></div>
                            </a>
                        </div>
                    </div>

                    <div class="card-particles">
                        <div class="particle particle-1"></div>
                        <div class="particle particle-2"></div>
                        <div class="particle particle-3"></div>
                    </div>
                </div>

                <!-- CTR Product Line -->
                <div class="product-line-card ctr-card" data-product="CTR">
                    <div class="card-background">
                        <div class="bg-pattern"></div>
                        <div class="bg-gradient ctr-gradient"></div>
                        <div class="bg-mesh"></div>
                    </div>
                    
                    <div class="card-glow ctr-glow"></div>
                    
                    <div class="card-content">
                        <div class="card-header">
                            <div class="product-badge ctr-badge">
                                <span class="badge-text">CTR</span>
                                <div class="badge-indicator"></div>
                            </div>
                            <div class="card-status">
                                <div class="status-dot active"></div>
                                <span>Active</span>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="product-icon ctr-icon">
                                <i class="fas fa-cogs"></i>
                                <div class="icon-glow"></div>
                            </div>
                            
                            <h3 class="product-title">Control Systems</h3>
                            <p class="product-description">
                                Intelligent control units, automation systems, and advanced 
                                algorithms for comprehensive vehicle management and optimization.
                            </p>

                            <div class="product-stats">
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-file"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number" id="ctr-file-count">0</span>
                                        <span class="stat-label">Documents</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-clock"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">1h</span>
                                        <span class="stat-label">Ago</span>
                                    </div>
                                </div>
                                <div class="stat-item">
                                    <div class="stat-icon">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <div class="stat-content">
                                        <span class="stat-number">1.5K</span>
                                        <span class="stat-label">Views</span>
                                    </div>
                                </div>
                            </div>

                            <div class="technology-tags">
                                <span class="tech-tag">AI/ML</span>
                                <span class="tech-tag">Automation</span>
                                <span class="tech-tag">IoT</span>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('gammes.files', 'CTR') }}" class="access-button ctr-button">
                                <span class="button-text">Access Documentation</span>
                                <div class="button-icon">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                                <div class="button-glow"></div>
                            </a>
                        </div>
                    </div>

                    <div class="card-particles">
                        <div class="particle particle-1"></div>
                        <div class="particle particle-2"></div>
                        <div class="particle particle-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Ultra-Professional Container - Using Theme Variables */
.ultra-professional-container {
    min-height: 100vh;
    background: var(--bg-gradient);
    color: var(--text-primary);
    position: relative;
    overflow-x: hidden;
    margin: -4rem -2rem 0 -2rem; /* Counteract main padding */
    padding-top: 0;
}

/* Animated Background - Adapts to Theme */
.animated-background {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    pointer-events: none;
}

.floating-shapes {
    position: absolute;
    width: 100%;
    height: 100%;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(5, 150, 105, 0.1), rgba(16, 185, 129, 0.1));
    animation: float 20s infinite ease-in-out;
}

/* Dark mode shapes */
html[data-theme="dark"] .shape {
    background: linear-gradient(45deg, rgba(16, 185, 129, 0.15), rgba(5, 150, 105, 0.15));
}

.shape-1 {
    width: 300px;
    height: 300px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
}

.shape-2 {
    width: 200px;
    height: 200px;
    top: 60%;
    right: 15%;
    animation-delay: -5s;
}

.shape-3 {
    width: 150px;
    height: 150px;
    bottom: 20%;
    left: 20%;
    animation-delay: -10s;
}

.shape-4 {
    width: 250px;
    height: 250px;
    top: 30%;
    right: 30%;
    animation-delay: -15s;
}

.shape-5 {
    width: 100px;
    height: 100px;
    bottom: 40%;
    right: 10%;
    animation-delay: -7s;
}

@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    33% { transform: translateY(-30px) rotate(120deg); }
    66% { transform: translateY(20px) rotate(240deg); }
}

.grid-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: 
        linear-gradient(var(--border-secondary) 1px, transparent 1px),
        linear-gradient(90deg, var(--border-secondary) 1px, transparent 1px);
    background-size: 50px 50px;
    animation: gridMove 30s linear infinite;
    opacity: 0.3;
}

@keyframes gridMove {
    0% { transform: translate(0, 0); }
    100% { transform: translate(50px, 50px); }
}

/* Breadcrumb Section */
.breadcrumb-section {
    position: relative;
    z-index: 10;
    padding: var(--space-lg) var(--space-xl);
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid var(--glass-border);
}

.breadcrumb-container {
    max-width: 1400px;
    margin: 0 auto;
}

.breadcrumb-nav {
    display: flex;
    align-items: center;
    gap: var(--space-md);
}

.breadcrumb-item {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    color: var(--text-muted);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: var(--transition-normal);
}

.breadcrumb-item:hover {
    color: var(--stellantis-primary);
    text-decoration: none;
}

.breadcrumb-item.active {
    color: var(--text-primary);
}

.breadcrumb-separator {
    color: var(--text-muted);
    font-size: 0.75rem;
}

/* Hero Section */
.hero-section {
    position: relative;
    z-index: 10;
    padding: 6rem var(--space-xl);
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
}

.hero-container {
    max-width: 1400px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 4rem;
    align-items: center;
}

.hero-badge-container {
    margin-bottom: var(--space-xl);
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-md);
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-2xl);
    padding: var(--space-md) var(--space-lg);
    position: relative;
    overflow: hidden;
}

.badge-icon {
    width: 40px;
    height: 40px;
    background: var(--primary-gradient);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.125rem;
    color: white;
}

.badge-text {
    display: flex;
    flex-direction: column;
}

.badge-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    font-weight: 500;
}

.badge-title {
    font-size: 0.875rem;
    color: var(--text-primary);
    font-weight: 700;
}

.badge-pulse {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, transparent, var(--glass-border), transparent);
    animation: pulse-slide 3s infinite;
}

@keyframes pulse-slide {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    line-height: 1.1;
    margin: 0 0 var(--space-xl) 0;
    color: var(--text-primary);
}

.title-line {
    display: block;
}

.title-line.highlight {
    background: var(--primary-gradient);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-description {
    font-size: 1.25rem;
    line-height: 1.7;
    color: var(--text-secondary);
    margin: 0 0 var(--space-2xl) 0;
    max-width: 500px;
}

.hero-metrics {
    display: flex;
    gap: var(--space-xl);
}

.metric-item {
    text-align: center;
}

.metric-value {
    font-size: 2rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1;
}

.metric-label {
    font-size: 0.875rem;
    color: var(--text-muted);
    margin-top: var(--space-sm);
    font-weight: 500;
}

.metric-trend {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    margin-top: var(--space-sm);
    font-size: 0.75rem;
    color: var(--stellantis-secondary);
}

/* Hero Visual */
.hero-visual {
    display: flex;
    justify-content: center;
    align-items: center;
}

.visual-container {
    position: relative;
    width: 400px;
    height: 400px;
}

.central-orb {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
}

.orb-core {
    width: 100%;
    height: 100%;
    background: var(--primary-gradient);
    border-radius: 50%;
    box-shadow: 0 0 50px rgba(5, 150, 105, 0.5);
    animation: pulse-glow 3s infinite ease-in-out;
}

@keyframes pulse-glow {
    0%, 100% { box-shadow: 0 0 50px rgba(5, 150, 105, 0.5); }
    50% { box-shadow: 0 0 80px rgba(5, 150, 105, 0.8); }
}

.orb-ring {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    border: 2px solid var(--border-primary);
    border-radius: 50%;
    animation: rotate 20s linear infinite;
}

.ring-1 {
    width: 160px;
    height: 160px;
    animation-duration: 20s;
}

.ring-2 {
    width: 200px;
    height: 200px;
    animation-duration: 30s;
    animation-direction: reverse;
}

.ring-3 {
    width: 240px;
    height: 240px;
    animation-duration: 40s;
}

@keyframes rotate {
    from { transform: translate(-50%, -50%) rotate(0deg); }
    to { transform: translate(-50%, -50%) rotate(360deg); }
}

.satellite-nodes {
    position: absolute;
    width: 100%;
    height: 100%;
}

.node {
    position: absolute;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
    animation: orbit 15s linear infinite;
}

.node-las {
    background: var(--primary-gradient);
    top: 20%;
    right: 20%;
    animation-delay: 0s;
}

.node-str {
    background: var(--success-gradient);
    bottom: 20%;
    right: 30%;
    animation-delay: -5s;
}

.node-ctr {
    background: var(--warning-gradient);
    bottom: 30%;
    left: 20%;
    animation-delay: -10s;
}

@keyframes orbit {
    from { transform: rotate(0deg) translateX(100px) rotate(0deg); }
    to { transform: rotate(360deg) translateX(100px) rotate(-360deg); }
}

/* Stats Dashboard */
.stats-dashboard {
    position: relative;
    z-index: 10;
    padding: 4rem var(--space-xl);
    background: var(--glass-bg);
    backdrop-filter: blur(20px);
}

.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-2xl);
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    margin: 0;
}

.dashboard-controls {
    display: flex;
    gap: var(--space-sm);
    background: var(--glass-bg);
    border-radius: var(--radius-xl);
    padding: var(--space-sm);
    border: 1px solid var(--glass-border);
}

.control-btn {
    padding: var(--space-md) var(--space-lg);
    border: none;
    background: transparent;
    color: var(--text-muted);
    border-radius: var(--radius-lg);
    font-weight: 600;
    transition: var(--transition-normal);
    cursor: pointer;
}

.control-btn.active,
.control-btn:hover {
    background: var(--primary-gradient);
    color: white;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-xl);
}

.premium-card {
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-2xl);
    padding: var(--space-xl);
    transition: var(--transition-normal);
    position: relative;
    overflow: hidden;
}

.premium-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: var(--primary-gradient);
    opacity: 0;
    transition: var(--transition-normal);
}

.premium-card:hover {
    transform: translateY(-5px);
    border-color: var(--border-primary);
    box-shadow: var(--shadow-xl);
}

.premium-card:hover::before {
    opacity: 1;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-lg);
}

.card-icon {
    width: 50px;
    height: 50px;
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.las-theme { background: var(--primary-gradient); }
.str-theme { background: var(--success-gradient); }
.ctr-theme { background: var(--warning-gradient); }
.premium-theme { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }

.card-menu {
    color: var(--text-muted);
    cursor: pointer;
    transition: var(--transition-normal);
}

.card-menu:hover {
    color: var(--text-primary);
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: var(--space-sm);
}

.stat-label {
    color: var(--text-muted);
    font-size: 0.875rem;
    font-weight: 500;
}

.stat-chart {
    display: flex;
    align-items: end;
    gap: 0.25rem;
    height: 40px;
    margin: var(--space-md) 0;
}

.chart-bar {
    flex: 1;
    background: var(--primary-gradient);
    border-radius: 2px;
    min-height: 20%;
    animation: chartGrow 1s ease-out;
}

@keyframes chartGrow {
    from { height: 0; }
    to { height: var(--height); }
}

.progress-ring {
    position: relative;
    width: 60px;
    height: 60px;
    margin: var(--space-md) 0;
}

.progress-svg {
    transform: rotate(-90deg);
}

.progress-bg {
    fill: none;
    stroke: var(--border-muted);
    stroke-width: 3;
}

.progress-fill {
    fill: none;
    stroke: var(--stellantis-secondary);
    stroke-width: 3;
    stroke-linecap: round;
    transition: stroke-dashoffset 1s ease;
}

.progress-text {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 0.875rem;
    font-weight: 700;
    color: var(--text-primary);
}

.user-avatars {
    display: flex;
    margin: var(--space-md) 0;
}

.avatar {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    border: 2px solid var(--card-border);
    margin-left: -8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: 600;
}

.avatar-1 { background: var(--primary-gradient); }
.avatar-2 { background: var(--success-gradient); }
.avatar-3 { background: var(--warning-gradient); }
.avatar-more { background: var(--glass-bg); color: var(--text-primary); }

.uptime-indicator {
    margin: var(--space-md) 0;
}

.uptime-bar {
    width: 100%;
    height: 6px;
    background: var(--border-muted);
    border-radius: 3px;
    overflow: hidden;
    margin-bottom: var(--space-sm);
}

.uptime-fill {
    height: 100%;
    background: var(--success-gradient);
    border-radius: 3px;
    transition: width 1s ease;
}

.uptime-status {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    font-size: 0.75rem;
    color: var(--text-muted);
}

.status-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--stellantis-secondary);
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: var(--space-lg);
    padding-top: var(--space-md);
    border-top: 1px solid var(--border-muted);
}

.trend-indicator {
    display: flex;
    align-items: center;
    gap: 0.25rem;
    font-size: 0.75rem;
    font-weight: 600;
}

.trend-indicator.positive { color: var(--stellantis-secondary); }
.trend-indicator.negative { color: #ef4444; }
.trend-indicator.neutral { color: var(--stellantis-gold); }

.trend-text {
    font-size: 0.75rem;
    color: var(--text-muted);
}

/* Product Lines Section */
.product-lines-section {
    position: relative;
    z-index: 10;
    padding: 6rem var(--space-xl);
}

.section-container {
    max-width: 1400px;
    margin: 0 auto;
}

.section-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 4rem;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0 0 var(--space-md) 0;
}

.section-subtitle {
    font-size: 1.125rem;
    color: var(--text-secondary);
    margin: 0;
    max-width: 600px;
}

.view-toggle {
    display: flex;
    gap: var(--space-sm);
    background: var(--glass-bg);
    border-radius: var(--radius-xl);
    padding: var(--space-sm);
    border: 1px solid var(--glass-border);
}

.toggle-btn {
    width: 40px;
    height: 40px;
    border: none;
    background: transparent;
    color: var(--text-muted);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition-normal);
    cursor: pointer;
}

.toggle-btn.active,
.toggle-btn:hover {
    background: var(--primary-gradient);
    color: white;
}

.product-lines-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: var(--space-2xl);
}

/* Product Line Cards */
.product-line-card {
    position: relative;
    background: var(--card-bg);
    backdrop-filter: blur(20px);
    border: 1px solid var(--card-border);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    min-height: 600px;
}

.product-line-card:hover {
    transform: translateY(-15px) scale(1.02);
    border-color: var(--border-primary);
    box-shadow: var(--shadow-2xl);
}

.card-background {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 1;
}

.bg-pattern {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        radial-gradient(circle at 25% 25%, var(--glass-border) 0%, transparent 50%),
        radial-gradient(circle at 75% 75%, var(--glass-border) 0%, transparent 50%);
    background-size: 100px 100px;
}

.bg-gradient {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 50%;
    opacity: 0.1;
}

.las-gradient { background: var(--primary-gradient); }
.str-gradient { background: var(--success-gradient); }
.ctr-gradient { background: var(--warning-gradient); }

.bg-mesh {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(var(--border-secondary) 1px, transparent 1px),
        linear-gradient(90deg, var(--border-secondary) 1px, transparent 1px);
    background-size: 20px 20px;
}

.card-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    right: -50%;
    bottom: -50%;
    opacity: 0;
    transition: opacity 0.5s ease;
    z-index: 0;
    pointer-events: none;
}

.las-glow { background: radial-gradient(circle, rgba(5, 150, 105, 0.2) 0%, transparent 70%); }
.str-glow { background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%); }
.ctr-glow { background: radial-gradient(circle, rgba(245, 158, 11, 0.2) 0%, transparent 70%); }

.product-line-card:hover .card-glow {
    opacity: 1;
}

.card-content {
    position: relative;
    z-index: 2;
    padding: var(--space-xl);
    height: 100%;
    display: flex;
    flex-direction: column;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: var(--space-xl);
}

.product-badge {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    padding: var(--space-md) var(--space-lg);
    border-radius: var(--radius-2xl);
    font-weight: 700;
    font-size: 0.875rem;
    position: relative;
    overflow: hidden;
}

.las-badge { background: var(--primary-gradient); }
.str-badge { background: var(--success-gradient); }
.ctr-badge { background: var(--warning-gradient); }

.badge-text {
    color: white;
    font-weight: 800;
    letter-spacing: 0.1em;
}

.badge-indicator {
    width: 8px;
    height: 8px;
    background: rgba(255, 255, 255, 0.8);
    border-radius: 50%;
    animation: pulse-indicator 2s infinite;
}

@keyframes pulse-indicator {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.2); }
}

.card-status {
    display: flex;
    align-items: center;
    gap: var(--space-sm);
    font-size: 0.75rem;
    color: var(--text-muted);
}

.status-dot.active {
    width: 8px;
    height: 8px;
    background: var(--stellantis-secondary);
    border-radius: 50%;
    animation: pulse-dot 2s infinite;
}

.card-body {
    flex: 1;
    margin-bottom: var(--space-xl);
}

.product-icon {
    width: 80px;
    height: 80px;
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    margin-bottom: var(--space-xl);
    position: relative;
    box-shadow: var(--shadow-lg);
}

.las-icon { background: var(--primary-gradient); }
.str-icon { background: var(--success-gradient); }
.ctr-icon { background: var(--warning-gradient); }

.icon-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    right: -50%;
    bottom: -50%;
    background: inherit;
    border-radius: inherit;
    opacity: 0;
    filter: blur(20px);
    transition: var(--transition-normal);
}

.product-line-card:hover .icon-glow {
    opacity: 0.6;
}

.product-title {
    font-size: 1.75rem;
    font-weight: 800;
    color: var(--text-primary);
    margin: 0 0 var(--space-md) 0;
    line-height: 1.3;
}

.product-description {
    color: var(--text-secondary);
    line-height: 1.6;
    margin: 0 0 var(--space-xl) 0;
    font-size: 0.95rem;
}

.product-stats {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-md);
    margin-bottom: var(--space-xl);
}

.stat-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    padding: var(--space-md);
    background: var(--glass-bg);
    border-radius: var(--radius-xl);
    border: 1px solid var(--glass-border);
}

.stat-icon {
    width: 32px;
    height: 32px;
    background: var(--glass-bg);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    font-size: 0.875rem;
    margin-bottom: var(--space-sm);
}

.stat-content {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    line-height: 1;
}

.stat-label {
    font-size: 0.75rem;
    color: var(--text-muted);
    margin-top: 0.25rem;
}

.technology-tags {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-sm);
    margin-bottom: var(--space-xl);
}

.tech-tag {
    padding: var(--space-sm) var(--space-md);
    background: var(--glass-bg);
    border: 1px solid var(--glass-border);
    border-radius: var(--radius-2xl);
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--text-secondary);
    transition: var(--transition-normal);
}

.tech-tag:hover {
    background: var(--primary-gradient);
    color: white;
    border-color: transparent;
}

.card-footer {
    margin-top: auto;
}

.access-button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    width: 100%;
    padding: var(--space-lg) var(--space-xl);
    border-radius: var(--radius-2xl);
    text-decoration: none;
    font-weight: 700;
    font-size: 0.95rem;
    color: white;
    position: relative;
    overflow: hidden;
    transition: var(--transition-normal);
}

.las-button { background: var(--primary-gradient); }
.str-button { background: var(--success-gradient); }
.ctr-button { background: var(--warning-gradient); }

.access-button:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-xl);
    color: white;
    text-decoration: none;
}

.button-text {
    position: relative;
    z-index: 2;
}

.button-icon {
    position: relative;
    z-index: 2;
    transition: var(--transition-normal);
}

.access-button:hover .button-icon {
    transform: translateX(5px);
}

.button-glow {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s ease;
}

.access-button:hover .button-glow {
    left: 100%;
}

.card-particles {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    pointer-events: none;
    z-index: 1;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--border-primary);
    border-radius: 50%;
    animation: particle-float 6s infinite ease-in-out;
}

.particle-1 {
    top: 20%;
    left: 20%;
    animation-delay: 0s;
}

.particle-2 {
    top: 60%;
    right: 30%;
    animation-delay: -2s;
}

.particle-3 {
    bottom: 30%;
    left: 70%;
    animation-delay: -4s;
}

@keyframes particle-float {
    0%, 100% { transform: translateY(0px); opacity: 0.3; }
    50% { transform: translateY(-20px); opacity: 1; }
}

/* Responsive Design */
@media (max-width: 1200px) {
    .hero-container {
        grid-template-columns: 1fr;
        text-align: center;
        gap: var(--space-2xl);
    }
    
    .hero-title {
        font-size: 3rem;
    }
    
    .product-lines-grid {
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: var(--space-xl);
    }
}

@media (max-width: 768px) {
    .ultra-professional-container {
        margin: -2rem -1rem 0 -1rem;
    }
    
    .hero-section {
        padding: 4rem var(--space-md);
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-metrics {
        flex-direction: column;
        gap: var(--space-md);
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .product-lines-grid {
        grid-template-columns: 1fr;
    }
    
    .section-header {
        flex-direction: column;
        gap: var(--space-xl);
        text-align: center;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .product-stats {
        grid-template-columns: 1fr;
    }
    
    .breadcrumb-section,
    .stats-dashboard,
    .product-lines-section {
        padding-left: var(--space-md);
        padding-right: var(--space-md);
    }
}

@media (max-width: 480px) {
    .card-content {
        padding: var(--space-lg);
    }
    
    .product-line-card {
        min-height: 500px;
    }
    
    .hero-badge {
        flex-direction: column;
        text-align: center;
        gap: var(--space-sm);
    }
}

/* Animation Delays for Staggered Loading */
.product-line-card:nth-child(1) { animation-delay: 0.1s; }
.product-line-card:nth-child(2) { animation-delay: 0.2s; }
.product-line-card:nth-child(3) { animation-delay: 0.3s; }

/* Accessibility */
.access-button:focus,
.control-btn:focus,
.toggle-btn:focus {
    outline: 2px solid var(--stellantis-primary);
    outline-offset: 2px;
}

/* Performance Optimizations */
.product-line-card:hover {
    will-change: transform;
}

/* Theme-specific adjustments */
html[data-theme="dark"] .ultra-professional-container {
    background: var(--bg-gradient);
}

html[data-theme="dark"] .orb-core {
    box-shadow: 0 0 50px rgba(16, 185, 129, 0.6);
}

html[data-theme="dark"] .pulse-glow {
    0%, 100% { box-shadow: 0 0 50px rgba(16, 185, 129, 0.6); }
    50% { box-shadow: 0 0 80px rgba(16, 185, 129, 0.9); }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Page loaded, initializing functionality...');
    
    // Initialize all functionality
    initializeAnimations();
    loadDataAndStats();
    setupInteractivity();
    setupIntersectionObserver();
    
    // Initialize Animations
    function initializeAnimations() {
        console.log('Initializing animations...');
        
        // Stagger card animations
        const cards = document.querySelectorAll('.product-line-card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(50px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.8s cubic-bezier(0.4, 0, 0.2, 1)';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 200 * (index + 1));
        });
        
        // Animate stats cards
        const statCards = document.querySelectorAll('.premium-card');
        statCards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100 * (index + 1));
        });
    }
    
    // Load Data and Stats
    function loadDataAndStats() {
        console.log('Loading data and stats...');
        
        // Load file counts for each product line
        const productLines = ['LAS', 'STR', 'CTR'];
        let totalFiles = 0;
        
        productLines.forEach(type => {
            fetch(`/gammes/count/${type}`)
                .then(response => response.json())
                .then(data => {
                    const count = data.success ? data.count : 0;
                    totalFiles += count;
                    
                    // Update individual product line counts
                    const countElement = document.getElementById(`${type.toLowerCase()}-file-count`);
                    if (countElement) {
                        animateNumber(countElement, 0, count, 1500);
                    }
                    
                    // Update total files in hero and dashboard
                    updateTotalFiles(totalFiles);
                })
                .catch(error => {
                    console.error(`Error loading count for ${type}:`, error);
                });
        });
        
        // Simulate other metrics
        setTimeout(() => {
            animateNumber(document.getElementById('totalDocuments'), 0, 1247, 2000);
        }, 500);
    }
    
    function updateTotalFiles(total) {
        const heroMetric = document.getElementById('totalFilesMetric');
        
        if (heroMetric) {
            animateNumber(heroMetric, 0, total, 2000);
        }
    }
    
    // Setup Interactivity
    function setupInteractivity() {
        console.log('Setting up interactivity...');
        
        // Product line card click handlers
        document.querySelectorAll('.product-line-card').forEach(card => {
            card.addEventListener('click', function(e) {
                if (!e.target.closest('.access-button')) {
                    const button = this.querySelector('.access-button');
                    if (button) {
                        // Add click animation
                        this.style.transform = 'scale(0.98)';
                        setTimeout(() => {
                            this.style.transform = '';
                            window.location.href = button.href;
                        }, 150);
                    }
                }
            });
            
            // Enhanced hover effects
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-15px) scale(1.02)';
                
                // Activate particles
                const particles = this.querySelectorAll('.particle');
                particles.forEach(particle => {
                    particle.style.animationPlayState = 'running';
                });
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });
        
        // Dashboard controls - FIXED VERSION
        document.querySelectorAll('.control-btn').forEach(btn => {
            console.log('Adding event listener to button:', btn.dataset.period);
            
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('Dashboard button clicked:', this.dataset.period);
                
                // Remove active class from all buttons
                document.querySelectorAll('.control-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Simulate data refresh
                refreshDashboardData(this.dataset.period);
            });
        });
        
        // View toggle - FIXED VERSION
        document.querySelectorAll('.toggle-btn').forEach(btn => {
            console.log('Adding event listener to toggle button:', btn.dataset.view);
            
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                console.log('View toggle button clicked:', this.dataset.view);
                
                // Remove active class from all buttons
                document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                
                // Toggle view (grid or list)
                const view = this.dataset.view;
                toggleProductLinesView(view);
            });
        });
        
        // Access button hover effects
        document.querySelectorAll('.access-button').forEach(btn => {
            btn.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.boxShadow = '0 20px 40px rgba(0, 0, 0, 0.4)';
            });
            
            btn.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });
    }
    
    // Setup Intersection Observer for scroll animations
    function setupIntersectionObserver() {
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-in');
                    
                    // Trigger specific animations based on element type
                    if (entry.target.classList.contains('premium-card')) {
                        animateStatsCard(entry.target);
                    }
                    
                    if (entry.target.classList.contains('product-line-card')) {
                        animateProductCard(entry.target);
                    }
                }
            });
        }, observerOptions);
        
        // Observe elements
        document.querySelectorAll('.premium-card, .product-line-card, .hero-metrics').forEach(el => {
            observer.observe(el);
        });
    }
    
    // Utility Functions
    function animateNumber(element, start, end, duration) {
        if (!element) return;
        
        const startTime = performance.now();
        const range = end - start;
        
        function updateNumber(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = Math.floor(start + (range * easeOutQuart));
            
            element.textContent = current.toLocaleString();
            
            if (progress < 1) {
                requestAnimationFrame(updateNumber);
            } else {
                element.textContent = end.toLocaleString();
            }
        }
        
        requestAnimationFrame(updateNumber);
    }
    
    function animateStatsCard(card) {
        // Animate chart bars
        const chartBars = card.querySelectorAll('.chart-bar');
        chartBars.forEach((bar, index) => {
            setTimeout(() => {
                bar.style.transform = 'scaleY(1)';
                bar.style.transformOrigin = 'bottom';
            }, index * 100);
        });
        
        // Animate progress rings
        const progressFill = card.querySelector('.progress-fill');
        if (progressFill) {
            setTimeout(() => {
                progressFill.style.strokeDashoffset = '47';
            }, 500);
        }
        
        // Animate uptime bar
        const uptimeFill = card.querySelector('.uptime-fill');
        if (uptimeFill) {
            setTimeout(() => {
                uptimeFill.style.width = '98.7%';
            }, 300);
        }
    }
    
    function animateProductCard(card) {
        // Animate technology tags
        const techTags = card.querySelectorAll('.tech-tag');
        techTags.forEach((tag, index) => {
            setTimeout(() => {
                tag.style.opacity = '1';
                tag.style.transform = 'translateY(0)';
            }, index * 100);
        });
        
        // Animate stats
        const statNumbers = card.querySelectorAll('.stat-number');
        statNumbers.forEach((stat, index) => {
            if (stat.id.includes('file-count')) return; // Skip file counts as they're handled separately
            
            const value = parseInt(stat.textContent) || 0;
            setTimeout(() => {
                animateNumber(stat, 0, value, 1000);
            }, index * 200);
        });
    }
    
    function refreshDashboardData(period) {
        console.log(`Refreshing dashboard data for period: ${period}`);
        
        // Show visual feedback that the button is working
        const activeBtn = document.querySelector(`.control-btn[data-period="${period}"]`);
        if (activeBtn) {
            activeBtn.style.transform = 'scale(0.95)';
            activeBtn.style.background = 'var(--primary-gradient)';
            activeBtn.style.color = 'white';
            setTimeout(() => {
                activeBtn.style.transform = '';
            }, 200);
        }
        
        // Simulate data refresh based on period
        const multipliers = {
            'today': 1,
            'week': 7,
            'month': 30
        };
        
        const multiplier = multipliers[period] || 1;
        
        // Update dashboard metrics with animation
        setTimeout(() => {
            const totalDocs = document.getElementById('totalDocuments');
            if (totalDocs) {
                const baseValue = 1247;
                const newValue = Math.floor(baseValue * (0.8 + (multiplier * 0.1)));
                const currentValue = parseInt(totalDocs.textContent.replace(/,/g, '')) || 0;
                animateNumber(totalDocs, currentValue, newValue, 1000);
            }
            
            // Update download metrics
            const downloadsValue = document.getElementById('downloadsValue');
            if (downloadsValue) {
                const baseDownloads = period === 'today' ? 2.4 : (period === 'week' ? 16.8 : 72.3);
                downloadsValue.textContent = `${baseDownloads.toFixed(1)}K`;
            }
            
            // Update users metrics
            const usersValue = document.getElementById('usersValue');
            if (usersValue) {
                const baseUsers = period === 'today' ? 847 : (period === 'week' ? 1243 : 1876);
                const currentUsers = parseInt(usersValue.textContent.replace(/,/g, '')) || 0;
                animateNumber(usersValue, currentUsers, baseUsers, 1000);
            }
            
            // Update trend indicators
            const trendTexts = {
                'today': 'vs yesterday',
                'week': 'vs last week', 
                'month': 'vs last month'
            };
            
            document.querySelectorAll('.trend-text').forEach(trend => {
                trend.textContent = trendTexts[period] || 'vs last period';
            });
            
        }, 200);
    }

    function toggleProductLinesView(view) {
        console.log(`Switching to ${view} view`);
        
        // Show visual feedback that the button is working
        const activeBtn = document.querySelector(`.toggle-btn[data-view="${view}"]`);
        if (activeBtn) {
            activeBtn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                activeBtn.style.transform = '';
            }, 200);
        }
        
        const grid = document.getElementById('productLinesGrid');
        
        if (view === 'list') {
            grid.style.gridTemplateColumns = '1fr';
            grid.style.gap = 'var(--space-md)';
            
            // Modify cards for list view
            document.querySelectorAll('.product-line-card').forEach(card => {
                card.style.minHeight = '200px';
                card.style.transition = 'all 0.3s ease';
                
                const cardContent = card.querySelector('.card-content');
                if (cardContent) {
                    cardContent.style.flexDirection = 'row';
                    cardContent.style.alignItems = 'center';
                    cardContent.style.gap = 'var(--space-xl)';
                }
                
                const cardBody = card.querySelector('.card-body');
                if (cardBody) {
                    cardBody.style.marginBottom = '0';
                    cardBody.style.display = 'flex';
                    cardBody.style.flexDirection = 'column';
                    cardBody.style.justifyContent = 'center';
                }
                
                const cardFooter = card.querySelector('.card-footer');
                if (cardFooter) {
                    cardFooter.style.marginTop = '0';
                    cardFooter.style.width = '200px';
                    cardFooter.style.flexShrink = '0';
                }
                
                const productStats = card.querySelector('.product-stats');
                if (productStats) {
                    productStats.style.display = 'none';
                }
                
                const techTags = card.querySelector('.technology-tags');
                if (techTags) {
                    techTags.style.display = 'none';
                }
            });
        } else {
            grid.style.gridTemplateColumns = 'repeat(auto-fit, minmax(400px, 1fr))';
            grid.style.gap = 'var(--space-2xl)';
            
            // Reset cards for grid view
            document.querySelectorAll('.product-line-card').forEach(card => {
                card.style.minHeight = '600px';
                
                const cardContent = card.querySelector('.card-content');
                if (cardContent) {
                    cardContent.style.flexDirection = 'column';
                    cardContent.style.alignItems = 'stretch';
                    cardContent.style.gap = '';
                }
                
                const cardBody = card.querySelector('.card-body');
                if (cardBody) {
                    cardBody.style.marginBottom = 'var(--space-xl)';
                    cardBody.style.display = '';
                    cardBody.style.flexDirection = '';
                    cardBody.style.justifyContent = '';
                }
                
                const cardFooter = card.querySelector('.card-footer');
                if (cardFooter) {
                    cardFooter.style.marginTop = 'auto';
                    cardFooter.style.width = '';
                    cardFooter.style.flexShrink = '';
                }
                
                const productStats = card.querySelector('.product-stats');
                if (productStats) {
                    productStats.style.display = 'grid';
                }
                
                const techTags = card.querySelector('.technology-tags');
                if (techTags) {
                    techTags.style.display = 'flex';
                }
            });
        }
    }
        
    // Advanced particle system
    function createParticleSystem() {
        const particles = document.querySelectorAll('.particle');
        
        particles.forEach(particle => {
            // Random movement
            setInterval(() => {
                const x = Math.random() * 20 - 10;
                const y = Math.random() * 20 - 10;
                particle.style.transform = `translate(${x}px, ${y}px)`;
            }, 2000 + Math.random() * 3000);
        });
    }
    
    // Initialize particle system
    createParticleSystem();
    
    // Performance optimization: Throttle scroll events
    let ticking = false;
    
    function updateScrollEffects() {
        const scrollY = window.scrollY;
        const shapes = document.querySelectorAll('.shape');
        
        shapes.forEach((shape, index) => {
            const speed = 0.5 + (index * 0.1);
            shape.style.transform = `translateY(${scrollY * speed}px) rotate(${scrollY * 0.1}deg)`;
        });
        
        ticking = false;
    }
    
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(updateScrollEffects);
            ticking = true;
        }
    });
    
    // Add loading completion class
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 1000);
    
    // Preload hover states for better performance
    document.querySelectorAll('.product-line-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.willChange = 'transform';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.willChange = 'auto';
        });
    });
    
    console.log('All functionality initialized successfully!');
});

// Global utility functions
window.navigateToProductLine = function(type) {
    const card = document.querySelector(`[data-product="${type}"]`);
    if (card) {
        card.style.transform = 'scale(0.95)';
        setTimeout(() => {
            window.location.href = `/gammes/${type}/files`;
        }, 200);
    }
};

// Add CSS for loaded state
const loadedStyles = `
    .loaded .floating-shapes .shape {
        animation-play-state: running;
    }
    
    .loaded .grid-overlay {
        animation-play-state: running;
    }
`;

const styleSheet = document.createElement('style');
styleSheet.textContent = loadedStyles;
document.head.appendChild(styleSheet);
</script>
@endsection
