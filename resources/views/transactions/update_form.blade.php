@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Transacción</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateTransactionForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="id_user" class="form-label">Usuario</label>
                    <select class="form-control" id="id_user" name="id_user" required>
                        <option value="">Seleccionar usuario...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="transaction_date" class="form-label">Fecha de Transacción</label>
                    <input type="date" class="form-control" id="transaction_date" name="transaction_date" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Transacción</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const transactionId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    // Cargar usuarios
    try {
        const usersResponse = await fetch("{{ url('/api/users/all') }}");
        const usersResult = await usersResponse.json();
        
        if (usersResult.data) {
            const userSelect = document.getElementById('id_user');
            usersResult.data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id_user;
                option.textContent = user.name;
                userSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading users:', error);
    }

    // Cargar datos de la transacción
    const fetchUrl = `{{ url('/api/transactions/OneTransaction') }}/${transactionId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const transaction = result.data;
            document.getElementById('id_user').value = transaction.id_user;
            document.getElementById('transaction_date').value = transaction.transaction_date;
        } else {
            alert(result.message || 'No se pudieron cargar los datos de la transacción.');
        }
    } catch (error) {
        console.error('Error fetching transaction data:', error);
        alert('Error al cargar los datos de la transacción.');
    }
});

document.getElementById('updateTransactionForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/transactions/UpdateTransaction') }}/${transactionId}`;

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
            alert(result.message || 'Transacción actualizada con éxito');
            window.location.href = "{{ route('transactions.index') }}";
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
