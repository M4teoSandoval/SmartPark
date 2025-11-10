<aside class="sidebar " id="sidebar">
    <!-- Marca -->
    <div class="sidebar-brand mb-4 text-center">
        <div class="fw-bold text-white fs-3">SmartPark</div>
        <div class="text-white small">Cliente</div>
    </div>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Inicio</a></li>
        <li><a href="{{ route('admin.ajustes') }}" class="{{ request()->routeIs('admin.ajustes') ? 'active' : '' }}">Parqueadero</a></li>
        <li><a href="{{ route('admin.tarifas') }}" class="{{ request()->routeIs('admin.tarifas') ? 'active' : '' }}">Tarifas</a></li>
        <li><a href="{{ route('admin.movimientos') }}" class="{{ request()->routeIs('admin.movimientos') ? 'active' : '' }}">Movimientos</a></li>
        <li><a href="{{ route('admin.reservas.index') }}" class="{{ request()->routeIs('admin.reservas.index') ? 'active' : '' }}">Reservas</a></li>
        <li><a href="{{ route('admin.mensualidades') }}" class="{{ request()->routeIs('admin.mensualidades') ? 'active' : '' }}">Mensualidades</a></li>
        <li><a href="{{ route('admin.vehiculos') }}" class="{{ request()->routeIs('admin.vehiculos') ? 'active' : '' }}">Vehiculo</a></li>
        <li><a href="{{ route('admin.usuarios') }}" class="{{ request()->routeIs('admin.usuarios') ? 'active' : '' }}">Usuarios</a></li>
        <li><a href="{{ route('admin.transacciones') }}" class="{{ request()->routeIs('admin.transacciones') ? 'active' : '' }}">Transacciones</a></li>
        <li><a href="{{ route('admin.reportes') }}" class="{{ request()->routeIs('admin.reportes') ? 'active' : '' }}">Reportes</a></li>
        
            
    </ul>
</aside>

