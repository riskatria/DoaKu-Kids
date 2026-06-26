<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="DoaKu Kids - Aplikasi Doa Islami untuk Anak-Anak. Belajar doa sehari-hari dengan cara yang menyenangkan.">
    <meta name="keywords" content="doa anak, doa islami, belajar doa, doa sehari-hari, anak muslim">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'DoaKu Kids') | Belajar Doa Islami</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Amiri:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

    <style>
        /* =============================================
           CSS VARIABLES & DESIGN TOKENS
        ============================================= */
        :root {
            --primary: #16a34a;
            --primary-light: #22c55e;
            --primary-dark: #15803d;
            --primary-glow: rgba(34, 197, 94, 0.25);
            --secondary: #0ea5e9;
            --secondary-light: #38bdf8;
            --accent: #f59e0b;
            --accent-light: #fbbf24;
            --danger: #ef4444;
            --danger-light: #f87171;

            --bg-dark: #0a0f0a;
            --bg-card: #0f1a0f;
            --bg-card2: #111c11;
            --bg-surface: #162016;
            --bg-elevated: #1a2a1a;

            --text-primary: #f0fdf4;
            --text-secondary: #86efac;
            --text-muted: #4ade80;
            --text-dim: #6b7280;

            --border: rgba(34, 197, 94, 0.15);
            --border-hover: rgba(34, 197, 94, 0.35);
            --border-active: rgba(34, 197, 94, 0.6);

            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.4);
            --shadow-md: 0 4px 20px rgba(0, 0, 0, 0.5);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.6);
            --shadow-glow: 0 0 30px rgba(34, 197, 94, 0.15);

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;
            --radius-xl: 24px;
            --radius-full: 9999px;

            --transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            --transition-slow: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* =============================================
           RESET & BASE
        ============================================= */
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
            line-height: 1.6;
            background-image:
                radial-gradient(ellipse at 10% 0%, rgba(22, 163, 74, 0.08) 0%, transparent 60%),
                radial-gradient(ellipse at 90% 100%, rgba(14, 165, 233, 0.05) 0%, transparent 60%);
            background-attachment: fixed;
        }

        a {
            color: var(--primary-light);
            text-decoration: none;
            transition: var(--transition);
        }

        a:hover {
            color: var(--accent-light);
        }

        img {
            max-width: 100%;
        }

        /* =============================================
           SCROLLBAR
        ============================================= */
        ::-webkit-scrollbar {
            width: 6px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-dark);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary-dark);
            border-radius: var(--radius-full);
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary);
        }

        /* =============================================
           NAVBAR
        ============================================= */
        .navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            background: rgba(10, 15, 10, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border);
            padding: 0 1.5rem;
            transition: var(--transition);
        }

        .navbar-inner {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
            gap: 1rem;
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 1.25rem;
            font-weight: 800;
            color: var(--text-primary);
            letter-spacing: -0.025em;
            flex-shrink: 0;
        }

        .navbar-brand .brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            box-shadow: 0 0 16px var(--primary-glow);
        }

        .navbar-brand span.green {
            color: var(--primary-light);
        }

        /* Search Bar */
        .navbar-search {
            flex: 1;
            max-width: 420px;
        }

        .search-form {
            position: relative;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 1rem 0.5rem 2.5rem;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-full);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            transition: var(--transition);
            outline: none;
        }

        .search-input::placeholder {
            color: var(--text-dim);
        }

        .search-input:focus {
            border-color: var(--border-active);
            background: var(--bg-elevated);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-dim);
            pointer-events: none;
            font-size: 0.875rem;
        }

        /* Nav Links */
        .navbar-nav {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            flex-shrink: 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.375rem;
            padding: 0.5rem 0.875rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            color: var(--text-secondary);
            transition: var(--transition);
            white-space: nowrap;
        }

        .nav-link:hover {
            background: var(--bg-surface);
            color: var(--text-primary);
        }

        .nav-link.active {
            background: rgba(34, 197, 94, 0.15);
            color: var(--primary-light);
        }

        .btn-nav-primary {
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            border: none;
            border-radius: var(--radius-md);
            color: white;
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.375rem;
            box-shadow: 0 2px 8px rgba(22, 163, 74, 0.3);
        }

        .btn-nav-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 16px rgba(22, 163, 74, 0.4);
            color: white;
        }

        .btn-nav-outline {
            padding: 0.5rem 1rem;
            background: transparent;
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-secondary);
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .btn-nav-outline:hover {
            border-color: var(--border-hover);
            color: var(--text-primary);
            background: var(--bg-surface);
        }

        /* Hamburger / Mobile menu */
        .hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: var(--radius-sm);
        }

        /* =============================================
           MAIN CONTENT
        ============================================= */
        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem 1.5rem;
            min-height: calc(100vh - 64px - 80px);
        }

        /* =============================================
           FLASH MESSAGES
        ============================================= */
        .flash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0.75rem 1.5rem 0;
        }

        .alert {
            padding: 0.875rem 1.25rem;
            border-radius: var(--radius-md);
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.625rem;
            margin-bottom: 0;
            animation: slideDown 0.3s ease;
        }

        .alert-success {
            background: rgba(34, 197, 94, 0.1);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #86efac;
        }

        .alert-error {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* =============================================
           FOOTER
        ============================================= */
        .footer {
            background: var(--bg-card);
            border-top: 1px solid var(--border);
            padding: 1.5rem;
            text-align: center;
            color: var(--text-dim);
            font-size: 0.8125rem;
        }

        .footer a {
            color: var(--primary-light);
        }

        /* =============================================
           BUTTONS (Global)
        ============================================= */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.625rem 1.25rem;
            border-radius: var(--radius-md);
            font-family: 'Outfit', sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            outline: none;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            box-shadow: 0 2px 10px rgba(22, 163, 74, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.45);
            color: white;
        }

        .btn-secondary {
            background: var(--bg-elevated);
            color: var(--text-primary);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            border-color: var(--border-hover);
            background: var(--bg-surface);
            color: var(--text-primary);
        }

        .btn-danger {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger-light);
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background: rgba(239, 68, 68, 0.25);
            border-color: rgba(239, 68, 68, 0.5);
            color: var(--danger-light);
        }

        .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8125rem;
        }

        .btn-lg {
            padding: 0.875rem 2rem;
            font-size: 1rem;
        }

        /* =============================================
           CARDS (Global)
        ============================================= */
        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: var(--transition);
        }

        .card:hover {
            border-color: var(--border-hover);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .card-body {
            padding: 1.25rem;
        }

        /* =============================================
           BADGE (Global)
        ============================================= */
        .badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.2rem 0.625rem;
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-green {
            background: rgba(34, 197, 94, 0.15);
            color: var(--primary-light);
            border: 1px solid rgba(34, 197, 94, 0.25);
        }

        .badge-blue {
            background: rgba(14, 165, 233, 0.15);
            color: var(--secondary-light);
            border: 1px solid rgba(14, 165, 233, 0.25);
        }

        .badge-amber {
            background: rgba(245, 158, 11, 0.15);
            color: var(--accent-light);
            border: 1px solid rgba(245, 158, 11, 0.25);
        }

        .badge-red {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger-light);
            border: 1px solid rgba(239, 68, 68, 0.25);
        }

        /* =============================================
           FORMS (Global)
        ============================================= */
        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-secondary);
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            background: var(--bg-surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            font-size: 0.9375rem;
            transition: var(--transition);
            outline: none;
        }

        .form-control::placeholder {
            color: var(--text-dim);
        }

        .form-control:focus {
            border-color: var(--border-active);
            background: var(--bg-elevated);
            box-shadow: 0 0 0 3px var(--primary-glow);
        }

        .form-error {
            margin-top: 0.375rem;
            font-size: 0.8125rem;
            color: var(--danger-light);
        }

        /* =============================================
           RESPONSIVE
        ============================================= */
        @media (max-width: 768px) {
            .navbar-search {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .navbar-nav {
                display: none;
                position: fixed;
                top: 64px;
                left: 0;
                right: 0;
                background: rgba(10, 15, 10, 0.97);
                backdrop-filter: blur(20px);
                padding: 1rem;
                flex-direction: column;
                border-bottom: 1px solid var(--border);
                z-index: 99;
            }

            .navbar-nav.open {
                display: flex;
            }

            .nav-link, .btn-nav-primary, .btn-nav-outline {
                width: 100%;
                justify-content: center;
            }

            .main-content {
                padding: 1.5rem 1rem;
            }
        }

        /* =============================================
           ANIMATIONS (Global)
        ============================================= */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.6; }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        .fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }

        .delay-1 { animation-delay: 0.1s; opacity: 0; }
        .delay-2 { animation-delay: 0.2s; opacity: 0; }
        .delay-3 { animation-delay: 0.3s; opacity: 0; }
        .delay-4 { animation-delay: 0.4s; opacity: 0; }

        /* =============================================
           LOADER SKELETON
        ============================================= */
        .skeleton {
            background: linear-gradient(90deg, var(--bg-surface) 25%, var(--bg-elevated) 50%, var(--bg-surface) 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
            border-radius: var(--radius-md);
        }

        /* =============================================
           SECTION HEADERS
        ============================================= */
        .section-header {
            margin-bottom: 1.5rem;
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary);
            display: flex;
            align-items: center;
            gap: 0.625rem;
        }

        .section-title .icon {
            font-size: 1.25rem;
        }

        .section-subtitle {
            margin-top: 0.375rem;
            font-size: 0.875rem;
            color: var(--text-dim);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-title {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .empty-desc {
            font-size: 0.875rem;
            color: var(--text-dim);
            margin-bottom: 1.5rem;
        }

        /* Divider */
        .divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 1.5rem 0;
        }

        /* Ornament / decorative */
        .ornament {
            font-size: 0.875rem;
            color: var(--primary-light);
            opacity: 0.4;
            user-select: none;
        }
    </style>

    @stack('styles')
</head>
<body>

    <!-- =============================================
         NAVBAR
    ============================================= -->
    <nav class="navbar" id="main-navbar">
        <div class="navbar-inner">
            <!-- Brand -->
            <a href="{{ route('home') }}" class="navbar-brand">
                <div class="brand-icon">🌙</div>
                <span>Doa<span class="green">Ku</span> Kids</span>
            </a>

            <!-- Search -->
            <div class="navbar-search">
                <form action="{{ route('doa.search') }}" method="GET" class="search-form" role="search">
                    <span class="search-icon">🔍</span>
                    <input
                        type="text"
                        name="query"
                        id="navbar-search-input"
                        class="search-input"
                        placeholder="Cari doa..."
                        value="{{ request('query') }}"
                        autocomplete="off"
                    >
                </form>
            </div>

            <!-- Nav Links -->
            <div class="navbar-nav" id="navbar-nav">
                <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                    🏠 Beranda
                </a>

                @auth
                    <a href="{{ route('favorites.index') }}" class="nav-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                        ❤️ Favorit
                    </a>
                    <a href="{{ route('memorization.index') }}" class="nav-link {{ request()->routeIs('memorization.*') ? 'active' : '' }}">
                        📖 Hafalan
                    </a>
                    <span class="nav-link" style="cursor: default; color: var(--text-secondary); font-weight: 600; pointer-events: none;">
                        👤 {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-nav-outline">
                            👋 Keluar
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-nav-outline">
                        🔑 Masuk
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav-primary">
                        ✨ Daftar
                    </a>
                @endauth
            </div>

            <!-- Hamburger -->
            <button class="hamburger" id="hamburger-btn" aria-label="Toggle menu" aria-expanded="false">
                ☰
            </button>
        </div>
    </nav>

    <!-- =============================================
         FLASH MESSAGES
    ============================================= -->
    @if(session('success') || $errors->any())
    <div class="flash-container" id="flash-container">
        @if(session('success'))
        <div class="alert alert-success" role="alert">
            ✅ {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-error" role="alert">
            ❌ {{ $errors->first() }}
        </div>
        @endif
    </div>
    @endif

    <!-- =============================================
         MAIN CONTENT
    ============================================= -->
    <main class="main-content" id="main-content">
        @yield('content')
    </main>

    <!-- =============================================
         FOOTER
    ============================================= -->
    <footer class="footer">
        <p>
            <span class="ornament">﷽</span>&nbsp;
            DoaKu Kids &copy; {{ date('Y') }} &mdash; Belajar doa dengan cinta ❤️
            &nbsp;<span class="ornament">☽</span>
        </p>
        <p style="margin-top:0.375rem; font-size: 0.75rem;">
            Data doa dari <a href="https://doa-doa-api-ahmadramadhan.fly.dev/api" target="_blank" rel="noopener">Ahmad Ramadhan Doa API</a>
        </p>
    </footer>

    <script>
        // Hamburger menu toggle
        const hamburger = document.getElementById('hamburger-btn');
        const nav = document.getElementById('navbar-nav');

        if (hamburger && nav) {
            hamburger.addEventListener('click', () => {
                const isOpen = nav.classList.toggle('open');
                hamburger.setAttribute('aria-expanded', isOpen);
                hamburger.textContent = isOpen ? '✕' : '☰';
            });
        }

        // Auto-dismiss flash messages
        const flash = document.getElementById('flash-container');
        if (flash) {
            setTimeout(() => {
                flash.style.transition = 'opacity 0.5s ease';
                flash.style.opacity = '0';
                setTimeout(() => flash.remove(), 500);
            }, 4000);
        }
    </script>

    @stack('scripts')
</body>
</html>
