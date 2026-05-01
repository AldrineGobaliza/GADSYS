<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAD Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

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
            background-color: #800080;
            overflow-y: auto; 
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar a.active {
            background-color: #495057;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <div class="sidebar p-0 list-group">
            <h4 class="text-white text-center py-3">GAD Admin</h4>

            <a href="{{ route('posts.index') }}" 
                class="{{ request()->routeIs('posts.index') ? 'active' : '' }}">
                Manage Posts</a>
            <a href="{{ route('posts.create') }}"
                class="{{ request()->routeIs('posts.create') ? 'active' : '' }}">
                Create Post</a>
            <a href="{{ route('events.create') }}"
                class="{{ request()->routeIs('events.create') ? 'active' : '' }}">
                Create Event</a>
            <a href="{{ route('personnel.create') }}"
            class="{{ request()->routeIs('personnel.create') ? 'active' : '' }}">
                Personnel</a>
            <a href="{{ route('documents.index') }}"
            class="{{ request()->routeIs('documents.index') ? 'active' : '' }}">
                File Management</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4" style="margin-left: 16.6667%;">
            <nav class="navbar navbar-light bg-light mb-4">
                <span class="navbar-brand mb-0 h5">
                    Good Day, {{ Auth::user()->name }}!
                </span>
            </nav>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
