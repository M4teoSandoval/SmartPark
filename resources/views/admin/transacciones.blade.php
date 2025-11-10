@extends('layouts.app')

@section('title', 'Transacciones')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">

    {{-- Sidebar del admin --}}
    @include('admin.sidebar')

    <section class="main-content">

        <h1 class="mb-4">Historial de Transacciones</h1>

        {{-- ALERTAS --}}
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

        {{-- TABLA DE TRANSACCIONES --}}
        <div class="card shadow">
            <div class="card-header bg-primary text-white fw-bold">
                Transacciones Registradas
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Placa</th>
                            <th>Tipo</th>
                            <th>Método de Pago</th>
                            <th>Valor</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($transacciones as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>{{ $t->vehiculo->placa }}</td>
                                <td>{{ ucfirst($t->tipo_transaccion) }}</td>
                                <td>{{ ucfirst($t->metodo_pago) }}</td>
                                <td>${{ number_format($t->valor, 0, ',', '.') }}</td>
                                <td>{{ $t->fecha }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No hay transacciones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- PAGINACIÓN (si quieres usarla) --}}
                @if(method_exists($transacciones, 'links'))
                    <div class="mt-3">
                        {{ $transacciones->links() }}
                    </div>
                @endif
            </div>
        </div>

    </section>
</div>
@endsection
