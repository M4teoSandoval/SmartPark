@extends('layouts.app')

@section('title', 'Mis Transacciones')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">

    @include('usuario.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Mis Transacciones</h1>

        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Vehículo</th>
                    <th>Parqueadero</th>
                    <th>Tipo</th>
                    <th>Valor</th>
                    <th>Método de Pago</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transacciones as $t)
                    <tr>
                        <td>{{ $t->vehiculo->placa }}</td>
                        <td>{{ $t->parqueadero->nombre }}</td>
                        <td>{{ ucfirst($t->tipo_transaccion) }}</td>
                        <td>${{ number_format($t->valor, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($t->metodo_pago) }}</td>
                        <td>{{ $t->fecha }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No hay transacciones registradas.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

</div>
@endsection
