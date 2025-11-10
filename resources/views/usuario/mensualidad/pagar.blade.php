@extends('usuario.layout')

@section('content')
<div class="res-card mb-4">

    <h3 class="fw-bold mb-3">Pagar mensualidad</h3>

    {{-- Información del parqueadero --}}
    <div class="mb-3 p-3 border rounded bg-light">
        <h5 class="mb-1">{{ $parqueadero->nombre }}</h5>
        <p class="m-0 text-muted">{{ $parqueadero->direccion }}</p>
    </div>

    {{-- Formulario --}}
    <form action="{{ route('usuario.mensualidad.store') }}" method="POST">
        @csrf

        {{-- Parqueadero --}}
        <input type="hidden" name="parqueadero_id" value="{{ $parqueadero->id }}">

        {{-- Vehículo --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Vehículo para la mensualidad</label>
            <select name="vehiculo_id" class="form-select" required>
                <option value="" disabled selected>Seleccione un vehículo</option>
                @foreach ($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id }}">
                        {{ $vehiculo->placa }} — {{ ucfirst($vehiculo->tipo_vehiculo) }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Meses --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Duración</label>
            <select name="meses" class="form-select" required>
                <option value="1">1 mes</option>
                <option value="2">2 meses</option>
                <option value="3">3 meses</option>
                <option value="6">6 meses</option>
            </select>
        </div>

        {{-- Precio --}}
        <div class="mb-3">
            <label class="form-label fw-bold">Valor mensualidad</label>
            <input type="text" class="form-control" value="${{ number_format($parqueadero->precio_mensualidad, 0, ',', '.') }}" disabled>
        </div>

        <button class="btn btn-primary w-100 fw-bold">Pagar mensualidad</button>

    </form>
</div>
@endsection
