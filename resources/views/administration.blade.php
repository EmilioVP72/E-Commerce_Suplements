<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></div>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administración - SupleMex</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
            --dark-bg: #1a1a1a;
            --light-bg: #f8f9fa;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%) !important;
            box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: white !important;
            letter-spacing: -0.5px;
            background: linear-gradient(135deg, #FF6B35, #F77F00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            padding-top: 70px;
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%);
            box-shadow: 4px 0 12px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            z-index: 99;
        }

        .main-content {
            margin-left: 260px;
            padding: 80px 30px 30px 30px;
            max-width: calc(100vw - 260px);
            overflow-x: hidden;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.7);
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
            margin: 0.5rem 0;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: rgba(255, 107, 53, 0.15);
            border-left-color: var(--primary-color);
            padding-left: 1.75rem;
        }

        .sidebar .nav-item .text-muted {
            color: rgba(255, 255, 255, 0.5) !important;
            font-weight: 600;
            letter-spacing: 0.5px;
            opacity: 0.8;
            padding: 0.75rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 78, 137, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%) !important;
            color: white !important;
            border-bottom: none;
            border-radius: 1rem 1rem 0 0;
        }

        .card-header h5,
        .card-header h6 {
            margin: 0;
            font-weight: 700;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%) !important;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 107, 53, 0.05);
        }

        .badge-success {
            background-color: #00A86B !important;
        }

        .badge-warning {
            background-color: var(--accent-color) !important;
        }

        .badge-danger {
            background-color: #dc3545 !important;
        }

        /* Scrollbar personalizada */
        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 107, 53, 0.3);
            border-radius: 3px;
        }

        .sidebar::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 107, 53, 0.5);
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 0;
                padding-top: 0;
                transition: width 0.3s ease;
            }

            .sidebar.show {
                width: 260px;
            }

            .main-content {
                margin-left: 0;
                padding: 80px 15px 30px 15px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">
                <i class="bi bi-capsule me-2"></i>SUPLEMEX
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            <i class="bi bi-house me-2"></i>Volver a Tienda
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Mi Perfil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i>Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar p-0">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('administration') }}" class="nav-link {{ request()->routeIs('administration') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i>Dashboard
                </a>
            </li>

            <!-- Gestión de Usuarios -->
            <li class="nav-item mt-3">
                <span class="nav-link text-muted" style="cursor: default;">
                    <small><i class="bi bi-people me-2"></i>GESTIÓN DE USUARIOS</small>
                </span>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-people me-2"></i>Usuarios
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="bi bi-shield-check me-2"></i>Roles
                </a>
            </li>

            <!-- Gestión de Productos -->
            <li class="nav-item mt-3">
                <span class="nav-link text-muted" style="cursor: default;">
                    <small><i class="bi bi-box-seam me-2"></i>GESTIÓN DE PRODUCTOS</small>
                </span>
            </li>
            <li class="nav-item">
                <a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
                    <i class="bi bi-box-seam me-2"></i>Productos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
                    <i class="bi bi-truck me-2"></i>Proveedores
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('brands.index') }}" class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i>Marcas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('catalogs.index') }}" class="nav-link {{ request()->routeIs('catalogs.*') ? 'active' : '' }}">
                    <i class="bi bi-bookmark me-2"></i>Catálogos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('brand_catalogs.index') }}" class="nav-link {{ request()->routeIs('brand_catalogs.*') ? 'active' : '' }}">
                    <i class="bi bi-link-45deg me-2"></i>Asociar Marcas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('inventories.index') }}" class="nav-link {{ request()->routeIs('inventories.*') ? 'active' : '' }}">
                    <i class="bi bi-inbox me-2"></i>Inventarios
                </a>
            </li>

            <!-- Gestión de Ventas -->
            <li class="nav-item mt-3">
                <span class="nav-link text-muted" style="cursor: default;">
                    <small><i class="bi bi-bag-check me-2"></i>VENTAS Y TRANSACCIONES</small>
                </span>
            </li>
            <li class="nav-item">
                <a href="{{ route('purchases.index') }}" class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
                    <i class="bi bi-cart-check me-2"></i>Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('purchase_details.index') }}" class="nav-link {{ request()->routeIs('purchase_details.*') ? 'active' : '' }}">
                    <i class="bi bi-receipt me-2"></i>Detalles de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right me-2"></i>Transacciones
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('transaction_details.index') }}" class="nav-link {{ request()->routeIs('transaction_details.*') ? 'active' : '' }}">
                    <i class="bi bi-file-text me-2"></i>Detalles de Transacciones
                </a>
            </li>

            <!-- Gestión de Residencias -->
            <li class="nav-item mt-3">
                <span class="nav-link text-muted" style="cursor: default;">
                    <small><i class="bi bi-building me-2"></i>MÉTODOS Y UBICACIONES</small>
                </span>
            </li>
            <li class="nav-item">
                <a href="{{ route('payment_methods.index') }}" class="nav-link {{ request()->routeIs('payment_methods.*') ? 'active' : '' }}">
                    <i class="bi bi-credit-card me-2"></i>Métodos de Pago
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('residences.index') }}" class="nav-link {{ request()->routeIs('residences.*') ? 'active' : '' }}">
                    <i class="bi bi-house me-2"></i>Residencias
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('residence_users.index') }}" class="nav-link {{ request()->routeIs('residence_users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace me-2"></i>Usuarios-Residencias
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <main class="main-content container-fluid">
        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>
