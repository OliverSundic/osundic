<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @stack('styles')

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #001233;
            --accent-color: #0466c8;
        }

        main {
            padding-top: 4rem;
        }

        .dropdown-menu {
            background-color: var(--secondary-color);
            border: 1px solid var(--accent-color);
        }

        .dropdown-item {
            color: rgba(255,255,255,0.8) !important;
        }

        .dropdown-item:hover {
            background-color: var(--accent-color);
            color: white !important;
        }

        .navbar-custom {
            background-color: var(--secondary-color) !important;
            padding: 0.5rem 2rem;
        }

        .nav-link-custom {
            color: rgba(255,255,255,0.8) !important;
            transition: all 0.3s ease;
        }

        .nav-link-custom:hover {
            color: var(--accent-color) !important;
            transform: translateX(5px);
        }

        .burger-menu {
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .offcanvas {
            background-color: var(--secondary-color) !important;
            max-width: 250px;
        }

        .hero-section {
            height: 70vh;
            background: linear-gradient(rgba(0,0,0,0.7));
            display: flex;
            align-items: center;
            margin-bottom: 4rem;
        }

        .ship-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: none;
            border-radius: 15px;
            overflow: hidden;
        }

        .ship-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .featured-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: var(--accent-color);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
        }

        footer {
            background: var(--secondary-color);
            color: white;
            padding: 3rem 0;
            margin-top: 5rem;
        }
    </style>
    </head>

    <body>
        <!-- Navigation -->
        <nav class="navbar navbar-custom fixed-top">
            <div class="container-fluid">
                <button class="burger-menu" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar">
                    <i class="fas fa-bars"></i>
                </button>
                <a class="navbar-brand text-white ms-3" href="/"><img src="/logo.png" style="height: 50px" alt="Harbor"></a>
            </div>
        </nav>
    
        <!-- Sidebar Menu -->
        <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title text-white">Menu</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <nav class="nav flex-column">
                    @auth
                        <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" 
                        data-bs-toggle="dropdown" aria-expanded="false">
                            @if(auth()->user()->profile_image)
                                <img src="{{ auth()->user()->profile_image_url }}" 
                                    class="rounded-circle me-2" 
                                    style="width: 30px; height: 30px; object-fit: cover;">
                            @else
                                <i class="fas fa-user me-2"></i>
                            @endif
                            {{ Auth::user()->name }}
                        </a>
                    @endauth

                    <a class="nav-link nav-link-custom mb-3" href="/">Home</a>
                    <a class="nav-link nav-link-custom mb-3" href="/ships">Ships</a>
                    <a class="nav-link nav-link-custom mb-3" href="/contact">Contact</a>

                    @auth
                        <!-- Authenticated User Menu -->
                        <div class="dropdown">
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('profile.show') }}">
                                        <i class="fas fa-user me-2"></i> Profile
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-sign-out-alt me-2"></i> Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
    
                        <a class="nav-link nav-link-custom mb-3" href="{{ route('cargos.index') }}">
                            <i class="fas fa-shipping-fast me-2"></i> Place Shipment
                        </a>
    
                        @if(auth()->user()->role === 'editor' || auth()->user()->role === 'admin')
                            <a class="nav-link nav-link-custom mb-3" href="{{ route('schedules.index') }}">
                                <i class="fas fa-calendar-alt me-2"></i> Manage Schedules
                            </a>
                        @endif
    
                        @if(auth()->user()->role === 'admin')
                            <a class="nav-link nav-link-custom mb-3" href="{{ route('admin.ships.index') }}">
                                <i class="fas fa-ship me-2"></i> Manage Ships
                            </a>
                        @endif
                        @if(auth()->user()->role === 'editor')
                            <!-- Editor links -->
                        @endif
                    @else
                        <!-- Guest Menu -->
                        <a class="nav-link nav-link-custom mb-3" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt me-2"></i> Login
                        </a>
                        <a class="nav-link nav-link-custom mb-3" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i> Register
                        </a>
                    @endauth

                    
                    
                </nav>
            </div>
        </div>
    
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <h5>Harbor Shipping Co.</h5>
                        <p class="mt-3">24/7 Global Operations<br>
                        contact@harborshipping.com<br>
                        +1 (555) 123-4567</p>
                    </div>
                    <div class="col-md-4">
                        <h5>Services</h5>
                        <ul class="list-unstyled">
                            <li><a href="#" class="text-white text-decoration-none">Cargo Shipping</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Port Management</a></li>
                            <li><a href="#" class="text-white text-decoration-none">Logistics Solutions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <h5>Connect</h5>
                        <div class="social-links mt-3">
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-linkedin"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-5 pt-3 border-top">
                    <p class="mb-0">&copy; 2025 Harbor Shipping Co. All rights reserved.</p>
                </div>
            </div>
        </footer>
    
        @stack('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            // Add smooth scrolling behavior
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    document.querySelector(this.getAttribute('href')).scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });
        </script>
    </body>

    
</html>
