<section>
    <header class="mb-4 text-center">
        <h4 class="fw-bold text-uppercase text-danger">{{ __('Eliminar Cuenta') }}</h4>
        <p class="text-muted">{{ __('Una vez eliminada, todos tus datos serán borrados permanentemente.') }}</p>
    </header>

    <button class="btn btn-danger w-100 mb-3" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
        {{ __('Eliminar mi cuenta') }}
    </button>

    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger" id="confirmDeleteLabel">{{ __('Confirmar Eliminación') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Esta acción eliminará permanentemente tu cuenta. Ingresa tu contraseña para confirmar.') }}</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <input id="password" name="password" type="password" class="form-control" placeholder="{{ __('Contraseña') }}" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">{{ __('Cancelar') }}</button>
                            <button type="submit" class="btn btn-danger">{{ __('Eliminar Cuenta') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
