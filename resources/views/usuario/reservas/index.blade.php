@extends('usuario.layout')

@section('content')
{{-- Resumen en 4 cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
        <div class="card p-3 text-center">
            <small class="text-muted">Días usados</small>
            <div class="fs-4 fw-bold">{{ $diasUsados ?? 0 }}</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card p-3 text-center">
            <small class="text-muted">Horas totales</small>
            <div class="fs-4 fw-bold">{{ $horasTotales ?? 0 }}</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card p-3 text-center">
            <small class="text-muted">Reservas</small>
            <div class="fs-4 fw-bold">{{ $reservas->count() }}</div>
        </div>
    </div>

    <div class="col-sm-6 col-md-3">
        <div class="card p-3 text-center">
            <small class="text-muted">Promedio/día</small>
            <div class="fs-4 fw-bold">${{ $promedio ?? '0.00' }}</div>
        </div>
    </div>
</div>

{{-- Reservas activas --}}
<div class="card mb-4 p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Reservas activas</h5>
        <small class="text-muted">{{ $reservasActivas->count() }} en curso</small>
    </div>

    <div class="list-group">
        @foreach($reservasActivas as $res)
            <div class="list-group-item d-flex justify-content-between align-items-start">
                <div>
                    <div class="fw-bold">{{ $res->parqueadero->nombre }}</div>
                    <div class="text-muted small">
                        {{ $res->parqueadero->direccion }} — 
                        {{ $res->fecha_reserva->format('d M Y') }}, {{ $res->hora_inicio }} - {{ $res->hora_fin }}
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge bg-success mb-2">Activa</span>
                    <div><a href="#" class="btn btn-sm btn-outline-primary">Ver</a></div>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Historial --}}
<div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5 class="mb-0">Historial</h5>
        <small class="text-muted">Últimos 6</small>
    </div>

    <div class="accordion" id="historialAccordion">
        @foreach($historial as $key => $h)
        <div class="accordion-item">
            <h2 class="accordion-header" id="h{{ $key }}">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">
                    {{ $h->parqueadero->nombre }} — {{ $h->fecha_reserva->format('d M Y') }}
                </button>
            </h2>
            <div id="collapse{{ $key }}" class="accordion-collapse collapse" aria-labelledby="h{{ $key }}" data-bs-parent="#historialAccordion">
                <div class="accordion-body">
                    Horario: {{ $h->hora_inicio }} - {{ $h->hora_fin }} · 
                    Precio: ${{ $h->transaccion?->monto ?? '0.00' }} · Estado: {{ ucfirst($h->estado) }}
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-outline-secondary">Ver factura</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
