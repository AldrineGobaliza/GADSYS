<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>GAD Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            overflow-x: hidden;
        }

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

        .nav-section {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            margin-bottom: 10px;
            padding-left: 10px;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            margin-bottom: 6px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .nav-item i {
            font-size: 1.1rem;
            opacity: 0.9;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(4px);
        }

        .nav-item.active {
            background: #fff;
            color: #0d6efd;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-item.active i {
            color: #0d6efd;
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

        .alert {
            border-radius: 12px;
            border: none;
            padding: 14px 16px;
            backdrop-filter: blur(6px);

            animation: alertSlideIn 0.4s ease;
        }

        .alert-success {
            background: linear-gradient(135deg, #e6f4ea, #d1f2dc);
            color: #146c43;
        }

        .alert-danger {
            background: linear-gradient(135deg, #fdecea, #f8d7da);
            color: #842029;
        }

        @keyframes alertSlideIn {
            from {
                opacity: 0;
                transform: translateY(-15px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .modal-content {
            background-color: rgba(255, 153, 0, 0.4) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .post-card {
            background-color: rgba(255, 153, 0, 0.4) !important;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 14px;
            padding: 16px;
            transition: 0.25s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-card-header {
            margin-bottom: 10px;
        }

        .post-title {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .post-date {
            font-size: 0.8rem;
            color: #6c757d;
        }

        .post-content {
            font-size: 0.9rem;
            color: #555;
        }

        .image-grid {
            display: flex;
            gap: 6px;
            margin-top: 10px;
        }

        .image-wrapper {
            position: relative;
        }

        .image-wrapper img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
        }

        .image-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.6);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            border-radius: 8px;
            cursor: pointer;
        }

        .post-card-footer {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            margin-top: 12px;
        }
    </style>
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="sidebar p-1">

                <div class="text-center mb-4">
                    <h5 class="fw-bold text-white mb-0">GAD Admin</h5>
                    <small class="text-white-50">Dashboard</small>
                </div>

                <div class="nav-section">Content</div>

                <a href="{{ route('posts.index') }}"
                    class="nav-item {{ request()->routeIs('posts.index') ? 'active' : '' }}">
                    <i class="bi bi-file-text"></i>
                    <span>Manage Posts</span>
                </a>

                <a href="{{ route('posts.create') }}"
                    class="nav-item {{ request()->routeIs('posts.create') ? 'active' : '' }}">
                    <i class="bi bi-plus-circle"></i>
                    <span>Create Post</span>
                </a>

                <a href="{{ route('events.create') }}"
                    class="nav-item {{ request()->routeIs('events.create') ? 'active' : '' }}">
                    <i class="bi bi-calendar-event"></i>
                    <span>Create Event</span>
                </a>

                <div class="nav-section mt-4">Management</div>

                <a href="{{ route('personnel.create') }}"
                    class="nav-item {{ request()->routeIs('personnel.create') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    <span>Personnel</span>
                </a>

                <a href="{{ route('documents.index') }}"
                    class="nav-item {{ request()->routeIs('documents.index') ? 'active' : '' }}">
                    <i class="bi bi-folder2-open"></i>
                    <span>File Management</span>
                </a>

            </div>

            <div class="col-md-10 p-4" style="margin-left: 16.6667%;">
                <span class="navbar-brand mb-0 h5">
                    Good Day, {{ Auth::user()->name }}!
                </span>

                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>