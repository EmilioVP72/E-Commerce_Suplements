@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Catálogo</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createCatalogForm">
                @csrf
                <div class="mb-3">
                    <label for="catalog" class="form-label">Nombre del Catálogo</label>
                    <input type="text" class="form-control" id="catalog" name="catalog" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Catálogo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('createCatalogForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/catalogs/StoreCatalog') }}";

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
            alert(result.message || 'Catálogo creado con éxito');
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
