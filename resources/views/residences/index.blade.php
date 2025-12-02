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
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Código Postal</th>
                            <th>Estado</th>
                            <th>Ciudad</th>
                            <th>Dirección</th>
                            <th>Indicaciones Extra</th>
                            <th class="text-end">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($residences as $residence)
                            <tr>
                                <td>{{ $residence->id_residence }}</td>
                                <td>{{ $residence->{'zip code'} }}</td>
                                <td>{{ $residence->municipality }}</td>
                                <td>{{ $residence->city }}</td>
                                <td>{{ $residence->address }}</td>
                                <td>{{ $residence->extra_directions ?? '—' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('residences.edit', $residence->id_residence) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button class="btn btn-danger btn-sm" onclick="deleteResidence({{ $residence->id_residence }})">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
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
    if (!confirm('¿Eliminar esta residencia?')) return;

    const url = `{{ url('/api/residences/DeleteResidence') }}/${id}`;

    try {
        const response = await fetch(url, {
            method: 'DELETE',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' }
        });

        const result = await response.json();
        alert(result.message);
        location.reload();

    } catch (err) {
        alert('Error al eliminar.');
    }
}
</script>
@endsection
