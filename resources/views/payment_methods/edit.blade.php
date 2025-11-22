@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Editar Método de Pago</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('payment_methods.update', $payment_method->id_payment_method) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Nombre del Método de Pago</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $payment_method->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('payment_methods.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Actualizar Método de Pago</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
