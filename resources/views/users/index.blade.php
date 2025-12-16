@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Usuarios</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Usuario
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
                            <th scope="col">Nombre</th>
                            <th scope="col">Email</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>
                                    @if($user->photo)
                                        @php
                                            // Detecta si es una URL completa (de seeder) o ruta relativa (cargada por usuario)
                                            $photoUrl = $user->photo;
                                            
                                            if (str_contains($photoUrl, 'http://') || str_contains($photoUrl, 'https://')) {
                                                $photoUrl = str_replace('http://localhost/', 'http://localhost:8000/', $photoUrl);
                                            } else {
                                                $photoUrl = asset('storage/' . $photoUrl);
                                            }
                                        @endphp
                                        <img src="{{ $photoUrl }}" alt="Foto de {{ $user->name }}" style="max-width: 50px; max-height: 50px; border-radius: 5px; object-fit: cover;">
                                    @else
                                        <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                                    @endif
                                </td>
                                <td>{{ $user->name }} {{ $user->lastname1 ?? '' }} {{ $user->lastname2 ?? '' }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone ?? 'N/A' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteUser({{ $user->id }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteUser(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar este usuario?')) {
        return;
    }

    const url = `{{ url('/api/users/DeleteUser') }}/${id}`;

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
        alert('No se pudo eliminar el usuario.');
    }
}
</script>
@endsection
