<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <i class="bi bi-speedometer2 me-2"></i>{{ __('Dashboard') }}
            </h2>
            <span class="badge bg-warning text-dark">
                <i class="bi bi-person-circle me-2"></i>{{ Auth::user()->name }}
            </span>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Stats Row -->
            <div class="row mb-4">
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #FF6B35;">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Mis Pedidos</h6>
                            <h3 class="mb-0" style="color: #FF6B35;"><i class="bi bi-box-seam me-2"></i>0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #004E89;">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Total Gastado</h6>
                            <h3 class="mb-0" style="color: #004E89;"><i class="bi bi-wallet2 me-2"></i>$0.00</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #F77F00;">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Carrito Activo</h6>
                            <h3 class="mb-0" style="color: #F77F00;"><i class="bi bi-bag-check me-2"></i>0</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-0 shadow-sm" style="border-left: 4px solid #00A86B;">
                        <div class="card-body">
                            <h6 class="card-title text-muted">Direcciones</h6>
                            <h3 class="mb-0" style="color: #00A86B;"><i class="bi bi-geo-alt me-2"></i>1</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="row">
                <!-- Recent Orders -->
                <div class="col-lg-8 mb-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-0">
                        <div class="card-header bg-gradient p-3" style="background: linear-gradient(135deg, #004E89 0%, #003d6b 100%); color: white;">
                            <h5 class="mb-0">
                                <i class="bi bi-clock-history me-2"></i>Pedidos Recientes
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Pedido</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th>Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                <i class="bi bi-inbox fs-4"></i>
                                                <p>No hay pedidos aún</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="col-lg-4 mb-4">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-0">
                        <div class="card-header bg-gradient p-3" style="background: linear-gradient(135deg, #FF6B35 0%, #F77F00 100%); color: white;">
                            <h5 class="mb-0">
                                <i class="bi bi-lightning me-2"></i>Acciones Rápidas
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="#" class="btn btn-outline-primary btn-sm">
                                    <i class="bi bi-bag-plus me-2"></i>Continuar Comprando
                                </a>
                                <a href="#" class="btn btn-outline-info btn-sm">
                                    <i class="bi bi-heart me-2"></i>Mis Favoritos
                                </a>
                                <a href="#" class="btn btn-outline-warning btn-sm">
                                    <i class="bi bi-geo-alt me-2"></i>Mis Direcciones
                                </a>
                                <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="bi bi-gear me-2"></i>Editar Perfil
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Info Section -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-0 mt-3">
                        <div class="card-header bg-light p-3">
                            <h6 class="mb-0">
                                <i class="bi bi-info-circle me-2"></i>Información
                            </h6>
                        </div>
                        <div class="card-body small text-muted">
                            <p class="mb-2">
                                <strong>Email:</strong><br>
                                {{ Auth::user()->email }}
                            </p>
                            <p class="mb-0">
                                <strong>Miembro desde:</strong><br>
                                {{ Auth::user()->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Products -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-0 mt-4">
                <div class="card-header bg-gradient p-3" style="background: linear-gradient(135deg, #004E89 0%, #003d6b 100%); color: white;">
                    <h5 class="mb-0">
                        <i class="bi bi-star me-2"></i>Productos Destacados
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @for ($i = 1; $i <= 4; $i++)
                            <div class="col-md-3">
                                <div class="card border-0 shadow-sm h-100">
                                    <img src="https://images.unsplash.com/photo-1584208694987-3c1a92f23fbc?w=300&h=200&fit=crop" class="card-img-top" alt="Producto">
                                    <div class="card-body">
                                        <h6 class="card-title">Proteína Whey</h6>
                                        <p class="card-text small text-muted">Premium Quality</p>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <span class="h6 mb-0" style="color: #FF6B35;">$45.99</span>
                                            <button class="btn btn-sm btn-warning">
                                                <i class="bi bi-bag-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
        }

        .bg-gradient {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%) !important;
        }

        .card {
            border-radius: 0.75rem;
            transition: all 0.3s ease;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 78, 137, 0.15) !important;
            transform: translateY(-2px);
        }

        .btn-outline-primary {
            color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-outline-primary:hover {
            background-color: var(--secondary-color);
        }

        .btn-outline-warning {
            color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .btn-outline-warning:hover {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(255, 107, 53, 0.05);
        }
    </style>
</x-app-layout>
