<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SmartPark - Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
    <style>
        /* pequeños ajustes locales para esta vista */
        .hero-img {
            width: 320px;
            height: 320px;
            object-fit: cover;
            border-radius: 50%;
        }

        .section-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: #000;
        }
    </style>
</head>

<body>

    @include('layouts.navbar')

    <div class="site-wrapper">
        <div class="site-content">
            @include('usuario.sidebar')

            <main class="main-content">
                <!-- TOPBAR Y CONTENIDO (mantén aquí lo que ya tenías) -->
                <div class="main-topbar d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h2 class="mb-0">Panel de Cliente</h2>
                        <small class="text-muted">Bienvenido {{ auth()->user()->name ?? 'Usuario' }}</small>
                    </div>
                    <div class="d-flex align-items-center gap-3">
                        <button class="btn btn-outline-secondary"><i class="bi bi-bell"></i></button>
                        <div class="d-flex align-items-center">
                            <div class="me-2 text-end">
                                <div style="font-weight:600">{{ auth()->user()->name ?? 'Usuario' }}</div>
                                <div class="text-muted" style="font-size:.75rem">Cliente</div>
                            </div>
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                style="width:44px;height:44px">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Aquí va el resto de tu contenido (hero, stats, grid...) -->
            </main>
        </div> <!-- /.site-content -->
    </div> <!-- /.site-wrapper -->


    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
