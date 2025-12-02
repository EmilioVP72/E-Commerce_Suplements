@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Relación Marca-Catálogo</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateBrandCatalogForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="id_brand" class="form-label">Marca</label>
                    <select class="form-control" id="id_brand" name="id_brand" required>
                        <option value="">Seleccionar marca...</option>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id_brand }}" 
                                {{ $brand->id_brand == $id_brand ? 'selected' : '' }}>
                                {{ $brand->brand }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_catalog" class="form-label">Catálogo</label>
                    <select class="form-control" id="id_catalog" name="id_catalog" required>
                        <option value="">Seleccionar catálogo...</option>
                        @foreach($catalogs as $catalog)
                            <option value="{{ $catalog->id_catalog }}" 
                                {{ $catalog->id_catalog == $id_catalog ? 'selected' : '' }}>
                                {{ $catalog->catalog }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('brand_catalogs.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Relación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const relationBrand = {{ $relationBrand }};
const relationCatalog = {{ $relationCatalog }};

// SUBMIT UPDATE
document.getElementById('updateBrandCatalogForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);

    // URL correcta: incluye ambos IDs
    const url = `{{ url('/api/brandcatalogs/UpdateBrandCatalog') }}/${relationBrand}/${relationCatalog}`;

    try {
        const response = await fetch(url, {
            method: 'POST', // porque usas formData + _method PUT
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message || 'Relación actualizada con éxito');
            window.location.href = "{{ route('brand_catalogs.index') }}";
        } else {
            let errorMessage = result.message || 'Ocurrió un error.';
            if (result.errors) {
                errorMessage += '\n' + Object.values(result.errors).flat().join('\n');
            }
            alert(errorMessage);
        }

    } catch (error) {
        console.error('Error:', error);
        alert('No se pudo conectar con el servidor.');
    }
});
</script>
@endsection
