@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Privilegios</h1>
        <a href="{{ route('privileges.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Privilegio
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Privilegio</th>
                            <th scope="col">Descripción</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($privileges as $privilege)
                            <tr>
                                <th scope="row">{{ $privilege->id_privilege }}</th>
                                <td>{{ $privilege->privilege }}</td>
                                <td>{{ $privilege->description ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('privileges.edit', $privilege->id_privilege) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deletePrivilege({{ $privilege->id_privilege }})"><i class="bi bi-trash-fill"></i></button>
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
async function deletePrivilege(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este privilegio?')) {
        return;
    }

    const url = `{{ url('/api/privileges/DeletePrivilege') }}/${id}`;

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
        alert('No se pudo eliminar el privilegio.');
    }
}
</script>
@endsection
