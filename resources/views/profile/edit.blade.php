<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-bold text-uppercase text-center text-white mt-4">
            {{ __('Panel de Usuario') }}
        </h2>
    </x-slot>

    <div class="profile-page py-5">
        <div class="container">
            <!-- Información del perfil -->
            <div class="card custom-card mb-4">
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Actualizar contraseña -->
            <div class="card custom-card mb-4">
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Eliminar cuenta -->
            <div class="card custom-card mb-4">
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
<style>
/* ==== ESTILO GENERAL ==== */
body {
    background: radial-gradient(circle at top, #121212, #000);
    font-family: 'Poppins', sans-serif;
    color: #e0e0e0;
}

.profile-page .custom-card {
    background: linear-gradient(145deg, #1b1b1b, #111);
    border: 1px solid #2c2c2c;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(255, 0, 0, 0.15);
    transition: all 0.3s ease;
}
.profile-page .custom-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(255, 0, 0, 0.25);
}

h2, h4 {
    color: #fff;
    font-weight: 600;
    letter-spacing: 0.5px;
}

/* ==== BOTONES ==== */
.btn-primary {
    background-color: #d10000;
    border: none;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}
.btn-primary:hover {
    background-color: #ff0000;
    box-shadow: 0 0 12px rgba(255, 0, 0, 0.7);
}

.btn-secondary {
    background-color: #2c2c2c;
    border: none;
    color: #fff;
    font-weight: 500;
}
.btn-secondary:hover {
    background-color: #3a3a3a;
    box-shadow: 0 0 8px rgba(255, 255, 255, 0.1);
}

.btn-danger {
    background-color: #9a0000;
    border: none;
    font-weight: 600;
}
.btn-danger:hover {
    background-color: #ff1a1a;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.6);
}

/* ==== INPUTS ==== */
.form-control {
    background-color: #181818;
    border: 1px solid #333;
    color: #e0e0e0;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.form-control:focus {
    background-color: #202020;
    border-color: #d10000;
    box-shadow: 0 0 8px rgba(255, 0, 0, 0.5);
    color: #fff;
}

/* ==== TEXTOS ==== */
.text-muted {
    color: #aaa !important;
}

.text-danger {
    font-size: 0.9rem;
    color: #ff4d4d !important;
}

/* ==== FOTO DE PERFIL ==== */
.profile-photo {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid #d10000;
    box-shadow: 0 0 10px rgba(255, 0, 0, 0.4);
}

.profile-photo-preview {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background-size: cover;
    background-position: center;
    border: 2px solid #ff1a1a;
}

/* ==== MODALES ==== */
.modal-content {
    background-color: #1a1a1a;
    border: 1px solid #333;
    color: #fff;
}
.modal-header {
    border-bottom: 1px solid #2c2c2c;
}
.modal-footer {
    border-top: 1px solid #2c2c2c;
}

/* ==== EFECTO GUARDADO ==== */
.text-success {
    color: #00ff66 !important;
    font-weight: 600;
}
</style>
@endpush
