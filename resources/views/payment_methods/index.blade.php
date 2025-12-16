@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Métodos de Pago</h1>
        <a href="{{ route('payment_methods.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Método de Pago
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($paymentMethods as $paymentMethod)
                            <tr>
                                <th scope="row">{{ $paymentMethod->id_payment_method }}</th>
                                <td>{{ $paymentMethod->payment_method }}</td>
                                <td class="text-end">
                                    <a href="{{ route('payment_methods.edit', $paymentMethod->id_payment_method) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePaymentMethod({{ $paymentMethod->id_payment_method }})"><i class="bi bi-trash-fill"></i></button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
async function deletePaymentMethod(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este método de pago??')) {
        return;
    }

    const url = `{{ url('/api/paymentmethods/DeletePaymentMethod') }}/${id}`;

    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
        });

        const result = await response.json();
        alert(result.message || 'Acción completada.');
        location.reload();
    } catch (error) {
        console.error('Error:', error);
        alert('No se pudo eliminar el método de pago.');
    }
}
</script>
@endsection
