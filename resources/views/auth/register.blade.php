<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro - Suplements</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Alpine.js para la previsualización de la foto -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body {
            background-color: #f0f2f5;
        }
        .card {
            max-width: 500px;
            margin: 50px auto;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body x-data="{ photoName: null, photoPreview: null }">
    <div class="container">
        <div class="card shadow-sm">
            <div class="card-body p-5">
                <h3 class="card-title text-center mb-4">Registro</h3>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Campo para la foto de perfil -->
                    <div class="mb-3 text-center">
                        <label for="photo" class="form-label">{{ __('Foto de Perfil') }}</label>

                        <!-- Input de archivo oculto con referencia Alpine -->
                        <input type="file"
                               id="photo"
                               name="photo"
                               class="hidden"
                               x-ref="photo"
                               x-on:change="
                                   photoName = $refs.photo.files[0].name;
                                   const reader = new FileReader();
                                   reader.onload = (e) => {
                                       photoPreview = e.target.result;
                                   };
                                   reader.readAsDataURL($refs.photo.files[0]);
                               " />

                        <!-- Imagen por defecto -->
                        <div class="mt-2 mb-3 mx-auto" style="width: 100px; height: 100px;" x-show="!photoPreview">
                            <img src="{{ asset('images/icono_sin_imagen.png') }}" alt="Foto por defecto" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover;">
                        </div>

                        <!-- Previsualización de la nueva foto -->
                        <div class="mt-2 mb-3 mx-auto" x-show="photoPreview" style="width: 100px; height: 100px; overflow: hidden;">
                            <img x-bind:src="photoPreview" alt="Previsualización de la foto" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <button type="button" class="btn btn-secondary btn-sm" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Seleccionar una foto') }}
                        </button>
                        @error('photo')<div class="text-danger mt-2">{{ $message }}</div>@enderror
                    </div>

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input id="name" class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Name 1 -->
                    <div class="mb-3">
                        <label for="lastname1" class="form-label">Primer Apellido</label>
                        <input id="lastname1" class="form-control @error('lastname1') is-invalid @enderror" type="text" name="lastname1" value="{{ old('lastname1') }}" required autocomplete="lastname1">
                        @error('lastname1')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Last Name 2 -->
                    <div class="mb-3">
                        <label for="lastname2" class="form-label">Segundo Apellido</label>
                        <input id="lastname2" class="form-control" type="text" name="lastname2" value="{{ old('lastname2') }}" autocomplete="lastname2">
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="new-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a class="text-decoration-none" href="{{ route('login') }}">
                            ¿Ya estás registrado?
                        </a>

                        <button type="submit" class="btn btn-primary">Registrarse</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>