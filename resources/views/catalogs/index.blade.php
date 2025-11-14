{{-- Usamos el layout del panel de administración --}}
@extends('administration')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-5">Gestión de Catálogos</h1>
        {{-- Botón para crear un nuevo registro --}}
        <a href="#" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i> Nuevo Catálogo
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nombre del Catálogo</th>
                            <th scope="col">Fecha de Creación</th>
                            <th scope="col" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Iteramos sobre los catálogos que vienen del controlador --}}
                        @forelse ($catalogs as $catalog)
                            <tr>
                                <th scope="row">{{ $catalog->id }}</th>
                                <td>{{ $catalog->catalog }}</td>
                                <td>{{ $catalog->created_at->format('d/m/Y') }}</td>
                                <td class="text-center">
                                    {{-- Botones de acción --}}
                                    <a href="#" class="btn btn-sm btn-warning" title="Editar">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Eliminar">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No hay catálogos registrados.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
