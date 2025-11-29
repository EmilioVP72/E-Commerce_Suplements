@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Usuario-Roles</h1>
        <a href="{{ route('user_roles.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Asignar Rol
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Rol</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userRoles as $userRole)
                            <tr>
                                <th scope="row">{{ $userRole->id }}</th>
                                <td>{{ $userRole->user->name ?? 'N/A' }}</td>
                                <td>{{ $userRole->rol->rol ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('user_roles.edit', $userRole->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteUserRole({{ $userRole->id }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteUserRole(id) {
    if (!confirm('¿Estás seguro de que quieres revocar este rol del usuario?')) {
        return;
    }

    const url = `{{ url('/api/user-roles') }}/${id}`;

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
        alert('No se pudo eliminar la asignación.');
    }
}
</script>
@endsection
