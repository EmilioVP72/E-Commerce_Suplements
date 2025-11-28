<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - SupleMex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
            --text-color: #ffffff;
            --dark-blue: #1a3a52;
        }

        body {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--dark-blue) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1.5rem;
            font-family: 'Poppins', sans-serif;
        }

        .auth-card {
            width: 100%;
            max-width: 800px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
            padding: 2rem;
            transition: transform .2s ease;
        }
        .auth-card:hover {
            transform: translateY(-3px);
        }

        .form-header {
            text-align: center;
            margin-bottom: 1.8rem;
            color: var(--text-color);
        }

        .form-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: .3rem;
        }

        .form-header p {
            opacity: 0.85;
        }

        .form-label {
            color: var(--text-color);
            font-weight: 600;
        }

        .form-control {
            padding: 0.75rem 1rem;
            border-radius: 8px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
            font-weight: 600;
        }
        .btn-primary:hover {
            background-color: #006eb5;
            border-color: #006eb5;
        }

        .btn-warning {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
            font-weight: 600;
            color: #fff;
        }
        .btn-warning:hover {
            background-color: #e67500;
            border-color: #e67500;
        }

        .divider {
            text-align: center;
            margin: 1.8rem 0 1rem;
            color: var(--text-color);
            opacity: 0.85;
        }

        .auth-card a {
            font-weight: 600;
            color: var(--text-color); /* Asegura que los enlaces se vean */
            text-decoration: none; /* Quitar subrayado por defecto */
        }
        
        .auth-card a:hover {
            text-decoration: underline;
        }

        .invalid-feedback {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        /* Estilos específicos para el registro */
        .file-input-wrapper {
            display: block;
            background: rgba(255, 255, 255, 0.1);
            border: 2px dashed rgba(255, 255, 255, 0.5);
            border-radius: 8px;
            padding: 1.5rem;
            cursor: pointer;
            color: var(--text-color);
            transition: background-color .2s ease;
        }

        .file-input-wrapper:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .file-input-wrapper i {
            font-size: 2rem;
            display: block;
        }

        .text-muted {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        .button-group {
            display: flex;
            gap: 10px; /* Espacio entre botones */
            margin-top: 1rem;
        }

        /* Cambiado para usar las clases de botón del login para armonizar */
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: 600;
            color: #fff;
        }

    </style>
    
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body x-data="{ photoPreview: null }">

    <div class="auth-card">
        
        <div class="form-header">
            <h1><i class="bi bi-capsule me-2"></i>SUPLEMEX</h1>
            <p>Crea tu cuenta y comienza a comprar</p>
        </div>

        <div>
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label text-center w-100" for="photo"><i class="bi bi-image me-1"></i> Foto de Perfil</label>

                    <label class="file-input-wrapper w-100" for="photo">
                        <input id="photo" type="file" class="d-none" name="photo" accept="image/*"
                            x-on:change="
                                const reader = new FileReader();
                                reader.onload = e => photoPreview = e.target.result;
                                reader.readAsDataURL($event.target.files[0]);
                            ">
                        <div x-show="!photoPreview" class="text-center">
                            <i class="bi bi-cloud-upload"></i>
                            <p class="mt-2 mb-0">Haz clic para seleccionar una imagen</p>
                        </div>
                        <div x-show="photoPreview" class="text-center">
                             <img :src="photoPreview" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                        </div>
                    </label>

                    @error('photo')
                    <div class="invalid-feedback d-block mt-1"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="name" class="form-label"><i class="bi bi-person"></i> Nombre</label>
                    <input type="text" id="name" name="name"
                        class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') }}" required placeholder="Tu nombre">
                    @error('name')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname1" class="form-label"><i class="bi bi-person"></i> Primer Apellido</label>
                    <input type="text" id="lastname1" name="lastname1"
                        class="form-control @error('lastname1') is-invalid @enderror"
                        value="{{ old('lastname1') }}" required placeholder="Tu primer apellido">
                    @error('lastname1')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="lastname2" class="form-label"><i class="bi bi-person"></i> Segundo Apellido</label>
                    <input type="text" id="lastname2" name="lastname2"
                        class="form-control @error('lastname2') is-invalid @enderror"
                        value="{{ old('lastname2') }}" placeholder="Opcional">
                    @error('lastname2')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label"><i class="bi bi-telephone"></i> Teléfono</label>
                    <input type="text" id="phone" name="phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        value="{{ old('phone') }}" required placeholder="Tu número">
                    @error('phone')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo Electrónico</label>
                    <input type="email" id="email" name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required placeholder="tu@correo.com">
                    @error('email')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label"><i class="bi bi-lock"></i> Contraseña</label>
                    <input type="password" id="password" name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        required placeholder="••••••••">
                    @error('password')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i> {{ $message }}</div>
                    @enderror
                    <small class="text-muted d-block mt-1">Mínimo 8 caracteres, mayúscula, número y especial</small>
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label"><i class="bi bi-lock"></i> Confirmar Contraseña</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="form-control" required placeholder="••••••••">
                </div>

                <div class="button-group">
                    <a href="{{ route('login') }}" class="btn btn-secondary w-50">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-warning w-50">
                        <i class="bi bi-person-plus"></i> Registrarse
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p class="text-muted mb-0">¿Ya tienes cuenta?
                        <a href="{{ route('login') }}" class="text-decoration-none">Inicia sesión</a>
                    </p>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>