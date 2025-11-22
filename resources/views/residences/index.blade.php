@extends('administration')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="m-0">Gestión de Residencias</h1>
        <a href="{{ route('residences.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Crear Residencia
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
                            <th scope="col">Dirección</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Estado</th>
                            <th scope="col">País</th>
                            <th scope="col" class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residences as $residence)
                            <tr>
                                <th scope="row">{{ $residence->id_residence }}</th>
                                <td>{{ $residence->address }}</td>
                                <td>{{ $residence->city }}</td>
                                <td>{{ $residence->state }}</td>
                                <td>{{ $residence->country }}</td>
                                <td class="text-end">
                                    <a href="{{ route('residences.edit', $residence->id_residence) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="deleteResidence({{ $residence->id_residence }})"><i class="bi bi-trash-fill"></i></button>
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
async function deleteResidence(id) {
    if (!confirm('¿Estás seguro de que quieres eliminar esta residencia?')) {
        return;
    }

    const url = `{{ url('/api/residences/DeleteResidence') }}/${id}`;

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
        alert('No se pudo eliminar la residencia.');
    }
}
</script>
@endsection
