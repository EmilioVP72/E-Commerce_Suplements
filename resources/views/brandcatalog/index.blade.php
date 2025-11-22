@extends('administration')

@section('content')
<div>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Asociación de Marcas y Catálogos</h1>
        <a href="{{-- {{ route('brand_catalogs.create') }} --}}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Asociar Marca y Catálogo
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Marca</th>
                            <th scope="col">Catálogo</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Asumiendo que la variable se llamará $brandCatalogs --}}
                        @foreach($brandCatalogs as $brandCatalog)
                            <tr>
                                <td>{{ $brandCatalog->brand->name ?? 'No disponible' }}</td>
                                <td>{{ $brandCatalog->catalog->name ?? 'No disponible' }}</td>
                                <td class="text-end">
                                    {{-- La edición de una tabla pivote no es común, usualmente se elimina y se crea una nueva asociación --}}
                                    {{-- Por eso, el botón de editar está comentado --}}
                                    {{-- <a href="#" class="btn btn-warning btn-sm"><i class="bi bi-pencil-fill"></i></a> --}}
                                    <form action="{{-- {{ route('brand_catalogs.destroy', ['id_brand' => $brandCatalog->id_brand, 'id_catalog' => $brandCatalog->id_catalog]) }} --}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar esta asociación?')"><i class="bi bi-trash-fill"></i></button>
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
