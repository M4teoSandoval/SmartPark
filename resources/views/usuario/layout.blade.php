<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>SmartPark - Usuario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/user.css') }}" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    @include('layouts.navbar')

    <!-- Wrapper principal -->
    <div class="d-flex flex-column min-vh-100">

        <!-- Contenedor sidebar + main -->
        <div class="d-flex flex-grow-1">
            <!-- Sidebar -->
            @includeIf('usuario.sidebar')

            <!-- Contenido principal -->
            <main class="main-content">
                @yield('content')
            </main>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>