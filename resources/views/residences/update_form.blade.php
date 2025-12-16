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
                    <label for="zip_code" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control" id="address" name="address" required>
                </div>

                <div class="mb-3">
                    <label for="extra_directions" class="form-label">Indicaciones Extra</label>
                    <textarea class="form-control" id="extra_directions" name="extra_directions"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('residences.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
const residenceId = {{ $id }};

document.addEventListener('DOMContentLoaded', async () => {

    const res = await fetch(`{{ url('/api/residences/OneResidence') }}/${residenceId}`);
    const result = await res.json();

    if (res.ok) {
        const r = result.data;

        document.getElementById('zip_code').value = r.zip_code;
        document.getElementById('state').value = r.state;
        document.getElementById('city').value = r.city;
        document.getElementById('address').value = r.address;
        document.getElementById('extra_directions').value = r.extra_directions ?? '';

    } else {
        alert("Error cargando los datos.");
    }
});

document.getElementById('updateResidenceForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);

    const res = await fetch(`{{ url('/api/residences/UpdateResidence') }}/${residenceId}`, {
        method: 'POST',
        body: formData,
        headers: { 'Accept': 'application/json' }
    });

    const result = await res.json();

    if (res.ok) {
        alert(result.message);
        window.location.href = "{{ route('residences.index') }}";
    } else {
        alert(result.message);
    }
});
</script>
@endsection
