@extends('administration')

@section('content')
<div class="container">
    <h1 class="my-4">Asignar Residencia a Usuario</h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('residence_users.store') }}" method="POST">
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
                    <label for="id_residence" class="form-label">Residencia</label>
                    <select class="form-select @error('id_residence') is-invalid @enderror" id="id_residence" name="id_residence" required>
                        <option value="">Seleccionar residencia...</option>
                        @foreach($residences as $residence)
                            <option value="{{ $residence->id_residence }}" {{ old('id_residence') == $residence->id_residence ? 'selected' : '' }}>{{ $residence->address }} - {{ $residence->city }}</option>
                        @endforeach
                    </select>
                    @error('id_residence')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('residence_users.index') }}" class="btn btn-secondary me-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Asignación</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
