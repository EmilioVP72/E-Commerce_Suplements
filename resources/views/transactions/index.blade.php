@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Transacciones</h1>
        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Transacción
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
                            <th scope="col">Usuario</th>
                            <th scope="col">Fecha de Transacción</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <th scope="row">{{ $transaction->id_transaction }}</th>
                                <td>{{ $transaction->user->name ?? 'Usuario no disponible' }}</td>
                                <td>{{ $transaction->transaction_date ? \Carbon\Carbon::parse($transaction->transaction_date)->format('d/m/Y') : 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('transactions.edit', $transaction->id_transaction) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction->id_transaction) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta transacción?')"><i class="bi bi-trash-fill"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
