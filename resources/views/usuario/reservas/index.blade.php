@extends('usuario.layout')

@section('content')
<div class="reservas-container">

    {{-- ====== RESUMEN RÁPIDO ====== --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="res-card card-primary">
                <h5>Días usados</h5>
                <p class="fs-3 fw-bold">{{ $diasUsados ?? 0 }}</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="res-card card-success text-white">
                <h5>Horas totales</h5>
                <p class="fs-3 fw-bold">{{ $horasTotales ?? 0 }}</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="res-card card-warning">
                <h5>Reservas</h5>
                <p class="fs-3 fw-bold">{{ $reservas->count() }}</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="res-card card-info">
                <h5>Promedio / día</h5>
                <p class="fs-3 fw-bold">${{ $promedio ?? '0.00' }}</p>
            </div>
        </div>
    </div>



    {{-- ====== RESERVAS ACTIVAS ====== --}}
    <div class="res-card mb-4">

        <div class="d-flex justify-content-between align-items-center mb-2">
            <h4 class="fw-bold">Reservas activas</h4>
            <span class="badge-activa">{{ $reservasActivas->count() }} activas</span>
        </div>

        @if ($reservasActivas->isEmpty())
            <p class="text-muted text-center">No tienes reservas activas.</p>

        @else
            @foreach ($reservasActivas as $res)
                <div class="reserva-item">

                    <div>
                        <div class="reserva-title">
                            #RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }} – {{ $res->parqueadero->nombre }}
                        </div>

                        <div class="reserva-det">
                            {{ $res->parqueadero->direccion }} <br>
                            {{ $res->fecha_reserva->format('d M Y') }}
                            — {{ $res->hora_inicio }} a {{ $res->hora_fin }}
                        </div>
                    </div>

                    <div class="text-end">
                        <a class="btn btn-res btn-ver">Ver</a>

                        <form action="{{ route('usuario.reservas.destroy', $res->id) }}"
                              method="POST"
                              class="d-inline-block ms-2"
                              onsubmit="return confirm('¿Cancelar la reserva?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-res btn-cancelar">Cancelar</button>
                        </form>
                    </div>

                </div>
            @endforeach
        @endif

    </div>



    {{-- ====== HISTORIAL ====== --}}
    <div class="res-card">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold">Historial</h4>
            <small class="text-muted">Últimos 6 movimientos</small>
        </div>

        @if ($historial->isEmpty())
            <p class="text-muted text-center">Sin historial por ahora.</p>

        @else
            <div class="accordion" id="historialAccordion">

                @foreach ($historial as $key => $h)
                    <div class="accordion-item">

                        <h2 class="accordion-header" id="h{{ $key }}">
                            <button class="accordion-button collapsed" data-bs-toggle="collapse"
                                    data-bs-target="#c{{ $key }}">
                                #RSV-{{ str_pad($h->id, 5, '0', STR_PAD_LEFT) }}
                                &nbsp;—&nbsp; {{ $h->parqueadero->nombre }}
                                &nbsp;—&nbsp; {{ $h->fecha_reserva->format('d M Y') }}
                            </button>
                        </h2>

                        <div id="c{{ $key }}" class="accordion-collapse collapse">

                            <div class="accordion-body">

                                <div><strong>Horario:</strong> {{ $h->hora_inicio }} - {{ $h->hora_fin }}</div>
                                <div><strong>Precio:</strong> ${{ $h->transaccion?->monto ?? '0.00' }}</div>
                                <div class="mb-2"><strong>Estado:</strong> {{ ucfirst($h->estado) }}</div>

                                <a class="btn btn-res btn-ver">Ver factura</a>

                            </div>

                        </div>

                    </div>
                @endforeach

            </div>
        @endif

    </div>

</div>
@endsection
