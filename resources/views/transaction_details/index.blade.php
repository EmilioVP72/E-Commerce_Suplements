@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Detalles de Transacciones</h1>
        <a href="{{ route('transaction_details.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Detalle de Transacción
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
                            <th scope="col">Transacción</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Precio</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactionDetails as $detail)
                            <tr>
                                <th scope="row">{{ $detail->id }}</th>
                                <td>{{ $detail->transaction->id_transaction ?? 'Transacción no disponible' }}</td>
                                <td>{{ $detail->product->product ?? 'Producto no disponible' }}</td>
                                <td>{{ $detail->quantity }}</td>
                                <td>${{ number_format($detail->price, 2) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('transaction_details.edit', $detail->id_transaction_detail) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteTransactionDetail({{ $detail->id_transaction_detail }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteTransactionDetail(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este detalle?')) {
        return;
    }

    const url = `{{ url('/api/transactiondetails/DeleteTransactionDetail') }}/${id}`;

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
        alert('No se pudo eliminar el detalle.');
    }
}
</script>
@endsection
