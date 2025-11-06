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

    <!-- NAVBAR -->
@include('layouts.navbar')

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
                    <img src="/images/logo.png" alt="Mapa SmartPark">
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
