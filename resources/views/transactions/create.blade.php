@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Crear Nueva Transacción</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="id_user" class="form-label">Usuario</label>
                    <select class="form-select @error('id_user') is-invalid @enderror" id="id_user" name="id_user" required>
                        <option value="">Seleccionar usuario...</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}" {{ old('id_user') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="transaction_date" class="form-label">Fecha de Transacción</label>
                    <input type="date" class="form-control @error('transaction_date') is-invalid @enderror" id="transaction_date" name="transaction_date" value="{{ old('transaction_date') }}" required>
                    @error('transaction_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Transacción</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
