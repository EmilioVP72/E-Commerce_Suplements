<x-guest-layout>
    <div class="form-header">
        <h2><i class="bi bi-envelope-check me-2"></i>Verificar Correo Electrónico</h2>
        <p>Confirma tu dirección de correo para continuar</p>
    </div>

    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        <strong>¡Gracias por registrarte!</strong> Hemos enviado un enlace de verificación a tu correo electrónico. Por favor, verifica tu dirección de correo antes de continuar.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            <strong>Enlace enviado correctamente</strong> Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="mt-4">
        <p class="text-muted mb-3"><i class="bi bi-exclamation-circle me-2"></i>¿No recibiste el email?</p>

        <form method="POST" action="{{ route('verification.send') }}" class="mb-3">
            @csrf
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-send"></i>Enviar nuevo enlace de verificación
            </button>
        </form>
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button type="submit" class="btn btn-secondary w-100">
            <i class="bi bi-box-arrow-right"></i>Cerrar Sesión
        </button>
    </form>
</x-guest-layout>
