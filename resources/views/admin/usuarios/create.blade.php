@extends('layouts.app')

@section('title', 'Agregar Usuario')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-container">

    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Registrar Usuario</h1>

        <form method="POST" action="{{ route('admin.usuarios.store') }}">
            @csrf

            <div class="mb-3">
                <label>Nombre completo</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Tipo documento</label>
                <select name="tipo_documento" class="form-control">
                    <option value="CC">CC</option>
                    <option value="CE">CE</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Número documento</label>
                <input type="text" name="numero_documento" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button class="btn btn-primary w-100">Guardar Usuario</button>
        </form>

    </section>

</div>

@endsection
