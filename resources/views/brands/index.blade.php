@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Marcas</h1>
        <a href="{{ route('brands.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Marca
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($brands as $brand)
                            <tr>
                                <th scope="row">{{ $brand->id_brand }}</th>
                                <td>{{ $brand->name }}</td>
                                <td>{{ Str::limit($brand->description, 80) }}</td>
                                <td class="text-end">
                                    <a href="{{ route('brands.edit', $brand->id_brand) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square me-1"></i>Editar
                                    </a>
                                    <form action="{{ route('brands.destroy', $brand->id_brand) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta marca?')"><i class="bi bi-trash3 me-1"></i>Eliminar</button>
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