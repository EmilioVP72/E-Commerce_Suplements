@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Inventario</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateInventoryForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="id_product" class="form-label">Producto</label>
                    <select class="form-control" id="id_product" name="id_product" required>
                        <option value="">Seleccionar producto...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="min_quantity" class="form-label">Cantidad Mínima</label>
                    <input type="number" class="form-control" id="min_quantity" name="min_quantity" step="0.01" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('inventories.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Inventario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const inventoryId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    // Cargar productos
    try {
        const productsResponse = await fetch("{{ url('/api/products/all') }}");
        const productsResult = await productsResponse.json();
        
        if (productsResult.data) {
            const productSelect = document.getElementById('id_product');
            productsResult.data.forEach(product => {
                const option = document.createElement('option');
                option.value = product.id_product;
                option.textContent = product.product;
                productSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading products:', error);
    }

    // Cargar datos del inventario
    const fetchUrl = `{{ url('/api/inventories/OneInventory') }}/${inventoryId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const inventory = result.data;
            document.getElementById('id_product').value = inventory.id_product || '';
            document.getElementById('quantity').value = inventory.quantity || '';
            document.getElementById('min_quantity').value = inventory.min_quantity || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos del inventario.');
        }
    } catch (error) {
        console.error('Error fetching inventory data:', error);
        alert('Error al cargar los datos del inventario.');
    }
});

document.getElementById('updateInventoryForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/inventories/UpdateInventory') }}/${inventoryId}`;

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
            alert(result.message || 'Inventario actualizado con éxito');
            window.location.href = "{{ route('inventories.index') }}";
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
