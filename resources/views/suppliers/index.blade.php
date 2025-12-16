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
                            <th scope="col">Fotografía</th>
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
                                            $photoUrl = $supplier->photo;
                                        
                                            if (str_contains($photoUrl, 'http://') || str_contains($photoUrl, 'https://')) {
                                                $photoUrl = str_replace('http://localhost/', 'http://localhost:8000/', $photoUrl);
                                            } else {
                                                $photoUrl = asset('storage/' . $photoUrl);
                                            }
                                        @endphp
                                        <img src="{{ $photoUrl }}" alt="Foto de {{ $supplier->name }}" style="max-width: 50px; max-height: 50px; border-radius: 5px; object-fit: cover;">
                                    @else
                                        <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                                    @endif
                                </td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->phone ?? 'No disponible' }}</td>
                                <td>{{ $supplier->email ?? 'No disponible' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('suppliers.edit', $supplier->id_supplier) }}" class="btn btn-warning btn-sm"> <!-- Updated route -->
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteSupplier( {{ $supplier->id_supplier }} )"><i class="bi bi-trash-fill"></i></button>
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
async function deleteSupplier(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este proveedor?')) {
        return;
    }

    const url = `{{ url('/api/suppliers/DeleteSupplier') }}/${id}`;

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
        alert('No se pudo eliminar el proveedor.');
    }
}
</script>
@endsection
