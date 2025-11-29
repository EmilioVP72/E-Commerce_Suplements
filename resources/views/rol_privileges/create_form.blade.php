@extends('administration')

@section('content')
<div class="container">
    <h1>Asignar Privilegio a Rol</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createRolPrivilegeForm">
                @csrf
                <div class="mb-3">
                    <label for="id_rol" class="form-label">Selecciona un Rol</label>
                    <select class="form-control" id="id_rol" name="id_rol" required onchange="loadPrivileges()">
                        <option value="">-- Selecciona un Rol --</option>
                        @foreach($roles as $rol)
                            <option value="{{ $rol->id_rol }}">{{ $rol->rol }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_privilege" class="form-label">Selecciona un Privilegio</label>
                    <select class="form-control" id="id_privilege" name="id_privilege" required>
                        <option value="">-- Carga un Rol primero --</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Asignar Privilegio</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
async function loadPrivileges() {
    const rolId = document.getElementById('id_rol').value;
    const privilegeSelect = document.getElementById('id_privilege');

    if (!rolId) {
        privilegeSelect.innerHTML = '<option value="">-- Carga un Rol primero --</option>';
        return;
    }

    try {
        const response = await fetch(`{{ url('/api/rol-privileges/rol') }}/${rolId}/privileges`);
        const result = await response.json();

        let privilegesHtml = '<option value="">-- Selecciona un Privilegio --</option>';

        if (response.ok && result.data && result.data.length > 0) {
            result.data.forEach(privilege => {
                privilegesHtml += `<option value="${privilege.id_privilege}">${privilege.privilege}</option>`;
            });
        } else {
            privilegesHtml = '<option value="">-- No hay privilegios disponibles --</option>';
        }

        privilegeSelect.innerHTML = privilegesHtml;
    } catch (error) {
        console.error('Error loading privileges:', error);
        privilegeSelect.innerHTML = '<option value="">-- Error al cargar --</option>';
    }
}

document.getElementById('createRolPrivilegeForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/rol-privileges/rol-privileges/assign') }}";

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
            alert(result.message || 'Privilegio asignado con éxito');
            window.location.href = "{{ route('rol_privileges.index') }}";
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
