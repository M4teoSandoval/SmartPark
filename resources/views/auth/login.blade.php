@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="row w-75 bg-white shadow rounded p-5 align-items-center">
        
        <!-- Lado izquierdo: logo / marca -->
        <div class="col-md-6 text-center border-end">
            <img src="{{ asset('images/logo.png') }}" alt="SmartPark Logo" class="img-fluid mb-3" style="max-width: 220px;">
            <h2 class="text-primary fw-bold" style="color: #1D457D;">Smart<span class="text-success" style="color: #2CA6D0;">Park</span></h2>
        </div>

        <!-- Lado derecho: formulario -->
        <div class="col-md-6">
            <h3 class="fw-bold mb-4" style="color:#76b82a;">Iniciar sesión</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                        class="form-control rounded-pill p-3 @error('email') is-invalid @enderror"
                        placeholder="Correo electrónico" required autofocus>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <input id="password" type="password" name="password"
                        class="form-control rounded-pill p-3 @error('password') is-invalid @enderror"
                        placeholder="Contraseña" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember">
                            Recordarme
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-muted">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-success w-100 rounded-pill fw-bold py-2">
                    Continuar
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
