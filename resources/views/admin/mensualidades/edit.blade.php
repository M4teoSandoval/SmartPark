@extends('layouts.app')

@section('title', 'Editar Mensualidad')
@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">

    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Editar Mensualidad</h1>

        <form method="POST" action="{{ route('admin.mensualidades.update', $mensualidad->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="fw-semibold">Fecha Fin</label>
                <input type="date" name="fecha_fin"
                       value="{{ $mensualidad->fecha_fin }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Valor</label>
                <input type="number" name="valor"
                       value="{{ $mensualidad->valor }}"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Estado</label>
                <select name="estado" class="form-control">
                    <option value="activa" {{ $mensualidad->estado == 'activa' ? 'selected' : '' }}>Activa</option>
                    <option value="vencida" {{ $mensualidad->estado == 'vencida' ? 'selected' : '' }}>Vencida</option>
                    <option value="cancelada" {{ $mensualidad->estado == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>

            <button class="btn btn-primary w-100">Actualizar</button>

        </form>

    </section>

</div>
@endsection
