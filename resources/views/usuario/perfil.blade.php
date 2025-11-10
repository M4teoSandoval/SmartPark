<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Mi Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

<body>
    @include('layouts.navbar')
    <div class="site-wrapper">
        <div class="site-content">
            @include('usuario.sidebar')
            <main class="main-content">
                <h2 class="fw-bold mb-2">Mi Perfil</h2>
                <p class="text-muted mb-4">Gestiona tu información personal.</p>

                <div class="card shadow-sm border border-primary-subtle rounded-4 p-4" style="max-width: 550px;">
                    <div class="d-flex align-items-center gap-4 mb-3">
                        <img src="{{ asset('images/wilson.jpg') }}" alt="Foto de perfil"
                            class="rounded-circle border border-primary-subtle"
                            style="width: 200px; height: 200px; object-fit: cover;">
                        <div>
                            <h5 class="fw-semibold mb-1">{{ auth()->user()->name ?? 'Usuario' }}</h5>
                            <p class="text-muted small mb-0">{{ auth()->user()->email ?? 'email@ejemplo.com' }}</p>
                            <p class="text-muted small mb-0">
                                {{ auth()->user()->tipo_documento ?? 'Tipo de documento no registrado' }}:
                                {{ auth()->user()->numero_documento ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Rol</p>
                            <p class="fw-medium">Cliente</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small">Estado</p>
                            <p class="fw-medium text-success">Activo</p>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
