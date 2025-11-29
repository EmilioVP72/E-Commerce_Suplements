<nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(135deg, #004E89 0%, #003d6b 100%);">
    <div class="container-fluid px-md-4">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
            <i class="bi bi-capsule text-warning"></i>
            <span class="d-none d-sm-inline">SUPLEMEX</span>
        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">

            <!-- LINKS CENTRALES -->
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ url('/') }}#inicio">
                        <i class="bi bi-house me-2"></i>Inicio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#productos">
                        <i class="bi bi-basket me-2"></i>Productos
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#beneficios">
                        <i class="bi bi-star me-2"></i>Beneficios
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}#contacto">
                        <i class="bi bi-envelope me-2"></i>Contacto
                    </a>
                </li>
            </ul>

            <!-- ICONO CARRITO + LOGIN/USER -->
            <div class="d-flex align-items-center gap-3">

                {{-- ICONO CARRITO --}}
                @auth
                    <a href="{{ route('cart.index') }}" class="text-white position-relative text-decoration-none">
                        <i class="bi bi-bag fs-5"></i>
                        <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.65rem;">0</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="text-white position-relative text-decoration-none">
                        <i class="bi bi-bag fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                            style="font-size: 0.65rem;">0</span>
                    </a>
                @endauth

                {{-- DROPDOWN DE USUARIO --}}
                @auth
                    <div class="dropdown">

                        <button class="btn btn-link text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-2"
                            type="button" data-bs-toggle="dropdown">

                            <div style="width: 32px; height: 32px; border-radius: 50%;
                                background: linear-gradient(135deg, #FF6B35, #F77F00);
                                display: flex; align-items: center; justify-content: center;
                                color: white; font-weight: 600;">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>

                            <span class="d-none d-md-inline text-white small">{{ Auth::user()->name }}</span>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end"
                            style="border-radius: 0.75rem; box-shadow: 0 8px 24px rgba(0,0,0,0.12);">

                            <li><h6 class="dropdown-header fw-bold">{{ Auth::user()->name }}</h6></li>
                            <li><hr class="dropdown-divider"></li>

                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i>Editar Perfil</a>
                            </li>

                            <li><a class="dropdown-item" href="#pedidos">
                                <i class="bi bi-box-seam me-2"></i>Mis Pedidos</a>
                            </li>

                            @if(Auth::user()->hasRole('Administrador'))
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item text-warning fw-bold" href="{{ route('administration') }}">
                                        <i class="bi bi-gear me-2"></i>Panel Administrativo
                                    </a>
                                </li>
                            @endif

                            <li><hr class="dropdown-divider"></li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0">
                                    @csrf
                                    <button class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                @else
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
                    </a>

                    <a href="{{ route('register') }}" class="btn btn-warning btn-sm text-dark fw-bold">
                        <i class="bi bi-person-plus me-2"></i>Registrarse
                    </a>
                @endauth
            </div>

        </div>
    </div>
</nav>
