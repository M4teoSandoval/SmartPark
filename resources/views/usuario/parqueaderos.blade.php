<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Parqueaderos</title>
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" href="{{ asset('images/logo.png') }}" type="image/png">
</head>

<body>
    @include('layouts.navbar')
    <div class="site-wrapper">
        <div class="site-content">
            @include('usuario.sidebar')
            <main class="main-content">
                <h2>Parqueaderos</h2>
                <p class="text-muted">Explora los parqueaderos disponibles.</p>

                <div class="parking-grid">

                    @foreach ($parqueaderos as $parqueadero)
                        <div class="parking-card">
                            <img src="{{ asset('images/image_parqueadero.jpeg') }}" alt="">
                            <div class="card-body">
                                <h5>{{ $parqueadero->nombre }}</h5>
                                <p class="text-muted">{{ $parqueadero->direccion }}</p>

                                <div class="mb-2">
                                    <small>Plazas Carros:
                                        {{ $parqueadero->plazasCarrosDisponibles() }}/{{ $parqueadero->capacidad_carros }}</small><br>
                                    <small>Plazas Motos:
                                        {{ $parqueadero->plazasMotosDisponibles() }}/{{ $parqueadero->capacidad_motos }}</small>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="bi bi-star-fill text-warning"></i> 4.8
                                    </div>

                                    @if ($parqueadero->plazasCarrosDisponibles() > 0)
                                        <a href="{{ route('usuario.reservas.create', $parqueadero->id) }}"
                                            class="btn btn-sm btn-primary">Reservar</a>
                                        <a href="{{ route('usuario.mensualidad.pagar', $parqueadero->id) }}"
                                            class="btn btn-primary w-100">
                                            Pagar Mensualidad
                                        </a>
                                    @else
                                        <span class="text-danger">No disponible</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>


            </main>
        </div>
        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
