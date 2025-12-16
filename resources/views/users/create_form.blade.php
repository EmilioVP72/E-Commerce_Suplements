@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nuevo Usuario</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createUserForm">
                @csrf
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
                    <div id="photoPreview" class="mt-3" style="display: none;">
                        <p><strong>Vista previa:</strong></p>
                        <img id="photoImage" src="" alt="Vista previa" style="max-width: 200px; max-height: 200px; border-radius: 8px;">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Previsualización de foto
document.getElementById('photo').addEventListener('change', function(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('photoImage').src = e.target.result;
            document.getElementById('photoPreview').style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        document.getElementById('photoPreview').style.display = 'none';
    }
});

document.getElementById('createUserForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/users/StoreUser') }}";

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
            alert(result.message || 'Usuario creado con éxito');
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
