{{-- resources/views/admin/vehiculos/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalles del Vehículo')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Detalles de Vehículo: {{ $vehiculo->placa }}</h1>

        <ul class="list-group mb-4">
            <li class="list-group-item"><strong>Placa:</strong> {{ $vehiculo->placa }}</li>
            <li class="list-group-item"><strong>Tipo:</strong> {{ ucfirst($vehiculo->tipo_vehiculo) }}</li>
            <li class="list-group-item"><strong>Registrado por:</strong> {{ $vehiculo->user->name ?? 'N/A' }}</li>
            <li class="list-group-item"><strong>Fecha de registro:</strong> {{ $vehiculo->created_at->format('d-m-Y H:i') }}</li>
        </ul>

        <h3>Historial de Movimientos</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Parqueadero</th>
                    <th>Fecha y Hora</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($historial as $mov)
                    <tr>
                        <td>{{ ucfirst($mov->tipo) }}</td>
                        <td>{{ $mov->parqueadero->nombre ?? 'N/A' }}</td>
                        <td>{{ $mov->fecha_hora }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No hay movimientos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('admin.vehiculos') }}" class="btn btn-custom-salida mt-3">Volver</a>
    </section>
</div>
@endsection
