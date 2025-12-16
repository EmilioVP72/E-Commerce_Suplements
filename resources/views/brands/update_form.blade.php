@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Marca</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateBrandForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="brand" class="form-label">Nombre de la Marca</label>
                    <input type="text" class="form-control" id="brand" name="brand" required>
                </div>
                <div class="mb-3">
                    <label for="id_supplier" class="form-label">Proveedor</label>
                    <select class="form-control" id="id_supplier" name="id_supplier" required>
                        <option value="">Selecciona un proveedor</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id_supplier }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('brands.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Marca</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const brandId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/brands/OneBrand') }}/${brandId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const brand = result.data;
            document.getElementById('brand').value = brand.brand || '';
            document.getElementById('id_supplier').value = brand.id_supplier || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos de la marca.');
        }
    } catch (error) {
        console.error('Error fetching brand data:', error);
        alert('Error al cargar los datos de la marca.');
    }
});

document.getElementById('updateBrandForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/brands/UpdateBrand') }}/${brandId}`;

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
            alert(result.message || 'Marca actualizada con éxito');
            window.location.href = "{{ route('brands.index') }}";
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
