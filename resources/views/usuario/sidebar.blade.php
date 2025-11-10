<aside class="sidebar d-flex flex-column p-3" style="width: 250px; background-color: #1D457D;">
    <!-- Marca -->
    <div class="sidebar-brand mb-4 text-center">
        <div class="fw-bold text-white fs-3">SmartPark</div>
        <div class="text-white small">Cliente</div>
    </div>

    <!-- Menú -->
    <ul class="sidebar-menu list-unstyled">
        <li>
            <a href="{{ route('usuario.inicio') }}" class="{{ request()->routeIs('usuario.inicio') ? 'active' : '' }} text-white text-decoration-none d-flex align-items-center mb-2">
                <i class="bi bi-house-fill me-2"></i>Inicio
            </a>
        </li>
        <li>
            <a href="{{ route('usuario.reservas') }}" class="{{ request()->routeIs('usuario.reservas') ? 'active' : '' }} text-white text-decoration-none d-flex align-items-center mb-2">
                <i class="bi bi-calendar-check-fill me-2"></i>Reservas
            </a>
        </li>
        <li>
            <a href="{{ route('usuario.parqueaderos') }}" class="{{ request()->routeIs('usuario.parqueaderos') ? 'active' : '' }} text-white text-decoration-none d-flex align-items-center mb-2">
                <i class="bi bi-geo-alt-fill me-2"></i>Parqueaderos
            </a>
        </li>
        <li>
            <a href="{{ route('usuario.transacciones') }}" class="{{ request()->routeIs('usuario.transacciones') ? 'active' : '' }} text-white text-decoration-none d-flex align-items-center mb-2">
                <i class="bi bi-receipt me-2"></i>Transacciones
            </a>
        </li>
        <li>
            <a href="{{ route('usuario.perfil') }}" class="{{ request()->routeIs('usuario.perfil') ? 'active' : '' }} text-white text-decoration-none d-flex align-items-center mb-2">
                <i class="bi bi-person-fill me-2"></i>Perfil
            </a>
        </li>

        <!-- Cerrar sesión alineado con los demás -->
        <li class="mt-3">
            <a href="#" class="text-white text-decoration-none d-flex align-items-center"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right me-2"></i>Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        </li>
    </ul>

    <!-- Botón Ser Administrador al fondo -->
    <div class="mt-auto pt-3">
        <a href="{{ url('/admin/become') }}" class="btn btn-danger w-100 mb-3 text-white">
            <i class="bi bi-crown me-2"></i>Ser Administrador
        </a>
    </div>
</aside>