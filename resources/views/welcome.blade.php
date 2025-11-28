<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>SupleMex - Tu tienda de suplementos</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
            --dark-bg: #1a1a1a;
            --light-bg: #f8f9fa;
            --text-dark: #212529;
            --text-light: #6c757d;
            --success-color: #00A86B;
            --warning-color: #FFB703;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: var(--light-bg);
            color: var(--text-dark);
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%);
            box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: white !important;
            letter-spacing: -0.5px;
            text-transform: uppercase;
            background: linear-gradient(135deg, #FF6B35, #F77F00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%);
            padding: 4rem 2rem;
            color: white;
            text-align: center;
            margin-top: 0;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            letter-spacing: -1px;
        }

        .hero-section p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.95;
        }

        .carousel-item img {
            height: 500px;
            object-fit: cover;
            filter: brightness(0.85);
        }

        .carousel-caption {
            background: linear-gradient(to top, rgba(0, 78, 137, 0.8), transparent);
            bottom: 0;
            top: auto;
        }

        .carousel-caption h5 {
            font-size: 2rem;
            font-weight: 700;
        }

        .carousel-caption p {
            font-size: 1.1rem;
        }

        /* Section Titles */
        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
        }

        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border-radius: 2px;
        }

        /* Product Cards */
        .product-card {
            border: none;
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 78, 137, 0.15);
        }

        .product-card img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .product-card:hover img {
            transform: scale(1.05);
        }

        .product-card .card-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 1.5rem;
        }

        .product-card .card-title {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 1.1rem;
        }

        .product-card .card-text {
            color: var(--text-light);
            font-size: 0.9rem;
            flex: 1;
            margin-bottom: 1rem;
        }

        .product-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            border: none;
            color: white;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
            color: white;
        }

        /* Benefits Section */
        .benefits-section {
            background: white;
            padding: 4rem 2rem;
            margin: 3rem 0;
        }

        .benefit-card {
            text-align: center;
            padding: 2rem;
            border-radius: 1rem;
            transition: all 0.3s ease;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 78, 137, 0.1);
        }

        .benefit-icon {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .benefit-card h5 {
            font-weight: 700;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
        }

        .benefit-card p {
            color: var(--text-light);
            font-size: 0.95rem;
        }

        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1a1a1a 100%);
            color: white;
            padding: 3rem 2rem 1rem;
            margin-top: 3rem;
        }

        .footer-section h6 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--accent-color);
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
        }

        .footer-section ul li {
            margin-bottom: 0.5rem;
        }

        .footer-section ul li a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-section ul li a:hover {
            color: var(--primary-color);
            padding-left: 5px;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 2rem;
            margin-top: 2rem;
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }

        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
        }

        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 2rem;
            }

            .hero-section p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 1.8rem;
            }

            .carousel-item img {
                height: 300px;
            }

            .carousel-caption h5 {
                font-size: 1.2rem;
            }

            .carousel-caption p {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body class="antialiased">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top" style="background: linear-gradient(135deg, #004E89 0%, #003d6b 100%);">
        <div class="container-fluid px-md-4">
            <a class="navbar-brand d-flex align-items-center gap-2 fw-bold" href="{{ route('home') }}">
                <i class="bi bi-capsule text-warning"></i>
                <span class="d-none d-sm-inline">SUPLEMEX</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio"><i class="bi bi-house me-2"></i>Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#productos"><i class="bi bi-basket me-2"></i>Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#beneficios"><i class="bi bi-star me-2"></i>Beneficios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto"><i class="bi bi-envelope me-2"></i>Contacto</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <a href="#carrito" class="text-white position-relative text-decoration-none">
                        <i class="bi bi-bag fs-5"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">0</span>
                    </a>

                    @auth
                        <div class="dropdown">
                            <button class="btn btn-link text-white text-decoration-none dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, #FF6B35, #F77F00); display: flex; align-items: center; justify-content: center; color: white; font-weight: 600;">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <span class="d-none d-md-inline text-white small">{{ Auth::user()->name }}</span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" style="border-radius: 0.75rem; box-shadow: 0 8px 24px rgba(0,0,0,0.12);">
                                <li><h6 class="dropdown-header fw-bold">{{ Auth::user()->name }}</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                
                                <!-- Opciones de usuario -->
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i>Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="#pedidos"><i class="bi bi-box-seam me-2"></i>Mis Pedidos</a></li>
                                
                                <!-- Opciones de administrador -->
                                @if(Auth::user()->hasRole('Administrador'))
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-warning fw-bold" href="{{ route('administration') }}"><i class="bi bi-gear me-2"></i>Panel Administrativo</a></li>
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

    <!-- Hero Section -->
    <section class="hero-section" id="inicio">
        <div class="container">
            <h1>Potencia tu Rendimiento</h1>
            <p>Suplementos premium para tu estilo de vida activo</p>
            <a href="#productos" class="btn btn-warning btn-lg fw-bold">
                <i class="bi bi-arrow-down me-2"></i>Explorar Productos
            </a>
        </div>
    </section>

    <!-- Carousel -->
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('./images/banner_proteina.jpg') }}" class="d-block w-100" alt="Proteínas">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Proteínas de Alta Calidad</h5>
                    <p>Acelera tu recuperación muscular</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner_vitaminas.jpg') }}" class="d-block w-100" alt="Vitaminas">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Vitaminas Esenciales</h5>
                    <p>Mantén tu energía durante el día</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/banner_promo.jpg') }}" class="d-block w-100" alt="Pre-entrenos">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Paquetes Especiales</h5>
                    <p>Maximiza tu rendimiento en el gimnasio</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Product Cards -->
    <div class="container mt-5" id="productos">
        <div class="text-center mb-5">
            <h2 class="section-title">Nuestros Productos Destacados</h2>
        </div>
        <div class="row g-4">
            @if(isset($products) && !$products->isEmpty())
                @foreach ($products as $product)
                    <div class="col-md-6 col-lg-4">
                        <div class="card product-card">
                            <img src="{{ asset('storage/' . $product->photo) }}" class="card-img-top" alt="{{ $product->product }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->product }}</h5>
                                <p class="card-text">{{ Str::limit($product->description, 80) }}</p>
                                <div class="product-price">${{ number_format($product->sale_price, 2) }}</div>
                                <a href="{{ route('product.show', $product->id_product) }}" class="btn btn-add-cart">
                                    <i class="bi bi-bag-plus me-2"></i>Ver Producto
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @for ($i = 1; $i <= 6; $i++)
                    <div class="col-md-6 col-lg-4">
                        <div class="card product-card">
                            <img src="https://images.unsplash.com/photo-1584208694987-3c1a92f23fbc?w=500&h=250&fit=crop" class="card-img-top" alt="Proteína {{ $i }}">
                            <div class="card-body">
                                <h5 class="card-title">Proteína Whey Premium</h5>
                                <p class="card-text">Proteína de suero de alta pureza con 25g de proteína por serv.</p>
                                <div class="product-price">$45.99</div>
                                <button class="btn btn-add-cart">
                                    <i class="bi bi-bag-plus me-2"></i>Agregar al Carrito
                                </button>
                            </div>
                        </div>
                    </div>
                @endfor
            @endif
        </div>
    </div>

    <!-- Benefits Section -->
    <section class="benefits-section" id="beneficios">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="section-title">¿Por Qué Elegir Suplements?</h2>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-check-circle-fill"></i>
                        </div>
                        <h5>100% Garantizado</h5>
                        <p>Productos certificados y de máxima calidad</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-truck"></i>
                        </div>
                        <h5>Envío Rápido</h5>
                        <p>Entrega en 24-48 horas a todo el país</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-credit-card"></i>
                        </div>
                        <h5>Pago Seguro</h5>
                        <p>Múltiples opciones de pago confiables</p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="benefit-card">
                        <div class="benefit-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h5>Soporte 24/7</h5>
                        <p>Atención al cliente disponible siempre</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contacto">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3 footer-section">
                    <h6><i class="bi bi-capsule me-2"></i>SUPLEMENTS</h6>
                    <p>Tu tienda de confianza para suplementos de calidad premium.</p>
                </div>
                <div class="col-md-6 col-lg-3 footer-section">
                    <h6>Productos</h6>
                    <ul>
                        <li><a href="#">Proteínas</a></li>
                        <li><a href="#">Vitaminas</a></li>
                        <li><a href="#">Pre-Entrenos</a></li>
                        <li><a href="#">Suplementos</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 footer-section">
                    <h6>Empresa</h6>
                    <ul>
                        <li><a href="#">Sobre Nosotros</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contacto</a></li>
                        <li><a href="#">Política de Privacidad</a></li>
                    </ul>
                </div>
                <div class="col-md-6 col-lg-3 footer-section">
                    <h6>Síguenos</h6>
                    <div class="social-links">
                        <a href="#facebook" title="Facebook"><i class="bi bi-facebook"></i></a>
                        <a href="#instagram" title="Instagram"><i class="bi bi-instagram"></i></a>
                        <a href="#twitter" title="Twitter"><i class="bi bi-twitter"></i></a>
                        <a href="#youtube" title="YouTube"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 SUPLEMENTS. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>