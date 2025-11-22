@extends('administration')

@section('content')
<div class="container-fluid">
    {{-- Encabezado y botón de acción --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Inventario</h1>
        <a href="{{ route('inventories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Añadir Inventario
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad Actual</th>
                            <th scope="col">Cantidad Mínima</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($inventories as $item)
                            <tr>
                                <th scope="row">{{ $item->id_inventory }}</th>
                                <td>{{ $item->product->product ?? 'Producto no encontrado' }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ $item->min_quantity }}</td>
                                
                                <td class="text-end">
                                    <a href="{{ route('inventory.edit', $item->id_inventory) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    
                                    <form action="{{ route('inventory.destroy', $item->id_inventory) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este registro de inventario?')">
                                            <i class="bi bi-trash-fill"></i>
                                        </button>
                                    </form>
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