@extends('usuario.layout')

@section('content')
<h2>Agregar Vehículo</h2>

@if($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
    </div>
@endif

<form action="{{ route('usuario.vehiculos.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Placa</label>
        <input type="text" name="placa" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Tipo</label>
        <select name="tipo_vehiculo" class="form-control" required>
            <option value="carro">Carro</option>
            <option value="moto">Moto</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@endsection
