@extends('layouts.app')

@section('title', 'Dashboard Admin')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">

        {{-- Sidebar del admin --}}
        @include('admin.sidebar')

        <section class="main-content">
            <h1 class="mb-4">Panel de Administración</h1>

            {{-- Estadísticas rápidas --}}
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-primary shadow">
                        <div class="card-body">
                            <h5 class="card-title">Vehículos</h5>
                            <p class="card-text fs-3">{{ $totalVehiculos }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success shadow">
                        <div class="card-body">
                            <h5 class="card-title">Entradas hoy</h5>
                            <p class="card-text fs-3">{{ $entradasHoy }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning shadow">
                        <div class="card-body">
                            <h5 class="card-title">Salidas hoy</h5>
                            <p class="card-text fs-3">{{ $salidasHoy }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-info shadow">
                        <div class="card-body">
                            <h5 class="card-title">Transacciones</h5>
                            <p class="card-text fs-3">{{ $totalTransacciones }}</p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Plazas disponibles --}}
            @if ($parqueadero)
                <div class="row mb-4">

                    <div class="col-md-6">
                        <div class="card text-white bg-dark shadow">
                            <div class="card-body">
                                <h5 class="card-title">Plazas disponibles - Carros</h5>
                                <p class="card-text fs-3">
                                    {{ $carrosDisponibles }} / {{ $parqueadero->capacidad_carros }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card text-white bg-secondary shadow">
                            <div class="card-body">
                                <h5 class="card-title">Plazas disponibles - Motos</h5>
                                <p class="card-text fs-3">
                                    {{ $motosDisponibles }} / {{ $parqueadero->capacidad_motos }}
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            @else
                <div class="alert alert-warning">
                    No has configurado tu parqueadero aún.
                </div>
            @endif



            {{-- Entradas recientes --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-primary text-white fw-bold">
                    Entradas recientes
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Vehículo</th>
                                <th>Tipo</th>
                                <th>Parqueadero</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($entradasRecientes as $entrada)
                                <tr>
                                    <td>{{ $entrada->vehiculo->placa }}</td>
                                    <td>{{ ucfirst($entrada->vehiculo->tipo_vehiculo) }}</td>
                                    <td>{{ $entrada->parqueadero->nombre ?? 'N/A' }}</td>
                                    <td>{{ $entrada->fecha_hora }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Sin entradas recientes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Salidas recientes --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    Salidas recientes
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Vehículo</th>
                                <th>Tipo</th>
                                <th>Parqueadero</th>
                                <th>Fecha y Hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($salidasRecientes as $salida)
                                <tr>
                                    <td>{{ $salida->vehiculo->placa }}</td>
                                    <td>{{ ucfirst($salida->vehiculo->tipo_vehiculo) }}</td>
                                    <td>{{ $salida->parqueadero->nombre ?? 'N/A' }}</td>
                                    <td>{{ $salida->fecha_hora }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Sin salidas recientes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </section>
    </div>
@endsection
