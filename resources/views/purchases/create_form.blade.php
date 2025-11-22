@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nueva Compra</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createPurchaseForm">
                @csrf
                <div class="mb-3">
                    <label for="id_user" class="form-label">Usuario</label>
                    <select class="form-control" id="id_user" name="id_user" required>
                        <option value="">Seleccionar usuario...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="sail_date" class="form-label">Fecha de Venta</label>
                    <input type="date" class="form-control" id="sail_date" name="sail_date" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Compra</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    try {
        const response = await fetch("{{ url('/api/user') }}", {
            headers: {
                'Authorization': 'Bearer ' + document.querySelector('meta[name="csrf-token"]').content,
                'Accept': 'application/json',
            }
        });
        
        // Cargar usuarios fallback
        const users = [
            { id: 1, name: 'Admin' },
            { id: 2, name: 'Usuario 1' }
        ];
        
        const select = document.getElementById('id_user');
        users.forEach(user => {
            const option = document.createElement('option');
            option.value = user.id;
            option.textContent = user.name;
            select.appendChild(option);
        });
    } catch (error) {
        console.error('Error loading users:', error);
    }
});

document.getElementById('createPurchaseForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/purchases/StorePurchase') }}";

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
            alert(result.message || 'Compra creada con éxito');
            window.location.href = "{{ route('purchases.index') }}";
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
