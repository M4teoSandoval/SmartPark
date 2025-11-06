<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

<body>

    <nav class="navbar navbar-expand-lg bg-white shadow-sm fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo y nombre -->
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <img src="{{ asset('images/logo.png') }}" alt="SmartPark" width="50" class="me-2">
                <span class="fw-bold" style="color: #1D457D;">Smart<span style="color: #2CA6D0;">Park</span></span>
            </a>

            <!-- Menú -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item">
                        <a class="nav-link fw-bold text-success" href="{{ url('/') }}">Inicio</a>
                    </li>

                    @guest
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-success" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-bold text-success" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle fw-bold text-success" href="#"
                                role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-danger fw-semibold" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar sesión
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>


    <!-- HERO -->
    <section class="hero text-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1>Encuentra y gestiona tu parqueadero de forma rápida, segura y sin estrés.</h1>
                    <p class="mt-3">Reserva tu lugar en segundos con SmartPark en Bucaramanga, Santander.</p>
                    <div class="mt-4">
                        <a href="#" class="btn btn-green me-2">Reserva ahora</a>
                        <a href="#" class="btn btn-outline-success me-2">Ver parqueaderos</a>
                        <a href="#" class="btn btn-outline-success">Contáctanos</a>
                    </div>
                </div>
                <div class="col-md-6 mt-4 mt-md-0">
                    <img src="/images/image.png" alt="Mapa SmartPark">
                </div>
            </div>
        </div>
    </section>

    <!-- FEATURES -->
    <section class="features text-center py-5">
        <div class="container">
            <h2 class="fw-bold mb-4">¿Por qué elegirnos?</h2>
            <div class="row">
                <div class="col-md-3">
                    <i class="bi bi-coin"></i>
                    <h5 class="mt-3">Administración de Tarifas</h5>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-clock-history"></i>
                    <h5 class="mt-3">Control en Tiempo Real</h5>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-bar-chart"></i>
                    <h5 class="mt-3">Reportes Automáticos</h5>
                </div>
                <div class="col-md-3">
                    <i class="bi bi-person-badge"></i>
                    <h5 class="mt-3">Gestión de Usuarios</h5>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</body>

</html>
