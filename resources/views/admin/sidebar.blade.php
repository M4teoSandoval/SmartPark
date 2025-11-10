<aside class="sidebar" id="sidebar">

    <!-- Marca -->
    <div class="sidebar-brand mb-4 text-center">
        <div class="fw-bold text-white fs-3">SmartPark</div>
        <div class="text-white small">Admin</div>
    </div>

    <ul class="sidebar-menu">

        <li>
            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 icon"></i> Inicio
            </a>
        </li>

        <li>
            <a href="{{ route('admin.ajustes') }}" class="{{ request()->routeIs('admin.ajustes') ? 'active' : '' }}">
                <i class="bi bi-gear icon"></i> Parqueadero
            </a>
        </li>

        <li>
            <a href="{{ route('admin.tarifas') }}" class="{{ request()->routeIs('admin.tarifas') ? 'active' : '' }}">
                <i class="bi bi-cash-coin icon"></i> Tarifas
            </a>
        </li>

        <li>
            <a href="{{ route('admin.movimientos') }}" class="{{ request()->routeIs('admin.movimientos') ? 'active' : '' }}">
                <i class="bi bi-arrow-left-right icon"></i> Movimientos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.reservas.index') }}" class="{{ request()->routeIs('admin.reservas.index') ? 'active' : '' }}">
                <i class="bi bi-calendar-check icon"></i> Reservas
            </a>
        </li>

        <li>
            <a href="{{ route('admin.mensualidades') }}" class="{{ request()->routeIs('admin.mensualidades') ? 'active' : '' }}">
                <i class="bi bi-clock-history icon"></i> Mensualidades
            </a>
        </li>

        <li>
            <a href="{{ route('admin.vehiculos') }}" class="{{ request()->routeIs('admin.vehiculos') ? 'active' : '' }}">
                <i class="bi bi-car-front icon"></i> Vehículos
            </a>
        </li>

        <li>
            <a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">
                <i class="bi bi-people icon"></i> Usuarios
            </a>
        </li>

        <li>
            <a href="{{ route('admin.transacciones') }}" class="{{ request()->routeIs('admin.transacciones') ? 'active' : '' }}">
                <i class="bi bi-receipt icon"></i> Transacciones
            </a>
        </li>

        <li>
            <a href="{{ route('admin.reportes') }}" class="{{ request()->routeIs('admin.reportes') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line icon"></i> Reportes
            </a>
        </li>

    </ul>

</aside>

