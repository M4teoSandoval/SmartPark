@extends('usuario.layout')

@section('content')
<h2>Mis Mensualidades</h2>
<p class="text-muted">Lista de tus mensualidades activas y expiradas.</p>

<div class="card p-3">
    <div class="list-group">
        @forelse($mensualidades as $mensualidad)
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <div class="fw-bold">{{ $mensualidad->parqueadero->nombre }}</div>
                    <div class="text-muted small">
                        Vehículo: {{ $mensualidad->vehiculo->placa }} — Tipo: {{ ucfirst($mensualidad->vehiculo->tipo) }}<br>
                        Inicio: {{ \Carbon\Carbon::parse($mensualidad->fecha_inicio)->format('d M Y') }} <br>
                        Fin: {{ \Carbon\Carbon::parse($mensualidad->fecha_fin)->format('d M Y') }}
                    </div>
                </div>
                <div class="text-end">
                    <span class="badge 
                        {{ $mensualidad->estado == 'activa' ? 'bg-success' : 'bg-secondary' }}">
                        {{ ucfirst($mensualidad->estado) }}
                    </span>
                    <div class="mt-2">
                        @if($mensualidad->estado == 'activa')
                            <a href="#" class="btn btn-sm btn-outline-primary">Renovar</a>
                        @else
                            <span class="text-muted small">Expirada</span>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="list-group-item text-center text-muted">
                No tienes mensualidades registradas.
            </div>
        @endforelse
    </div>
</div>
@endsection
