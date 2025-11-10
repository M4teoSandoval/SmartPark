@extends('usuario.layout')

@section('content')
    {{-- Encabezado animado --}}
    <div class="mb-4 text-center animate__animated animate__fadeInDown">
        <h1 class="welcome-title display-5 fw-bold">Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</h1>
        <p class="text-muted fs-5">Aquí encontrarás tus noticias, resumen y estado de suscripción.</p>
    </div>

    <div class="row g-4">

        <!-- Columna izquierda: Resumen + Suscripción -->
        <div class="col-lg-4 d-flex flex-column gap-4">

            {{-- Resumen de uso --}}
            <div class="card shadow-sm p-4 animate__animated animate__fadeInLeft summary-card">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-bar-chart-line fs-3 text-primary me-2"></i>
                    <div>
                        <div class="fw-bold fs-5">Resumen de Uso</div>
                        <small class="text-muted">Este mes</small>
                    </div>
                </div>
                <div class="row g-3 mt-3">
                    @php
                        $summary = [
                            ['label' => 'Días usados', 'value' => $usageDays ?? 0, 'color' => 'bg-primary text-white'],
                            [
                                'label' => 'Horas totales',
                                'value' => $usageHours ?? 0,
                                'color' => 'bg-success text-white',
                            ],
                            [
                                'label' => 'Reservas',
                                'value' => $totalReservations ?? 0,
                                'color' => 'bg-warning text-dark',
                            ],
                            [
                                'label' => 'Promedio/día',
                                'value' => $averagePerDay ?? 0,
                                'color' => 'bg-info text-white',
                            ],
                        ];
                    @endphp
                    @foreach ($summary as $item)
                        <div class="col-6">
                            <div class="p-3 rounded text-center {{ $item['color'] }}">
                                <small class="d-block">{{ $item['label'] }}</small>
                                <div class="fs-4 fw-bold">{{ $item['value'] }}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Suscripción --}}
            <div class="card shadow-sm p-4 animate__animated animate__fadeInLeft animate__delay-1s subscription-card">
                <div class="d-flex align-items-center mb-3">
                    <i class="bi bi-wallet2 fs-3 text-success me-2"></i>
                    <div>
                        <div class="fw-bold fs-5">Mi Suscripción</div>
                        <small class="text-muted">Parqueadero</small>
                    </div>
                </div>

                @if ($mensualidad)
                    <div class="mt-2">
                        <div class="fw-bold">{{ $mensualidad->parqueadero->nombre }}</div>
                        <div class="fw-bold text-success fs-4">${{ number_format($mensualidad->valor, 0) }}</div>
                    </div>
                    <div class="mt-3 p-3 bg-light rounded text-center">
                        <small class="text-muted">Días restantes</small>
                        <div class="fw-bold fs-5">{{ intval($mensualidad->dias_restantes) }}</div>
                    </div>
                    @if ($mensualidad->dias_restantes <= 15)
                        <div class="mt-3">
                            <div class="alert alert-danger p-2 mb-0 text-center">
                                Renovación próxima — Tu suscripción se renovará en {{ intval($mensualidad->dias_restantes) }} días
                            </div>
                        </div>
                    @endif
                @else
                    <div class="mt-3">
                        <div class="alert alert-warning p-2 mb-0 text-center">
                            No tienes suscripción activa
                        </div>
                    </div>
                @endif
            </div>


        </div>

        <!-- Columna derecha: Noticias / Avisos -->
        <div class="col-lg-8 d-flex flex-column gap-4">

            {{-- Noticia principal --}}
            <div class="card shadow-sm p-3 animate__animated animate__fadeInRight news-card">
                <div class="row g-3 align-items-center">
                    <div class="col-md-4 text-center">
                        <img src="{{ asset('images/pp.jpg') }}" alt="Pico y placa" class="rounded w-100"
                            style="height: 200px; object-fit: cover;">
                    </div>
                    <div class="col-md-8">
                        <h5 class="fw-bold mb-2">Aviso: Pico y placa</h5>
                        <p class="mb-2 text-muted">Estimado cliente: El pico y placa Bucaramanga: Octubre - Noviembre -
                            Diciembre. Revisa horarios y evita multas.</p>
                        <span class="badge bg-warning text-dark">Importante</span>
                    </div>
                </div>
            </div>

            {{-- Noticias secundarias (quemadas) --}}
            @php
                $news = [
                    [
                        'img' => 'mantenimiento.png',
                        'title' => 'Mantenimiento programado',
                        'text' => 'Se realizará mantenimiento en el parqueadero Norte el próximo viernes.',
                        'badge' => 'bg-info text-white',
                    ],
                    [
                        'img' => 'promociones.png',
                        'title' => 'Promoción del mes',
                        'text' => '20% de descuento en parqueaderos seleccionados los fines de semana.',
                        'badge' => 'bg-success text-white',
                    ],
                ];
            @endphp
            @foreach ($news as $item)
                <div
                    class="card shadow-sm p-3 d-flex flex-row gap-3 align-items-start animate__animated animate__fadeInRight animate__delay-1s news-card">
                    <img src="{{ asset('images/' . $item['img']) }}" alt="{{ $item['title'] }}" class="rounded"
                        style="width: 150px; height: 100px; object-fit: cover;">
                    <div class="flex-grow-1">
                        <h6 class="fw-bold">{{ $item['title'] }}</h6>
                        <p class="mb-0 text-muted">{{ $item['text'] }}</p>
                    </div>
                </div>
            @endforeach

        </div>

    </div>

    {{-- Animate.css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

    {{-- Estilos extra --}}
    <style>
        .welcome-title {
            color: #0d6efd;
        }

        .summary-card .col-6 {
            transition: transform 0.3s;
        }

        .summary-card .col-6:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        }

        .subscription-card {
            border-left: 5px solid #198754;
        }

        .news-card {
            transition: all 0.3s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
@endsection
