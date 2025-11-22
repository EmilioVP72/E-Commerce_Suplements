@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Detalle de Transacción</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createTransactionDetailForm">
                @csrf
                <div class="mb-3">
                    <label for="id_transaction" class="form-label">Transacción</label>
                    <select class="form-control" id="id_transaction" name="id_transaction" required>
                        <option value="">Seleccionar transacción...</option>
                    </select>
                </div>
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
                    <label for="price" class="form-label">Precio</label>
                    <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Detalle de Transacción</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Cargar transacciones
    try {
        const transactionsResponse = await fetch("{{ url('/api/transactions/all') }}");
        const transactionsResult = await transactionsResponse.json();
        
        if (transactionsResult.data) {
            const transactionSelect = document.getElementById('id_transaction');
            transactionsResult.data.forEach(transaction => {
                const option = document.createElement('option');
                option.value = transaction.id_transaction;
                option.textContent = `Transacción #${transaction.id_transaction}`;
                transactionSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading transactions:', error);
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
});

document.getElementById('createTransactionDetailForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/transactiondetails/StoreTransactionDetail') }}";

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
            alert(result.message || 'Detalle de transacción creado con éxito');
            window.location.href = "{{ route('transaction_details.index') }}";
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
