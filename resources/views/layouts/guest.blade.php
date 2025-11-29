<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Suplements') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Global Forms CSS -->
        <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

        <style>
            :root {
                --primary-color: #FF6B35;
                --secondary-color: #004E89;
                --accent-color: #F77F00;
                --dark-bg: #1a1a1a;
                --light-bg: #f8f9fa;
                --text-dark: #212529;
                --text-light: #6c757d;
            }

            * {
                font-family: 'Poppins', sans-serif;
            }

            body {
                background: linear-gradient(135deg, var(--secondary-color) 0%, #1a3a52 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                overflow-x: hidden;
            }

            .auth-container {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
                padding: 1rem;
            }

            .auth-wrapper {
                width: 100%;
                max-width: 450px;
            }

            .auth-card {
                background: white;
                border-radius: 1rem;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
                overflow: hidden;
                animation: slideUp 0.5s ease;
            }

            @keyframes slideUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .auth-header {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
                padding: 2rem 1rem;
                text-align: center;
                color: white;
            }

            .auth-header h1 {
                font-size: 1.8rem;
                font-weight: 700;
                margin: 0;
                letter-spacing: -0.5px;
            }

            .auth-header p {
                margin: 0.5rem 0 0 0;
                opacity: 0.9;
                font-size: 0.9rem;
            }

            .auth-body {
                padding: 2rem;
            }

            .form-group label {
                font-weight: 600;
                color: var(--text-dark);
                margin-bottom: 0.5rem;
                font-size: 0.95rem;
            }

            .form-control {
                border: 2px solid #e9ecef;
                border-radius: 0.5rem;
                padding: 0.75rem 1rem;
                font-size: 0.95rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--primary-color);
                box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
                outline: none;
            }

            .form-control::placeholder {
                color: var(--text-light);
            }

            .btn-auth {
                background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
                border: none;
                color: white;
                font-weight: 600;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                width: 100%;
                transition: all 0.3s ease;
                margin-top: 1rem;
            }

            .btn-auth:hover {
                transform: translateY(-2px);
                box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
                color: white;
            }

            .auth-footer {
                text-align: center;
                padding: 1.5rem 2rem;
                border-top: 1px solid #e9ecef;
                font-size: 0.9rem;
                color: var(--text-light);
            }

            .auth-footer a {
                color: var(--primary-color);
                text-decoration: none;
                font-weight: 600;
                transition: all 0.3s ease;
            }

            .auth-footer a:hover {
                color: var(--accent-color);
            }

            .logo-container {
                text-align: center;
                margin-bottom: 1.5rem;
            }

            .logo-container img,
            .logo-container svg {
                max-height: 50px;
                width: auto;
            }

            .divider {
                display: flex;
                align-items: center;
                margin: 1.5rem 0;
                color: var(--text-light);
            }

            .divider::before,
            .divider::after {
                content: '';
                flex: 1;
                height: 1px;
                background: #e9ecef;
            }

            .divider span {
                margin: 0 0.75rem;
                font-size: 0.85rem;
            }

            /* Responsive */
            @media (max-width: 576px) {
                .auth-wrapper {
                    max-width: 100%;
                }

                .auth-body {
                    padding: 1.5rem;
                }

                .auth-header {
                    padding: 1.5rem 1rem;
                }

                .auth-header h1 {
                    font-size: 1.4rem;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="auth-container">
            <div class="auth-wrapper">
                <div class="auth-card">
                    <div class="auth-header">
                        <h1>SUPLEMENTS</h1>
                        <p>Tu tienda de suplementos premium</p>
                    </div>
                    <div class="auth-body">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>