@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Proveedor</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateSupplierForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Proveedor</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Teléfono</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Fotografía</label>
                    <input type="file" class="form-control" id="photo" name="photo">
                    <div class="mt-2">
                        <img id="current-photo" src="" alt="Foto actual" style="max-width: 100px; border-radius: 5px; display: none;">
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('suppliers.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const supplierId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/suppliers/OneSupplier') }}/${supplierId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const supplier = result.data;
            document.getElementById('name').value = supplier.name;
            document.getElementById('email').value = supplier.email;
            document.getElementById('phone').value = supplier.phone;
            if (supplier.photo) {
                const photoUrl = supplier.photo.replace('http://localhost/', 'http://localhost:8000/');
                const photoElement = document.getElementById('current-photo');
                photoElement.src = photoUrl;
                photoElement.style.display = 'block';
            }
        } else {
            alert(result.message || 'No se pudieron cargar los datos del proveedor.');
        }
    } catch (error) {
        console.error('Error fetching supplier data:', error);
        alert('Error al cargar los datos del proveedor.');
    }
});

document.getElementById('updateSupplierForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/suppliers/UpdateSupplier') }}/${supplierId}`;

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
            alert(result.message || 'Proveedor actualizado con éxito');
            window.location.href = "{{ route('suppliers.index') }}";
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
