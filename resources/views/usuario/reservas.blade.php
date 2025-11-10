@extends('usuario.layout')

@section('content')
  {{-- Resumen en 4 cards --}}
  <div class="row g-3 mb-4">
    <div class="col-sm-6 col-md-3">
      <div class="card p-3 text-center">
        <small class="text-muted">Días usados</small>
        <div class="fs-4 fw-bold">18</div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card p-3 text-center">
        <small class="text-muted">Horas totales</small>
        <div class="fs-4 fw-bold">72</div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card p-3 text-center">
        <small class="text-muted">Reservas</small>
        <div class="fs-4 fw-bold">24</div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card p-3 text-center">
        <small class="text-muted">Promedio/día</small>
        <div class="fs-4 fw-bold">$12.5K</div>
      </div>
    </div>
  </div>

  {{-- Reservas activas --}}
  <div class="card mb-4 p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h5 class="mb-0">Reservas activas</h5>
      <small class="text-muted">2 en curso</small>
    </div>

    <div class="list-group">
      {{-- Reemplaza por @foreach($reservasActivas as $res) --}}
      <div class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <div class="fw-bold">Centro Smart Park</div>
          <div class="text-muted small">Calle Principal 123 — 12 Nov 2025, 10:00 - 12:00</div>
        </div>
        <div class="text-end">
          <span class="badge bg-success mb-2">Activa</span>
          <div><a href="#" class="btn btn-sm btn-outline-primary">Ver</a></div>
        </div>
      </div>

      <div class="list-group-item d-flex justify-content-between align-items-start">
        <div>
          <div class="fw-bold">Mall Premium Parking</div>
          <div class="text-muted small">Centro Comercial 456 — 14 Nov 2025, 08:00 - 09:30</div>
        </div>
        <div class="text-end">
          <span class="badge bg-success mb-2">Activa</span>
          <div><a href="#" class="btn btn-sm btn-outline-primary">Ver</a></div>
        </div>
      </div>
      {{-- /foreach --}}
    </div>
  </div>

  {{-- Historial --}}
  <div class="card p-3">
    <div class="d-flex justify-content-between align-items-center mb-2">
      <h5 class="mb-0">Historial</h5>
      <small class="text-muted">Últimos 6</small>
    </div>

    <div class="accordion" id="historialAccordion">
      {{-- Reemplaza por @foreach($historial as $h) --}}
      <div class="accordion-item">
        <h2 class="accordion-header" id="hOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
            Centro Smart Park — 02 Nov 2025
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="hOne" data-bs-parent="#historialAccordion">
          <div class="accordion-body">
            Horario: 09:00 - 10:30 · Precio: $12.000 · Estado: Completada
            <div class="mt-2"><a href="#" class="btn btn-sm btn-outline-secondary">Ver factura</a></div>
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header" id="hTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
            Mall Premium Parking — 28 Oct 2025
          </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="hTwo" data-bs-parent="#historialAccordion">
          <div class="accordion-body">
            Horario: 17:00 - 18:00 · Precio: $8.000 · Estado: Completada
            <div class="mt-2"><a href="#" class="btn btn-sm btn-outline-secondary">Ver factura</a></div>
          </div>
        </div>
      </div>
      {{-- /foreach --}}
    </div>
  </div>
@endsection