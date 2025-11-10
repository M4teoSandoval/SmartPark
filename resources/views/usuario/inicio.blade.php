@extends('usuario.layout')

@section('content')
    {{-- Encabezado simple --}}
    <div class="mb-4">
        <h1 class="welcome-title">Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</h1>
        <p class="text-muted">Aquí encontrarás tus noticias, resumen y estado de suscripción.</p>
    </div>

    <div class="row g-4">
        <!-- Columna izquierda: Resumen + Suscripción -->
        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="card summary-card p-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-bar-chart-line me-2 fs-4"></i>
                    <div>
                        <div class="fw-bold">Resumen de Uso</div>
                        <small class="text-muted">Este mes</small>
                    </div>
                </div>

                <div class="row g-2 mt-3">
                    <div class="col-6">
                        <div class="p-3 bg-light rounded text-center">
                            <small class="text-muted d-block">Días usados</small>
                            <div class="fs-4 fw-bold">18</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded text-center">
                            <small class="text-muted d-block">Horas totales</small>
                            <div class="fs-4 fw-bold">72</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded text-center">
                            <small class="text-muted d-block">Reservas</small>
                            <div class="fs-4 fw-bold">24</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 bg-light rounded text-center">
                            <small class="text-muted d-block">Promedio/día</small>
                            <div class="fs-4 fw-bold">$12.5K</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card subscription-card p-3">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-wallet2 me-2 fs-4"></i>
                    <div>
                        <div class="fw-bold">Mi Suscripción</div>
                        <small class="text-muted">Parqueadero</small>
                    </div>
                </div>

                <div class="mt-2">
                    <div class="fw-bold">Parqueadero Centro</div>
                    <div class="fw-bold text-success fs-4">$150.000</div>
                </div>

                <div class="mt-3 p-2 bg-light rounded">
                    <small class="text-muted">Días restantes</small>
                    <div class="fw-bold">15 días</div>
                </div>

                <div class="mt-3">
                    <div class="alert alert-danger p-2 mb-0">Renovación próxima — Tu suscripción se renovará en 15 días
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna derecha: Noticias / Avisos -->
        <!-- Columna derecha: Noticias / Avisos -->
        <div class="col-lg-8 d-flex flex-column gap-3">

            <!-- Noticia principal (imagen más grande) -->
            <div class="card news-card p-3">
                <img src="{{ asset('images/pp.jpg') }}" alt="Pico y placa" class="w-100 rounded mb-3"
                    style="width: 250px; height: 300px; object-fit: contain;">
                <div>
                    <h5 class="mb-1">Aviso: Pico y placa</h5>
                    <p class="mb-1 text-muted">
                        Estimado cliente: El pico y placa Bucaramanga: Octubre - Noviembre - Diciembre.
                        Revisa horarios y evita multas.
                    </p>
                    <span class="badge bg-warning text-dark">Importante</span>
                </div>
            </div>

            <!-- Noticias secundarias (mismo formato, imagen más pequeña) -->
            <div class="card news-card p-3 d-flex flex-row gap-3 align-items-start">
                <img src="{{ asset('images/mantenimiento.png') }}" alt="Mantenimiento programado" class="news-img rounded"
                    style="width: 220px; height: 150px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h5 class="mb-1">Mantenimiento programado</h5>
                    <p class="mb-1 text-muted">
                        Se realizará mantenimiento en el parqueadero Norte el próximo viernes.
                    </p>
                </div>
            </div>

            <div class="card news-card p-3 d-flex flex-row gap-3 align-items-start">
                <img src="{{ asset('images/promociones.png') }}" alt="Promoción del mes" class="news-img rounded"
                    style="width: 220px; height: 150px; object-fit: cover;">
                <div class="flex-grow-1">
                    <h5 class="mb-1">Promoción del mes</h5>
                    <p class="mb-1 text-muted">
                        20% de descuento en parqueaderos seleccionados los fines de semana.
                    </p>
                </div>
            </div>
        </div>


    </div>
    </div>
@endsection
