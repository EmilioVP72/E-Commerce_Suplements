@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Método de Pago</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createPaymentMethodForm">
                @csrf
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Método de Pago</label>
                    <input type="text" class="form-control" id="payment_method" name="payment_method" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Método de Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('createPaymentMethodForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/paymentmethods/StorePaymentMethod') }}";

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
            alert(result.message || 'Método de pago creado con éxito');
            window.location.href = "{{ route('payment_methods.index') }}";
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
