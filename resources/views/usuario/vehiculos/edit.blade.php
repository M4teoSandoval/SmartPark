@extends('usuario.layout')

@section('title', 'Editar Vehículo')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('usuario.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Editar Vehículo</h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm p-4" style="max-width: 500px; margin: 0 auto;">
            <form method="POST" action="{{ route('usuario.vehiculos.update', $vehiculo->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-semibold">Placa</label>
                    <input type="text" name="placa" value="{{ $vehiculo->placa }}" class="form-control" required>
                    @error('placa')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Tipo de Vehículo</label>
                    <select name="tipo_vehiculo" class="form-control" required>
                        <option value="carro" {{ $vehiculo->tipo_vehiculo === 'carro' ? 'selected' : '' }}>Carro</option>
                        <option value="moto" {{ $vehiculo->tipo_vehiculo === 'moto' ? 'selected' : '' }}>Moto</option>
                    </select>
                    @error('tipo_vehiculo')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Actualizar Vehículo</button>
                <a href="{{ route('usuario.vehiculos.index') }}" class="btn btn-outline-secondary w-100 mt-2">Cancelar</a>
            </form>
        </div>
    </section>
</div>
@endsection
