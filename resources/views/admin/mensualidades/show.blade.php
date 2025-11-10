@extends('layouts.app')

@section('title', 'Detalle de Mensualidad')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">

    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Detalle de Mensualidad</h1>

        <div class="card">
            <div class="card-body">

                <p><strong>Usuario:</strong> {{ $mensualidad->usuario->name }}</p>
                <p><strong>Vehículo:</strong> {{ $mensualidad->vehiculo->placa }}</p>
                <p><strong>Fecha Inicio:</strong> {{ $mensualidad->fecha_inicio }}</p>
                <p><strong>Fecha Fin:</strong> {{ $mensualidad->fecha_fin }}</p>
                <p><strong>Valor:</strong> ${{ number_format($mensualidad->valor, 0, ',', '.') }}</p>
                <p><strong>Estado:</strong> {{ ucfirst($mensualidad->estado) }}</p>

                <a href="{{ route('admin.mensualidades.edit', $mensualidad->id) }}" class="btn btn-warning mt-3">
                    Editar
                </a>

            </div>
        </div>

    </section>

</div>
@endsection
