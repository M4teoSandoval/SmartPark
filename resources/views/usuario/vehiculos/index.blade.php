@extends('usuario.layout')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Mis Vehículos</h2>
    <a href="{{ route('usuario.vehiculos.create') }}" class="btn btn-primary">Agregar Vehículo</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@if($vehiculos->isEmpty())
    <p>No tienes vehículos registrados.</p>
@else
    <table class="table">
        <thead>
            <tr>
                <th>Placa</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $veh)
            <tr>
                <td>{{ $veh->placa }}</td>
                <td>{{ ucfirst($veh->tipo_vehiculo) }}</td>
                <td>
                    <form action="{{ route('usuario.vehiculos.destroy', $veh->id) }}" method="POST" onsubmit="return confirm('¿Eliminar este vehículo?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
