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
                <h2 class="fw-bold mb-2 text-center">Mi Perfil</h2>
                <p class="text-muted mb-4 text-center">Gestiona tu información personal.</p>

                <!-- CONTENEDOR FLEXIBLE DE TARJETAS -->
                <div class="d-flex flex-column flex-lg-row gap-4">

                    <!-- CARD PERFIL -->
                    <div class="card shadow-sm border border-primary-subtle rounded-4 p-4 flex-fill"
                        style="max-width: 550px;">
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

                        <div class="text-center">
                            <a href="#" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm">
                                <i class="bi bi-pencil-square me-2"></i>Editar perfil
                            </a>
                        </div>
                    </div>

                    <!-- CARD VEHÍCULO REGISTRADO -->
                    <!-- CARD VEHÍCULOS REGISTRADOS -->
                    <div class="card shadow-sm border border-success-subtle rounded-4 p-4 flex-fill"
                        style="max-width: 550px;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center"
                                style="width: 60px; height: 60px;">
                                <i class="bi bi-car-front fs-2"></i>
                            </div>
                            <div>
                                <h5 class="fw-semibold mb-1">Vehículos Registrados</h5>
                                <p class="text-muted small mb-0">Listado de tus vehículos</p>
                            </div>
                        </div>
                        <hr>

                        @php
                            $vehiculos = auth()->user()->vehiculos;
                        @endphp

                        @if ($vehiculos->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach ($vehiculos as $vehiculo)
                                    <div
                                        class="list-group-item px-0 py-2 border-0 d-flex justify-content-between align-items-center">
                                        <div>
                                            <p class="fw-semibold mb-0 text-uppercase">{{ $vehiculo->placa }}</p>
                                            <small class="text-muted">{{ ucfirst($vehiculo->tipo_vehiculo) }}</small>
                                        </div>
                                        <a href="{{ route('usuario.vehiculos.index') }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>
                                    @if (!$loop->last)
                                        <hr class="my-2">
                                    @endif
                                @endforeach
                            </div>
                        @else
                            <p class="text-muted text-center mb-0">No tienes vehículos registrados aún.</p>
                            <div class="text-center mt-3">
                                <a href="{{ route('usuario.vehiculos.create') }}" class="btn btn-success rounded-3">
                                    <i class="bi bi-plus-lg me-1"></i>Registrar vehículo
                                </a>
                            </div>
                        @endif
                    </div>

                </div> <!-- /flex -->
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
