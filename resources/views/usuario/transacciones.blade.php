@extends('usuario.layout')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="mb-0">Transacciones</h4>
    <small class="text-muted">Últimas operaciones</small>
  </div>

  <div class="card p-3 mb-4">
    <table class="table table-borderless mb-0">
      <thead class="small text-muted">
        <tr>
          <th>Fecha</th>
          <th>Parqueadero</th>
          <th>Servicio</th>
          <th class="text-end">Monto</th>
        </tr>
      </thead>
      <tbody>
        {{-- Reemplaza por @forelse($transacciones as $t) --}}
        <tr>
          <td>2025-11-01 10:12</td>
          <td>Centro Smart Park</td>
          <td>Reserva 2h</td>
          <td class="text-end">$12.000</td>
        </tr>
        <tr>
          <td>2025-10-28 17:05</td>
          <td>Mall Premium Parking</td>
          <td>Estacionamiento</td>
          <td class="text-end">$8.000</td>
        </tr>
        {{-- @empty <tr><td colspan="4" class="text-center text-muted">No hay transacciones</td></tr> @endforelse --}}
      </tbody>
    </table>
  </div>
@endsection