{{-- resources/views/admin/vehiculos/edit.blade.php --}}
@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush
@section('title', 'Editar Vehículo')

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1 class="mb-4">Editar Vehículo</h1>

        <form action="{{ route('admin.vehiculos.update', $vehiculo->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="placa">Placa</label>
                <input type="text" id="placa" name="placa" value="{{ old('placa', $vehiculo->placa) }}"
                    class="form-control @error('placa') is-invalid @enderror" placeholder="Ej: ABC123">
                @error('placa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tipo_vehiculo">Tipo de Vehículo</label>
                <select id="tipo_vehiculo" name="tipo_vehiculo"
                    class="form-control @error('tipo_vehiculo') is-invalid @enderror">
                    <option value="carro" {{ $vehiculo->tipo_vehiculo == 'carro' ? 'selected' : '' }}>Carro</option>
                    <option value="moto" {{ $vehiculo->tipo_vehiculo == 'moto' ? 'selected' : '' }}>Moto</option>
                </select>
                @error('tipo_vehiculo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-custom-salida">Actualizar Vehículo</button>
            <a href="{{ route('admin.vehiculos') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </section>
</div>
@endsection
