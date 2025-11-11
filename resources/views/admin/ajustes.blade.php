@extends('layouts.app')

@section('title', 'Configuración del Parqueadero')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

    <div class="dashboard-container">

        @include('admin.sidebar')

        <section class="main-content">

            <h1 class="mb-4">Configuración del Parqueadero</h1>

            {{-- ✅ Alertas --}}
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            {{-- ✅ Si NO existe parqueadero -> formulario para crear --}}
            @if (is_null($parqueadero))
                <div class="card shadow mb-4">
                    <div class="card-header bg-success text-white fw-bold">
                        Registrar Parqueadero
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.parqueadero.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label class="fw-semibold">Nombre</label>
                                <input type="text" name="nombre" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Dirección</label>
                                <input type="text" name="direccion" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Ciudad</label>
                                <input type="text" name="ciudad" class="form-control" required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-semibold">Capacidad Carros</label>
                                    <input type="number" name="capacidad_carros" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold">Capacidad Motos</label>
                                    <input type="number" name="capacidad_motos" class="form-control" required>
                                </div>
                            </div>

                            <button class="btn btn-success w-100">Guardar</button>
                        </form>
                    </div>
                </div>
            @else
                {{-- ✅ Existe parqueadero: formulario editar --}}
                <div class="card shadow">
                    <div class="card-header bg-primary text-white fw-bold">
                        Parqueadero Registrado
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.parqueadero.update', $parqueadero->id) }} "
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="fw-semibold">Nombre</label>
                                <input type="text" name="nombre" value="{{ $parqueadero->nombre }}" class="form-control"
                                    required>
                            </div>

                            <div class="mb-3">
                                {{-- Mostrar imagen actual si existe --}}
                                @if ($parqueadero->imagen)
                                    <label class="fw-semibold" for="imagen">Foto actual parqueadero</label>
                                    <div class="mb-2">

                                        <img src="{{ asset('storage/' . $parqueadero->imagen) }}" alt="Imagen actual"
                                            style="width: 150px; height: 100px; object-fit: cover; border-radius: 5px;">
                                    </div>
                                @endif
                                <label class="fw-semibold" for="imagen">Subir foto del parqueadero</label>
                                <input type="file" name="imagen" id="imagen" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Dirección</label>
                                <input type="text" name="direccion" value="{{ $parqueadero->direccion }}"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="fw-semibold">Ciudad</label>
                                <input type="text" name="ciudad" value="{{ $parqueadero->ciudad }}" class="form-control"
                                    required>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="fw-semibold">Capacidad Carros</label>
                                    <input type="number" name="capacidad_carros"
                                        value="{{ $parqueadero->capacidad_carros }}" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-semibold">Capacidad Motos</label>
                                    <input type="number" name="capacidad_motos"
                                        value="{{ $parqueadero->capacidad_motos }}" class="form-control" required>
                                </div>
                            </div>

                            <button class="btn btn-primary w-100">Actualizar</button>
                        </form>
                    </div>
                </div>
            @endif

        </section>

    </div>

@endsection
