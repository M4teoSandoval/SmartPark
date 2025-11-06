<aside class="sidebar">
    <h2 class="sidebar-title">ADMIN</h2>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="{{ route('admin.ajustes') }}" class="{{ request()->routeIs('admin.ajustes') ? 'active' : '' }}">Parqueadero</a></li>
        <li><a href="{{ route('admin.tarifas') }}" class="{{ request()->routeIs('admin.tarifas') ? 'active' : '' }}">Tarifas</a></li>
        <li><a href="{{ route('admin.movimientos') }}" class="{{ request()->routeIs('admin.ingresos') ? 'active' : '' }}">Movimientos</a></li>
        <li><a href="{{ route('admin.abonados') }}" class="{{ request()->routeIs('admin.abonados') ? 'active' : '' }}">Mensualidades</a></li>
        <li><a href="{{ route('admin.tarifas') }}" class="{{ request()->routeIs('admin.tarifas') ? 'active' : '' }}">Vehiculo</a></li>
        <li><a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">Usuarios</a></li>
        <li><a href="{{ route('admin.pagos') }}" class="{{ request()->routeIs('admin.pagos') ? 'active' : '' }}">Transacciones</a></li>
        <li><a href="{{ route('admin.reportes') }}" class="{{ request()->routeIs('admin.reportes') ? 'active' : '' }}">Reportes</a></li>
        
            
    </ul>
</aside>
