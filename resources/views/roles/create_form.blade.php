@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Rol</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createRolForm">
                @csrf
                <div class="mb-3">
                    <label for="rol" class="form-label">Nombre del Rol</label>
                    <input type="text" class="form-control" id="rol" name="rol" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Rol</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('createRolForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/rols/StoreRol') }}";

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
            alert(result.message || 'Rol creado con éxito');
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
