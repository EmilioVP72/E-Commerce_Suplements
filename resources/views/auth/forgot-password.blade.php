<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar Contraseña - SupleMex</title>
    
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

        .form-container {
            width: 100%;
            max-width: 480px;
            background: rgba(255, 255, 255, 0.12);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.35);
            padding: 2rem;
            transition: transform .2s ease;
        }

        .form-container:hover {
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

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
            font-weight: 600;
            color: #fff;
        }
        
        .invalid-feedback {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .form-text {
            color: rgba(255, 255, 255, 0.75) !important;
        }

        /* Estilo para el grupo de botones al final */
        .button-group {
            display: flex;
            gap: 10px; /* Espacio entre botones */
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="form-container"> 
            
            <div class="form-header">
                <h1><i class="bi bi-key me-2"></i>Recuperar Contraseña</h1>
                <p>Te enviaremos un enlace para restablecer tu contraseña</p>
            </div>

            @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4"> <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo Electrónico</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="email"
                        name="email" value="{{ old('email') }}" required autofocus placeholder="tu@email.com">

                    @error('email')
                    <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                    @enderror

                    <small class="form-text d-block mt-1"><i class="bi bi-info-circle me-1"></i>Ingresa el correo asociado a tu cuenta</small>
                </div>

                <div class="button-group">
                    <a href="{{ route('login') }}" class="btn btn-secondary w-50">
                        <i class="bi bi-arrow-left"></i> Volver
                    </a>
                    <button type="submit" class="btn btn-primary w-50">
                        <i class="bi bi-send"></i> Enviar Enlace
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>