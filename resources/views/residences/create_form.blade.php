@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nueva Residencia</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createResidenceForm">
                @csrf

                <div class="mb-3">
                    <label for="zip_code" class="form-label">Código Postal</label>
                    <input type="text" class="form-control" id="zip_code" name="zip_code" required>
                </div>

                <div class="mb-3">
                    <label for="municipality" class="form-label">Estado</label>
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
                    <label for="extra_directions" class="form-label">Indicaciones Extra (Opcional)</label>
                    <textarea class="form-control" id="extra_directions" name="extra_directions"></textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('createResidenceForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const formData = new FormData(e.target);
    const url = "{{ url('/api/residences/StoreResidence') }}";

    const res = await fetch(url, { method: 'POST', body: formData, headers: { 'Accept': 'application/json' }});
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
