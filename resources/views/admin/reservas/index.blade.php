@extends('layouts.app')

@section('title', 'Reservas Pendientes')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
@section('content')
<div class="dashboard-container">
    
    @include('admin.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Solicitudes de Reservas</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($reservas->isEmpty())
            <div class="alert alert-info text-center">
                No hay reservas pendientes.
            </div>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Vehículo</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($reservas as $res)
                        <tr>
                            <td>#RSV-{{ str_pad($res->id, 5, '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $res->usuario->name }}</td>
                            <td>{{ $res->vehiculo->placa }} ({{ $res->vehiculo->tipo_vehiculo }})</td>
                            <td>{{ $res->fecha_reserva->format('d M Y') }}</td>
                            <td>{{ $res->hora_inicio }} - {{ $res->hora_fin }}</td>
                            <td>
                                <span class="badge bg-warning text-dark">{{ ucfirst($res->estado) }}</span>
                            </td>
                            <td>
                                <form action="{{ route('admin.reservas.aceptar', $res->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-success btn-sm">Aceptar</button>
                                </form>

                                <form action="{{ route('admin.reservas.rechazar', $res->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button class="btn btn-danger btn-sm">Rechazar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        @endif
    </section>

</div>
@endsection
