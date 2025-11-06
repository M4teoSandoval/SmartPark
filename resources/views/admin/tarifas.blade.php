@extends('layouts.app')

@section('title', 'Tarifas')

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Gestión de Tarifas</h1>

        {{-- Alertas --}}
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario agregar tarifa --}}
        <div class="card mb-4">
            <div class="card-header bg-success text-white fw-bold">Agregar Tarifa</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.tarifas.store') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-semibold">Tipo Vehículo</label>
                            <select name="tipo_vehiculo" class="form-control" required>
                                <option disabled selected>Seleccionar...</option>
                                <option value="carro">Carro</option>
                                <option value="moto">Moto</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="fw-semibold">Valor por Hora</label>
                            <input type="number" name="valor_hora" class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="fw-semibold">Valor por Minuto</label>
                            <input type="number" name="valor_minuto" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="fw-semibold">Mensualidad</label>
                            <input type="number" name="valor_mensualidad" class="form-control" required>
                        </div>
                    </div>

                    <button class="btn btn-success">Guardar Tarifa</button>
                </form>
            </div>
        </div>

        {{-- Tabla de tarifas --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Tipo</th>
                    <th>Hora</th>
                    <th>Minuto</th>
                    <th>Mensualidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tarifas as $t)
                    <tr>
                        <td>{{ ucfirst($t->tipo_vehiculo) }}</td>
                        <td>${{ number_format($t->valor_hora) }}</td>
                        <td>${{ number_format($t->valor_minuto) }}</td>
                        <td>${{ number_format($t->valor_mensualidad) }}</td>
                        <td>
                            <form method="POST" action="{{ route('admin.tarifas.delete', $t->id) }}"
                                  onsubmit="return confirm('¿Eliminar tarifa?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center">Sin tarifas registradas</td></tr>
                @endforelse
            </tbody>
        </table>

    </section>
</div>

@endsection
