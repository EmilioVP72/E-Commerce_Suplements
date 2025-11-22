@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nueva Residencia de Usuario</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createResidenceUserForm">
                @csrf
                <div class="mb-3">
                    <label for="id_user" class="form-label">Usuario</label>
                    <select class="form-control" id="id_user" name="id_user" required>
                        <option value="">Seleccionar usuario...</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="id_residence" class="form-label">Residencia</label>
                    <select class="form-control" id="id_residence" name="id_residence" required>
                        <option value="">Seleccionar residencia...</option>
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Residencia de Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', async function() {
    // Cargar usuarios
    try {
        const usersResponse = await fetch("{{ url('/api/users/all') }}");
        const usersResult = await usersResponse.json();
        
        if (usersResult.data) {
            const userSelect = document.getElementById('id_user');
            usersResult.data.forEach(user => {
                const option = document.createElement('option');
                option.value = user.id_user;
                option.textContent = user.name;
                userSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading users:', error);
    }

    // Cargar residencias
    try {
        const residencesResponse = await fetch("{{ url('/api/residences/all') }}");
        const residencesResult = await residencesResponse.json();
        
        if (residencesResult.data) {
            const residenceSelect = document.getElementById('id_residence');
            residencesResult.data.forEach(residence => {
                const option = document.createElement('option');
                option.value = residence.id_residence;
                option.textContent = `${residence.address}, ${residence.city}`;
                residenceSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading residences:', error);
    }
});

document.getElementById('createResidenceUserForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/residenceusers/StoreResidenceUser') }}";

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
            alert(result.message || 'Residencia de usuario creada con éxito');
            window.location.href = "{{ route('residence_users.index') }}";
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
