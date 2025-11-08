@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
@section('content')
    <div class="dashboard-container">
        @include('admin.sidebar')

        <section class="main-content">


            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <h1 class="mb-4">Vehículos Registrados</h1>

            <a href="{{ route('admin.vehiculos.create') }}" class="btn btn-success mb-3">Agregar Vehículo</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Último Movimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vehiculos as $v)
                        @php
                            $ultimo = $v->movimientos->first();
                            $estado = $ultimo ? ($ultimo->tipo === 'entrada' ? 'Dentro' : 'Fuera') : 'Sin historial';
                        @endphp
                        <tr>
                            <td>{{ $v->placa }}</td>
                            <td>{{ ucfirst($v->tipo_vehiculo) }}</td>
                            <td>{{ $estado }}</td>
                            <td>{{ $ultimo->fecha_hora ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.vehiculos.show', $v->id) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('admin.vehiculos.edit', $v->id) }}"
                                    class="btn btn-primary btn-sm">Editar</a>



                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </div>
@endsection
