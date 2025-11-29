@extends('administration')

@section('content')
<div class="container">
    <h1>Actualizar Usuario-Rol</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateUserRoleForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="id_user" class="form-label">Selecciona un Usuario</label>
                    <select class="form-control" id="id_user" name="id_user" required onchange="loadRoles()">
                        <option value="">-- Selecciona un Usuario --</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="id_rol" class="form-label">Selecciona un Rol</label>
                    <select class="form-control" id="id_rol" name="id_rol" required>
                        <option value="">-- Carga un Usuario primero --</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('user_roles.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Asignación</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const userRoleId = {{ $id }};

async function loadRoles() {
    const userId = document.getElementById('id_user').value;
    const rolSelect = document.getElementById('id_rol');

    if (!userId) {
        rolSelect.innerHTML = '<option value="">-- Carga un Usuario primero --</option>';
        return;
    }

    try {
        const response = await fetch(`{{ url('/api/user-roles/user') }}/${userId}/roles`);
        const result = await response.json();

        let rolesHtml = '<option value="">-- Selecciona un Rol --</option>';

        if (response.ok && result.data && result.data.length > 0) {
            result.data.forEach(rol => {
                rolesHtml += `<option value="${rol.id_rol}">${rol.rol}</option>`;
            });
        } else {
            rolesHtml = '<option value="">-- No hay roles disponibles --</option>';
        }

        rolSelect.innerHTML = rolesHtml;
    } catch (error) {
        console.error('Error loading roles:', error);
        rolSelect.innerHTML = '<option value="">-- Error al cargar --</option>';
    }
}

document.getElementById('updateUserRoleForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/user-roles') }}/${userRoleId}`;

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
            alert(result.message || 'Asignación actualizada con éxito');
            window.location.href = "{{ route('user_roles.index') }}";
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
