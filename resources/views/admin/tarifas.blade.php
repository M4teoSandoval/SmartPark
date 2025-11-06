@extends('layouts.app')

@section('title', 'Tarifas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1>Gestión de Tarifas</h1>
        <p>Aquí podrás agregar, editar o eliminar tarifas de vehículos.</p>

        {{-- Botón para agregar nueva tarifa --}}
        <button class="btn btn-success mb-4">Agregar Tarifa</button>

        {{-- Tabla de tarifas --}}
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Tipo de Vehículo</th>
                    <th>Tarifa por Hora</th>
                    <th>Tarifa por Día</th>
                    <th>Tarifa Mensual</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Auto</td>
                    <td>$3.000 COP</td>
                    <td>$20.000 COP</td>
                    <td>$200.000 COP</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Moto</td>
                    <td>$1.500 COP</td>
                    <td>$10.000 COP</td>
                    <td>$100.000 COP</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Camioneta</td>
                    <td>$4.000 COP</td>
                    <td>$25.000 COP</td>
                    <td>$250.000 COP</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
                <tr>
                    <td>Bus</td>
                    <td>$5.000 COP</td>
                    <td>$30.000 COP</td>
                    <td>$300.000 COP</td>
                    <td>
                        <button class="btn btn-primary btn-sm">Editar</button>
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</div>
@endsection
