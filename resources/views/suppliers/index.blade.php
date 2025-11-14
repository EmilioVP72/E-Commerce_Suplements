@extends('administration')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Proveedores</h1>
        <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Proveedor
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fotografia</th>
                            <th scope="col">Proveedor</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Email</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($suppliers as $supplier)
                            <tr>
                                <th scope="row">{{ $supplier->id_supplier }}</th>
                                <td>
                                    @if ($supplier->photo)
                                        @php
                                            $correctUrl = str_replace('http://localhost/', 'http://localhost:8000/', $supplier->photo);
                                        @endphp
                                        <img src="{{ $correctUrl }}" alt="Foto del Proveedor" style="max-width: 50px; max-height: 50px; border-radius: 5px;">
                                    @else
                                        No disponible
                                    @endif
                                </td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->phone ?? 'No disponible' }}</td>
                                <td>{{ $supplier->email ?? 'No disponible' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <form action="{{ route('suppliers.destroy', $supplier->id_supplier) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este proveedor?')"><i class="bi bi-trash-fill"></i></button>
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
