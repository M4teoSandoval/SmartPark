<aside class="sidebar d-flex flex-column p-3" style="width: 250px; background-color: #1D457D; min-height: 100vh;">
    <!-- Marca -->
    <div class="sidebar-brand mb-4 text-center">
        <div class="fw-bold text-white fs-3">SmartPark</div>
        <div class="text-white small">Cliente</div>
    </div>

    <!-- Menú -->
    <ul class="sidebar-menu list-unstyled flex-grow-1">
        <li class="mb-2">
            <a href="{{ route('usuario.inicio') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.inicio') ? 'fw-bold active' : '' }}">
                <i class="bi bi-house-fill me-2"></i> Inicio
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('usuario.reservas.index') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.reservas.index') ? 'fw-bold active' : '' }}">
                <i class="bi bi-calendar-check-fill me-2"></i> Reservas
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('usuario.parqueaderos') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.parqueaderos') ? 'fw-bold active' : '' }}">
                <i class="bi bi-geo-alt-fill me-2"></i> Parqueaderos
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('usuario.vehiculos.index') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.vehiculos.index') ? 'fw-bold active' : '' }}">
                <i class="bi bi-car-front-fill me-2"></i> Vehículos
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('usuario.transacciones') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.transacciones') ? 'fw-bold active' : '' }}">
                <i class="bi bi-receipt me-2"></i> Transacciones
            </a>
        </li>
        <li class="mb-2">
            <a href="{{ route('usuario.perfil') }}" 
               class="text-white text-decoration-none d-flex align-items-center {{ request()->routeIs('usuario.perfil') ? 'fw-bold active' : '' }}">
                <i class="bi bi-person-fill me-2"></i> Perfil
            </a>
        </li>
    </ul>

    <!-- Cerrar sesión -->
    <div class="mt-auto">
        <a href="#" class="text-white text-decoration-none d-flex align-items-center mb-3"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
        
        <!-- Botón Ser Administrador opcional -->
        <a href="{{ url('/admin/become') }}" class="btn btn-danger w-100 text-white mt-3">
            <i class="bi bi-crown me-2"></i> Ser Administrador
        </a>
    </div>
</aside>
