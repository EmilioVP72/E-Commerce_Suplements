@extends('administration')

@section('content')
<div class="container-fluid" style="margin-left: 250px; width: calc(100% - 250px);">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Productos</h1>
        <div class="d-flex gap-2">
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-2"></i>Crear Producto
            </a>
            <a href="{{ route('products.print') }}" class="btn btn-outline-secondary">
                <i class="bi bi-printer me-2"></i>Imprimir
            </a>
            <a href="{{ route('products.stats') }}" class="btn btn-outline-success">
                <i class="bi bi-graph-up me-2"></i>Estadísticas
            </a>
            <a href="{{ route('products.export') }}" class="btn btn-success text-white">
                <i class="bi bi-file-earmark-excel me-2"></i> Exportar a Excel
            </a>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fotografía</th>
                            <th scope="col">Producto</th>
                            <th scope="col">P. Venta</th>
                            <th scope="col">P. Compra</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Uso</th>
                            <th scope="col">Advertencias</th>
                            <th scope="col">Marca</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id_product }}</th>

                                {{-- Fotografía --}}
                                <td class="text-center">
                                    @if($product->photo)
                                        <img src="{{ asset('storage/' . $product->photo) }}" alt="Foto" width="60" class="rounded shadow-sm">
                                    @else
                                        <span class="text-muted">Sin imagen</span>
                                    @endif
                                </td>
                                <td>{{ $product->product }}</td>
                                <td>${{ number_format($product->sale_price, 2) }}</td>
                                <td>${{ number_format($product->purchase_price, 2) }}</td>
                                <td>{{ Str::limit($product->description, 40, '...') }}</td>
                                <td>{{ Str::limit($product->how_to_use, 40, '...') }}</td>
                                <td>{{ Str::limit($product->warning, 40, '...') }}</td>
                                <td>{{ $product->brand->brand ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <div class="d-flex flex-column gap-2">
                                        <a href="{{ route('products.edit', $product->id_product) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square me-1"></i>Editar
                                        </a>
                                        <form action="{{ route('products.destroy', $product->id_product) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="bi bi-trash3 me-1"></i>Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
