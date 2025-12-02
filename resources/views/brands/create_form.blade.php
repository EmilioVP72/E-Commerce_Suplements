@extends('administration')

@section('content')
<div class="container">
    <h1>Crear Nueva Marca</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form id="createBrandForm">
                @csrf
                <div class="mb-3">
                    <label for="brand" class="form-label">Nombre de la Marca</label>
                    <input type="text" class="form-control" id="brand" name="brand" required>
                </div>
                <div class="mb-3">
                    <label for="id_supplier" class="form-label">Proveedor</label>
                    <select class="form-control" id="id_supplier" name="id_supplier" required>
                        <option value="">Selecciona un proveedor</option>
                        @foreach($suppliers as $supplier)
                            <option value="{{ $supplier->id_supplier }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Marca</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.getElementById('createBrandForm').addEventListener('submit', async function(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(form);
    const url = "{{ url('/api/brands/StoreBrand') }}";

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
            alert(result.message || 'Marca creada con éxito');
            window.location.href = "{{ route('brands.index') }}";
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
