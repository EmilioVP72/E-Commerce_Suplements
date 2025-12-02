@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Usuarios-Residencias</h1>
        <a href="{{ route('residence_users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Asignar Residencia a Usuario
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
                            <th scope="col">Residencia</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residenceUsers as $residenceUser)
                            <tr>
                                <th scope="row">{{ $residenceUser->id_residence_user }}</th>
                                <td>{{ $residenceUser->user->name ?? 'Usuario no disponible' }}</td>
                                <td>{{ $residenceUser->residence->address ?? 'Residencia no disponible' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('residence_users.edit', $residenceUser->id_residence_user) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteResidenceUser({{ $residenceUser->id_residence_user }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteResidenceUser(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar esta asociación?')) {
        return;
    }

    const url = `{{ url('/api/residenceusers/DeleteResidenceUser') }}/${id}`;

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
        alert('No se pudo eliminar la asociación.');
    }
}
</script>
@endsection
