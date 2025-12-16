{{-- Usamos el layout del panel de administración --}}
@extends('administration')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5">Gestión de Catálogos</h1>
        {{-- Botón para crear un nuevo registro --}}
        <a href="{{ route('catalogs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Nuevo Catálogo
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre del Catálogo</th>
                            <th scope="col">Fecha de Creación</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Iteramos sobre los catálogos que vienen del controlador --}}
                        @forelse ($catalogs as $catalog)
                            <tr>
                                <th scope="row">{{ $catalog->id_catalog }}</th>
                                <td>{{ $catalog->catalog }}</td>
                                <td>{{ $catalog->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    {{-- Botones de acción --}}
                                    <a href="{{ route('catalogs.edit', $catalog->id_catalog) }}" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" onclick="deleteCatalog({{ $catalog->id_catalog }})" title="Eliminar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No hay catálogos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
async function deleteCatalog(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este catálogo?')) {
        return;
    }

    const url = `{{ url('/api/catalogs/DeleteCatalog') }}/${id}`;

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
        alert('No se pudo eliminar el catálogo.');
    }
}
</script>
@endsection
