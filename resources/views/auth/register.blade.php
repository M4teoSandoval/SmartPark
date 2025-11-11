@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="row w-75 bg-white shadow rounded p-5 align-items-center">

            <!-- Lado izquierdo: logo / marca -->
            <div class="col-md-6 text-center border-end">
                <img src="{{ asset('images/logo.png') }}" alt="SmartPark Logo" class="img-fluid mb-3 d-block mx-auto"
                    style="max-width: 180px; width: 100%; height: auto;">

                <h2 class="text-primary fw-bold" style="color: #1D457D;">
                    Smart<span class="text-success" style="color: #2CA6D0;">Park</span>
                </h2>
            </div>

            <!-- Lado derecho: formulario -->
            <div class="col-md-6">
                <h3 class="fw-bold mb-4" style="color:#76b82a;">Registrarse</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Nombre -->
                    <div class="mb-3">
                        <input id="name" type="text"
                            class="form-control rounded-pill p-3 @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" required autofocus placeholder="Nombre completo">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Correo -->
                    <div class="mb-3">
                        <input id="email" type="email"
                            class="form-control rounded-pill p-3 @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required placeholder="Correo electrónico">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Tipo de documento -->
                    <div class="mb-3">
                        <select name="tipo_documento"
                            class="form-control rounded-pill p-3 @error('tipo_documento') is-invalid @enderror" required>
                            <option value="" disabled selected>Tipo de documento</option>
                            <option value="CC">Cédula de ciudadanía</option>
                            <option value="TI">Tarjeta de identidad</option>
                            <option value="CE">Cédula de extranjería</option>
                            <option value="PAS">Pasaporte</option>
                        </select>
                        @error('tipo_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Número de documento -->
                    <div class="mb-3">
                        <input id="numero_documento" type="text"
                            class="form-control rounded-pill p-3 @error('numero_documento') is-invalid @enderror"
                            name="numero_documento" value="{{ old('numero_documento') }}" required
                            placeholder="Número de documento">
                        @error('numero_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Teléfono -->
                    <div class="mb-3">
                        <input id="telefono" type="text"
                            class="form-control rounded-pill p-3 @error('telefono') is-invalid @enderror" name="telefono"
                            value="{{ old('telefono') }}" required placeholder="Teléfono">
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Contraseña -->
                    <div class="mb-3">
                        <input id="password" type="password"
                            class="form-control rounded-pill p-3 @error('password') is-invalid @enderror" name="password"
                            required placeholder="Contraseña">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirmar contraseña -->
                    <div class="mb-4">
                        <input id="password-confirm" type="password" class="form-control rounded-pill p-3"
                            name="password_confirmation" required placeholder="Confirmar contraseña">
                    </div>

                    <!-- Botón -->
                    <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2">
                        Continuar
                    </button>
                </form>

                <div class="text-center mt-3">
                    <small>¿Ya tienes una cuenta?
                        <a href="{{ route('login') }}" class="text-success fw-semibold text-decoration-none">
                            Inicia sesión
                        </a>
                    </small>
                </div>
            </div>
        </div>
    </div>
@endsection
