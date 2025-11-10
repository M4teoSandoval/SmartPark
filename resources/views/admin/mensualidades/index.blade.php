@extends('layouts.app')

@section('title', 'Mensualidades')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">

    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Mensualidades Registradas</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('admin.mensualidades.create') }}" class="btn btn-success mb-4">
            Registrar Mensualidad
        </a>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Usuario</th>
                    <th>Vehículo</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Fin</th>
                    <th>Valor</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($mensualidades as $m)
                    <tr>
                        <td>{{ $m->usuario->name }}</td>
                        <td>{{ $m->vehiculo->placa }}</td>
                        <td>{{ $m->fecha_inicio }}</td>
                        <td>{{ $m->fecha_fin }}</td>
                        <td>${{ number_format($m->valor, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($m->estado) }}</td>
                        <td>
                            <a href="{{ route('admin.mensualidades.show', $m->id) }}" class="btn btn-sm btn-primary">Ver</a>
                            <a href="{{ route('admin.mensualidades.edit', $m->id) }}" class="btn btn-sm btn-warning">Editar</a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="text-center">No hay mensualidades registradas.</td></tr>
                @endforelse
            </tbody>

        </table>

    </section>

</div>
@endsection
