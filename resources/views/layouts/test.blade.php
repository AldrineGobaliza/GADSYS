<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GAD Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700;800&family=DM+Sans:wght@400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --orb-purple: #6c2bd9;
            --orb-teal: #0d9488;
            --glass-bg: rgba(15, 10, 30, 0.6);
            --glass-border: rgba(255, 255, 255, 0.08);
            --sidebar-width: 260px;
            --text-primary: #f0ecff;
            --text-muted: rgba(200, 190, 230, 0.6);
            --accent-purple: #a78bfa;
            --accent-teal: #2dd4bf;
            --accent-pink: #f472b6;
            --navbar-h: 60px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            overflow-x: hidden;
            background: #06040f;
            font-family: 'DM Sans', sans-serif;
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* ── Background: static gradient + mesh — single element, no JS ── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background:
                linear-gradient(rgba(108, 43, 217, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(108, 43, 217, 0.06) 1px, transparent 1px),
                radial-gradient(ellipse 80% 60% at 10% 0%, rgba(124, 58, 237, 0.28) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 90%, rgba(13, 148, 136, 0.22) 0%, transparent 60%),
                radial-gradient(ellipse 45% 45% at 80% 30%, rgba(236, 72, 153, 0.14) 0%, transparent 55%),
                #06040f;
            background-size: 48px 48px, 48px 48px, 100% 100%, 100% 100%, 100% 100%, 100% 100%;
            animation: meshShift 32s linear infinite;
            will-change: background-position;
        }

        @keyframes meshShift {
            from {
                background-position: 0 0, 0 0, 0 0, 0 0, 0 0, 0 0;
            }

            to {
                background-position: 48px 48px, 48px 48px, 0 0, 0 0, 0 0, 0 0;
            }
        }

        /* Two GPU-composited orbs — transform only, no filter changes mid-animation */
        .orb-a,
        .orb-b {
            position: fixed;
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            will-change: transform;
            filter: blur(70px);
        }

        .orb-a {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(124, 58, 237, 0.55), transparent 70%);
            top: -150px;
            left: -120px;
            animation: floatA 22s ease-in-out infinite;
        }

        .orb-b {
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(13, 148, 136, 0.45), transparent 70%);
            bottom: -80px;
            right: -80px;
            animation: floatB 18s ease-in-out infinite;
        }

        @keyframes floatA {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(50px, 60px);
            }
        }

        @keyframes floatB {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(-50px, -50px);
            }
        }

        @media (prefers-reduced-motion: reduce) {

            body::before,
            .orb-a,
            .orb-b {
                animation: none;
            }
        }

        /* ── Sidebar ── */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            z-index: 200;
            display: flex;
            flex-direction: column;
            background: rgba(10, 5, 24, 0.72);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border-right: 1px solid var(--glass-border);
            box-shadow: 4px 0 30px rgba(0, 0, 0, 0.45);
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .sidebar::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 1px;
            height: 100%;
            background: linear-gradient(to bottom,
                    transparent,
                    rgba(167, 139, 250, 0.4) 30%,
                    rgba(45, 212, 191, 0.3) 70%,
                    transparent);
            pointer-events: none;
        }

        @media (max-width: 767px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.open {
                transform: translateX(0);
            }
        }

        .sidebar-header {
            padding: 24px 20px 18px;
            border-bottom: 1px solid var(--glass-border);
            flex-shrink: 0;
        }

        .sidebar-logo {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 1.25rem;
            background: linear-gradient(135deg, var(--accent-purple), var(--accent-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
        }

        .sidebar-tagline {
            font-size: 0.65rem;
            color: var(--text-muted);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 10px;
            overflow-y: auto;
            scrollbar-width: none;
            overscroll-behavior: contain;
        }

        .sidebar-nav::-webkit-scrollbar {
            display: none;
        }

        .nav-section-label {
            font-size: 0.63rem;
            font-weight: 600;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-muted);
            padding: 12px 12px 5px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 13px;
            margin: 2px 0;
            border-radius: 10px;
            color: rgba(200, 190, 230, 0.72);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 400;
            transition: color 0.2s, background 0.2s, transform 0.2s;
            position: relative;
        }

        .sidebar-link:hover {
            color: var(--text-primary);
            background: rgba(167, 139, 250, 0.09);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            color: #fff;
            background: linear-gradient(135deg, rgba(124, 58, 237, 0.32), rgba(13, 148, 136, 0.18));
            border: 1px solid rgba(167, 139, 250, 0.22);
            box-shadow: 0 0 18px rgba(124, 58, 237, 0.18);
            font-weight: 500;
        }

        .sidebar-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 20%;
            height: 60%;
            width: 3px;
            background: linear-gradient(to bottom, var(--accent-purple), var(--accent-teal));
            border-radius: 0 3px 3px 0;
        }

        .nav-icon {
            width: 17px;
            height: 17px;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .sidebar-link.active .nav-icon,
        .sidebar-link:hover .nav-icon {
            opacity: 1;
        }

        .sidebar-footer {
            padding: 14px 12px;
            border-top: 1px solid var(--glass-border);
            flex-shrink: 0;
            font-size: 0.68rem;
            color: var(--text-muted);
            text-align: center;
        }

        /* ── Mobile overlay ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 199;
            backdrop-filter: blur(2px);
        }

        .sidebar-overlay.open {
            display: block;
        }

        /* ── Main wrap ── */
        .main-wrap {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            position: relative;
            z-index: 1;
            display: flex;
            flex-direction: column;
        }

        @media (max-width: 767px) {
            .main-wrap {
                margin-left: 0;
            }
        }

        /* ── Top Navbar ── */
        .top-navbar {
            position: sticky;
            top: 0;
            z-index: 100;
            height: var(--navbar-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            background: rgba(8, 5, 20, 0.65);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--glass-border);
            flex-shrink: 0;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .hamburger {
            display: none;
            background: none;
            border: none;
            color: var(--text-primary);
            cursor: pointer;
            padding: 4px;
            line-height: 1;
        }

        @media (max-width: 767px) {
            .hamburger {
                display: flex;
            }
        }

        .navbar-greeting {
            font-family: 'Poppins', sans-serif;
            font-size: 0.95rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .navbar-greeting span {
            background: linear-gradient(90deg, var(--accent-purple), var(--accent-teal));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .navbar-right {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .status-pill {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 4px 11px;
            border-radius: 20px;
            background: rgba(45, 212, 191, 0.09);
            border: 1px solid rgba(45, 212, 191, 0.2);
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--accent-teal);
            white-space: nowrap;
        }

        @media (max-width: 400px) {
            .status-pill {
                display: none;
            }
        }

        .status-dot {
            width: 6px;
            height: 6px;
            background: var(--accent-teal);
            border-radius: 50%;
            box-shadow: 0 0 5px var(--accent-teal);
            animation: pulse 3s ease-in-out infinite;
            will-change: opacity;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.4;
            }
        }

        .avatar-ring {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--orb-purple), var(--orb-teal));
            padding: 2px;
            cursor: pointer;
            flex-shrink: 0;
        }

        .avatar-inner {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background: #1a0f3a;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
            font-size: 0.78rem;
            font-weight: 700;
            color: var(--accent-purple);
        }

        /* ── Content ── */
        .content-area {
            padding: clamp(14px, 3vw, 32px);
            flex: 1;
        }

        .page-content-glass {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            padding: clamp(14px, 3vw, 28px);
            box-shadow: 0 6px 28px rgba(0, 0, 0, 0.38), inset 0 1px 0 rgba(255, 255, 255, 0.06);
            position: relative;
            overflow: hidden;
        }

        .page-content-glass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 8%;
            right: 8%;
            height: 1px;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(167, 139, 250, 0.45) 40%,
                    rgba(45, 212, 191, 0.35) 60%,
                    transparent);
            pointer-events: none;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 18px;
            box-shadow: 0 6px 28px rgba(0, 0, 0, 0.38), inset 0 1px 0 rgba(255, 255, 255, 0.06);
            position: relative;
            overflow: hidden;
        }

        /* ── Bootstrap dark overrides ── */
        .table {
            color: var(--text-primary);
        }

        .table> :not(caption)>*>* {
            background-color: transparent;
            border-color: rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
        }

        .table thead th {
            color: var(--text-muted);
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-weight: 600;
        }

        .form-control,
        .form-select {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border-radius: 10px;
        }

        .form-control:focus,
        .form-select:focus {
            background: rgba(255, 255, 255, 0.07);
            border-color: rgba(167, 139, 250, 0.5);
            box-shadow: 0 0 0 3px rgba(124, 58, 237, 0.14);
            color: var(--text-primary);
        }

        .form-control::placeholder {
            color: var(--text-muted);
        }

        label {
            color: rgba(200, 190, 230, 0.8);
            font-size: 0.82rem;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, #7c3aed, #4f46e5);
            border: none;
            border-radius: 10px;
            font-weight: 500;
            box-shadow: 0 3px 12px rgba(124, 58, 237, 0.32);
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #8b5cf6, #6366f1);
            box-shadow: 0 5px 18px rgba(124, 58, 237, 0.48);
            transform: translateY(-1px);
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc2626, #9f1239);
            border: none;
            border-radius: 10px;
        }

        .btn-sm {
            border-radius: 8px;
        }

        .alert {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            border-radius: 12px;
        }

        .alert-success {
            background: rgba(45, 212, 191, 0.1);
            border-color: rgba(45, 212, 191, 0.25);
            color: var(--accent-teal);
        }

        .alert-danger {
            background: rgba(244, 114, 182, 0.1);
            border-color: rgba(244, 114, 182, 0.25);
            color: var(--accent-pink);
        }

        .badge {
            border-radius: 6px;
            font-weight: 500;
        }

        .card {
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.07);
            border-radius: 14px;
            color: var(--text-primary);
        }

        .card-header {
            background: rgba(255, 255, 255, 0.03);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            color: var(--text-primary);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: 'Poppins', sans-serif;
            color: var(--text-primary);
        }

        a:not(.sidebar-link):not(.btn) {
            color: var(--accent-purple);
        }

        a:not(.sidebar-link):not(.btn):hover {
            color: var(--accent-teal);
        }

        .pagination .page-link {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .pagination .page-item.active .page-link {
            background: var(--orb-purple);
            border-color: var(--orb-purple);
        }

        .modal-content {
            background: #0f0a1e;
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 16px;
            color: var(--text-primary);
        }

        .modal-header,
        .modal-footer {
            border-color: rgba(255, 255, 255, 0.07);
        }
    </style>
</head>

<body>

    <!-- 2 orbs (down from 4) — only transform animates, GPU composited -->
    <div class="orb-a" aria-hidden="true"></div>
    <div class="orb-b" aria-hidden="true"></div>

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

    <div style="position:relative;z-index:1;display:flex;min-height:100vh;">

        <!-- ── Sidebar ── -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <span class="sidebar-logo">GAD Admin</span>
                <span class="sidebar-tagline">Control Panel</span>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-label">Content</div>

                <a href="{{ route('posts.index') }}"
                    class="sidebar-link {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Manage Posts
                </a>

                <a href="{{ route('posts.create') }}"
                    class="sidebar-link {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Post
                </a>

                <a href="{{ route('events.create') }}"
                    class="sidebar-link {{ request()->routeIs('events.create') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Create Event
                </a>

                <div class="nav-section-label" style="margin-top:8px;">Management</div>

                <a href="{{ route('personnel.create') }}"
                    class="sidebar-link {{ request()->routeIs('personnel.create') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Personnel
                </a>

                <a href="{{ route('documents.index') }}"
                    class="sidebar-link {{ request()->routeIs('documents.index') ? 'active' : '' }}">
                    <svg class="nav-icon" fill="none" stroke="currentColor" stroke-width="1.75" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                    </svg>
                    File Management
                </a>
            </nav>

            <div class="sidebar-footer">GAD Admin &copy; {{ date('Y') }}</div>
        </aside>

        <!-- ── Main ── -->
        <div class="main-wrap">

            <header class="top-navbar">
                <div class="navbar-left">
                    <button class="hamburger" onclick="toggleSidebar()" aria-label="Toggle menu">
                        <svg width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="navbar-greeting">
                        Good Day, <span>{{ Auth::user()->name }}</span>
                    </div>
                </div>
                <div class="navbar-right">
                    <div class="status-pill">
                        <span class="status-dot"></span>
                        Online
                    </div>
                    <div class="avatar-ring">
                        <div class="avatar-inner">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="content-area">
                <div class="page-content-glass">
                    @yield('content')
                </div>
            </main>

        </div>
    </div>

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('open');
            document.getElementById('sidebarOverlay').classList.toggle('open');
        }
        // Auto-close sidebar on nav click (mobile UX)
        if (window.innerWidth < 768) {
            document.querySelectorAll('.sidebar-link').forEach(function(link) {
                link.addEventListener('click', toggleSidebar);
            });
        }
    </script>

</body>

</html>

.sidebar {
position: fixed;
top: 0;
left: 0;
width: 16.6667%;
height: 100vh;
background: linear-gradient(180deg, #0d6efd, #0a58ca);
overflow-y: auto;
border-radius: 0 16px 16px 0;
}

.sidebar a {
color: white;
text-decoration: none;
display: block;
padding: 15px;
}

.sidebar a:hover {
background-color: #495057;
border-radius: 0 16px 16px 0;
}

.sidebar a.active {
background-color: #495057;
border-radius: 0 16px 16px 0;
}