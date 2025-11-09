@extends('layouts.app')

@section('title', 'Registrar Mensualidad')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">

        @include('admin.sidebar')

        <section class="main-content">

            <h1 class="mb-4">Registrar Mensualidad</h1>

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.mensualidades.store') }}">
                @csrf

                <div class="mb-3">
                    <label class="fw-semibold">Usuario</label>
                    <select name="usuario_id" class="form-control" required>
                        <option disabled selected>Seleccionar...</option>
                        @foreach ($usuarios as $u)
                            <option value="{{ $u->id }}">{{ $u->name }} ({{ $u->email }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Vehículo</label>
                    <select name="vehiculo_id" class="form-control" required>
                        <option disabled selected>Seleccionar...</option>
                        @foreach ($vehiculos as $v)
                            <option value="{{ $v->id }}">
                                {{ $v->placa }} ({{ $v->tipo_vehiculo }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-semibold">Fecha Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-semibold">Fecha Fin</label>
                        <input type="date" name="fecha_fin" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Método de Pago</label>
                    <select name="metodo_pago" class="form-control" required>
                        <option disabled selected>Seleccionar...</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjeta">Tarjeta</option>
                        <option value="transferencia">Transferencia</option>
                        <option value="payu">PayU</option>
                    </select>
                </div>

                {{-- ✅ El valor ya NO se pide en el formulario
         Se calcula automáticamente según la tarifa del parqueadero --}}

                <button class="btn btn-success w-100 fw-bold">Guardar</button>

            </form>


        </section>

    </div>
@endsection
