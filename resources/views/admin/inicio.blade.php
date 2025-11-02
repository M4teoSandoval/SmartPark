@extends('layouts.app')

@section('title', 'Inicio Admin')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1>Bienvenido al Panel de Administración</h1>
        <p>Aquí podrás gestionar todas las secciones del parqueadero.</p>
    </section>
</div>
@endsection
