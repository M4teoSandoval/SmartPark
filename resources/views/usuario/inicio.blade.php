// ...existing code...
@extends('usuario.layout')

@section('content')
  {{-- Encabezado simple --}}
  <div class="mb-4">
    <h1 class="welcome-title">Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</h1>
    <p class="text-muted">Aquí encontrarás tus noticias, resumen y estado de suscripción.</p>
  </div>

  <div class="row g-4">
    <!-- Columna izquierda: Resumen de uso + Suscripción -->
    <div class="col-lg-4">
      <div class="card summary-card mb-3 p-3">
        <div class="d-flex align-items-center mb-2">
          <i class="bi bi-bar-chart-line me-2 fs-4"></i>
          <div>
            <div class="fw-bold">Resumen de Uso</div>
            <small class="text-muted">Este mes</small>
          </div>
        </div>

        <div class="row g-2 mt-3">
          <div class="col-6">
            <div class="p-3 bg-light rounded text-center">
              <small class="text-muted d-block">Días usados</small>
              <div class="fs-4 fw-bold">18</div>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 bg-light rounded text-center">
              <small class="text-muted d-block">Horas totales</small>
              <div class="fs-4 fw-bold">72</div>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 bg-light rounded text-center">
              <small class="text-muted d-block">Reservas</small>
              <div class="fs-4 fw-bold">24</div>
            </div>
          </div>
          <div class="col-6">
            <div class="p-3 bg-light rounded text-center">
              <small class="text-muted d-block">Promedio/día</small>
              <div class="fs-4 fw-bold">$12.5K</div>
            </div>
          </div>
        </div>
      </div>

      <div class="card subscription-card p-3">
        <div class="d-flex align-items-center mb-2">
          <i class="bi bi-wallet2 me-2 fs-4"></i>
          <div>
            <div class="fw-bold">Mi Suscripción</div>
            <small class="text-muted">Parqueadero</small>
          </div>
        </div>

        <div class="mt-2">
          <div class="fw-bold">Parqueadero Centro</div>
          <div class="fw-bold text-success fs-4">$150.000</div>
        </div>

        <div class="mt-3 p-2 bg-light rounded">
          <small class="text-muted">Días restantes</small>
          <div class="fw-bold">15 días</div>
        </div>

        <div class="mt-3">
          <div class="alert alert-danger p-2 mb-0">Renovación próxima — Tu suscripción se renovará en 15 días</div>
        </div>
      </div>
    </div>

    <!-- Columna derecha: Noticias / Avisos -->
    <div class="col-lg-8">
      <div class="row g-3">
        <!-- Card noticia grande -->
        <div class="col-12">
          <div class="card news-card p-3 d-flex gap-3 align-items-center">
            <img src="{{ asset('images/traffic.jpg') }}" alt="Pico y placa" class="news-img rounded">
            <div>
              <div class="d-flex justify-content-between align-items-start">
                <div>
                  <h5 class="mb-1">Aviso: Pico y placa — {{ now()->format('F Y') }}</h5>
                  <p class="mb-1 text-muted">Estimado cliente: El pico y placa para este mes aplica a placas terminadas en 1-2 los días lunes y martes. Revisa horarios y evita multas.</p>
                </div>
                <div class="text-end">
                  <span class="badge bg-warning text-dark">Importante</span>
                </div>
              </div>
              <a href="#" class="small">Ver detalles</a>
            </div>
          </div>
        </div>

        <!-- Otras noticias en cards -->
        <div class="col-md-6">
          <div class="card news-card p-3">
            <div class="d-flex gap-3">
              <img src="{{ asset('images/news-placeholder.jpg') }}" alt="noticia" class="news-img-sm rounded">
              <div>
                <div class="fw-semibold">Mantenimiento programado</div>
                <div class="text-muted small">Se realizará mantenimiento en el parqueadero Norte el próximo viernes.</div>
                <a href="#" class="small">Leer más</a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card news-card p-3">
            <div class="d-flex gap-3">
              <img src="{{ asset('images/news-placeholder.jpg') }}" alt="noticia" class="news-img-sm rounded">
              <div>
                <div class="fw-semibold">Promoción del mes</div>
                <div class="text-muted small">20% de descuento en parqueaderos seleccionados los fines de semana.</div>
                <a href="#" class="small">Ver condiciones</a>
              </div>
            </div>
          </div>
        </div>

        <!-- espacio para más noticias -->
      </div>
    </div>
  </div>
@endsection
// ...existing code...