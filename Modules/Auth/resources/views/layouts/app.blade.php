<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Valorent - Sewa Akun Valorant')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        :root {
        --color-primary: #ff4654;
        --color-secondary: #ba3a46; 
        --color-tertiary: #6c757d;
        }
        /* Make body use flexbox and full height */
        html, body {
            height: 100%;
            margin: 0;
        }
        
        body {
            display: flex;
            flex-direction: column;
            background-color: #0f1923;
            padding-top: 60px;
            min-height: 100vh;
        }
        
        /* Main content takes remaining space */
        main {
            flex: 1 0 auto;
            padding: 0;
            margin-top: 56px;
        }
        
        /* Footer stays at bottom */
        footer {
            flex-shrink: 0;
        }

        .btn-primary {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #e63e4b;
            border-color: #e63e4b;
            color: #fff;
        }

        .btn-outline-primary {
            color: var(--color-primary);
            border-color: var(--color-primary);
            background-color: transparent;
        }

        .btn-outline-primary:hover {
            border-color: var(--color-primary);
            background-color: var(--color-primary);
            color: #fff;
        }
         /* Custom styling for hero section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-color: #1a2332;
        }

        .hero .hero-text {
            max-width: 600px;
        }

        .hero .hero-image img {
            border-radius: 10px;
            max-width: 100%;
            height: auto;
        }

        .navbar {
            padding: 0.5rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.25rem;
            padding: 0.5rem 0;
        }

        /* Section styling */
        section.info, section.security, section.features, section.testimonials {
            padding: 60px 0;
        }

        section.info {
            background-color: #0f1923;
        }

        section.security {
            background-color: #1a2332;
        }

        section.features {
            background-color: #0f1923;
        }

        section.testimonials {
            background-color: #1a2332;
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--color-primary);
            margin-bottom: 20px;
        }

        .privacy-card {
            padding: 30px;
            border: 2px solid ##f1f5f9;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .privacy-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .feature-card {
            padding: 30px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .testimonial-card {
            border-radius: 8px;
            border: 2px solid #fff;
            padding: 30px;
            box-shadow: 0 0 15px rgb(0 0 0 / 0.1);
            margin-bottom: 30px;
        }

        /* Navbar hover effect */
        .navbar-dark .navbar-nav .nav-link {
            position: relative;
            padding: 0.5rem 1rem;
            padding-bottom: 1.25rem;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar-dark .navbar-nav .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--color-primary);
            transform: scaleX(0);
            transition: transform 0.3s ease;
        }

        .navbar-dark .navbar-nav .nav-link:hover::after,
        .navbar-dark .navbar-nav .nav-link.active::after {
            transform: scaleX(1);
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #fff;
        }

        .navbar-dark .navbar-nav .nav-item {
            margin: 0;
        }

        .navbar-collapse {
            align-items: center;
        }

        .navbar-toggler {
            padding: 0.25rem 0.5rem;
            font-size: 1rem;
        }

        /* Dropdown styling */
        .dropdown-menu {
            background-color: #1a2332;
            border: 1px solid #2a3442;
        }

        .dropdown-item {
            color: #fff;
        }

        .dropdown-item:hover {
            background-color: #2a3442;
            color: var(--color-primary);
        }

        .dropdown-divider {
            border-top: 1px solid #2a3442;
        }
    </style>
    
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Valorent</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('catalog.index') }}">Catalog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('rental.my-rentals') }}">My Rentals</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('profile.show') }}">Profile</a></li>
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3" style="margin-top: 70px; z-index: 1040; position: relative;" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3" style="margin-top: 70px; z-index: 1040; position: relative;" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">&copy; 2025 Valorent - Sewa Akun Valorant</p>
        </div>
    </footer>

    <!-- Bootstrap JS & Bootstrap Icons -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" />

    @stack('scripts')
</body>
</html>
