<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $product->product }} - SupleMex</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

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
        }

        /* NAVBAR */
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

        .nav-link {
            color: white !important;
            font-weight: 600;
            padding: 0.7rem 1rem !important;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .cart-count {
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            padding: 4px 8px;
            font-size: 0.75rem;
            margin-left: 6px;
            vertical-align: top;
        }

        .section-title {
            font-size: 2.2rem;
            font-weight: 700;
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

        .btn-add-cart {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            color: white;
            padding: 0.75rem;
            border-radius: 0.5rem;
            font-weight: 600;
        }

        .btn-add-cart:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
            color: white;
        }

        .benefit-card {
            padding: 2rem;
            border-radius: 1rem;
            transition: 0.3s;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(0, 78, 137, 0.1);
        }

        .benefit-icon {
            font-size: 3rem;
            color: var(--primary-color);
        }

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

<body>
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
                    @auth
                        <a href="{{ route('cart.index') }}" class="text-white position-relative text-decoration-none" id="cart-icon-auth">
                            <i class="bi bi-bag fs-5"></i>
                            <span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">0</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-white position-relative text-decoration-none">
                            <i class="bi bi-bag fs-5"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">0</span>
                        </a>
                    @endauth

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
    <div class="container py-5">

        <div class="bg-light py-4 px-3 mb-4 rounded shadow-sm"></div>

        <div class="card shadow-sm border-0 mb-5 p-4 p-md-5">
            <div class="row g-5">

                <div class="col-lg-6 d-flex flex-column align-items-center">
                    <div class="w-100 mb-4 bg-light rounded-3 overflow-hidden d-flex align-items-center justify-content-center"
                        style="max-width: 450px; aspect-ratio: 1/1;">

                        @if($product->photo && $product->photo !== "default.png")
                            <img src="{{ asset('storage/' . $product->photo) }}" class="img-fluid"
                                style="object-fit: cover; width:100%; height:100%;">
                        @else
                            <div class="text-center text-muted">
                                <i class="bi bi-image" style="font-size: 5rem;"></i>
                                <p>Imagen no disponible</p>
                            </div>
                        @endif
                    </div>

                    @if($product->warning)
                        <div class="alert alert-warning border-warning w-100" style="max-width:450px">
                            <h4 class="alert-heading fs-6 fw-bold">⚠️ Advertencia Importante</h4>
                            <p class="mb-0 small">{{ $product->warning }}</p>
                        </div>
                    @endif
                </div>

                <div class="col-lg-6 d-flex flex-column">

                    @if($product->brand)
                        <span class="badge text-bg-primary fw-semibold mb-2"
                            style="background-color:var(--secondary-color) !important;">
                            {{ $product->brand->brand }}
                        </span>
                    @endif

                    <h1 class="display-5 fw-bold">{{ $product->product }}</h1>

                    <div class="my-3 border-bottom pb-3">
                        <span class="fs-1 fw-bold text-danger">${{ number_format($product->sale_price, 2, ',', '.') }}</span>
                        <p class="text-success fw-semibold">
                            <i class="bi bi-check-circle-fill me-1"></i> Envío GRATIS a nivel nacional
                        </p>
                    </div>

                    <h3 class="fs-5 fw-bold">Descripción del Producto</h3>
                    <p class="text-muted">{{ $product->description ?? 'Sin descripción disponible' }}</p>

                    @if($product->how_to_use)
                        <div class="p-3 rounded-3 mb-4"
                            style="background-color:rgba(0,78,137,0.05); border:1px solid rgba(0,78,137,0.1);">
                            <h4 class="fs-6 fw-bold">💡 Cómo Usar</h4>
                            <p class="small text-muted">{{ $product->how_to_use }}</p>
                        </div>
                    @endif

                    <form id="addToCartForm" class="mt-auto">
                        @csrf
                        <div class="d-flex align-items-center mb-3">
                            <label class="me-3 fw-semibold">Cantidad:</label>

                            <input type="number" id="quantity" name="quantity" min="1" value="1"
                                class="form-control text-center me-3" style="width:80px;">

                            <input type="hidden" name="id_product" value="{{ $product->id_product }}">

                            <button type="submit" class="btn btn-add-cart flex-grow-1">
                                <i class="bi bi-bag-plus me-2"></i> Añadir al Carrito
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row g-4 mb-5 text-center">
            <div class="col-md-4">
                <div class="card benefit-card shadow-sm border-0">
                    <div class="benefit-icon"><i class="bi bi-truck"></i></div>
                    <h5 class="fw-bold">Entrega Rápida</h5>
                    <p>2-3 días hábiles</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card benefit-card shadow-sm border-0">
                    <div class="benefit-icon" style="color:var(--success-color)">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                    <h5 class="fw-bold">Garantía Original</h5>
                    <p>Producto 100% original</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card benefit-card shadow-sm border-0">
                    <div class="benefit-icon" style="color:var(--secondary-color)">
                        <i class="bi bi-arrow-return-left"></i>
                    </div>
                    <h5 class="fw-bold">Devoluciones Fáciles</h5>
                    <p>30 días para cambios</p>
                </div>
            </div>
        </div>

        @if($relatedProducts->count() > 0)
            <div class="card shadow-sm border-0 p-4 p-md-5">
                <h2 class="section-title mb-5">Productos Relacionados</h2>

                <div class="row g-4">
                    @foreach($relatedProducts as $related)
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="{{ route('product.show', $related->id_product) }}" class="text-decoration-none">
                                <div class="card product-card h-100">
                                    <div class="overflow-hidden" style="height:200px;">
                                        @if($related->photo && $related->photo !== "default.png")
                                            <img src="{{ asset('storage/' . $related->photo) }}"
                                                 class="card-img-top"
                                                 style="height:100%;object-fit:cover;">
                                        @else
                                            <div class="d-flex align-items-center justify-content-center bg-light h-100">
                                                <i class="bi bi-image" style="font-size:3rem;color:#ced4da;"></i>
                                            </div>
                                        @endif
                                    </div>

                                    <div class="card-body p-3 d-flex flex-column">
                                        <h5 class="fw-semibold text-truncate">{{ $related->product }}</h5>
                                        <p class="product-price fs-5 mt-auto mb-2">
                                            ${{ number_format($related->sale_price, 2, ',', '.') }}
                                        </p>
                                        <div class="text-warning small">
                                            @for($i = 0; $i < 5; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>

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
                <p>&copy; 2025 SUPLEMEX. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.getElementById('addToCartForm').addEventListener('submit', function(e) {
            e.preventDefault();

            fetch('{{ route("cart.add") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    id_product: {{ $product->id_product }},
                    quantity: parseInt(document.getElementById("quantity").value)
                })
            })
                .then(r => r.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        document.querySelector(".cart-count").textContent = data.count ?? 0;
                    } else {
                        alert("Error: " + data.message);
                    }
                })
                .catch(err => {
                    console.error(err);
                    alert("Error al añadir al carrito");
                });
        });
    </script>

</body>
</html>
