<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        
    <title>TaskMaster</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="/images/icon.png">
    <link rel="apple-touch-icon" href="/images/icon.png">


        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            /* ============================================= */
            /* LIGHT MODE */
            /* ============================================= */
            :root {
                --bg-body: linear-gradient(135deg, #f0f4ff 0%, #e8edf8 30%, #dce3f0 60%, #d0d8e8 100%);
                --bg-navbar: #0a0a0a;
                --bg-card: rgba(255, 255, 255, 0.85);
                --bg-card-hover: rgba(255, 255, 255, 0.95);
                --text-primary: #0f0c29;
                --text-secondary: #4a5568;
                --text-muted: #718096;
                --border-color: rgba(0, 0, 0, 0.06);
                --shadow-color: rgba(0, 0, 0, 0.08);
                --input-bg: #f7fafc;
                --dropdown-bg: #ffffff;
                --dropdown-text: #1a202c;
                --navbar-text: rgba(255, 255, 255, 0.6);
                --navbar-text-hover: #ffffff;
                --navbar-border: rgba(255, 255, 255, 0.05);
                --welcome-bg: rgba(255, 255, 255, 0.03);
                --welcome-border: rgba(255, 255, 255, 0.04);
                --sidebar-bg: #0f0c29;
                --sidebar-hover: rgba(255,255,255,0.05);
                --sidebar-active: rgba(96,165,250,0.12);
                --sidebar-text: rgba(255,255,255,0.6);
                --sidebar-text-hover: #ffffff;
                --sidebar-border: rgba(255,255,255,0.04);
            }

            /* ============================================= */
            /* DARK MODE */
            /* ============================================= */
            [data-theme="dark"] {
                --bg-body: linear-gradient(135deg, #0a0a1a 0%, #0f1a2e 30%, #1a2a4e 60%, #0f1a2e 100%);
                --bg-navbar: #0a0a0a;
                --bg-card: rgba(30, 41, 59, 0.85);
                --bg-card-hover: rgba(30, 41, 59, 0.95);
                --text-primary: #f1f5f9;
                --text-secondary: #94a3b8;
                --text-muted: #64748b;
                --border-color: rgba(255, 255, 255, 0.06);
                --shadow-color: rgba(0, 0, 0, 0.3);
                --input-bg: #1e293b;
                --dropdown-bg: #1a1a2e;
                --dropdown-text: #e2e8f0;
                --navbar-text: rgba(255, 255, 255, 0.6);
                --navbar-text-hover: #ffffff;
                --navbar-border: rgba(255, 255, 255, 0.05);
                --welcome-bg: rgba(255, 255, 255, 0.02);
                --welcome-border: rgba(255, 255, 255, 0.03);
                --sidebar-bg: #0f0c29;
                --sidebar-hover: rgba(255,255,255,0.05);
                --sidebar-active: rgba(96,165,250,0.12);
                --sidebar-text: rgba(255,255,255,0.6);
                --sidebar-text-hover: #ffffff;
                --sidebar-border: rgba(255,255,255,0.04);
            }

            /* ============================================= */
            /* BODY BACKGROUND */
            /* ============================================= */
            body {
                background: var(--bg-body);
                min-height: 100vh;
                font-family: 'Figtree', sans-serif;
                transition: background 0.5s ease;
            }

            /* ============================================= */
            /* SIDEBAR */
            /* ============================================= */
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                width: 240px;
                height: 100vh;
                background: var(--sidebar-bg);
                border-right: 1px solid var(--sidebar-border);
                padding: 20px 0;
                z-index: 1000;
                transition: all 0.3s ease;
                overflow-y: auto;
                box-shadow: 2px 0 30px rgba(0,0,0,0.2);
            }

            .sidebar-brand {
                padding: 0 20px 20px;
                border-bottom: 1px solid var(--sidebar-border);
                margin-bottom: 20px;
            }

            .sidebar-brand a {
                color: #ffffff;
                text-decoration: none;
                font-weight: 700;
                font-size: 1.1rem;
                display: flex;
                align-items: center;
                gap: 10px;
            }

            .sidebar-brand a i {
                color: #60a5fa;
                font-size: 1.2rem;
            }

            .sidebar-menu {
                list-style: none;
                padding: 0;
                margin: 0;
            }

            .sidebar-menu li {
                padding: 0 12px;
                margin-bottom: 2px;
            }

            .sidebar-menu li a {
                display: flex;
                align-items: center;
                padding: 10px 14px;
                color: var(--sidebar-text);
                text-decoration: none;
                border-radius: 10px;
                transition: all 0.3s ease;
                font-weight: 500;
                font-size: 0.9rem;
                gap: 12px;
            }

            .sidebar-menu li a i {
                width: 20px;
                text-align: center;
                font-size: 1rem;
                color: var(--sidebar-text);
                transition: all 0.3s ease;
            }

            .sidebar-menu li a:hover {
                background: var(--sidebar-hover);
                color: var(--sidebar-text-hover);
                transform: translateX(4px);
            }

            .sidebar-menu li a:hover i {
                color: #60a5fa;
            }

            .sidebar-menu li a.active {
                background: var(--sidebar-active);
                color: #ffffff;
            }

            .sidebar-menu li a.active i {
                color: #60a5fa;
            }

            .sidebar-menu .menu-divider {
                padding: 8px 20px 4px;
                font-size: 0.65rem;
                text-transform: uppercase;
                color: rgba(255,255,255,0.2);
                letter-spacing: 1px;
                font-weight: 600;
            }

            /* ============================================= */
            /* MAIN CONTENT WITH SIDEBAR */
            /* ============================================= */
            .main-content-wrapper {
                margin-left: 240px;
                min-height: 100vh;
            }

            /* ============================================= */
            /* SIDEBAR TOGGLE (Mobile) */
            /* ============================================= */
            .sidebar-toggle {
                display: none;
                position: fixed;
                bottom: 20px;
                left: 20px;
                z-index: 1001;
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: var(--sidebar-bg);
                border: 1px solid var(--sidebar-border);
                color: #ffffff;
                font-size: 18px;
                cursor: pointer;
                box-shadow: 0 4px 20px rgba(0,0,0,0.3);
                transition: all 0.3s ease;
            }

            .sidebar-toggle:hover {
                transform: scale(1.05);
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }

            /* ============================================= */
            /* CARDS */
            /* ============================================= */
            .card {
                background: var(--bg-card) !important;
                backdrop-filter: blur(10px);
                border: 1px solid var(--border-color);
                transition: all 0.3s ease;
            }

            .card:hover {
                background: var(--bg-card-hover) !important;
            }

            .card .text-muted {
                color: var(--text-muted) !important;
            }

            .card .text-dark {
                color: var(--text-primary) !important;
            }

            /* ============================================= */
            /* LIST GROUP */
            /* ============================================= */
            .list-group-item {
                background: transparent !important;
                color: var(--text-secondary) !important;
                border-color: var(--border-color) !important;
            }

            .list-group-item:hover {
                background: rgba(255, 255, 255, 0.04) !important;
            }

            /* ============================================= */
            /* DROPDOWN */
            /* ============================================= */
            .dropdown-professional {
                background: var(--dropdown-bg) !important;
                border-color: var(--border-color) !important;
            }

            .dropdown-item-professional {
                color: var(--dropdown-text) !important;
            }

            .dropdown-item-professional:hover {
                background: rgba(255, 255, 255, 0.04) !important;
                color: #ffffff !important;
            }

            /* ============================================= */
            /* THEME TOGGLE BUTTON */
            /* ============================================= */
            .theme-toggle-btn {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                border: 1px solid rgba(255, 255, 255, 0.08);
                background: rgba(255, 255, 255, 0.03);
                color: rgba(255, 255, 255, 0.6);
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                font-size: 16px;
            }

            .theme-toggle-btn:hover {
                background: rgba(255, 255, 255, 0.08);
                color: #ffffff;
                transform: rotate(30deg);
            }

            /* ============================================= */
            /* MAIN CONTENT */
            /* ============================================= */
            .main-content {
                padding-top: 0px;
                padding-bottom: 40px;
            }

            /* ============================================= */
            /* SCROLLBAR */
            /* ============================================= */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }

            ::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.05);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb {
                background: linear-gradient(135deg, #60a5fa, #a78bfa);
                border-radius: 10px;
            }

            ::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(135deg, #a78bfa, #f472b6);
            }

            [data-theme="dark"] ::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.02);
            }

            /* ============================================= */
            /* ANIMATIONS */
            /* ============================================= */
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

            .fade-in-up {
                animation: fadeInUp 0.8s ease-out;
            }

            /* ============================================= */
            /* RESPONSIVE */
            /* ============================================= */
            @media (max-width: 768px) {
                .sidebar {
                    transform: translateX(-100%);
                    width: 280px;
                }

                .sidebar.open {
                    transform: translateX(0);
                }

                .sidebar-toggle {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .sidebar-overlay.active {
                    display: block;
                }

                .main-content-wrapper {
                    margin-left: 0;
                }

                .navbar-brand {
                    font-size: 0.9rem !important;
                }
            }

            @media (min-width: 769px) {
                .sidebar-toggle {
                    display: none !important;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        
        <!-- ===== SIDEBAR ===== -->
        @include('layouts.sidebar')
        
        <!-- ===== SIDEBAR OVERLAY (Mobile) ===== -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
        
        <!-- ===== SIDEBAR TOGGLE (Mobile) ===== -->
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        
        <div class="main-content-wrapper">
            <div class="min-h-screen">
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="bg-white/70 dark:bg-gray-800/70 backdrop-blur-sm shadow-sm">
                        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endisset

                <!-- Page Content -->
                <main class="main-content">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Theme toggle script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-theme', savedTheme);
                
                const themeToggle = document.getElementById('themeToggle');
                if (themeToggle) {
                    const icon = themeToggle.querySelector('i');
                    if (savedTheme === 'dark') {
                        icon.className = 'fas fa-sun';
                    } else {
                        icon.className = 'fas fa-moon';
                    }
                    
                    themeToggle.addEventListener('click', function() {
                        const currentTheme = document.documentElement.getAttribute('data-theme');
                        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                        
                        document.documentElement.setAttribute('data-theme', newTheme);
                        localStorage.setItem('theme', newTheme);
                        
                        const icon = this.querySelector('i');
                        if (newTheme === 'dark') {
                            icon.className = 'fas fa-sun';
                        } else {
                            icon.className = 'fas fa-moon';
                        }
                    });
                }
            });
        </script>

        <!-- Sidebar toggle script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sidebar = document.querySelector('.sidebar');
                const toggle = document.getElementById('sidebarToggle');
                const overlay = document.getElementById('sidebarOverlay');
                
                if (toggle) {
                    toggle.addEventListener('click', function() {
                        sidebar.classList.toggle('open');
                        overlay.classList.toggle('active');
                        const icon = this.querySelector('i');
                        if (sidebar.classList.contains('open')) {
                            icon.className = 'fas fa-times';
                        } else {
                            icon.className = 'fas fa-bars';
                        }
                    });
                }
                
                if (overlay) {
                    overlay.addEventListener('click', function() {
                        sidebar.classList.remove('open');
                        overlay.classList.remove('active');
                        if (toggle) {
                            toggle.querySelector('i').className = 'fas fa-bars';
                        }
                    });
                }
            });
        </script>
        <script>
   
    document.documentElement.setAttribute('data-theme', 'light');
    localStorage.setItem('theme', 'light');
</script>
    </body>
</html>