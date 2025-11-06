@extends('layouts.app')

@section('title', 'Salidas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="dashboard-container">
    @include('admin.sidebar')

    <section class="main-content">
        <h1>Usuarios</h1>
    </section>
</div>
@endsection
