@extends('administration')

@section('content')
<div class="container">
    <h1>Editar Residencia</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="updateResidenceForm">
                @csrf
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>
                <div class="mb-3">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="mb-3">
                    <label for="zip_code" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                </div>
                <div class="mb-3">
                    <label for="country" class="form-label">País</label>
                    <input type="text" class="form-control" id="country" name="country" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('residences.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Residencia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const residenceId = {{ $id }};

document.addEventListener('DOMContentLoaded', async function() {
    const fetchUrl = `{{ url('/api/residences/OneResidence') }}/${residenceId}`;
    try {
        const response = await fetch(fetchUrl);
        const result = await response.json();

        if (response.ok) {
            const residence = result.data;
            document.getElementById('address').value = residence.address || '';
            document.getElementById('city').value = residence.city || '';
            document.getElementById('state').value = residence.state || '';
            document.getElementById('zip_code').value = residence.zip_code || '';
            document.getElementById('country').value = residence.country || '';
        } else {
            alert(result.message || 'No se pudieron cargar los datos de la residencia.');
        }
    } catch (error) {
        console.error('Error fetching residence data:', error);
        alert('Error al cargar los datos de la residencia.');
    }
});

document.getElementById('updateResidenceForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = `{{ url('/api/residences/UpdateResidence') }}/${residenceId}`;

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
            alert(result.message || 'Residencia actualizada con éxito');
            window.location.href = "{{ route('residences.index') }}";
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
