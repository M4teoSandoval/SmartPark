<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Parqueaderos</title>
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    @include('layouts.navbar')
    <div class="site-wrapper">
        <div class="site-content">
            @include('usuario.sidebar')
            <main class="main-content">
                <h2>Parqueaderos</h2>
                <p class="text-muted">Explora los parqueaderos disponibles.</p>

                <div class="parking-grid">
                    <div class="parking-card">
                        <img src="{{ asset('images/parking1.jpg') }}" alt="">
                        <div class="card-body">
                            <h5>Centro Smart Park</h5>
                            <p class="text-muted">Calle Principal 123</p>
                            <div class="d-flex justify-content-between">
                                <div><i class="bi bi-star-fill text-warning"></i> 4.8</div>
                                <a href="#" class="btn btn-sm btn-primary">Reservar</a>
                            </div>
                        </div>
                    </div>
                    <!-- más cards -->
                </div>
            </main>
        </div>
        @include('layouts.footer')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
