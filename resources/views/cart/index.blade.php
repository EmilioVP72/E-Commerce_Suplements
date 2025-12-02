<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Mi Carrito - SupleMex</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        /* =================== ESTILOS SUPELMEX (ADMIN STYLE) =================== */
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
            --light-bg: #f8f9fa;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        /* NAVBAR */
        .navbar {
            background: linear-gradient(135deg, var(--secondary-color), #003d6b);
            box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #FF6B35, #F77F00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* CARD GENERAL */
        .custom-card {
            border: none;
            border-radius: 1rem;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            transition: all .3s ease;
        }

        .custom-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 22px rgba(0,0,0,0.15);
        }

        /* TITULOS */
        h3, h4 {
            font-weight: 600;
            color: #333;
        }

        /* BOTONES */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
            font-weight: 600;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(255, 107, 53, 0.3);
        }

        .btn-danger {
            background-color: #d9534f;
            border: none;
        }

        .btn-danger:hover {
            background-color: #c9302c;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
            font-weight: 600;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .quantity-input {
            width: 70px;
        }

        /* PRODUCT ITEM */
        .cart-item {
            border-bottom: 1px solid #ddd;
            padding-bottom: 1rem;
        }

        .cart-item:last-child {
            border-bottom: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-capsule me-2"></i>SUPLEMEX
            </a>
            <a href="{{ route('home') }}" class="text-white fw-semibold">
                <i class="bi bi-arrow-left me-2"></i>Volver a la tienda
            </a>
        </div>
    </nav>

    <main class="container" style="padding-top: 100px;">

        @if($items->count() > 0)

            <div class="row g-4">

                <div class="col-lg-8">
                    <div class="custom-card p-4">
                        <h3 class="mb-4">Productos en tu carrito</h3>

                        @foreach($items as $item)
                        <div class="cart-item d-flex align-items-center justify-content-between" data-cart-id="{{ $item->id_cart }}">
                            
                            <!-- INFO -->
                            <div>
                                <h5 class="fw-bold">{{ $item->product->product }}</h5>
                                <p class="text-muted mb-1">
                                    Precio: ${{ number_format($item->product->sale_price, 2) }}
                                </p>
                            </div>

                            <div>
                                <input type="number"
                                       min="1"
                                       max="{{ $item->product->stock }}"
                                       value="{{ $item->quantity }}"
                                       class="quantity-input form-control"
                                       data-cart-id="{{ $item->id_cart }}">
                            </div>

                            <div class="text-end" style="width: 120px;">
                                <p class="fw-semibold">${{ number_format($item->product->sale_price, 2) }}</p>
                            </div>

                            <!-- ELIMINAR -->
                            <button class="btn btn-danger btn-sm remove-btn" data-cart-id="{{ $item->id_cart }}">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </div>
                        @endforeach

                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="custom-card p-4 h-100">
                        <h4 class="mb-3">Resumen de compra</h4>

                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal:</span>
                            <strong>${{ number_format($total, 2) }}</strong>
                        </div>

                        <div class="d-flex justify-content-between mb-3">
                            <span>Impuestos (0%):</span>
                            <strong>$0.00</strong>
                        </div>

                        <div class="d-flex justify-content-between border-top pt-3 mb-4">
                            <span>Total:</span>
                            <strong class="fs-5">${{ number_format($total, 2) }}</strong>
                        </div>

                        <form action="{{ route('cart.finalize') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary btn-lg w-100 mt-4">
                                <i class="bi bi-credit-card"></i> Pagar Ahora
                            </button>
                        </form>
                        
                        <br>

                        <button class="btn btn-secondary w-100 mb-2 clear-cart-btn">
                            Vaciar carrito
                        </button>

                        <a href="{{ route('home') }}" class="btn btn-primary w-100">
                            Continuar comprando
                        </a>
                    </div>
                </div>

            </div>

        @else
            <div class="custom-card p-5 text-center">
                <h4 class="mb-3">Tu carrito está vacío</h4>
                <a href="{{ route('home') }}" class="btn btn-primary px-5 py-2">
                    Ir a comprar
                </a>
            </div>

        @endif

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.querySelectorAll('.quantity-input').forEach(input => {
            input.addEventListener('change', function() {
                const id = this.dataset.cartId;
                const qty = this.value;

                fetch(`/cart/${id}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ quantity: parseInt(qty) })
                })
                .then(r => r.json())
                .then(d => { location.reload(); });
            });
        });

        document.querySelectorAll('.remove-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.dataset.cartId;

                if (confirm("¿Eliminar este producto?")) {
                    fetch(`/cart/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    })
                    .then(r => r.json())
                    .then(d => { location.reload(); });
                }
            });
        });

        document.querySelector('.clear-cart-btn')?.addEventListener('click', function() {
            if (confirm("¿Vaciar el carrito completo?")) {
                fetch(`/cart`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                })
                .then(r => r.json())
                .then(d => { location.reload(); });
            }
        });
    </script>

</body>
</html>
