@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Privilegio</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updatePrivilegeForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="privilege" class="form-label">Nombre del Privilegio</label>
                    <input type="text" class="form-control" id="privilege" name="privilege" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('privileges.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Privilegio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const privilegeId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/privileges/OnePrivilege') }}/${privilegeId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const privilege = result.data;
            document.getElementById('privilege').value = privilege.privilege || '';
            document.getElementById('description').value = privilege.description || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos del privilegio.');
        }
    } catch (error) {
        console.error('Error fetching privilege data:', error);
        alert('Error al cargar los datos del privilegio.');
    }
});

document.getElementById('updatePrivilegeForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/privileges/UpdatePrivilege') }}/${privilegeId}`;

    try {
        const response = await fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'Accept': 'application/json',
            },
        });

        const result = await response.json();

        if (response.ok) {
            alert(result.message || 'Privilegio actualizado con éxito');
            window.location.href = "{{ route('privileges.index') }}";
        } else {
            let errorMessage = result.message || 'Ocurrió un error.';
            if (result.errors) {
                errorMessage += '\n' + Object.values(result.errors).flat().join('\n');
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
