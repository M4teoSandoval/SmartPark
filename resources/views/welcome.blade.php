<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartPark</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet"> <!-- hoja de estilos personalizada -->
</head>

<body>

    <!-- 🌐 Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm py-3 fixed-top">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Logo + nombre -->
            <a class="navbar-brand d-flex align-items-center" href="#">
                <img src="{{ asset('images/logo.png') }}" alt="SmartPark" width="40" class="me-2">
                <span class="fw-bold text-primary">Smart<span class="text-success">Park</span></span>
            </a>

            <!-- Enlaces centrados -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item mx-2"><a class="nav-link" href="#caracteristicas">Características</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#funciona">Cómo Funciona</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#planes">Planes</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#acerca">Acerca de</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="#contacto">Contacto</a></li>
                </ul>
            </div>

            <!-- Botones a la derecha -->
            <div class="d-flex">
                <a href="{{ route('login') }}" class="btn btn-success me-2">Ingresar</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Registrarse</a>
            </div>
        </div>
    </nav>

    <!-- 🏠 Sección principal -->
    <section class="hero d-flex align-items-center" id="inicio">
        <div class="container text-center text-md-start">
            <div class="row align-items-center">
                <div class="col-md-6 mt-5">
                    <h1 class="fw-bold text-primary fade-in">Encuentra y gestiona tu parqueadero <span
                            class="text-success">fácilmente</span>.</h1>
                    <p class="lead mt-3 text-secondary fade-in-delay">Reserva tu lugar en segundos con SmartPark, tu
                        aliado de parqueo en Bucaramanga.</p>
                    <div class="mt-4">
                        <a href="#contacto" class="btn btn-outline-success px-4">Contáctanos</a>
                    </div>
                </div>
                <div class="col-md-6 text-center mt-4">
                    <img src="{{ asset('images/home1.png') }}" alt="SmartPark" class="img-fluid slide-in-right w-75">
                </div>
            </div>
        </div>
    </section>

    <!-- 🌟 Sección: Diseñado para todos -->
    <section class="py-5 bg-light-gray" id="caracteristicas">
        <div class="container text-center">
            <h2 class="fw-bold mb-3 fade-in">Diseñado para todos</h2>
            <p class="text-muted mb-5 fade-in-delay">
                Ya seas conductor o administrador de parqueadero, tenemos la solución perfecta para ti.
            </p>

            <div class="row g-4">
                <!-- Card 1 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4 text-start">
                        <div class="icon-box mb-3 bg-light-blue">
                            <i class="bi bi-person fs-3 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Para Conductores</h5>
                        <p class="text-muted">Reserva espacios con anticipación, cancela sin penalización y controla tu
                            mensualidad desde una app sencilla.</p>
                        <ul class="list-unstyled text-success">
                            <li><i class="bi bi-check-circle-fill me-2"></i>Reservas sin estrés</li>
                            <li><i class="bi bi-check-circle-fill me-2"></i>Cancelación flexible</li>
                        </ul>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4 text-start border-success-subtle">
                        <div class="icon-box mb-3 bg-light-green">
                            <i class="bi bi-bar-chart-line fs-3 text-success"></i>
                        </div>
                        <h5 class="fw-bold">Para Administradores</h5>
                        <p class="text-muted">Gestiona automáticamente tus espacios, genera reportes en tiempo real y
                            controla ocupación y pagos fácilmente.</p>
                        <ul class="list-unstyled text-success">
                            <li><i class="bi bi-check-circle-fill me-2"></i>Panel de control</li>
                            <li><i class="bi bi-check-circle-fill me-2"></i>Reportes automáticos</li>
                            <li><i class="bi bi-check-circle-fill me-2"></i>Gestión de ocupación</li>
                        </ul>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="col-md-4">
                    <div class="card feature-card h-100 p-4 text-start">
                        <div class="icon-box mb-3 bg-light-blue">
                            <i class="bi bi-shield-lock fs-3 text-primary"></i>
                        </div>
                        <h5 class="fw-bold">Seguridad y Confianza</h5>
                        <p class="text-muted">Transacciones seguras, soporte 24/7 y un sistema de alertas que te
                            notifica de cualquier inconsistencia.</p>
                        <ul class="list-unstyled text-success">
                            <li><i class="bi bi-check-circle-fill me-2"></i>Pagos verificados</li>
                            <li><i class="bi bi-check-circle-fill me-2"></i>Soporte continuo</li>
                            <li><i class="bi bi-check-circle-fill me-2"></i>Alertas en tiempo real</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 🧩 Sección Características -->
    <section class="py-5" style="background-color: #f5f5f5;" id="caracteristicas">
        <div class="container text-center">
            <h2 class="fw-bold mb-4 text-primary">Características</h2>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-3 h-100 hover-up">
                        <h5 class="text-success">Ubicación GPS</h5>
                        <p>Encuentra los parqueaderos más cercanos según tu ubicación.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-3 h-100 hover-up">
                        <h5 class="text-success">Reserva en segundos</h5>
                        <p>Haz tu reserva rápida y evita perder tiempo buscando espacio.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card border-0 shadow-sm p-3 h-100 hover-up">
                        <h5 class="text-success">Pagos seguros</h5>
                        <p>Paga de manera rápida y protegida con tus métodos favoritos.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- 🚗 Sección: Cómo resolvemos el problema -->
<section class="py-5 bg-light-gray" id="comparacion">
  <div class="container">
    <h2 class="text-center fw-bold mb-4">Cómo resolvemos el problema</h2>
    <p class="text-center text-secondary mb-5">Comparación: métodos tradicionales vs SmartPark</p>

    <div class="comparison-table">
      <div class="row header">
        <div class="col-4 fw-bold text-dark">Características</div>
        <div class="col-4 fw-bold text-muted">Método Tradicional</div>
        <div class="col-4 fw-bold text-primary">SmartPark</div>
      </div>

      <hr class="row-divider">

      <!-- Fila 1 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Reserva de espacios</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 2 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Control de ocupación</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 3 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Sistema de pagos integrado</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 4 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Gestión de mensualidades</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 5 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Reportes automáticos</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 6 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Notificaciones en tiempo real</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 7 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Múltiples entradas/salidas</div>
        <div class="col-4 text-success fs-5">✔</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
      <hr class="row-divider">

      <!-- Fila 8 -->
      <div class="row align-items-center py-2">
        <div class="col-4 fw-semibold">Acceso desde app móvil</div>
        <div class="col-4 text-danger fs-5">✖</div>
        <div class="col-4 text-success fs-5">✔</div>
      </div>
    </div>
  </div>
</section>

<section class="py-5" style="background-color: #f5f5f5;">
  <div class="container text-center">
    <h2 class="fw-bold mb-3 text-primary">Planes para todos</h2>
    <p class="text-secondary mb-5">Elige el plan que se adapte a tus necesidades, ya sea como conductor o administrador de estacionamientos</p>

    <div class="row justify-content-center">
      <!-- Card Conductores -->
      <div class="col-md-5 mb-4">
        <div class="card border-primary shadow-sm h-100 position-relative">
          <div class="card-body">
            <h4 class="fw-bold text-primary mb-2">Para Conductores</h4>
            <p class="text-muted mb-3">Encuentra y reserva estacionamientos fácilmente</p>
            <h3 class="fw-bold mb-0 text-dark">Gratis</h3>
            <p class="text-muted">Comienza sin costo</p>
            <ul class="list-unstyled text-start mt-3">
              <li><span class="text-success me-2 fw-bold">✔</span>Buscar estacionamientos disponibles</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Reservar con anticipación</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Navegar hasta tu estacionamiento</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Reseñas y calificaciones</li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Card Administradores -->
      <div class="col-md-5 mb-4">
        <div class="card border-primary shadow-sm h-100 position-relative">
          <!-- Etiqueta “Más Popular” -->
          <div class="position-absolute top-0 end-0 m-2 px-3 py-1 bg-primary text-white rounded-pill small fw-semibold shadow-sm">
            Más Popular
          </div>

          <div class="card-body">
            <h4 class="fw-bold text-primary mb-2">Para Administradores</h4>
            <p class="text-muted mb-3">Gestiona y monetiza tus espacios</p>
            <h3 class="fw-bold mb-0 text-dark">$9.99</h3>
            <p class="text-muted">por mes</p>
            <ul class="list-unstyled text-start mt-3">
              <li><span class="text-success me-2 fw-bold">✔</span>Panel de control completo</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Gestión de disponibilidad</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Reportes e ingresos en tiempo real</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Soporte prioritario</li>
              <li><span class="text-success me-2 fw-bold">✔</span>Comisión reducida (5%)</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- 🚗 Sección: Acerca de -->
<section class="py-5" style="background-color: #f8f9fa;">
  <div class="container text-center">

    <!-- Título principal -->
    <h2 class="fw-bold mb-3" style="color: #28a745;">Acerca de SmartPark</h2>
    <p class="text-secondary mb-4">Con la misión de resolver un problema que afecta a millones de personas todos los días</p>

    <!-- Descripción -->
    <p class="text-dark mb-5 px-md-5">
      En 2025, nuestro equipo se dio cuenta de que buscar estacionamiento era uno de los mayores dolores de cabeza de los conductores urbanos. 
      Pasamos horas investigando y hablando con cientos de personas para entender realmente el problema. 
      <br><br>
      Entonces decidimos crear <span class="fw-bold text-success">SmartPark</span>: una plataforma que conecta a conductores desesperados con espacios de estacionamiento disponibles, mientras ayuda a los administradores de estacionamientos a monetizar sus espacios vacíos.
    </p>

    <!-- Cards de Misión y Visión -->
    <div class="row justify-content-center mb-5">
      <!-- Misión -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0 h-100 p-4">
          <div class="text-success fs-1 mb-3">
            <i class="bi bi-lightbulb-fill"></i>
          </div>
          <h4 class="fw-bold text-success">Nuestra Misión</h4>
          <p class="text-secondary mt-2">
            Hacer que encontrar estacionamiento sea fácil, rápido y accesible para todos.
          </p>
        </div>
      </div>

      <!-- Visión -->
      <div class="col-md-5 mb-4">
        <div class="card shadow-sm border-0 h-100 p-4">
          <div class="text-success fs-1 mb-3">
            <i class="bi bi-eye-fill"></i>
          </div>
          <h4 class="fw-bold text-success">Nuestra Visión</h4>
          <p class="text-secondary mt-2">
            Transformar las ciudades con inteligencia en estacionamiento.
          </p>
        </div>
      </div>
    </div>

    <!-- Nuestro Equipo -->
    <div class="card shadow-sm border-0 p-4 mx-auto" style="max-width: 900px;">
      <div class="text-success fs-1 mb-3">
        <i class="bi bi-people-fill"></i>
      </div>
      <h4 class="fw-bold text-success mb-4">Nuestro Equipo</h4>

      <div class="row justify-content-center">
        <!-- Miembro 1 -->
        <div class="col-md-4 mb-4">
          <div class="text-center">
            <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Wilson Suarez">
            <h5 class="fw-bold mb-1">Wilson Suarez</h5>
            <p class="text-primary mb-1">Co-Fundador & Desarrollador</p>
            <p class="text-muted small">
              Apasionado por la innovación tecnológica y la mejora urbana.
            </p>
          </div>
        </div>

        <!-- Miembro 2 -->
        <div class="col-md-4 mb-4">
          <div class="text-center">
            <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Mateo Sandoval">
            <h5 class="fw-bold mb-1">Mateo Sandoval</h5>
            <p class="text-primary mb-1">Co-Fundador & Diseñador UX/UI</p>
            <p class="text-muted small">
              Enfocado en crear experiencias simples y atractivas para los usuarios.
            </p>
          </div>
        </div>

        <!-- Ejemplo para añadir más -->
        <div class="col-md-4 mb-4">
          <div class="text-center">
            <img src="https://via.placeholder.com/120" class="rounded-circle mb-3" alt="Nuevo miembro">
            <h5 class="fw-bold mb-1">María García</h5>
            <p class="text-primary mb-1">Co-Fundadora & CEO</p>
            <p class="text-muted small">
              10+ años en tecnología y startups. Apasionada por resolver problemas urbanos.
            </p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>


<!-- 🚗 Sección: Contacto -->
<section id="contacto" class="py-5 bg-light-gray">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" style="color: #0d6efd;">Contáctenos</h2>

    <div class="card border-0 shadow-lg overflow-hidden">
      <div class="row g-0">

        <!-- Imagen izquierda -->
        <div class="col-md-6 d-none d-md-block">
          <img src="{{ asset('images/contactenos.png') }}" alt="Contacto SmartPark" class="img-fluid h-100 w-100" style="object-fit: cover;">
        </div>

        <!-- Formulario derecha -->
        <div class="col-md-6 bg-white p-5">
          <h4 class="fw-bold mb-3 text-success">Estamos aquí para ayudarte</h4>
          <p class="text-secondary mb-4">¿Tienes preguntas o deseas colaborar con nosotros? Envíanos un mensaje y te responderemos pronto.</p>

          <!-- Formulario -->
          <form action="mailto:contacto@smartpark.com" method="post" enctype="text/plain">
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre" required>
              </div>
              <div class="col-md-6 mb-3">
                <label for="apellido" class="form-label">Apellido</label>
                <input type="text" id="apellido" name="apellido" class="form-control" placeholder="Tu apellido" required>
              </div>
            </div>

            <div class="mb-3">
              <label for="telefono" class="form-label">Teléfono</label>
              <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="+57 300 123 4567">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo Electrónico</label>
              <input type="email" id="correo" name="correo" class="form-control" placeholder="tucorreo@example.com" required>
            </div>

            <div class="mb-3">
              <label for="mensaje" class="form-label">Mensaje</label>
              <textarea id="mensaje" name="mensaje" rows="4" class="form-control" placeholder="Escribe tu mensaje aquí..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold">Enviar Mensaje</button>
          </form>

          <!-- Opción Gmail directa -->
          <div class="text-center mt-4">
            <p class="text-secondary mb-2">¿Prefieres enviarnos un correo directo?</p>
            <a href="mailto:contacto@smartpark.com?subject=Consulta%20SmartPark" 
               class="btn btn-outline-success">
              <i class="bi bi-envelope-fill me-1"></i> Abrir en Gmail
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
