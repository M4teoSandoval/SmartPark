@extends('usuario.layout')

@section('content')
    <div class="res-card mb-4">

        <h3 class="fw-bold mb-3">Pagar Mensualidad</h3>

        <p><strong>Parqueadero:</strong> {{ $parqueadero->nombre }}</p>
        <p><strong>Dirección:</strong> {{ $parqueadero->direccion }}</p>

        <hr>

        <form action="{{ route('usuario.mensualidad.store') }}" method="POST">
            @csrf

            <input type="hidden" name="parqueadero_id" value="{{ $parqueadero->id }}">

            <div class="mb-3">
                <label for="vehiculo_id">Selecciona tu vehículo</label>
                <select name="vehiculo_id" id="vehiculo_id" class="form-control" required>
                    @foreach ($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id }}">
                            {{ $vehiculo->placa }} - {{ ucfirst($vehiculo->tipo) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Valor a pagar</label>
                <input type="text" class="form-control" value="{{ $valorMensualidad }}" readonly>
            </div>

            <button type="submit" class="btn btn-success">Confirmar Pago</button>
        </form>


    </div>
@endsection
