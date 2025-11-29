<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar Sesión - SuplemMex</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

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
            max-width: 480px;
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

        .form-check-label {
            color: var(--text-color);
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
        }

        .invalid-feedback {
            color: var(--primary-color) !important;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="auth-card">
        <div class="form-header">
            <h1><i class="bi bi-capsule me-2"></i>SUPLEMEX</h1>
            <p>Inicia sesión en tu cuenta</p>
        </div>

        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo Electrónico</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}"
                       required autofocus placeholder="tu@email.com">

                @error('email')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label"><i class="bi bi-lock"></i> Contraseña</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required placeholder="••••••••">

                @error('password')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember -->
            <div class="form-check mb-3">
                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                <label class="form-check-label" for="remember_me"><i class="bi bi-bookmark me-1"></i> Recuérdame</label>
            </div>

            <!-- Botón login -->
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-box-arrow-in-right"></i> Iniciar Sesión
            </button>

            @if (Route::has('password.request'))
                <div class="text-center mt-3">
                    <a href="{{ route('password.request') }}" class="text-light text-decoration-none">
                        <i class="bi bi-question-circle me-1"></i> ¿Olvidaste tu contraseña?
                    </a>
                </div>
            @endif

            <div class="divider">¿No tienes cuenta?</div>

            <a href="{{ route('register') }}" class="btn btn-warning w-100">
                <i class="bi bi-person-plus"></i> Registrarse Aquí
            </a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
