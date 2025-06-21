<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('Stellantis', 'Stellantis Project Management') }}</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            /* Stellantis Brand Colors - Light Mode */
            --stellantis-primary: #2563eb;
            --stellantis-secondary: #3b82f6;
            --stellantis-accent: #1d4ed8;
            --stellantis-gold: #F59E0B;
            --stellantis-silver: #64748B;
            
            /* Modern Color Palette - Light Mode */
            --primary-gradient: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
            --secondary-gradient: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
            --success-gradient: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #fbbf24 100%);
            --danger-gradient: linear-gradient(135deg, #ef4444 0%, #f87171 100%);
            
            /* Background Colors */
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            
            /* Text Colors */
            --text-primary: #1e293b;
            --text-secondary: #475569;
            --text-muted: #64748b;
            --text-inverse: #ffffff;
            
            /* Border Colors */
            --border-primary: rgba(37, 99, 235, 0.2);
            --border-secondary: rgba(255, 255, 255, 0.3);
            --border-muted: #e2e8f0;
            
            /* Neutral Colors */
            --white: #ffffff;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            
            /* Card and Glass Effects */
            --card-bg: rgba(255, 255, 255, 0.95);
            --card-border: rgba(255, 255, 255, 0.3);
            --glass-bg: rgba(255, 255, 255, 0.1);
            --glass-border: rgba(255, 255, 255, 0.2);
            
            /* Spacing */
            --space-xs: 0.25rem;
            --space-sm: 0.5rem;
            --space-md: 1rem;
            --space-lg: 1.5rem;
            --space-xl: 2rem;
            --space-2xl: 3rem;
            --space-3xl: 4rem;
            
            /* Border Radius */
            --radius-sm: 0.375rem;
            --radius-md: 0.5rem;
            --radius-lg: 0.75rem;
            --radius-xl: 1rem;
            --radius-2xl: 1.5rem;
            --radius-full: 9999px;
            
            /* Shadows */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            
            /* Transitions */
            --transition-fast: 150ms ease-in-out;
            --transition-normal: 300ms ease-in-out;
            --transition-slow: 500ms ease-in-out;
        }

        /* Dark Mode Variables */
        html[data-theme="dark"] {
            /* Stellantis Brand Colors - Dark Mode */
            --stellantis-primary: #3b82f6;
            --stellantis-secondary: #2563eb;
            --stellantis-accent: #60a5fa;
            --stellantis-gold: #fbbf24;
            --stellantis-silver: #94a3b8;
            
            /* Modern Color Palette - Dark Mode */
            --primary-gradient: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            --secondary-gradient: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
            --success-gradient: linear-gradient(135deg, #60a5fa 0%, #3b82f6 100%);
            --warning-gradient: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
            --danger-gradient: linear-gradient(135deg, #f87171 0%, #ef4444 100%);
            
            /* Background Colors */
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #334155;
            --bg-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            
            /* Text Colors */
            --text-primary: #f8fafc;
            --text-secondary: #e2e8f0;
            --text-muted: #cbd5e1;
            --text-inverse: #0f172a;
            
            /* Border Colors */
            --border-primary: rgba(59, 130, 246, 0.3);
            --border-secondary: rgba(255, 255, 255, 0.1);
            --border-muted: #334155;
            
            /* Card and Glass Effects */
            --card-bg: rgba(30, 41, 59, 0.95);
            --card-border: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(0, 0, 0, 0.2);
            --glass-border: rgba(255, 255, 255, 0.1);
            
            /* Shadows - Enhanced for dark mode */
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.3);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.4), 0 2px 4px -1px rgba(0, 0, 0, 0.2);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.5), 0 4px 6px -2px rgba(0, 0, 0, 0.3);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.6), 0 10px 10px -5px rgba(0, 0, 0, 0.3);
            --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.7);
            --shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.3);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            font-feature-settings: 'cv02', 'cv03', 'cv04', 'cv11';
            transition: background var(--transition-normal), color var(--transition-normal);
        }
        
        /* Glassmorphism Effect */
        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }
        
        .glass-dark {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
        }
        
        /* Dark Mode Toggle Switch */
        .theme-switch-wrapper {
            display: flex;
            align-items: center;
            margin-right: var(--space-lg);
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
            background-color: rgba(255, 255, 255, 0.3);
            transition: .4s;
            border-radius: 24px;
            backdrop-filter: blur(10px);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
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
            color: var(--text-inverse);
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
        
        /* Navigation */
        .navbar {
            background: var(--primary-gradient);
            padding: var(--space-lg) 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: var(--shadow-lg);
            transition: background var(--transition-normal);
        }
        
        .navbar-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 var(--space-xl);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: white;
            font-weight: 800;
            font-size: 1.75rem;
            transition: var(--transition-normal);
            letter-spacing: -0.025em;
        }
        
        .navbar-brand:hover {
            color: white;
            transform: translateY(-2px);
            filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
        }
        
        .navbar-brand i {
            margin-right: var(--space-md);
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 2rem;
        }
        
        .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
            gap: var(--space-md);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            padding: var(--space-md) var(--space-lg);
            border-radius: var(--radius-lg);
            font-weight: 500;
            transition: var(--transition-normal);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition-normal);
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        .nav-link:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }
        
        .dropdown {
            position: relative;
        }
        
        .dropdown-toggle {
            cursor: pointer;
            gap: var(--space-sm);
        }
        
        .dropdown-menu {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-xl);
            box-shadow: var(--shadow-2xl);
            min-width: 220px;
            padding: var(--space-md) 0;
            opacity: 0;
            visibility: hidden;
            transform: translateY(-10px) scale(0.95);
            transition: var(--transition-normal);
            border: 1px solid var(--card-border);
        }
        
        .dropdown.active .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }
        
        .dropdown-item {
            display: flex;
            align-items: center;
            padding: var(--space-md) var(--space-lg);
            color: var(--text-primary);
            text-decoration: none;
            transition: var(--transition-fast);
            border: none;
            background: none;
            width: 100%;
            text-align: left;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .dropdown-item:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateX(4px);
        }
        
        .dropdown-item i {
            margin-right: var(--space-md);
            width: 16px;
        }
        
        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: var(--radius-full);
            margin-right: var(--space-md);
            border: 2px solid rgba(255, 255, 255, 0.3);
            transition: var(--transition-normal);
        }
        
        .user-avatar:hover {
            border-color: rgba(255, 255, 255, 0.6);
            transform: scale(1.05);
        }
        
        /* Main Content */
        main {
            flex: 1;
            padding: var(--space-3xl) 0;
            max-width: 1600px;
            margin: 0 auto;
            width: 100%;
            padding-left: var(--space-xl);
            padding-right: var(--space-xl);
        }
        
        .container {
            max-width: 100%;
            margin: 0 auto;
        }
        
        /* Modern Cards */
        .card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            border-radius: var(--radius-2xl);
            box-shadow: var(--shadow-xl);
            border: 1px solid var(--card-border);
            margin-bottom: var(--space-xl);
            overflow: hidden;
            transition: var(--transition-normal);
            position: relative;
            
        }
        
        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--primary-gradient);
        }
        
        .card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-2xl);
        }
        
        .card-header {
            background: linear-gradient(135deg, rgba(5, 150, 105, 0.1) 0%, rgba(16, 185, 129, 0.1) 100%);
            color: var(--text-primary);
            padding: var(--space-xl);
            font-weight: 700;
            font-size: 1.25rem;
            border-bottom: 1px solid var(--border-secondary);
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: color var(--transition-normal);
        }
        
        .card-body {
            padding: 0;
        }
        
        /* Revolutionary Table Design */
        .table-container {
            background: transparent;
            border-radius: 0;
            overflow: auto;
            box-shadow: none;
            border: none;
            width: 100%;
            max-width: 100%;
        }
        
       .modern-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            font-size: 0.875rem;
            background: transparent;
            table-layout: fixed;
        }
        
        .modern-table thead {
            background: var(--primary-gradient);
            position: sticky;
            top: 0;
            z-index: 10;
        }
        
        .modern-table th {
            padding: var(--space-md);
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border: none;
            text-align: left;
            white-space: nowrap;
            position: relative;
            width: calc(100% / 12); /* Equal width for all columns - assuming 12 columns */
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .modern-table th:first-child {
            border-radius: var(--radius-lg) 0 0 0;
        }
        
        .modern-table th:last-child {
            border-radius: 0 var(--radius-lg) 0 0;
        }
        
        .modern-table tbody tr {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            transition: var(--transition-fast);
            border-bottom: 1px solid var(--border-secondary);
        }
        
        .modern-table tbody tr:hover {
            background: var(--bg-secondary);
            transform: scale(1.002);
            box-shadow: var(--shadow-lg);
        }
        
        .modern-table td {
            padding: var(--space-md) var(--space-sm);
            border: none;
            vertical-align: middle;
            position: relative;
            color: var(--text-primary);
            transition: color var(--transition-normal);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 0;
        }
        
        /* Expandable content for long text */
        .expandable-content {
            max-width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            cursor: pointer;
            transition: var(--transition-normal);
            position: relative;
        }
        
        .expandable-content:hover {
            background: rgba(5, 150, 105, 0.1);
            border-radius: var(--radius-md);
            padding: var(--space-sm);
            margin: calc(-1 * var(--space-sm));
        }
        
        .expandable-content.expanded {
            white-space: normal;
            word-wrap: break-word;
            background: rgba(5, 150, 105, 0.1);
            border-radius: var(--radius-md);
            padding: var(--space-sm);
            margin: calc(-1 * var(--space-sm));
        }
        
        /* Modern Buttons */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-md) var(--space-lg);
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.875rem;
            text-decoration: none;
            cursor: pointer;
            transition: var(--transition-normal);
            gap: var(--space-sm);
            position: relative;
            overflow: hidden;
            white-space: nowrap;
        }
        
        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition-normal);
        }
        
        .btn:hover::before {
            left: 100%;
        }
        
        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:hover {
            background: var(--secondary-gradient);
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-success {
            background: var(--success-gradient);
            color: white;
            box-shadow: var(--shadow-md);
        }
        
        .btn-success:hover {
            background: var(--primary-gradient);
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }
        
        .btn-outline-primary {
            background: rgba(5, 150, 105, 0.1);
            color: var(--stellantis-primary);
            border: 2px solid var(--border-primary);
            backdrop-filter: blur(10px);
        }
        
        .btn-outline-primary:hover {
            background: var(--primary-gradient);
            color: white;
            border-color: transparent;
            transform: translateY(-2px);
        }
        
        .btn-sm {
            padding: var(--space-sm) var(--space-md);
            font-size: 0.75rem;
        }
        
        /* Modern Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            justify-content: center; /* Center content horizontally */
            gap: var(--space-xs);
            padding: var(--space-sm) var(--space-md);
            font-size: 0.75rem;
            font-weight: 500;
            border-radius: var(--radius-full);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            white-space: nowrap;
            min-width: 100%; /* Take full width of container */
            box-sizing: border-box; /* Include padding in width calculation */
            width: 0; /* Allow flexible width */
            flex-grow: 1; /* Grow to fill available space */}
        
        .bg-warning {
            background: var(--warning-gradient);
            color: white;
        }
        
        .bg-primary {
            background: var(--primary-gradient);
            color: white;
        }
        
        .bg-success {
            background: var(--success-gradient);
            color: white;
        }
        
        .bg-secondary {
            background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%);
            color: white;
        }
        
        /* Form Elements */
        .form-control, .form-select {
            width: 100%;
            padding: var(--space-md) var(--space-lg);
            border: 2px solid var(--border-primary);
            border-radius: var(--radius-lg);
            font-size: 0.875rem;
            transition: var(--transition-normal);
            background: var(--bg-primary);
            backdrop-filter: blur(10px);
            color: var(--text-primary);
        }
        
        .form-control:focus, .form-select:focus {
            outline: none;
            border-color: var(--stellantis-primary);
            box-shadow: 0 0 0 4px rgba(5, 150, 105, 0.1);
            background: var(--bg-primary);
        }
        
        /* Alerts */
        .alert {
            padding: var(--space-lg) var(--space-xl);
            border-radius: var(--radius-xl);
            margin-bottom: var(--space-xl);
            border: 1px solid transparent;
            backdrop-filter: blur(10px);
        }
        
        .alert-info {
            background: rgba(37, 99, 235, 0.1);
            color: var(--stellantis-accent);
            border-color: var(--border-primary);
        }
        
        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            color: #991b1b;
            border-color: rgba(239, 68, 68, 0.2);
        }
        
        /* Footer */
        footer {
            background: var(--secondary-gradient);
            color: white;
            padding: var(--space-xl) 0;
            margin-top: auto;
        }
        
        .footer-container {
            max-width: 1600px;
            margin: 0 auto;
            padding: 0 var(--space-xl);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .footer-links {
            display: flex;
            gap: var(--space-lg);
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            font-size: 1.25rem;
            transition: var(--transition-normal);
            padding: var(--space-sm);
            border-radius: var(--radius-md);
        }
        
        .footer-links a:hover {
            color: white;
            background: rgba(255, 255, 255, 0.1);
            transform: translateY(-2px);
        }
        
        /* Utility Classes */
        .d-flex { display: flex; }
        .align-items-center { align-items: center; }
        .justify-content-between { justify-content: space-between; }
        .gap-2 { gap: var(--space-sm); }
        .gap-3 { gap: var(--space-md); }
        .mb-0 { margin-bottom: 0; }
        .mb-4 { margin-bottom: var(--space-xl); }
        .text-center { text-align: center; }
        
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
        
        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        .slide-in {
            animation: slideInRight 0.6s ease forwards;
        }
        
        /* Responsive Design */
        @media (max-width: 1200px) {
            .modern-table {
                font-size: 0.8rem;
            }
            
            .modern-table th, .modern-table td {
                padding: var(--space-md);
            }
        }
        
        @media (max-width: 768px) {
            main {
                padding: var(--space-xl) var(--space-md);
            }
            
            .navbar-container {
                padding: 0 var(--space-md);
            }
            
            .card-header {
                padding: var(--space-lg);
                flex-direction: column;
                gap: var(--space-md);
                align-items: flex-start;
            }
            
            .modern-table {
                font-size: 0.75rem;
            }
            
            .modern-table th, .modern-table td {
                padding: var(--space-sm);
            }
            
            .btn {
                padding: var(--space-sm) var(--space-md);
                font-size: 0.75rem;
            }
            
            .theme-switch-wrapper {
                margin-right: var(--space-md);
            }
        }
        
        /* Bootstrap-like Grid System */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        
        .col-md-3 {
            flex: 0 0 25%;
            max-width: 25%;
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .col-md-4 {
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding-right: 15px;
            padding-left: 15px;
        }
        
        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }
        
        @media (max-width: 768px) {
            .col-md-3, .col-md-4, .col-md-6, .col-md-12 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        
        /* Fix for table visibility */
        .table-container {
            max-width: 100%;
            overflow: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        /* Custom scrollbar for better UX */
        .table-container::-webkit-scrollbar {
            height: 8px;
        }
        
        .table-container::-webkit-scrollbar-track {
            background: var(--bg-secondary);
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb {
            background: rgba(37, 99, 235, 0.5);
            border-radius: 10px;
        }
        
        .table-container::-webkit-scrollbar-thumb:hover {
            background: rgba(37, 99, 235, 0.8);
        }
        
        /* Form validation animations */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .shake-animation {
            animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }
        
        /* Table highlight effect */
        .modern-table tbody tr {
            position: relative;
            z-index: 1;
        }
        
        .modern-table tbody tr::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.05) 0%, rgba(59, 130, 246, 0.05) 100%);
            opacity: 0;
            transition: var(--transition-normal);
            z-index: -1;
            pointer-events: none;
        }
        
        .modern-table tbody tr:hover::after {
            opacity: 1;
        }
        
        /* Tooltip styles */
        [data-tooltip] {
            position: relative;
            cursor: help;
        }
        
        [data-tooltip]::before,
        [data-tooltip]::after {
            position: absolute;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 99;
        }
        
        [data-tooltip]::before {
            content: attr(data-tooltip);
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background: var(--bg-tertiary);
            color: var(--text-primary);
            font-size: 0.75rem;
            white-space: nowrap;
            box-shadow: var(--shadow-lg);
        }
        
        [data-tooltip]::after {
            content: '';
            bottom: 115%;
            left: 50%;
            transform: translateX(-50%);
            border: 0.25rem solid transparent;
            border-top-color: var(--bg-tertiary);
        }
        
        [data-tooltip]:hover::before,
        [data-tooltip]:hover::after {
            opacity: 1;
            visibility: visible;
        }
        
        /* Print styles */
        @media print {
            body {
                background: white;
                color: black;
            }
            
            .navbar, .footer, .btn-success, .btn-outline-primary, .theme-switch-wrapper {
                display: none;
            }
            
            .card {
                box-shadow: none;
                border: 1px solid #ddd;
            }
            
            .card-header {
                background: #f5f5f5;
                color: black;
            }
            
            .modern-table th {
                background: #f5f5f5;
                color: black;
            }
            
            .modern-table tbody tr {
                background: white;
                border-bottom: 1px solid #ddd;
            }
            
            .badge {
                border: 1px solid #ddd;
                background: #f5f5f5 !important;
                color: black !important;
            }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <a class="navbar-brand" href="{{ auth()->check() && auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}">
                <img src="{{ asset('images/logo.png') }}" 
                alt="Stellantis Logo" 
                style="width: 100px; height: auto; object-fit: contain;">
                Stellantis HUB
            </a>
            
            <ul class="navbar-nav">
                <!-- Dark Mode Toggle -->
                <li class="nav-item theme-switch-wrapper">
                    <label class="theme-switch" for="theme-toggle">
                        <input type="checkbox" id="theme-toggle" />
                        <span class="slider">
                            <i class="fas fa-sun sun icon"></i>
                            <i class="fas fa-moon moon icon"></i>
                        </span>
                    </label>
                </li>
                
                @auth
                    <li class="nav-item dropdown" id="userDropdown">
                        <a class="nav-link dropdown-toggle" href="#" onclick="toggleDropdown(event)">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=059669&color=fff" 
                                 class="user-avatar" alt="User Avatar">
                            {{ Auth::user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{ route('profile.show') }}">
                                <i class="fas fa-user"></i> Profile
                            </a>
                            <hr style="margin: var(--space-sm) 0; border: none; height: 1px; background: var(--border-muted);">
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <main class="fade-in">
        @yield('content')
    </main>

    <footer>
        <div class="footer-container">
            <div>
                <p class="mb-0">&copy; {{ date('Y') }} Stellantis Project Hub. Driving Innovation Forward.</p>
            </div>
            <div class="footer-links">
                <a href="https://www.facebook.com/share/16Lhkm5zBg/?mibextid=wwXIfr" target="_blank" title="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://x.com/Stellantis?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor" target="_blank" title="Twitter">
                    <i class="fab fa-x-twitter"></i>
                </a>
                <a href="https://fr.linkedin.com/company/stellantis" target="_blank" title="LinkedIn">
                    <i class="fab fa-linkedin-in"></i>
                </a>
                <a href="https://github.com/Stellantis" target="_blank" title="GitHub">
                    <i class="fab fa-github"></i>
                </a>
            </div>
        </div>
    </footer>

    <script>
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
        });
        
        // Dropdown functionality
        function toggleDropdown(event) {
            event.preventDefault();
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('active');
        }
        
        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('userDropdown');
            if (dropdown && !dropdown.contains(event.target)) {
                dropdown.classList.remove('active');
            }
        });
        
        // Expandable content functionality
        document.addEventListener('DOMContentLoaded', function() {
            const expandableElements = document.querySelectorAll('.expandable-content');
            
            expandableElements.forEach(element => {
                element.addEventListener('click', function() {
                    this.classList.toggle('expanded');
                });
            });
            
            // Table row highlight effect
            const tableRows = document.querySelectorAll('.modern-table tbody tr');
            tableRows.forEach((row, index) => {
                row.style.animationDelay = `${index * 0.05}s`;
                
                // Add zebra striping with subtle gradient
                if (index % 2 === 0) {
                    row.style.background = 'var(--card-bg)';
                } else {
                    row.style.background = 'var(--bg-secondary)';
                }
            });
            
            // Add tooltip functionality
            const tooltipElements = document.querySelectorAll('[data-tooltip]');
            tooltipElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    const tooltip = this.getAttribute('data-tooltip');
                    if (!tooltip) return;
                    
                    const tooltipEl = document.createElement('div');
                    tooltipEl.className = 'tooltip';
                    tooltipEl.textContent = tooltip;
                    
                    document.body.appendChild(tooltipEl);
                    
                    const rect = this.getBoundingClientRect();
                    tooltipEl.style.position = 'absolute';
                    tooltipEl.style.top = `${rect.top - tooltipEl.offsetHeight - 10}px`;
                    tooltipEl.style.left = `${rect.left + rect.width / 2 - tooltipEl.offsetWidth / 2}px`;
                    tooltipEl.style.opacity = '1';
                });
                
                element.addEventListener('mouseleave', function() {
                    const tooltipEl = document.querySelector('.tooltip');
                    if (tooltipEl) {
                        tooltipEl.remove();
                    }
                });
            });
        });
        
        // Auto-logout functionality
        @if(auth()->check())
        let isReload = false;
        
        window.addEventListener('beforeunload', function(e) {
            isReload = true;
        });
        
        window.addEventListener('unload', function(e) {
            if (!isReload) {
                navigator.sendBeacon('/logout-silent');
            }
        });
        
        window.addEventListener('load', function() {
            setTimeout(() => {
                isReload = false;
            }, 100);
        });
        @endif
        
        // Smooth animations on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationDelay = Math.random() * 0.3 + 's';
                    entry.target.classList.add('slide-in');
                }
            });
        }, observerOptions);
        
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => observer.observe(card));
        });
        
        // Print functionality
        function printTable() {
            window.print();
        }
    </script>
</body>
</html>
