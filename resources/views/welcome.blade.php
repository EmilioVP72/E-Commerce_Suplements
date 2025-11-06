<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Suplements - Tu tienda de suplementos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Figtree', sans-serif;
        }

        .navbar {
            background-color: #212529 !important;
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
        }

        .card {
            transition: transform .2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .btn-custom {
            background-color: #28a745;
            border-color: #28a745;
            color: white;
        }

        .btn-custom:hover {
            background-color: #218838;
            border-color: #1e7e34;
        }

        .footer {
            background-color: #212529;
            color: white;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Suplements</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Sobre Nosotros</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <div class="d-flex">
                    @if (Route::has('login'))
                    @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Log in</a>
                    @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-success">Register</a>
                    @endif
                    @else
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/' . Auth::user()->photo) }}"
                                alt="{{ Auth::user()->name }}"
                                width="32" height="32"
                                class="rounded-circle me-2">
                            <strong>{{ Auth::user()->name }} {{ Auth::user()->lastname1 }}</strong>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Editar Perfil</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar Sesión</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                    @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://placehold.co/1920x500/212529/FFF?text=Promocion+1" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Las mejores proteinas</h5>
                    <p>Alcanza tus metas con nuestra selección premium.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://placehold.co/1920x500/343a40/FFF?text=Promocion+2" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Energía que no se acaba</h5>
                    <p>Descubre nuestros pre-entrenos y lleva tu rutina al siguiente nivel.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://placehold.co/1920x500/495057/FFF?text=Promocion+3" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Recuperación y Bienestar</h5>
                    <p>Vitaminas y minerales para un cuerpo sano.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Product Cards -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Nuestros Productos</h2>
        <div class="row">
            {{-- Suponiendo que pasas una variable $products a la vista --}}
            @if(isset($products) && !$products->isEmpty())
            @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ $product->photo ?? 'https://placehold.co/600x400' }}" class="card-img-top" alt="{{ $product->product }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $product->product }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <h6 class="card-subtitle mb-2 text-muted">${{ number_format($product->sale_price, 2) }}</h6>
                        <a href="#" class="btn btn-custom mt-auto">Ver Producto</a>
                    </div>
                </div>
            </div>
            @endforeach
            @else
            {{-- Tarjetas de ejemplo si no hay productos --}}
            @for ($i = 0; $i < 6; $i++)
                <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="https://placehold.co/600x400/cccccc/212529?text=Producto" class="card-img-top" alt="Producto de ejemplo">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Producto de Ejemplo {{ $i + 1 }}</h5>
                        <p class="card-text">Esta es una breve descripción del suplemento. Ideal para tus entrenamientos.</p>
                        <h6 class="card-subtitle mb-2 text-muted">$999.99</h6>
                        <a href="#" class="btn btn-custom mt-auto">Ver Producto</a>
                    </div>
                </div>
        </div>
        @endfor
        @endif
    </div>
    </div>

    <!-- Footer -->
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>© {{ date('Y') }} Suplements. Todos los derechos reservados.</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>