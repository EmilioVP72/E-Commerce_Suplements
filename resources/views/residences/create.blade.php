@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Nueva Residencia</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('residences.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="address" class="form-label">Dirección</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="city" class="form-label">Ciudad</label>
                    <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                    @error('city')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="state" class="form-label">Estado</label>
                    <input type="text" class="form-control @error('state') is-invalid @enderror" id="state" name="state" value="{{ old('state') }}" required>
                    @error('state')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="zip_code" class="form-label">Código Postal</label>
                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                    @error('zip_code')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">País</label>
                    <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}" required>
                    @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('residences.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Residencia</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
