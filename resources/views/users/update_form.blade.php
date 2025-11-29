@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Usuario</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateUserForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="lastname1" class="form-label">Primer Apellido</label>
                    <input type="text" class="form-control" id="lastname1" name="lastname1">
                </div>
                <div class="mb-3">
                    <label for="lastname2" class="form-label">Segundo Apellido</label>
                    <input type="text" class="form-control" id="lastname2" name="lastname2">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Foto de Perfil</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    <small class="form-text text-muted">Formatos permitidos: JPEG, PNG, JPG, GIF. Máximo 2MB.</small>
                    <div id="photoPreview" class="mt-3">
                        <p><strong>Foto actual:</strong></p>
                        <img id="photoImage" src="" alt="Foto actual" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                    <div id="newPhotoPreview" class="mt-3" style="display: none;">
                        <p><strong>Nueva foto:</strong></p>
                        <img id="newPhotoImage" src="" alt="Nueva foto" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('users.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const userId = {{ $id }};

// Previsualización de nueva foto
document.getElementById('photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('newPhotoImage').src = e.target.result;
            document.getElementById('newPhotoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('newPhotoPreview').style.display = 'none';
    }
});

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/users/OneUser') }}/${userId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const user = result.data;
            document.getElementById('name').value = user.name || '';
            document.getElementById('lastname1').value = user.lastname1 || '';
            document.getElementById('lastname2').value = user.lastname2 || '';
            document.getElementById('email').value = user.email || '';
            document.getElementById('phone').value = user.phone || '';
            
            // Mostrar foto actual
            if (user.photo) {
                document.getElementById('photoImage').src = user.photo;
                document.getElementById('photoPreview').style.display = 'block';
            } else {
                document.getElementById('photoPreview').style.display = 'none';
            }
        } else {
            alert(result.message || 'No se pudieron cargar los datos del usuario.');
        }
    } catch (error) {
        console.error('Error fetching user data:', error);
        alert('Error al cargar los datos del usuario.');
    }
});

document.getElementById('updateUserForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/users/UpdateUser') }}/${userId}`;

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
            alert(result.message || 'Usuario actualizado con éxito');
            window.location.href = "{{ route('users.index') }}";
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
