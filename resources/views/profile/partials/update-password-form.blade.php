<section>
    <header class="mb-4 text-center">
        <h4 class="fw-bold text-uppercase text-white">{{ __('Actualizar Contraseña') }}</h4>
        <p class="text-muted">{{ __('Asegúrate de usar una contraseña fuerte y única.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="current_password" class="form-label">{{ __('Contraseña Actual') }}</label>
            <input id="current_password" name="current_password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('Nueva Contraseña') }}</label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">{{ __('Confirmar Contraseña') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">{{ __('Actualizar Contraseña') }}</button>
    </form>
</section>
