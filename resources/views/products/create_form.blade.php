@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Producto</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createProductForm" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="product" class="form-label">Nombre del Producto</label>
                    <input type="text" class="form-control" id="product" name="product" required>
                </div>
                <div class="mb-3">
                    <label for="id_brand" class="form-label">Marca</label>
                    <select class="form-control" id="id_brand" name="id_brand" required>
                        <option value="">Seleccionar marca...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto del Producto</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                </div>
                <div class="mb-3">
                    <label for="sale_price" class="form-label">Precio de Venta</label>
                    <input type="number" class="form-control" id="sale_price" name="sale_price" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_price" class="form-label">Precio de Compra</label>
                    <input type="number" class="form-control" id="purchase_price" name="purchase_price" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="how_to_use" class="form-label">Modo de Uso</label>
                    <textarea class="form-control" id="how_to_use" name="how_to_use" rows="3"></textarea>
                </div>
                <div class="mb-3">
                    <label for="warning" class="form-label">Advertencia</label>
                    <textarea class="form-control" id="warning" name="warning" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
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
});

document.getElementById('createProductForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/products/StoreProduct') }}";

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
            alert(result.message || 'Producto creado con éxito');
            window.location.href = "{{ route('products.index') }}";
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
