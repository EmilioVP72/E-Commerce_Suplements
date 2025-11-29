@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Rol</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateRolForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="rol" class="form-label">Nombre del Rol</label>
                    <input type="text" class="form-control" id="rol" name="rol" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('roles.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Rol</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const rolId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/rols/OneRol') }}/${rolId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (result.flag) {
            const rol = result.data;
            document.getElementById('rol').value = rol.rol || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos del rol.');
        }
    } catch (error) {
        console.error('Error fetching rol data:', error);
        alert('Error al cargar los datos del rol.');
    }
});

document.getElementById('updateRolForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/rols/UpdateRol') }}/${rolId}`;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        });

        const result = await response.json();

        if (result.flag) {
            alert(result.message || 'Rol actualizado con éxito');
            window.location.href = "{{ route('roles.index') }}";
        } else {
            let errorMessage = result.message || 'Ocurrió un error.';
            if (result.data && result.data.errors) {
                errorMessage += '\n' + Object.values(result.data.errors).flat().join('\n');
            }
            alert(errorMessage);
        }
    } catch (error) {
        console.error('Error:', error);
        alert('No se pudo conectar con el servidor.');
    }
});
</script>
@endsection
