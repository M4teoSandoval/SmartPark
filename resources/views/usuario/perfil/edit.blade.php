@extends('layouts.app')

@section('title', 'Editar Perfil')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <style>
        /* Card del formulario */
        .edit-profile-card {
            background: #fff;
            border-radius: 15px;
            padding: 30px 25px;
            max-width: 600px;
            margin: 0 auto;
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .edit-profile-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
        }

        /* Campos de entrada */
        .edit-profile-card .form-control {
            border-radius: 50px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .edit-profile-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13,110,253,0.25);
            border-color: #0d6efd;
        }

        /* Select tipo documento */
        .edit-profile-card select.form-control {
            height: 50px;
        }

        /* Botón actualizar */
        .btn-update-profile {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: #fff !important;
            border: none;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .btn-update-profile:hover {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
            transform: translateY(-2px);
        }

        /* Encabezado */
        .main-content h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 30px;
            color: #0d6efd;
            text-align: center;
        }

        /* Campos tipo documento y número alineados */
        .doc-fields {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
        }

        .doc-fields .form-group {
            flex: 1;
        }

        @media (max-width: 576px) {
            .doc-fields {
                flex-direction: column;
            }
        }
    </style>
@endpush

@section('content')
<div class="dashboard-container">
    @include('usuario.sidebar')

    <section class="main-content">
        <h1>Editar Perfil</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="edit-profile-card">
            <form method="POST" action="{{ route('usuario.perfil.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="fw-semibold">Nombre</label>
                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control" required>
                </div>

                <div class="doc-fields mb-3">
                    <div class="form-group">
                        <label class="fw-semibold">Número de documento</label>
                        <select name="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror" required>
                            <option value="" disabled>Tipo de documento</option>
                            <option value="CC" {{ auth()->user()->tipo_documento == 'CC' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                            <option value="TI" {{ auth()->user()->tipo_documento == 'TI' ? 'selected' : '' }}>Tarjeta de identidad</option>
                            <option value="CE" {{ auth()->user()->tipo_documento == 'CE' ? 'selected' : '' }}>Cédula de extranjería</option>
                            <option value="PAS" {{ auth()->user()->tipo_documento == 'PAS' ? 'selected' : '' }}>Pasaporte</option>
                        </select>
                        @error('tipo_documento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="fw-semibold">Número de documento</label>
                        <input type="number" name="numero_documento" value="{{ auth()->user()->numero_documento }}" class="form-control" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Teléfono</label>
                    <input type="text" name="telefono" value="{{ auth()->user()->telefono }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="fw-semibold">Foto de perfil</label>
                    <input type="file" name="imagen" class="form-control">
                    @if (auth()->user()->imagen)
                        <small class="text-muted">Ya tienes una foto subida.</small>
                    @endif
                </div>

                <button class="btn btn-update-profile w-100">Actualizar Perfil</button>
            </form>
        </div>
    </section>
</div>
@endsection
