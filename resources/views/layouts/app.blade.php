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

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

        <!-- Google Fonts - Poppins para moderno -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- Global Forms CSS -->
        <link rel="stylesheet" href="{{ asset('css/forms.css') }}">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
// ...existing code...

        <style>
            :root {
                --primary-color: #FF6B35;
                --secondary-color: #004E89;
                --accent-color: #F77F00;
                --dark-bg: #1a1a1a;
                --light-bg: #f8f9fa;
                --text-dark: #212529;
                --text-light: #6c757d;
                --success-color: #00A86B;
                --warning-color: #FFB703;
            }

            * {
                font-family: 'Poppins', sans-serif;
            }

            body {
                background-color: var(--light-bg);
                color: var(--text-dark);
                overflow-x: hidden;
            }

            /* Navbar personalizada */
            .navbar {
                background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%);
                box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
                padding: 1rem 0;
            }

            .navbar .navbar-brand {
                font-weight: 700;
                font-size: 1.8rem;
                color: white !important;
                letter-spacing: -0.5px;
                text-transform: uppercase;
                background: linear-gradient(135deg, #FF6B35, #F77F00);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
            }

            .navbar-nav .nav-link {
                color: rgba(255, 255, 255, 0.85) !important;
                font-weight: 500;
                transition: all 0.3s ease;
                position: relative;
                margin: 0 0.5rem;
            }

            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link.active {
                color: var(--accent-color) !important;
            }

            .navbar-nav .nav-link::after {
                content: '';
                position: absolute;
                bottom: -5px;
                left: 0;
                width: 0;
                height: 2px;
                background: var(--accent-color);
                transition: width 0.3s ease;
            }

            .navbar-nav .nav-link:hover::after {
                width: 100%;
            }

            /* Dropdown menus */
            .dropdown-menu {
                border: none;
                box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
                border-radius: 0.75rem;
                padding: 0.5rem 0;
                animation: slideDown 0.3s ease;
            }

            @keyframes slideDown {
                from {
                    opacity: 0;
                    transform: translateY(-10px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .dropdown-item {
                padding: 0.75rem 1.25rem;
                transition: all 0.2s ease;
                color: var(--text-dark);
                font-weight: 500;
            }

            .dropdown-item:hover {
                background-color: var(--light-bg);
                color: var(--primary-color);
                padding-left: 1.5rem;
            }

            /* Main content area */
            .min-h-screen {
                display: flex;
                flex-direction: column;
            }

            main {
                flex: 1;
                padding: 2rem 0;
            }

            /* Página encabezado */
            header {
                background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%);
                color: white !important;
                box-shadow: 0 4px 12px rgba(0, 78, 137, 0.1);
            }

            header h2 {
                font-weight: 700;
                letter-spacing: -0.5px;
            }

            /* Responsive */
            @media (max-width: 768px) {
                .navbar .navbar-brand {
                    font-size: 1.4rem;
                }

                .navbar-nav .nav-link {
                    padding: 0.5rem 0 !important;
                    margin: 0.25rem 0;
                }

                .navbar-nav .nav-link::after {
                    display: none;
                }
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main>
                {{ $slot }}
            </main>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>