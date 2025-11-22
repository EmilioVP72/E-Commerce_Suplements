@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Catálogo</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateCatalogForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="catalog" class="form-label">Nombre del Catálogo</label>
                    <input type="text" class="form-control" id="catalog" name="catalog" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('catalogs.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Catálogo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const catalogId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/catalogs/OneCatalog') }}/${catalogId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const catalog = result.data;
            document.getElementById('catalog').value = catalog.catalog || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos del catálogo.');
        }
    } catch (error) {
        console.error('Error fetching catalog data:', error);
        alert('Error al cargar los datos del catálogo.');
    }
});

document.getElementById('updateCatalogForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/catalogs/UpdateCatalog') }}/${catalogId}`;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message || 'Catálogo actualizado con éxito');
            window.location.href = "{{ route('catalogs.index') }}";
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
