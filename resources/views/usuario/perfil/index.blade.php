@extends('layouts.app')

@section('title', 'Mi Perfil')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/user.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('usuario.sidebar')

    <section class="main-content">
        <h1>Mi Perfil</h1>

        {{-- Tarjeta de perfil --}}
        <div class="profile-card text-center">
            @if(auth()->user()->imagen)
                <img src="{{ asset('storage/' . auth()->user()->imagen) }}" alt="Foto de perfil" class="hero-img mb-3">
            @else
                <img src="{{ asset('images/default_user.png') }}" alt="Foto de perfil" class="hero-img mb-3">
            @endif

            <h3>{{ auth()->user()->name }}</h3>
            <p class="text-muted mb-1">Email: {{ auth()->user()->email }}</p>
            <p class="text-muted mb-1">{{ auth()->user()-> tipo_documento }} : {{ auth()->user()->numero_documento }}</p>
            @if(auth()->user()->telefono)
                <p class="text-muted mb-2">Teléfono: {{ auth()->user()->telefono }}</p>
            @endif

            <a href="{{ route('usuario.perfil.edit') }}" class="btn btn-edit-profile mt-3">Editar Perfil</a>
        </div>

        
    </section>
</div>
@endsection
