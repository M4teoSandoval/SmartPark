@extends('usuario.layout')

@section('content')
<div class="card p-3">
    <h4>Crear nueva reserva</h4>
    <p class="text-muted">Parqueadero: <strong>{{ $parqueadero->nombre }}</strong></p>

    <form action="{{ route('usuario.reservas.store') }}" method="POST">
        @csrf
        <input type="hidden" name="parqueadero_id" value="{{ $parqueadero->id }}">

        {{-- Selección de vehículo --}}
        <div class="mb-3">
            <label for="vehiculo_id" class="form-label">Vehículo</label>
            <select name="vehiculo_id" id="vehiculo_id" class="form-select" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $veh)
                    <option value="{{ $veh->id }}">
                        {{ $veh->placa }} — {{ ucfirst($veh->tipo) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Fecha --}}
        <div class="mb-3">
            <label for="fecha_reserva" class="form-label">Fecha de reserva</label>
            <input type="date" name="fecha_reserva" id="fecha_reserva" class="form-control" required>
        </div>

        {{-- Hora inicio --}}
        <div class="mb-3">
            <label for="hora_inicio" class="form-label">Hora de inicio</label>
            <input type="time" name="hora_inicio" id="hora_inicio" class="form-control" required>
        </div>

        {{-- Hora fin --}}
        <div class="mb-3">
            <label for="hora_fin" class="form-label">Hora de fin</label>
            <input type="time" name="hora_fin" id="hora_fin" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Reservar</button>
        <a href="{{ route('usuario.parqueaderos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
