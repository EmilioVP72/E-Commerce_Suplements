@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nueva Relación Marca-Catálogo</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createBrandCatalogForm">
                @csrf
                <div class="mb-3">
                    <label for="id_brand" class="form-label">Marca</label>
                    <select class="form-control" id="id_brand" name="id_brand" required>
                        <option value="">Seleccionar marca...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_catalog" class="form-label">Catálogo</label>
                    <select class="form-control" id="id_catalog" name="id_catalog" required>
                        <option value="">Seleccionar catálogo...</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Relación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Cargar marcas
    try {
        const brandsResponse = await fetch("{{ url('/api/brands/all') }}");
        const brandsResult = await brandsResponse.json();
        
        if (brandsResult.data) {
            const brandSelect = document.getElementById('id_brand');
            brandsResult.data.forEach(brand => {
                const option = document.createElement('option');
                option.value = brand.id_brand;
                option.textContent = brand.brand;
                brandSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading brands:', error);
    }

    // Cargar catálogos
    try {
        const catalogsResponse = await fetch("{{ url('/api/catalogs/all') }}");
        const catalogsResult = await catalogsResponse.json();
        
        if (catalogsResult.data) {
            const catalogSelect = document.getElementById('id_catalog');
            catalogsResult.data.forEach(catalog => {
                const option = document.createElement('option');
                option.value = catalog.id_catalog;
                option.textContent = catalog.catalog;
                catalogSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading catalogs:', error);
    }
});

document.getElementById('createBrandCatalogForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/brandcatalogs/StoreBrandCatalog') }}";

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
            alert(result.message || 'Relación creada con éxito');
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
