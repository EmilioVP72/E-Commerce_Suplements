@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Detalles de Compras</h1>
        <a href="{{ route('purchase_details.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Detalle de Compra
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
                            <th scope="col">Compra</th>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($purchaseDetails as $detail)
                            <tr>
                                <th scope="row">{{ $detail->id }}</th>
                                <td>{{ $detail->purchase->id_purchase ?? 'Compra no disponible' }}</td>
                                <td>{{ $detail->product->product ?? 'Producto no disponible' }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td class="text-end">
                                    <a href="{{ route('purchase_details.edit', $detail->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('purchase_details.destroy', $detail->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este detalle?')"><i class="bi bi-trash-fill"></i></button>
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
