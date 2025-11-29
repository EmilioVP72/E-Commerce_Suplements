<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmar Contraseña - SupleMex</title>

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

        .form-header h2 {
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

        .invalid-feedback {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .button-group {
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>

    <div class="auth-card">

        <div class="form-header">
            <h2><i class="bi bi-shield-check me-2"></i>Confirmar Contraseña</h2>
            <p>Por seguridad, confirma tu contraseña</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-3">
                <label for="password" class="form-label"><i class="bi bi-lock"></i> Contraseña</label>
                <input id="password" class="form-control @error('password') is-invalid @enderror" type="password"
                    name="password" required autofocus placeholder="••••••••">
                @error('password')
                <div class="invalid-feedback"><i class="bi bi-exclamation-circle me-1"></i>{{ $message }}</div>
                @enderror
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary w-100">
                    <i class="bi bi-check-circle"></i> Confirmar
                </button>
            </div>
        </form>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>