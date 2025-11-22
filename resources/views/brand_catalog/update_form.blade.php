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
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_catalog" class="form-label">Catálogo</label>
                    <select class="form-control" id="id_catalog" name="id_catalog" required>
                        <option value="">Seleccionar catálogo...</option>
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
const relationId = {{ $id }};

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

    // Cargar datos de la relación
    const fetchUrl = `{{ url('/api/brandcatalogs/OneBrandCatalog') }}/${relationId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const relation = result.data;
            document.getElementById('id_brand').value = relation.id_brand || '';
            document.getElementById('id_catalog').value = relation.id_catalog || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos de la relación.');
        }
    } catch (error) {
        console.error('Error fetching brand catalog data:', error);
        alert('Error al cargar los datos de la relación.');
    }
});

document.getElementById('updateBrandCatalogForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/brandcatalogs/UpdateBrandCatalog') }}/${relationId}`;

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
