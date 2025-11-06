<aside class="sidebar">
    <h2 class="sidebar-title">ADMIN</h2>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="{{ route('admin.tarifas') }}" class="{{ request()->routeIs('admin.tarifas') ? 'active' : '' }}">Tarifas</a></li>
        <li><a href="{{ route('admin.ingresos') }}" class="{{ request()->routeIs('admin.ingresos') ? 'active' : '' }}">Ingresos</a></li>
        <li><a href="{{ route('admin.salidas') }}" class="{{ request()->routeIs('admin.salidas') ? 'active' : '' }}">Salidas</a></li>
        <li><a href="{{ route('admin.abonados') }}" class="{{ request()->routeIs('admin.abonados') ? 'active' : '' }}">Abonados</a></li>
        <li><a href="{{ route('admin.caja') }}" class="{{ request()->routeIs('admin.caja') ? 'active' : '' }}">Caja</a></li>
        <li><a href="{{ route('admin.pagos') }}" class="{{ request()->routeIs('admin.pagos') ? 'active' : '' }}">Pagos</a></li>
        <li><a href="{{ route('admin.reportes') }}" class="{{ request()->routeIs('admin.reportes') ? 'active' : '' }}">Reportes</a></li>
        <li><a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">Usuarios</a></li>
        <li><a href="{{ route('admin.ajustes') }}" class="{{ request()->routeIs('admin.ajustes') ? 'active' : '' }}">Ajustes</a></li>
    </ul>
</aside>
