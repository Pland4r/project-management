<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    
    <style>
        /* Reset and Base Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            /* Light Mode Variables */
            --bg-primary: #f8fafc;
            --bg-secondary: #ffffff;
            --bg-tertiary: #f8fafc;
            --bg-card: #ffffff;
            
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            
            --border-primary: #e2e8f0;
            --border-secondary: rgba(25, 20, 0, 0.2);
            --border-hover: rgba(25, 20, 0, 0.29);
            
            --stellantis-primary: #2563eb;
            --stellantis-secondary: #3b82f6;
            --stellantis-accent: #1d4ed8;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            
            --gradient-primary: linear-gradient(135deg, #2563eb, #3b82f6);
            --gradient-secondary: linear-gradient(135deg, #1d4ed8, #2563eb);
            --gradient-bg: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            
            --transition-normal: 0.3s ease;
            --transition-fast: 0.2s ease;
        }

        /* Dark Mode Variables */
        html[data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-card: #1e293b;
            
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-muted: #94a3b8;
            
            --border-primary: #334155;
            --border-secondary: rgba(255, 255, 255, 0.1);
            --border-hover: rgba(255, 255, 255, 0.2);
            
            --stellantis-primary: #3b82f6;
            --stellantis-secondary: #2563eb;
            --stellantis-accent: #60a5fa;
            
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
            
            --gradient-primary: linear-gradient(135deg, #3b82f6, #2563eb);
            --gradient-secondary: linear-gradient(135deg, #2563eb, #1d4ed8);
            --gradient-bg: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            background: var(--gradient-bg);
            background-attachment: fixed;
            padding: 1.5rem 1.5rem 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
            transition: background var(--transition-normal), color var(--transition-normal);
        }

        /* Dark Mode Toggle Switch */
        .theme-switch-wrapper {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            align-items: center;
        }

        .theme-switch {
            display: inline-block;
            position: relative;
            width: 50px;
            height: 24px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: var(--border-primary);
            transition: .4s;
            border-radius: 24px;
            backdrop-filter: blur(10px);
            box-shadow: var(--shadow-md);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: var(--bg-secondary);
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        input:checked + .slider {
            background-color: var(--stellantis-primary);
        }

        input:checked + .slider:before {
            transform: translateX(26px);
        }

        .slider .icon {
            position: absolute;
            top: 4px;
            transition: .4s;
            color: var(--text-secondary);
            font-size: 12px;
            z-index: 1;
        }

        .slider .sun {
            left: 6px;
            opacity: 1;
        }

        .slider .moon {
            right: 6px;
            opacity: 0;
        }

        input:checked + .slider .sun {
            opacity: 0;
        }

        input:checked + .slider .moon {
            opacity: 1;
            color: white;
        }

        /* Header Section */
        header {
            width: 100%;
            max-width: 335px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
            position: relative;
            transition: all var(--transition-normal);
        }

        @media (min-width: 1024px) {
            header {
                max-width: 56rem;
            }
        }

        .header-logo-container {
            margin-bottom: 1rem;
            display: flex;
            justify-content: center;
        }

        .logo {
            background: var(--gradient-primary);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: var(--shadow-md);
            transition: all var(--transition-normal);
        }

        .logo:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .logo-text {
            color: white;
            font-weight: bold;
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        /* Laravel Blade Navigation Styles */
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-end { justify-content: flex-end; }
        .gap-4 { gap: 1rem; }
        .inline-block { display: inline-block; }
        .px-5 { padding-left: 1.25rem; padding-right: 1.25rem; }
        .py-1\.5 { padding-top: 0.375rem; padding-bottom: 0.375rem; }
        .text-sm { font-size: 0.875rem; }
        .leading-normal { line-height: 1.5; }
        .border { border-width: 1px; border-style: solid; }
        .border-transparent { border-color: transparent; }
        .rounded-sm { border-radius: 0.125rem; }
        .text-\[#1b1b18\] { color: var(--text-primary); }
        .border-\[#19140035\] { border-color: var(--border-secondary); }
        .hover\:border-\[#19140035\]:hover { border-color: var(--border-secondary); }
        .hover\:border-\[#1915014a\]:hover { border-color: var(--border-hover); }
        .dark\:text-\[#EDEDEC\] { color: var(--text-primary); }
        .dark\:border-\[#3E3E3A\] { border-color: var(--border-primary); }
        .dark\:hover\:border-\[#3E3E3A\]:hover { border-color: var(--border-primary); }
        .dark\:hover\:border-\[#62605b\]:hover { border-color: var(--border-hover); }
        .not-has-\[nav\]\:hidden:not(:has(nav)) { display: none; }

        header nav a {
            text-decoration: none;
            transition: all var(--transition-fast);
            color: var(--text-primary);
            border-radius: 6px;
            backdrop-filter: blur(10px);
        }

        header nav a:hover {
            background: var(--bg-tertiary);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }

        /* Real-time Statistics Section */
        .stats-section {
            padding: 4rem 2rem;
            background: var(--bg-primary);
            width: 100%;
            max-width: 1200px;
            border-radius: 16px;
            margin-bottom: 2rem;
            transition: background var(--transition-normal);
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .stats-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .stats-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text-primary);
            transition: color var(--transition-normal);
        }

        .last-updated {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--text-secondary);
            font-size: 0.875rem;
            background: var(--bg-card);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-primary);
        }

        .pulse-dot {
            width: 8px;
            height: 8px;
            background: var(--stellantis-primary);
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--bg-card);
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            transition: all var(--transition-normal);
            position: relative;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient-primary);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .stat-icon {
            width: 24px;
            height: 24px;
            color: var(--stellantis-primary);
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            transition: color var(--transition-normal);
        }

        .stat-change {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .stat-change.positive {
            color: var(--stellantis-primary);
        }

        .stat-change.negative {
            color: #ef4444;
        }

        .stat-description {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-top: 0.5rem;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: var(--bg-tertiary);
            border-radius: 4px;
            overflow: hidden;
            margin-top: 1rem;
        }

        .progress-fill {
            height: 100%;
            background: var(--gradient-primary);
            border-radius: 4px;
            transition: width 1s ease;
        }

        .detailed-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .detailed-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 2rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            transition: all var(--transition-normal);
        }

        .detailed-card h3 {
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--text-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .metric-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border-primary);
        }

        .metric-row:last-child {
            border-bottom: none;
        }

        .metric-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .metric-value {
            font-weight: 600;
            color: var(--text-primary);
        }

        .badge {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            background: var(--bg-tertiary);
            color: var(--stellantis-primary);
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: 600;
            border: 1px solid var(--stellantis-primary);
        }

        /* Hero Section */
        .hero-section {
            padding: 4rem 2rem;
            background: var(--bg-primary);
            width: 100%;
            max-width: 1200px;
            border-radius: 16px;
            margin-bottom: 2rem;
            transition: background var(--transition-normal);
        }

        .hero-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .hero-card {
            background: var(--bg-card);
            border-radius: 16px;
            box-shadow: var(--shadow-xl);
            overflow: hidden;
            display: grid;
            grid-template-columns: 1fr 1fr;
            min-height: 500px;
            transition: all var(--transition-normal);
            border: 1px solid var(--border-primary);
        }

        .hero-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-xl);
        }

        .hero-image {
            position: relative;
            overflow: hidden;
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(37, 99, 235, 0.2), rgba(59, 130, 246, 0.1));
            z-index: 2;
        }

        .hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.1s ease-out;
            will-change: transform;
        }

        .hero-card:hover .hero-img {
            transform: translateY(var(--parallax-offset, 0)) scale(1.08) !important;
        }

        .hero-content {
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            gap: 1.5rem;
            background: var(--bg-card);
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--text-primary);
            line-height: 1.2;
            transition: color var(--transition-normal);
        }

        .highlight {
            color: var(--stellantis-primary);
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.6;
            transition: color var(--transition-normal);
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary, .btn-secondary {
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all var(--transition-normal);
            font-size: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background: var(--gradient-primary);
            color: white;
            box-shadow: var(--shadow-md);
        }

        .btn-primary:hover {
            background: var(--gradient-secondary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        .btn-secondary {
            background: transparent;
            color: var(--stellantis-primary);
            border: 2px solid var(--stellantis-primary);
            backdrop-filter: blur(10px);
        }

        .btn-secondary:hover {
            background: var(--bg-tertiary);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* About Section */
        .about-section {
            padding: 4rem 2rem;
            background: var(--bg-primary);
            width: 100%;
            max-width: 1200px;
            border-radius: 16px;
            margin-bottom: 2rem;
            transition: background var(--transition-normal);
        }

        .about-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-card {
            background: var(--bg-card);
            border-radius: 16px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            transition: all var(--transition-normal);
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--text-primary);
            transition: color var(--transition-normal);
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .about-item {
            padding: 1.5rem;
            border-radius: 12px;
            background: var(--bg-tertiary);
            border-left: 4px solid var(--stellantis-primary);
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
        }

        .about-item:hover {
            transform: translateX(5px);
            box-shadow: var(--shadow-md);
        }

        .about-full {
            grid-column: 1 / -1;
        }

        .about-subtitle {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--stellantis-primary);
            margin-bottom: 1rem;
            transition: color var(--transition-normal);
        }

        .about-text {
            color: var(--text-secondary);
            line-height: 1.7;
            transition: color var(--transition-normal);
        }

        /* Brands Section */
        .brands-section {
            padding: 4rem 2rem;
            background: var(--bg-secondary);
            width: 100%;
            max-width: 1200px;
            border-radius: 16px;
            transition: background var(--transition-normal);
        }

        .brands-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .brands-card {
            background: var(--bg-tertiary);
            border-radius: 16px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-primary);
            transition: all var(--transition-normal);
        }

        .brands-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .brands-description {
            font-size: 1.1rem;
            color: var(--text-secondary);
            max-width: 600px;
            margin: 1rem auto 0;
            transition: color var(--transition-normal);
        }

        .brands-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .brand-item {
            background: var(--bg-card);
            padding: 2rem;
            border-radius: 12px;
            text-align: center;
            border: 2px solid var(--border-primary);
            transition: all var(--transition-normal);
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .brand-item:hover {
            border-color: var(--stellantis-primary);
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .brand-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--bg-tertiary), var(--bg-primary));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: bold;
            color: var(--stellantis-primary);
            margin: 0 auto 1rem;
            transition: all var(--transition-normal);
            box-shadow: var(--shadow-sm);
        }

        .brand-item:hover .brand-icon {
            background: var(--gradient-primary);
            color: white;
            transform: scale(1.1);
            box-shadow: var(--shadow-md);
        }

        .brand-name {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
            transition: color var(--transition-normal);
        }

        .brand-desc {
            color: var(--text-secondary);
            font-size: 0.9rem;
            transition: color var(--transition-normal);
        }

        /* Font Awesome Icons */
        .fa-sun, .fa-moon {
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }

        .fa-sun::before { content: '\f185'; }
        .fa-moon::before { content: '\f186'; }

        /* Responsive Design */
        @media (max-width: 768px) {
            body { padding: 1rem; }
            header { max-width: 335px; }
            .header-logo-container { margin-bottom: 0.5rem; }
            .gap-4 { gap: 0.5rem; }
            .px-5 { padding-left: 0.75rem; padding-right: 0.75rem; }
            .hero-card { grid-template-columns: 1fr; min-height: auto; }
            .hero-content { padding: 2rem; }
            .hero-title { font-size: 2rem; }
            .hero-buttons { flex-direction: column; }
            .about-card, .brands-card { padding: 2rem; }
            .section-title { font-size: 2rem; }
            .about-grid { grid-template-columns: 1fr; }
            .brands-grid { grid-template-columns: 1fr; }
            .theme-switch-wrapper { top: 10px; right: 10px; }
            .stats-section { padding: 2rem 1rem; }
            .stats-title { font-size: 2rem; }
            .stats-header { flex-direction: column; align-items: flex-start; }
            .stats-grid { grid-template-columns: 1fr; }
            .detailed-stats { grid-template-columns: 1fr; }
            .detailed-card { padding: 1.5rem; }
        }

        /* Animation Classes */
        .fade-in {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.6s ease;
        }

        .fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .slide-in-left {
            opacity: 0;
            transform: translateX(-50px);
            transition: all 0.6s ease;
        }

        .slide-in-left.visible {
            opacity: 1;
            transform: translateX(0);
        }

        .slide-in-right {
            opacity: 0;
            transform: translateX(50px);
            transition: all 0.6s ease;
        }

        .slide-in-right.visible {
            opacity: 1;
            transform: translateX(0);
        }

        /* Notification Styles */
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes slideOut {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: var(--bg-tertiary); }
        ::-webkit-scrollbar-thumb { background: var(--stellantis-primary); border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--stellantis-secondary); }
        
        a { color: #3b82f6; }
    </style>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <!-- Dark Mode Toggle -->
    <div class="theme-switch-wrapper">
        <label class="theme-switch" for="theme-toggle">
            <input type="checkbox" id="theme-toggle" />
            <span class="slider">
                <i class="fas fa-sun sun icon"></i>
                <i class="fas fa-moon moon icon"></i>
            </span>
        </label>
    </div>

    <!-- Header Section -->
    <header class="w-full lg:max-w-4xl max-w-[335px] text-sm mb-6 not-has-[nav]:hidden">
        <div class="header-logo-container">
            <div class="logo">
                <span class="logo-text">STELLANTIS</span>
            </div>
        </div>
        @if (Route::has('login'))
            <nav class="flex items-center justify-end gap-4">
            <a href="#" id="doc-btn" class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal" style="background: var(--stellantis-primary); color: white; font-weight: bold; text-decoration: none; border-radius: 999px;">Documentation</a>
                <a href="{{ route('restart.session') }}" 
                   class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] text-[#1b1b18] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm leading-normal">
                    Log in
                </a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                       class="inline-block px-5 py-1.5 dark:text-[#EDEDEC] border-[#19140035] hover:border-[#1915014a] border text-[#1b1b18] dark:border-[#3E3E3A] dark:hover:border-[#62605b] rounded-sm text-sm leading-normal">
                        Register
                    </a>
                @endif
            </nav>
        @endif
    </header>

    <!-- Documentation Section (hidden by default) -->
    <section id="documentation-section" style="display:none; max-width: 900px; margin: 0 auto 2rem auto; background: var(--bg-card); border-radius: 16px; box-shadow: var(--shadow-lg); border: 1px solid var(--border-primary); padding: 2.5rem; z-index: 100; position: relative;">
        <h2 style="font-size:2rem; font-weight:bold; color:var(--stellantis-primary); margin-bottom:1.5rem;">Documentation de la Plateforme</h2>
        <h3 style="color:var(--stellantis-secondary); margin-top:1.2rem;">Pour les utilisateurs simples :</h3>
        <ul style="margin-left:1.5rem; margin-bottom:1.5rem;">
            <li><b>Inscription :</b> Cliquez sur "Register" pour créer un compte. Attendez la validation de l'administrateur.</li>
            <li><b>Connexion :</b> Utilisez "Log in" pour accéder à votre espace.</li>
            <li><b>Créer un essai ou une mesure :</b> Dans un projet, cliquez sur "Créer un essai/messure" et complétez le formulaire.</li>
            <li><b>Gérer les éditeurs :</b> En tant que créateur d'un essai/messure, cliquez sur "Gérer les éditeurs" pour donner à d'autres utilisateurs le droit de modifier cet essai/messure.</li>
            <li><b>Consulter et modifier :</b> Vous pouvez consulter et modifier les essais/messures auxquels vous avez accès.</li>
            <li><b>Recevoir des rappels :</b> Vous recevrez des rappels automatiques par email selon les échéances définies.</li>
        </ul>
        <h3 style="color:var(--stellantis-secondary); margin-top:1.2rem;">Pour les administrateurs :</h3>
        <ul style="margin-left:1.5rem;">
            <li><b>Validation des utilisateurs :</b> Accédez à la liste des utilisateurs en attente et validez ou refusez les inscriptions.</li>
            <li><b>Gestion des projets :</b> Vous pouvez voir, modifier ou supprimer tous les projets.</li>
            <li><b>Gestion des essais/messures :</b> Vous avez un accès complet à tous les essais/messures et pouvez attribuer des droits d'édition à n'importe quel utilisateur.</li>
            <li><b>Suivi des activités :</b> Consultez l'historique des actions et des permissions attribuées.</li>
            <li><b>Configuration :</b> Accédez aux paramètres avancés pour personnaliser la plateforme selon les besoins de votre organisation.</li>
        </ul>
        <button onclick="document.getElementById('documentation-section').style.display='none'" style="margin-top:2rem; background:var(--stellantis-primary); color:white; border:none; border-radius:8px; padding:0.7rem 2rem; font-weight:bold; cursor:pointer;">Fermer la documentation</button>
    </section>

    <!-- Real-time Statistics Section -->
    <section class="stats-section">
        <div class="stats-container">
            <div class="stats-header">
                <h2 class="stats-title">Live Statistics</h2>
                <div class="last-updated">
                    <div class="pulse-dot"></div>
                    <span>Last updated: <span id="last-update-time">--:--:--</span></span>
                </div>
            </div>

            <!-- Key Metrics Grid -->
            <div class="stats-grid">
                <!-- Stock Price -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Stock Price (STLA)</span>
                        <i class="fas fa-dollar-sign stat-icon"></i>
                    </div>
                    <div class="stat-value" id="stock-price">$15.50</div>
                    <div class="stat-change" id="stock-change">
                        <i class="fas fa-arrow-up"></i>
                        <span>+0.25 (+1.64%)</span>
                    </div>
                    <div class="stat-description">NYSE: STLA</div>
                </div>

                <!-- Daily Production -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Daily Production</span>
                        <i class="fas fa-industry stat-icon"></i>
                    </div>
                    <div class="stat-value" id="daily-production">18,450</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+2.3% vs yesterday</span>
                    </div>
                    <div class="stat-description">vehicles manufactured today</div>
                </div>

                <!-- Global Sales -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Global Sales (YTD)</span>
                        <i class="fas fa-globe stat-icon"></i>
                    </div>
                    <div class="stat-value" id="global-sales">6.2M</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+5.8% vs last year</span>
                    </div>
                    <div class="stat-description">vehicles sold worldwide</div>
                </div>

                <!-- Market Share -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Market Share</span>
                        <i class="fas fa-chart-pie stat-icon"></i>
                    </div>
                    <div class="stat-value" id="market-share">11.2%</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+0.3% vs Q3</span>
                    </div>
                    <div class="stat-description">global automotive market</div>
                </div>

                <!-- EV Sales -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Electric Vehicle Sales</span>
                        <i class="fas fa-bolt stat-icon"></i>
                    </div>
                    <div class="stat-value" id="ev-sales">850K</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-up"></i>
                        <span>+45% vs last year</span>
                    </div>
                    <div class="stat-description">electric vehicles sold (YTD)</div>
                </div>

                <!-- Carbon Reduction -->
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-label">Carbon Reduction</span>
                        <i class="fas fa-leaf stat-icon"></i>
                    </div>
                    <div class="stat-value" id="carbon-reduction">-23.5%</div>
                    <div class="stat-change positive">
                        <i class="fas fa-arrow-down"></i>
                        <span>vs 2021 baseline</span>
                    </div>
                    <div class="stat-description">CO2 emissions reduction</div>
                </div>
            </div>

            <!-- Detailed Statistics -->
            <div class="detailed-stats">
                <!-- Production Metrics -->
                <div class="detailed-card">
                    <h3>
                        <i class="fas fa-cogs stat-icon"></i>
                        Production & Manufacturing
                    </h3>
                    <div class="metric-row">
                        <span class="metric-label">Monthly Production Target</span>
                        <span class="metric-value" id="monthly-target">450,000</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Current Month Progress</span>
                        <span class="metric-value" id="monthly-progress">320,000</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="production-progress" style="width: 71%"></div>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Manufacturing Plants</span>
                        <span class="metric-value">44</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Countries of Operation</span>
                        <span class="metric-value">30</span>
                    </div>
                </div>

                <!-- Sustainability Metrics -->
                <div class="detailed-card">
                    <h3>
                        <i class="fas fa-seedling stat-icon"></i>
                        Sustainability & Innovation
                    </h3>
                    <div class="metric-row">
                        <span class="metric-label">Electric Models Available</span>
                        <span class="metric-value" id="ev-models">45</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Renewable Energy Usage</span>
                        <span class="metric-value" id="renewable-energy">67.8%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" id="renewable-progress" style="width: 67.8%"></div>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">R&D Investment (Annual)</span>
                        <span class="metric-value">€7.4B</span>
                    </div>
                    <div class="metric-row">
                        <span class="metric-label">Carbon Net Zero Target</span>
                        <span class="badge">2038</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-container">
            <div class="hero-card">
                <div class="hero-image">
                    <div class="image-overlay"></div>
                    <img src="images/stellantis.png" alt="Stellantis Headquarters" class="hero-img">
                </div>
                <div class="hero-content">
                    <h1 class="hero-title">
                        Driving the Future of <span class="highlight">Mobility</span>
                    </h1>
                    <p class="hero-description">
                        Stellantis is a global automotive leader, shaping tomorrow's transportation through innovation, sustainability, and electrification.
                    </p>
                    <div class="hero-buttons">
                        <button class="btn-primary">Explore Our Brands</button>
                        <button class="btn-secondary">Learn More</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="about-container">
            <div class="about-card">
                <h2 class="section-title">About Stellantis</h2>
                <div class="about-grid">
                    <div class="about-item">
                        <h3 class="about-subtitle">Global Leadership</h3>
                        <p class="about-text">
                            Stellantis is a global automotive group formed in 2021 from the merger of Fiat Chrysler Automobiles (FCA) and PSA Group. It ranks among the world's leading car manufacturers, with a diverse portfolio of 14 iconic brands.
                        </p>
                    </div>
                    <div class="about-item">
                        <h3 class="about-subtitle">Innovation Focus</h3>
                        <p class="about-text">
                            Stellantis is committed to innovation, sustainability, and electrification, aiming to shape the future of mobility through its Dare Forward 2030 strategy.
                        </p>
                    </div>
                    <div class="about-item about-full">
                        <h3 class="about-subtitle">Sustainable Future</h3>
                        <p class="about-text">
                            Stellantis is at the forefront of transforming the automotive industry, focusing heavily on electrification, connectivity, and autonomous driving. Through its Dare Forward 2030 strategic plan, the company aims to become carbon net zero by 2038.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section class="brands-section">
        <div class="brands-container">
            <div class="brands-card">
                <div class="brands-header">
                    <h2 class="section-title">Our Iconic Brands</h2>
                    <p class="brands-description">
                        Discover the diverse portfolio of automotive brands that make up the Stellantis family
                    </p>
                </div>
                <div class="brands-grid">
                    <div class="brand-item" data-brand="peugeot">
                        <div class="brand-icon">P</div>
                        <h3 class="brand-name">Peugeot</h3>
                        <p class="brand-desc">French automotive excellence</p>
                    </div>
                    <div class="brand-item" data-brand="citroen">
                        <div class="brand-icon">C</div>
                        <h3 class="brand-name">Citroën</h3>
                        <p class="brand-desc">Creative automotive solutions</p>
                    </div>
                    <div class="brand-item" data-brand="fiat">
                        <div class="brand-icon">F</div>
                        <h3 class="brand-name">Fiat</h3>
                        <p class="brand-desc">Italian automotive heritage</p>
                    </div>
                    <div class="brand-item" data-brand="jeep">
                        <div class="brand-icon">J</div>
                        <h3 class="brand-name">Jeep</h3>
                        <p class="brand-desc">Adventure and capability</p>
                    </div>
                    <div class="brand-item" data-brand="opel">
                        <div class="brand-icon">O</div>
                        <h3 class="brand-name">Opel</h3>
                        <p class="brand-desc">German engineering precision</p>
                    </div>
                    <div class="brand-item" data-brand="chrysler">
                        <div class="brand-icon">C</div>
                        <h3 class="brand-name">Chrysler</h3>
                        <p class="brand-desc">American automotive innovation</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Real-time Statistics Data Management
        class StellantisDashboard {
            constructor() {
                this.data = {
                    stockPrice: { current: 15.50, change: 0.25, changePercent: 1.64 },
                    production: { daily: 18450, monthlyTarget: 450000, currentMonth: 320000 },
                    sales: { global: 6200000, ev: 850000, marketShare: 11.2 },
                    sustainability: { carbonReduction: 23.5, evModels: 45, renewableEnergy: 67.8 }
                };
                
                this.init();
                this.startRealTimeUpdates();
            }

            init() {
                this.updateDisplay();
                this.updateTimestamp();
            }

            generateRealisticData() {
                // Stock price fluctuation (±2%)
                const stockChange = (Math.random() - 0.5) * 0.8;
                this.data.stockPrice.current = Math.max(12, Math.min(20, this.data.stockPrice.current + stockChange));
                this.data.stockPrice.change = stockChange;
                this.data.stockPrice.changePercent = (stockChange / this.data.stockPrice.current) * 100;

                // Production variations (±5%)
                this.data.production.daily = Math.floor(18000 + Math.random() * 3000);
                this.data.production.currentMonth = Math.min(
                    this.data.production.monthlyTarget,
                    this.data.production.currentMonth + Math.floor(Math.random() * 2000)
                );

                // Sales growth simulation
                this.data.sales.global += Math.floor(Math.random() * 1000);
                this.data.sales.ev += Math.floor(Math.random() * 500);
                this.data.sales.marketShare = Math.max(10, Math.min(13, this.data.sales.marketShare + (Math.random() - 0.5) * 0.1));

                // Sustainability improvements
                this.data.sustainability.carbonReduction = Math.min(30, this.data.sustainability.carbonReduction + Math.random() * 0.1);
                this.data.sustainability.renewableEnergy = Math.min(100, this.data.sustainability.renewableEnergy + Math.random() * 0.2);
            }

            updateDisplay() {
                // Stock Price
                const stockPriceEl = document.getElementById('stock-price');
                const stockChangeEl = document.getElementById('stock-change');
                
                if (stockPriceEl) {
                    stockPriceEl.textContent = `$${this.data.stockPrice.current.toFixed(2)}`;
                }
                
                if (stockChangeEl) {
                    const isPositive = this.data.stockPrice.change >= 0;
                    const icon = isPositive ? 'fa-arrow-up' : 'fa-arrow-down';
                    const sign = isPositive ? '+' : '';
                    
                    stockChangeEl.className = `stat-change ${isPositive ? 'positive' : 'negative'}`;
                    stockChangeEl.innerHTML = `
                        <i class="fas ${icon}"></i>
                        <span>${sign}${this.data.stockPrice.change.toFixed(2)} (${sign}${this.data.stockPrice.changePercent.toFixed(2)}%)</span>
                    `;
                }

                // Production
                const dailyProductionEl = document.getElementById('daily-production');
                if (dailyProductionEl) {
                    dailyProductionEl.textContent = this.data.production.daily.toLocaleString();
                }

                // Sales
                const globalSalesEl = document.getElementById('global-sales');
                const marketShareEl = document.getElementById('market-share');
                const evSalesEl = document.getElementById('ev-sales');
                
                if (globalSalesEl) {
                    globalSalesEl.textContent = `${(this.data.sales.global / 1000000).toFixed(1)}M`;
                }
                if (marketShareEl) {
                    marketShareEl.textContent = `${this.data.sales.marketShare.toFixed(1)}%`;
                }
                if (evSalesEl) {
                    evSalesEl.textContent = `${Math.floor(this.data.sales.ev / 1000)}K`;
                }

                // Sustainability
                const carbonReductionEl = document.getElementById('carbon-reduction');
                const evModelsEl = document.getElementById('ev-models');
                const renewableEnergyEl = document.getElementById('renewable-energy');
                
                if (carbonReductionEl) {
                    carbonReductionEl.textContent = `-${this.data.sustainability.carbonReduction.toFixed(1)}%`;
                }
                if (evModelsEl) {
                    evModelsEl.textContent = this.data.sustainability.evModels.toString();
                }
                if (renewableEnergyEl) {
                    renewableEnergyEl.textContent = `${this.data.sustainability.renewableEnergy.toFixed(1)}%`;
                }

                // Detailed metrics
                const monthlyTargetEl = document.getElementById('monthly-target');
                const monthlyProgressEl = document.getElementById('monthly-progress');
                const productionProgressEl = document.getElementById('production-progress');
                const renewableProgressEl = document.getElementById('renewable-progress');

                if (monthlyTargetEl) {
                    monthlyTargetEl.textContent = this.data.production.monthlyTarget.toLocaleString();
                }
                if (monthlyProgressEl) {
                    monthlyProgressEl.textContent = this.data.production.currentMonth.toLocaleString();
                }
                if (productionProgressEl) {
                    const progressPercent = (this.data.production.currentMonth / this.data.production.monthlyTarget) * 100;
                    productionProgressEl.style.width = `${progressPercent}%`;
                }
                if (renewableProgressEl) {
                    renewableProgressEl.style.width = `${this.data.sustainability.renewableEnergy}%`;
                }
            }

            updateTimestamp() {
                const timestampEl = document.getElementById('last-update-time');
                if (timestampEl) {
                    timestampEl.textContent = new Date().toLocaleTimeString();
                }
            }

            startRealTimeUpdates() {
                // Update every 5 seconds
                setInterval(() => {
                    this.generateRealisticData();
                    this.updateDisplay();
                    this.updateTimestamp();
                }, 5000);

                // Update timestamp every second
                setInterval(() => {
                    this.updateTimestamp();
                }, 1000);
            }
        }

        // Dark mode functionality
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('theme-toggle');
            
            // Check for saved theme preference or respect OS preference
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const savedTheme = localStorage.getItem('theme');
            
            // Set initial theme
            if (savedTheme === 'dark' || (!savedTheme && prefersDark)) {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeToggle.checked = true;
            }
            
            // Toggle theme when switch is clicked
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                }
            });

            // Initialize the dashboard
            new StellantisDashboard();
        });

        // Initialize everything when DOM is loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize animations
            initScrollAnimations();
            
            // Initialize brand interactions
            initBrandInteractions();
            
            // Initialize button interactions
            initButtonInteractions();
            
            // Initialize header functionality
            initHeaderFunctionality();
            
            // Initialize Laravel Blade navigation handling
            initLaravelNavigation();
        });

        // Header functionality
        function initHeaderFunctionality() {
            const header = document.querySelector('header');
            let lastScrollY = window.scrollY;

            window.addEventListener('scroll', () => {
                const currentScrollY = window.scrollY;
                
                if (currentScrollY > 100) {
                    header.style.background = 'var(--bg-card)';
                    header.style.backdropFilter = 'blur(10px)';
                    header.style.borderRadius = '12px';
                    header.style.padding = '1rem';
                    header.style.boxShadow = 'var(--shadow-md)';
                    header.style.border = '1px solid var(--border-primary)';
                } else {
                    header.style.background = 'transparent';
                    header.style.backdropFilter = 'none';
                    header.style.borderRadius = '0';
                    header.style.padding = '0';
                    header.style.boxShadow = 'none';
                    header.style.border = 'none';
                }
                
                lastScrollY = currentScrollY;
            });
        }

        // Laravel Blade navigation handling
        function initLaravelNavigation() {
            // Handle Laravel route links - Allow normal navigation
            const loginLink = document.querySelector('a[href*="restart.session"]');
            const registerLink = document.querySelector('a[href*="register"]');
            
            if (loginLink) {
                loginLink.addEventListener('click', function(e) {
                    console.log('Login clicked - redirecting to Laravel login route');
                });
            }
            
            if (registerLink) {
                registerLink.addEventListener('click', function(e) {
                    console.log('Register clicked - redirecting to Laravel register route');
                });
            }
            
            // Handle nav visibility based on Laravel logic simulation
            const nav = document.querySelector('nav');
            if (nav) {
                const hasLoginRoute = true;
                
                if (!hasLoginRoute) {
                    document.querySelector('header').style.display = 'none';
                }
            }
        }

        // Show notification for demo purposes
        function showNotification(message) {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 80px;
                right: 20px;
                background: var(--bg-card);
                color: var(--text-primary);
                padding: 1rem 1.5rem;
                border-radius: 8px;
                box-shadow: var(--shadow-lg);
                z-index: 1000;
                animation: slideIn 0.3s ease;
                border: 1px solid var(--border-primary);
                backdrop-filter: blur(10px);
                max-width: 300px;
            `;
            
            notification.innerHTML = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.animation = 'slideOut 0.3s ease';
                setTimeout(() => notification.remove(), 300);
            }, 4000);
        }

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
            const statCards = document.querySelectorAll('.stat-card');

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

            statCards.forEach((item, index) => {
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

                // Enhanced hover effects
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-8px) scale(1.02)';
                    this.style.boxShadow = 'var(--shadow-xl)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = 'var(--shadow-lg)';
                });
            });
        }

        // Show brand information
        function showBrandInfo(brandName) {
            const brandInfo = {
                'Peugeot': {
                    description: 'Founded in 1810, Peugeot is one of the oldest car manufacturers in the world, known for innovative design and French elegance.',
                    url: 'https://www.peugeot.com'
                },
                'Citroën': {
                    description: 'Established in 1919, Citroën is renowned for its creative and unconventional approach to automotive design and technology.',
                    url: 'https://www.citroen.com'
                },
                'Fiat': {
                    description: 'Founded in 1899 in Turin, Italy, Fiat has been a symbol of Italian automotive excellence and innovation for over a century.',
                    url: 'https://www.fiat.com'
                },
                'Jeep': {
                    description: 'Born in 1941, Jeep is the most capable SUV brand, offering legendary off-road capability and adventure-ready vehicles.',
                    url: 'https://www.jeep.com'
                },
                'Opel': {
                    description: 'Founded in 1862, Opel represents German engineering precision and has been creating reliable, efficient vehicles for generations.',
                    url: 'https://www.opel.com'
                },
                'Chrysler': {
                    description: 'Established in 1925, Chrysler embodies American automotive innovation with a focus on luxury, performance, and technology.',
                    url: 'https://www.chrysler.com'
                }
            };

            const brand = brandInfo[brandName];
            if (brand) {
                showNotification(`${brandName}: ${brand.description} <a href="${brand.url}" target="_blank">Official Website</a>`);
            } else {
                showNotification(`${brandName}: Learn more about this iconic automotive brand.`);
            }
        }

        // Button interactions
        function initButtonInteractions() {
            const primaryButtons = document.querySelectorAll('.btn-primary');
            const secondaryButtons = document.querySelectorAll('.btn-secondary');

            primaryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    createRipple(this);
                    
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

        // Enhanced parallax effect for hero image
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroImg = document.querySelector('.hero-img');
            
            if (heroImg) {
                // Get the hero section position
                const heroSection = document.querySelector('.hero-section');
                const heroRect = heroSection.getBoundingClientRect();
                const windowHeight = window.innerHeight;
                
                // Only apply parallax when hero section is visible
                if (heroRect.bottom >= 0 && heroRect.top <= windowHeight) {
                    // Calculate parallax offset - slower movement (0.1 instead of 0.3)
                    // Negative value makes image move up when scrolling down
                    const speed = scrolled * -0.1;
                    heroImg.style.transform = `translateY(${speed}px) scale(1.05)`;
                }
            }
        });

        // Enhanced keyboard navigation for accessibility
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                const focusableElements = document.querySelectorAll('a, button, [tabindex]:not([tabindex="-1"])');
                focusableElements.forEach(el => {
                    el.addEventListener('focus', function() {
                        this.style.outline = '2px solid var(--stellantis-primary)';
                        this.style.outlineOffset = '2px';
                    });
                    
                    el.addEventListener('blur', function() {
                        this.style.outline = 'none';
                    });
                });
            }
        });

        // Handle responsive navigation for mobile
        function initMobileNavigation() {
            const nav = document.querySelector('nav');
            if (nav && window.innerWidth <= 768) {
                nav.style.flexDirection = 'column';
                nav.style.gap = '0.5rem';
                nav.style.alignItems = 'stretch';
                
                const links = nav.querySelectorAll('a');
                links.forEach(link => {
                    link.style.textAlign = 'center';
                    link.style.padding = '0.5rem 1rem';
                });
            }
        }

        // Initialize mobile navigation on resize
        window.addEventListener('resize', initMobileNavigation);
        initMobileNavigation();

        document.addEventListener('DOMContentLoaded', function() {
            var docBtn = document.getElementById('doc-btn');
            var docSection = document.getElementById('documentation-section');
            if(docBtn && docSection) {
                docBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    docSection.style.display = (docSection.style.display === 'none' || docSection.style.display === '') ? 'block' : 'none';
                    if(docSection.style.display === 'block') {
                        window.scrollTo({ top: docSection.offsetTop - 30, behavior: 'smooth' });
                    }
                });
            }
        });
    </script>
</body>
</html>
