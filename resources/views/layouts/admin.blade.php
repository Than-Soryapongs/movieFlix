<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        body {
            display: flex;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .sidebar {
            width: 240px;
            background-color: #212529;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding-top: 1rem;
        }
        .sidebar h4 {
            margin-bottom: 1rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            border-bottom: 1px solid #495057;
            padding-bottom: 0.75rem;
            text-align: center;
        }
        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 600;
        }
        .sidebar a:hover {
            background-color: #495057;
            color: #fff;
        }
        .sidebar a .bi {
            font-size: 1.2rem;
        }
        .content {
            flex-grow: 1;
            padding: 1.5rem 2rem;
            overflow-y: auto;
        }
        .navbar {
            border-bottom: 1px solid #dee2e6;
            margin-bottom: 1.5rem;
        }
        form.mt-auto {
            padding: 1rem 1.5rem;
        }
        form.mt-auto button {
            font-weight: 700;
        }
        .sidebar a.active {
            background-color: #495057;
            color: #fff;
        }
    </style>
</head>
@stack('scripts')
<body>
    <!-- Sidebar -->
    <nav class="sidebar">
        <h4>Admin Panel</h4>

        <a href="{{ route('admin.dashboard') }}" class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-house-door-fill"></i> Home
        </a>

        <a href="{{ route('admin.account.show') }}" class="{{ Route::is('admin.account.show') ? 'active' : '' }}">
            <i class="bi bi-person-circle"></i> Admin Profile
        </a>

        <a href="{{ route('admin.users.index') }}" class="{{ Route::is('admin.users.index') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Manage Users
        </a>

        <a href="{{ route('admin.movies.index') }}" class="{{ Route::is('admin.movies.*') ? 'active' : '' }}">
            <i class="bi bi-film"></i> Manage Movies
        </a>

        <a href="{{ route('admin.actors.index') }}" class="{{ Route::is('admin.actors.*') ? 'active' : '' }}">
            <i class="bi bi-person-video2"></i> Manage Characters
        </a>
        <a href="{{ route('admin.genres.index') }}" class="{{ Route::is('admin.genres.*') ? 'active' : '' }}">
            <i class="bi bi-tags-fill"></i> Manage Genres
        </a>
        <a href="{{ route('admin.directors.index') }}" class="{{ Route::is('admin.directors.*') ? 'active' : '' }}">
            <i class="bi bi-person-video3"></i> Manage Directors
        </a>

        <form method="POST" action="{{ route('logout') }}" class="mt-auto">
            @csrf
            <button type="submit" class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </nav>

    <!-- Main Content -->
    <div class="content">
        <nav class="navbar navbar-light bg-white shadow-sm rounded">
            <div class="container-fluid px-0">
                <span class="navbar-brand mb-0 h4">Admin Dashboard</span>
            </div>
        </nav>

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
