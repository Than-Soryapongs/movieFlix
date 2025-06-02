<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>@yield('title', 'MovieApp')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        html, body {
            height: 100%;
            background-color: #000; /* black background */
            color: #fff; /* white text by default */
        }
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        main.container {
            flex: 1 0 auto;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        footer {
            flex-shrink: 0;
            background: #1a1a1a; /* dark black/grey footer */
            padding: 1rem 0;
            text-align: center;
            border-top: 2px solid #dc3545; /* bootstrap red */
            color: #dc3545;
            font-weight: 600;
        }
        .navbar {
            background-color: #111; /* dark navbar */
        }
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        .navbar-brand span {
            color: #dc3545; /* red brand text */
            font-weight: 700;
            font-size: 1.5rem;
        }
        .navbar-collapse {
            justify-content: flex-end;
            align-items: center;
        }
        form.d-flex {
            margin-right: 1rem;
            max-width: 300px; /* This will be overridden by responsive styles */
            width: 100%; /* This will be overridden by responsive styles */
        }
        form.d-flex input.form-control {
            background-color: #222;
            border: 1px solid #dc3545;
            color: #fff;
        }
        form.d-flex input.form-control::placeholder {
            color: #ff7b7b;
        }
        form.d-flex input.form-control:focus {
            background-color: #2a2a2a;
            border-color: #ff4d4d;
            color: #fff;
            box-shadow: 0 0 5px #ff4d4d;
        }
        form.d-flex button.btn-outline-primary {
            border-color: #dc3545;
            color: #dc3545;
            transition: background-color 0.3s ease;
        }
        form.d-flex button.btn-outline-primary:hover {
            background-color: #dc3545;
            color: #fff;
        }
        .dropdown-toggle.btn-outline-dark {
            color: #dc3545;
            border-color: #dc3545;
            background-color: transparent;
        }
        .dropdown-toggle.btn-outline-dark:hover,
        .dropdown-toggle.btn-outline-dark:focus {
            background-color: #dc3545;
            color: #fff;
            border-color: #b02a37;
        }
        .dropdown-menu {
            background-color: #111;
            border: 1px solid #dc3545;
        }
        .dropdown-menu a.dropdown-item {
            color: #ff6b6b;
            display: flex;
            align-items: center;
        }
        .dropdown-menu a.dropdown-item:hover {
            background-color: #dc3545;
            color: #fff;
        }
        .dropdown-menu a.dropdown-item .bi {
            margin-right: 0.5rem;
            font-size: 1.1rem;
        }
        a.btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }
        a.btn-primary:hover {
            background-color: #b02a37;
            border-color: #b02a37;
            color: #fff;
        }

        /* Custom styles for the filter button and dropdown */
        .filter-dropdown .dropdown-menu {
            min-width: 280px; /* Increased width to accommodate labels and selects better */
            padding: 1rem; /* Added padding to the dropdown menu */
            background-color: #111; /* Dark background */
            border: 1px solid #dc3545; /* Red border */
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.5); /* Subtle shadow */
        }

        .filter-dropdown .dropdown-menu .form-label {
            margin-bottom: 0.25rem; /* Space between label and select */
            font-size: 0.9rem;
            color: #fff; /* Ensure labels are visible in dark mode */
        }

        .filter-dropdown .dropdown-menu .form-select {
            background-color: #222; /* Darker background for selects */
            border: 1px solid #dc3545; /* Red border for selects */
            color: #fff; /* White text for selects */
            padding: 0.5rem 1rem; /* Adjust padding for better look */
        }

        .filter-dropdown .dropdown-menu .form-select option {
            background-color: #111; /* Ensure options have dark background */
            color: #fff;
        }

        .filter-dropdown .dropdown-menu .form-select:focus {
            background-color: #2a2a2a;
            border-color: #ff4d4d;
            color: #fff;
            box-shadow: 0 0 5px rgba(220, 53, 69, 0.5); /* Matching shadow */
        }

        .filter-dropdown .btn-outline-primary {
            display: flex; /* Allow icon and text to align */
            align-items: center;
        }

        .filter-dropdown .btn-outline-primary .bi {
            margin-left: 0.5rem; /* Space between text and icon */
        }

        .filter-dropdown .btn-primary {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .filter-dropdown .btn-primary:hover {
            background-color: #b02a37;
            border-color: #b02a37;
        }

        /* Ensure the dropdown doesn't close when clicking inside select elements */
        .filter-dropdown .dropdown-menu {
            user-select: none; /* Prevent text selection issues */
        }
        /* This is generally handled by Bootstrap's JS for form elements, but adding if issues persist */
        .filter-dropdown .dropdown-menu form .form-select {
            pointer-events: all;
        }


        @media (max-width: 991px) {
            .navbar-collapse {
                justify-content: flex-start;
                margin-top: 1rem;
                flex-direction: column; /* Stack items vertically */
                align-items: flex-start;
            }
            form.d-flex {
                margin: 0 0 1rem 0;
                max-width: none;
                width: 100%;
                flex-direction: column;
                align-items: stretch; /* Stretch items to full width */
                margin-right: 0 !important; /* Override default margin */
                gap: 1rem; /* Add space between elements */
            }
            form.d-flex input.form-control {
                margin-right: 0 !important; /* Remove horizontal margin */
            }
            .filter-dropdown {
                width: 100%; /* Make filter dropdown full width */
            }
            .filter-dropdown button {
                width: 100%; /* Make filter button full width */
            }
            .filter-dropdown .dropdown-menu {
                width: 100%; /* Make dropdown menu full width on small screens */
                min-width: unset; /* Remove min-width restriction */
            }
            form.d-flex button.d-none.d-lg-block {
                display: none !important; /* Hide the extra search button on small screens */
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm px-4">
    <a class="navbar-brand d-flex align-items-center" href="/">
        <span class="ms-2">MovieFlix</span>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
            aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarContent">
        <form action="{{ route('home') }}" method="GET" class="d-flex flex-grow-1 me-2 align-items-center">
            <input
                type="search"
                name="q"
                class="form-control me-2"
                placeholder="Search movies..."
                value="{{ request('q') }}"
                aria-label="Search movies"
            />

            <div class="dropdown filter-dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter <i class="bi bi-funnel"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="filterDropdown">
                    <li class="mb-2">
                        <label for="actor-filter" class="form-label">Filter by Actor:</label>
                        <select name="actor" id="actor-filter" class="form-select">
                            <option value="">All Actors</option>
                            @foreach ($actors as $actor)
                                <option value="{{ $actor->id }}" {{ request('actor') == $actor->id ? 'selected' : '' }}>
                                    {{ $actor->name }}
                                </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="mb-2">
                        <label for="director-filter" class="form-label">Filter by Director:</label>
                        <select name="director" id="director-filter" class="form-select">
                            <option value="">All Directors</option>
                            @foreach ($directors as $director)
                                <option value="{{ $director->id }}" {{ request('director') == $director->id ? 'selected' : '' }}>
                                    {{ $director->name }}
                                </option>
                            @endforeach
                        </select>
                    </li>

                    <li class="mb-3">
                        <label for="genre-filter" class="form-label">Filter by Genre:</label>
                        <select name="genre" id="genre-filter" class="form-select">
                            <option value="">All Genres</option>
                            @foreach ($genres as $genre)
                                <option value="{{ $genre->id }}" {{ request('genre') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                            @endforeach
                        </select>
                    </li>

                    <li>
                        <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                    </li>
                </ul>
            </div>
            <button type="submit" class="btn btn-outline-primary d-none d-lg-block ms-2">Search</button>
        </form>


        @auth
            @php
                $user = Auth::user();
            @endphp
            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Avatar" width="20" height="20" class="rounded-circle me-1" style="vertical-align: middle;">
                    @else
                        <i class="bi bi-person-circle me-1"></i>
                    @endif
                    {{ $user->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ url('/user/dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary ms-3">Login</a>
        @endauth
    </div>
</nav>

<main class="container">
    @yield('content')
</main>

<footer>
    <div class="container">
        <p class="mb-0">&copy; {{ date('Y') }} MovieFlix. All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>