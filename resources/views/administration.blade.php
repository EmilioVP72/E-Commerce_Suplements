<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"></div>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Administración - Suplements</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background-color: #212529 !important;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            padding-top: 56px; /* Altura del navbar */
            background-color: #343a40;
        }

        .main-content {
            margin-left: 250px;
            padding: 70px 20px 20px 20px;
            max-width: calc(100vw - 250px);
            overflow-x: hidden;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background-color: #495057;
        }

        .sidebar .nav-item .text-muted {
            color: #90b8ff !important; 
            font-weight: 600; 
            letter-spacing: 0.5px; 
            opacity: 0.8; 
        }

        .card {
            border: none;
            border-radius: .5rem;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="{{ url('/') }}">Suplements</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            @auth
                                {{ Auth::user()->name }}
                            @else
                                Invitado
                            @endauth
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        Cerrar Sesión
                                    </a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar p-3">
        <ul class="nav flex-column">
            {{-- El helper request()->routeIs() comprueba si la ruta actual coincide con el patrón --}}
            <li class="nav-item"><a href="{{ route('administration') }}" class="nav-link {{ request()->routeIs('administration') ? 'active' : '' }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>

            {{-- Nota: La ruta para 'users.index' no está definida en tu archivo web.php. Deberás crearla. --}}
            <li class="nav-item mt-3"><span class="nav-link text-muted" style="cursor: default;"><small>USUARIOS</small></span></li>
            <li class="nav-item mt-3"><a href="#" class="nav-link"><i class="bi bi-people me-2"></i>Usuarios</a></li>
            
            <!-- Sección: Gestión de Productos -->
            <li class="nav-item mt-3"><span class="nav-link text-muted" style="cursor: default;"><small>GESTIÓN DE PRODUCTOS</small></span></li>
            <li class="nav-item"><a href="{{ route('products.index') }}" class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}"><i class="bi bi-box-seam me-2"></i>Productos</a></li>
            <li class="nav-item"><a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}"><i class="bi bi-truck me-2"></i>Proveedores</a></li>
            <li class="nav-item"><a href="{{ route('brands.index') }}" class="nav-link {{ request()->routeIs('brands.*') ? 'active' : '' }}"><i class="bi bi-tags me-2"></i>Marcas</a></li>
            <li class="nav-item"><a href="{{ route('catalogs.index') }}" class="nav-link {{ request()->routeIs('catalogs.*') ? 'active' : '' }}"><i class="bi bi-bookmark me-2"></i>Catálogos</a></li>
            <li class="nav-item"><a href="{{ route('brand_catalogs.index') }}" class="nav-link {{ request()->routeIs('brand_catalogs.*') ? 'active' : '' }}"><i class="bi bi-link-45deg me-2"></i>Asociar Marcas</a></li>
            <li class="nav-item"><a href="{{ route('inventories.index') }}" class="nav-link {{ request()->routeIs('inventories.*') ? 'active' : '' }}"><i class="bi bi-inbox me-2"></i>Inventarios</a></li>

            <!-- Sección: Ventas y Transacciones -->
            <li class="nav-item mt-3"><span class="nav-link text-muted" style="cursor: default;"><small>VENTAS Y TRANSACCIONES</small></span></li>
            <li class="nav-item"><a href="{{ route('purchases.index') }}" class="nav-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}"><i class="bi bi-cart-check me-2"></i>Compras</a></li>
            <li class="nav-item"><a href="{{ route('purchase_details.index') }}" class="nav-link {{ request()->routeIs('purchase_details.*') ? 'active' : '' }}"><i class="bi bi-receipt me-2"></i>Detalles de Compras</a></li>
            <li class="nav-item"><a href="{{ route('transactions.index') }}" class="nav-link {{ request()->routeIs('transactions.*') ? 'active' : '' }}"><i class="bi bi-arrow-left-right me-2"></i>Transacciones</a></li>
            <li class="nav-item"><a href="{{ route('transaction_details.index') }}" class="nav-link {{ request()->routeIs('transaction_details.*') ? 'active' : '' }}"><i class="bi bi-file-text me-2"></i>Detalles de Transacciones</a></li>

            <!-- Sección: Métodos de Pago y Ubicaciones -->
            <li class="nav-item mt-3"><span class="nav-link text-muted" style="cursor: default;"><small>MÉTODOS Y UBICACIONES</small></span></li>
            <li class="nav-item"><a href="{{ route('payment_methods.index') }}" class="nav-link {{ request()->routeIs('payment_methods.*') ? 'active' : '' }}"><i class="bi bi-credit-card me-2"></i>Métodos de Pago</a></li>
            <li class="nav-item"><a href="{{ route('residences.index') }}" class="nav-link {{ request()->routeIs('residences.*') ? 'active' : '' }}"><i class="bi bi-house me-2"></i>Residencias</a></li>
            <li class="nav-item"><a href="{{ route('residence_users.index') }}" class="nav-link {{ request()->routeIs('residence_users.*') ? 'active' : '' }}"><i class="bi bi-person-workspace me-2"></i>Usuarios-Residencias</a></li>
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
