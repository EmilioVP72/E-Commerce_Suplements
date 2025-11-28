<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(135deg, #004E89 0%, #003d6b 100%);">
    <div class="container-fluid px-md-4">
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
            <i class="bi bi-capsule text-warning"></i>
            <span class="d-none d-sm-inline">SUPLEMENTS</span>
        </a>

        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Navigation Links (Center) -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="bi bi-house me-2"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#productos">
                        <i class="bi bi-basket me-2"></i>Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about">
                        <i class="bi bi-info-circle me-2"></i>Sobre Nosotros
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contact">
                        <i class="bi bi-envelope me-2"></i>Contacto
                    </a>
                </li>
            </ul>

            <!-- Right Section: Cart & Auth -->
            <div class="d-flex align-items-center gap-3">
                <!-- Cart Icon -->
                <a href="#carrito" class="text-white position-relative text-decoration-none">
                    <i class="bi bi-bag fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">0</span>
                </a>

                @auth
                    <!-- User Dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="avatar-circle" style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #FF6B35, #F77F00); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="d-none d-md-inline text-white small">{{ Auth::user()->name }}</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 0.75rem; box-shadow: 0 8px 24px rgba(0,0,0,0.12);">
                            <li><h6 class="dropdown-header fw-bold">{{ Auth::user()->name }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="#pedidos"><i class="bi bi-box-seam me-2"></i>Mis Pedidos</a></li>
                            
                            @if(Auth::user()->hasRole('Administrador'))
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-warning" href="{{ route('administration') }}"><i class="bi bi-gear me-2"></i>Administración</a></li>
                            @endif
                            
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <!-- Auth Buttons -->
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-warning btn-sm text-dark fw-600">
                        <i class="bi bi-person-plus me-2"></i>Registrarse
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<style>
    :root {
        --primary-color: #FF6B35;
        --secondary-color: #004E89;
        --accent-color: #F77F00;
    }

    .navbar {
        box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
        padding: 0.75rem 0;
    }

    .navbar-brand {
        font-size: 1.4rem;
        letter-spacing: -0.5px;
        color: white !important;
    }

    .navbar-nav .nav-link {
        color: rgba(255, 255, 255, 0.85) !important;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        padding: 0.5rem 1rem !important;
    }

    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active {
        color: var(--accent-color) !important;
    }

    .navbar-nav .nav-link::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 1rem;
        width: calc(100% - 2rem);
        height: 2px;
        background: var(--accent-color);
        transform: scaleX(0);
        transform-origin: right;
        transition: transform 0.3s ease;
    }

    .navbar-nav .nav-link:hover::after,
    .navbar-nav .nav-link.active::after {
        transform: scaleX(1);
        transform-origin: left;
    }

    .dropdown-menu {
        border: none;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dropdown-item {
        padding: 0.75rem 1.25rem;
        transition: all 0.2s ease;
        color: #212529;
        font-weight: 500;
    }

    .dropdown-item:hover {
        background-color: #f8f9fa;
        color: var(--primary-color);
        padding-left: 1.5rem;
    }

    @media (max-width: 768px) {
        .navbar-brand {
            font-size: 1.2rem;
        }

        .navbar-nav .nav-link {
            padding: 0.5rem 0 !important;
            margin: 0.25rem 0;
        }

        .navbar-nav .nav-link::after {
            display: none;
        }
    }
</style>