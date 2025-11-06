@extends('layouts.app')

@section('title', 'Panel del Administrador')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">
        @include('admin.sidebar')

        {{-- Contenido principal --}}
        <section class="main-content">
            <h1>Registrar ingreso de vehículo</h1>

            <form class="form">
                <div class="form-group">
                    <label>Placa del vehículo</label>
                    <input type="text" placeholder="Ej: ABC123">
                </div>

                <div class="form-group">
                    <label>Clase de vehículo</label>
                    <select>
                        <option>Auto</option>
                        <option>Moto</option>
                        <option>Camioneta</option>
                        <option>Bus</option>
                    </select>
                </div>

                <div class="datetime">
                    <p><strong>Hora actual:</strong> <span id="hora">{{ now()->format('h:i:s A') }}</span></p>
                    <p><strong>Fecha:</strong> <span
                            id="fecha">{{ now()->translatedFormat('l, d \\de F \\de Y') }}</span></p>
                </div>

                <button type="submit">Ingresar</button>
            </form>
        </section>
    </div>

    <script>
        function actualizarHora() {
            const ahora = new Date();
            const opcionesHora = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };
            const opcionesFecha = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            document.getElementById('hora').textContent = ahora.toLocaleTimeString('es-ES', opcionesHora);
            document.getElementById('fecha').textContent = ahora.toLocaleDateString('es-ES', opcionesFecha);
        }
        setInterval(actualizarHora, 1000);
    </script>
@endsection
