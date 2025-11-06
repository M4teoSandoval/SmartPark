@extends('layouts.app')

@section('title', 'Ingresos')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1>Registrar Ingreso de Vehículos</h1>

        {{-- Hora y fecha en tiempo real --}}
        <p><strong>Hora actual:</strong> <span id="hora"></span></p>
        <p><strong>Fecha:</strong> <span id="fecha"></span></p>
         <p>Lista de vehículos que han entrado:</p>

        {{-- Lista de vehículos (ejemplo estático) --}}
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>Placa</th>
                    <th>Tipo de Vehículo</th>
                    <th>Hora de Ingreso</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ABC123</td>
                    <td>Auto</td>
                    <td>08:30 AM</td>
                    <td>2 de Noviembre, 2025</td>
                </tr>
                <tr>
                    <td>XYZ987</td>
                    <td>Moto</td>
                    <td>09:15 AM</td>
                    <td>2 de Noviembre, 2025</td>
                </tr>
            </tbody>
        </table>
    </section>
</div>

{{-- Script para actualizar hora y fecha --}}
<script>
function actualizarHora() {
    const ahora = new Date();
    const opcionesHora = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };
    const opcionesFecha = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('hora').textContent = ahora.toLocaleTimeString('es-ES', opcionesHora);
    document.getElementById('fecha').textContent = ahora.toLocaleDateString('es-ES', opcionesFecha);
}
setInterval(actualizarHora, 1000);
actualizarHora(); // Llamada inicial
</script>
@endsection
