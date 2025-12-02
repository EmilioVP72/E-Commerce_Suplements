<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perfil de Usuario - SupleMex</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --primary-color: #FF6B35;
            --secondary-color: #004E89;
            --accent-color: #F77F00;
            --dark-bg: #1a1a1a;
            --light-bg: #f8f9fa;
        }

        body {
            background-color: var(--light-bg);
            font-family: 'Poppins', sans-serif;
            overflow-x: hidden;
        }

        .navbar {
            background: linear-gradient(135deg, var(--secondary-color) 0%, #003d6b 100%);
            box-shadow: 0 4px 12px rgba(0, 78, 137, 0.15);
            padding: 0.75rem 0;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #FF6B35, #F77F00);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar {
            position: fixed;
            height: 100vh;
            width: 260px;
            top: 0;
            left: 0;
            padding-top: 70px;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            overflow-y: auto;
            z-index: 90;
        }

        .main-content {
            margin-left: 260px;
            padding: 90px 30px;
        }

        .card {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0, 78, 137, 0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--secondary-color), #003d6b);
            color: white;
            border-radius: 1rem 1rem 0 0;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
            border: none;
        }

        .btn-primary:hover {
            box-shadow: 0 8px 20px rgba(255, 107, 53, 0.3);
            transform: translateY(-2px);
        }

        .profile-photo {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <i class="bi bi-capsule me-2"></i>SUPLEMEX
            </a>
            <div>
                <a href="{{ route('home') }}" class="text-white me-4"><i class="bi bi-house"></i> Ir a la tienda</a>
            </div>
        </div>
    </nav>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item mt-3">
                <span class="nav-link text-muted">
                    <small><i class="bi bi-person-circle me-2"></i>MI CUENTA</small>
                </span>
            </li>

            <li><a class="nav-link active" href="#"><i class="bi bi-person-badge"></i> Perfil</a></li>

            <li><a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                   <i class="bi bi-box-arrow-right"></i> Cerrar sesión
            </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">@csrf</form>
            </li>
        </ul>
    </div>

    <!-- MAIN CONTENT -->
    <main class="main-content">
        <div class="container-fluid">

            {{-- ===================== SECCIÓN: INFORMACIÓN DEL PERFIL ===================== --}}
            <div class="card mb-4">
                <div class="card-header"><h5>Información del Perfil</h5></div>
                <div class="card-body">

                    <!-- FORMULARIO PRINCIPAL -->
                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- FOTO -->
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="{{ $user->getProfilePhotoUrl() }}"
                                     class="profile-photo"
                                     alt="Foto de perfil">

                                <!-- Botón de subir foto -->
                                <label class="btn btn-sm btn-primary position-absolute bottom-0 end-0 rounded-circle shadow"
                                       style="transform: translate(25%, 25%); cursor: pointer;">
                                    <i class="bi bi-camera-fill"></i>
                                    <input type="file" name="photo" class="d-none" onchange="this.form.submit()">
                                </label>
                            </div>

                            @if($user->photo)
                            <div class="mt-2">
                                <label class="text-danger" style="cursor:pointer;">
                                    <input type="checkbox" name="_profile_photo_removal"
                                           class="d-none"
                                           onchange="this.form.submit()">
                                    <i class="bi bi-x-circle"></i> Eliminar foto
                                </label>
                            </div>
                            @endif
                        </div>

                        <hr>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Nombre</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Apellido paterno</label>
                                <input type="text" name="lastname1" value="{{ old('lastname1', $user->lastname1) }}" class="form-control">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Apellido materno</label>
                                <input type="text" name="lastname2" value="{{ old('lastname2', $user->lastname2) }}" class="form-control">
                            </div>
                        </div>

                        <div class="mt-4 text-end">
                            <button class="btn btn-primary px-4">
                                <i class="bi bi-check-circle"></i> Guardar cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header"><h5>Actualizar Contraseña</h5></div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-danger"><h5 class="text-white">Eliminar Cuenta</h5></div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </main>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
