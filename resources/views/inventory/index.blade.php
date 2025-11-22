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
                                    <a href="{{ route('inventories.edit', $item->id_inventory) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteInventory({{ $item->id_inventory }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
async function deleteInventory(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este registro de inventario?')) {
        return;
    }

    const url = `{{ url('/api/inventories/DeleteInventory') }}/${id}`;

    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        });

        const result = await response.json();
        alert(result.message || 'Acción completada.');
        location.reload();
    } catch (error) {
        console.error('Error:', error);
        alert('No se pudo eliminar el registro de inventario.');
    }
}
</script>
@endsection