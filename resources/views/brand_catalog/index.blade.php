@extends('administration')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Asociación de Marcas y Catálogos</h1>
        <a href="{{ route('brand_catalogs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Asociar Marca y Catálogo
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Catálogo</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Asumiendo que la variable se llamará $brandCatalogs --}}
                        @foreach($brandCatalogs as $brandCatalog)
                            <tr>
                                <td>{{ $brandCatalog->brand->brand ?? 'No disponible' }}</td>
                                <td>{{ $brandCatalog->catalog->catalog ?? 'No disponible' }}</td>
                                <td class="text-end">
                                    {{-- La edición de una tabla pivote no es común, usualmente se elimina y se crea una nueva asociación --}}
                                    {{-- Por eso, el botón de editar está comentado --}}
                                    {{-- <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a> --}}
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteBrandCatalog({{ $brandCatalog->id_brand_catalog }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteBrandCatalog(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar esta asociación marca-catálogo?')) {
        return;
    }

    const url = `{{ url('/api/brandcatalogs/DeleteBrandCatalog') }}/${id}`;

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
        alert('No se pudo eliminar la asociación marca-catálogo.');
    }
}
</script>
@endsection
