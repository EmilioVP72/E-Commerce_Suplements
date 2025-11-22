@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Detalle de Compra</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updatePurchaseDetailForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="id_purchase" class="form-label">Compra</label>
                    <select class="form-control" id="id_purchase" name="id_purchase" required>
                        <option value="">Seleccionar compra...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_product" class="form-label">Producto</label>
                    <select class="form-control" id="id_product" name="id_product" required>
                        <option value="">Seleccionar producto...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="amount" class="form-label">Cantidad</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="0.01" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('purchase_details.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Detalle</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const detailId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    // Cargar compras
    try {
        const purchasesResponse = await fetch("{{ url('/api/purchases/all') }}");
        const purchasesResult = await purchasesResponse.json();
        
        if (purchasesResult.data) {
            const purchaseSelect = document.getElementById('id_purchase');
            purchasesResult.data.forEach(purchase => {
                const option = document.createElement('option');
                option.value = purchase.id_purchase;
                option.textContent = `Compra #${purchase.id_purchase}`;
                purchaseSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading purchases:', error);
    }

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

    // Cargar datos del detalle
    const fetchUrl = `{{ url('/api/purchasedetails/OnePurchaseDetail') }}/${detailId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const detail = result.data;
            document.getElementById('id_purchase').value = detail.id_purchase;
            document.getElementById('id_product').value = detail.id_product;
            document.getElementById('amount').value = detail.amount;
        } else {
            alert(result.message || 'No se pudieron cargar los datos del detalle.');
        }
    } catch (error) {
        console.error('Error fetching detail data:', error);
        alert('Error al cargar los datos del detalle.');
    }
});

document.getElementById('updatePurchaseDetailForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/purchasedetails/UpdatePurchaseDetail') }}/${detailId}`;

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
            alert(result.message || 'Detalle actualizado con éxito');
            window.location.href = "{{ route('purchase_details.index') }}";
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
