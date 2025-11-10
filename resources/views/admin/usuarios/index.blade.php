@extends('layouts.app')

@section('title', 'Usuarios')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')

<div class="dashboard-container">

    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Usuarios del Parqueadero</h1>

        <a href="{{ route('admin.usuarios.create') }}" class="btn btn-success mb-3">Agregar Usuario</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Documento</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $u)
                <tr>
                    <td>{{ $u->name }}</td>
                    <td>{{ $u->email }}</td>
                    <td>{{ $u->tipo_documento }} {{ $u->numero_documento }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center">No hay usuarios relacionados a tu parqueadero.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    </section>

</div>

@endsection
