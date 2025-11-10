@extends('layouts.app')

@section('title', 'Movimientos')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
    <div class="dashboard-container">

        {{-- Sidebar del admin --}}
        @include('admin.sidebar')

        <section class="main-content">

            <h1 class="mb-4">Control de Movimientos</h1>

            {{-- ALERTAS DE ÉXITO Y ERROR --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif


            {{-- MOSTRAR FECHA Y HORA --}}
            <div class="alert alert-info d-flex justify-content-between">
                <span><strong>Hora actual:</strong> <span id="hora"></span></span>
                <span><strong>Fecha:</strong> <span id="fecha"></span></span>
            </div>

            {{-- ============================= --}}
            {{-- REGISTRAR ENTRADA --}}
            {{-- ============================= --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-success text-white fw-bold">
                    Registrar Entrada de Vehículo
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.movimientos.entrada') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="fw-semibold">Placa del vehículo</label>
                                <input type="text" name="placa"
                                    class="form-control @error('placa') is-invalid @enderror" placeholder="Ej: ABC123"
                                    required>
                                @error('placa')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="fw-semibold">Tipo de vehículo</label>
                                <select name="tipo_vehiculo"
                                    class="form-control @error('tipo_vehiculo') is-invalid @enderror" required>
                                    <option disabled selected>Seleccionar...</option>
                                    <option value="carro">Carro</option>
                                    <option value="moto">Moto</option>
                                </select>
                                @error('tipo_vehiculo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <button class="btn btn-success w-100 fw-bold">Registrar Entrada</button>
                    </form>

                </div>
            </div>

            {{-- LISTA DE ENTRADAS RECIENTES --}}
            <h4 class="fw-bold mt-4">Vehículos que han ingresado hoy</h4>

            <table class="table table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($entradas as $e)
                        <tr>
                            <td>{{ $e->vehiculo->placa }}</td>
                            <td>{{ ucfirst($e->vehiculo->tipo_vehiculo) }}</td>
                            <td>{{ $e->fecha_hora }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Sin registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <hr class="my-5">

            {{-- ============================= --}}
            {{-- REGISTRAR SALIDA --}}
            {{-- ============================= --}}
            <div class="card shadow mb-4">
                <div class="card-header bg-custom-salida text-white fw-bold">
                    Registrar Salida de Vehículo
                </div>
                <div class="card-body">

                    <form method="POST" action="{{ route('admin.movimientos.salida') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="fw-semibold">Placa del vehículo</label>
                            <input type="text" name="placa" id="placaSalida"
                                class="form-control @error('placa') is-invalid @enderror" placeholder="Ej: ABC123" required
                                onkeyup="verificarMensualidad()">

                            @error('placa')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- ✅ MENSAJE SI TIENE MENSUALIDAD --}}
                        <div id="mensualidadActiva" class="alert alert-info fw-bold d-none">
                            Este vehículo tiene mensualidad activa. No se realizará cobro.
                        </div>

                        {{-- ✅ MÉTODO DE PAGO (se oculta si tiene mensualidad) --}}
                        <div class="mb-3" id="metodoPagoBox">
                            <label class="fw-semibold">Método de pago</label>
                            <select name="metodo_pago" id="metodo_pago"
                                class="form-control @error('metodo_pago') is-invalid @enderror">
                                <option disabled selected>Seleccionar...</option>
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="nequi">Nequi</option>
                                <option value="daviplata">Daviplata</option>
                            </select>

                            @error('metodo_pago')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <button class="btn btn-custom-salida w-100 fw-bold">Registrar Salida</button>
                    </form>

                </div>
            </div>

            {{-- SCRIPT AJAX PARA DETECTAR MENSUALIDAD --}}
            <script>
                function verificarMensualidad() {
                    let placa = document.getElementById('placaSalida').value.trim();

                    if (placa.length < 3) return;

                    fetch('/api/verificar-mensualidad/' + placa)
                        .then(response => response.json())
                        .then(data => {

                            const msg = document.getElementById('mensualidadActiva');
                            const metodo = document.getElementById('metodoPagoBox');
                            const metodoSelect = document.getElementById('metodo_pago');

                            if (data.activa === true) {
                                msg.classList.remove('d-none');
                                metodo.classList.add('d-none');
                                metodoSelect.removeAttribute('required');
                            } else {
                                msg.classList.add('d-none');
                                metodo.classList.remove('d-none');
                                metodoSelect.setAttribute('required', 'required');
                            }
                        });
                }
            </script>



            {{-- LISTA DE SALIDAS --}}
            <h4 class="fw-bold mt-4">Vehículos que han salido hoy</h4>

            <table class="table table-striped table-bordered mt-3 mb-5">
                <thead class="table-dark">
                    <tr>
                        <th>Placa</th>
                        <th>Tipo</th>
                        <th>Fecha y Hora</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($salidas as $s)
                        <tr>
                            <td>{{ $s->vehiculo->placa }}</td>
                            <td>{{ ucfirst($s->vehiculo->tipo_vehiculo) }}</td>
                            <td>{{ $s->fecha_hora }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Sin registros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </section>
    </div>

    {{-- SCRIPT PARA HORA Y FECHA --}}
    <script>
        function actualizarHora() {
            const ahora = new Date();
            document.getElementById('hora').textContent = ahora.toLocaleTimeString('es-ES');
            document.getElementById('fecha').textContent = ahora.toLocaleDateString('es-ES');
        }
        setInterval(actualizarHora, 1000);
        actualizarHora();
    </script>
@endsection
