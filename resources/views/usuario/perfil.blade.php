<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Perfil</title>
  <link href="{{ asset('css/user.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  @include('layouts.navbar')
  <div class="site-wrapper"><div class="site-content">
    @include('usuario.sidebar')
    <main class="main-content">
      <h2>Mi Perfil</h2>
      <div class="card p-3" style="max-width:600px;">
        <div class="d-flex gap-3 align-items-center">
          <div><img src="{{ asset('images/profile-placeholder.png') }}" class="rounded-circle" style="width:80px;height:80px;object-fit:cover;"></div>
          <div>
            <div class="fw-bold">{{ auth()->user()->name ?? 'Usuario' }}</div>
            <div class="text-muted small">{{ auth()->user()->email ?? 'email@ejemplo.com' }}</div>
          </div>
        </div>
        <hr>
        <a href="#" class="btn btn-primary btn-sm">Editar perfil</a>
      </div>
    </main>
  </div></div>
  @include('layouts.footer')
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>