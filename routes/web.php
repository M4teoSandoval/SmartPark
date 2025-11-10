<?php

use App\Http\Controllers\Admin\AdminReservaController;
use App\Http\Controllers\UsuarioController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MensualidadController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MovimientoController;
use App\Http\Controllers\Admin\ParqueaderoController;
use App\Http\Controllers\Admin\TarifaController;
use App\Http\Controllers\Admin\TransaccionController;
use App\Http\Controllers\Admin\UsersAdminController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MensualidadUsuarioController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\TransaccionUsuarioController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Laravel UI Auth
Auth::routes();

// Home
Route::get('/usuario', [HomeController::class, 'index'])->name('usuario.inicio');

// ✅ RUTAS DEL ADMIN (solo usuarios autenticados)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', [DashboardController::class, 'index'])->name('admin.dashboard');

    // ✅ PARQUEADERO
    Route::get('/admin/parqueadero', [ParqueaderoController::class, 'index'])
        ->name('admin.parqueadero');
    Route::post('/admin/parqueadero', [ParqueaderoController::class, 'store'])
        ->name('admin.parqueadero.store');
    Route::put('/admin/parqueadero/{id}', [ParqueaderoController::class, 'update'])
        ->name('admin.parqueadero.update');

    // ✅ TARIFAS
    Route::get('/admin/tarifas', [TarifaController::class, 'index'])->name('admin.tarifas');
    Route::post('/admin/tarifas', [TarifaController::class, 'store'])->name('admin.tarifas.store');
    Route::delete('/admin/tarifas/{id}', [TarifaController::class, 'destroy'])->name('admin.tarifas.delete');

    // ✅ MOVIMIENTOS
    Route::get('/admin/movimientos', [MovimientoController::class, 'index'])
        ->name('admin.movimientos');
    Route::post('/admin/movimientos/entrada', [MovimientoController::class, 'registrarEntrada'])
        ->name('admin.movimientos.entrada');
    Route::post('/admin/movimientos/salida', [MovimientoController::class, 'registrarSalida'])
        ->name('admin.movimientos.salida');

    Route::get('/api/verificar-mensualidad/{placa}', function ($placa) {
        $vehiculo = \App\Models\Vehiculo::where('placa', strtoupper($placa))->first();

        if (!$vehiculo) {
            return ['activa' => false];
        }

        $mensualidad = $vehiculo->mensualidades()
            ->where('estado', 'activa')
            ->whereDate('fecha_inicio', '<=', now())
            ->whereDate('fecha_fin', '>=', now())
            ->first();

        return ['activa' => $mensualidad ? true : false];
    });

    // ✅ ADMIN – Gestión de reservas
    Route::get('/admin/reservas', [AdminReservaController::class, 'index'])
        ->name('admin.reservas.index');

    Route::post('/admin/reservas/{id}/aceptar', [AdminReservaController::class, 'aceptar'])
        ->name('admin.reservas.aceptar');

    Route::post('/admin/reservas/{id}/rechazar', [AdminReservaController::class, 'rechazar'])
        ->name('admin.reservas.rechazar');


    // ✅ Otras secciones
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/admin/ajustes', [ParqueaderoController::class, 'index'])
        ->name('admin.ajustes');


    // ✅ VEHÍCULOS
    Route::get('/admin/vehiculos', [VehiculoController::class, 'index'])
        ->name('admin.vehiculos');
    Route::get('/admin/vehiculos/create', [VehiculoController::class, 'create'])
        ->name('admin.vehiculos.create');
    Route::post('/admin/vehiculos', [VehiculoController::class, 'store'])
        ->name('admin.vehiculos.store');
    Route::get('/admin/vehiculos/{id}', [VehiculoController::class, 'show'])
        ->name('admin.vehiculos.show');
    Route::get('/admin/vehiculos/{id}/edit', [VehiculoController::class, 'edit'])
        ->name('admin.vehiculos.edit');
    Route::put('/admin/vehiculos/{id}', [VehiculoController::class, 'update'])
        ->name('admin.vehiculos.update');


    //Transacciones
    Route::get('/admin/transacciones', [TransaccionController::class, 'index'])
        ->name('admin.transacciones');



    // ✅ MENSUALIDADES
    Route::get('/admin/mensualidades', [MensualidadController::class, 'index'])
        ->name('admin.mensualidades');
    Route::get('/admin/mensualidades/create', [MensualidadController::class, 'create'])
        ->name('admin.mensualidades.create');
    Route::post('/admin/mensualidades', [MensualidadController::class, 'store'])
        ->name('admin.mensualidades.store');
    Route::get('/admin/mensualidades/{id}', [MensualidadController::class, 'show'])
        ->name('admin.mensualidades.show');
    Route::get('/admin/mensualidades/{id}/edit', [MensualidadController::class, 'edit'])
        ->name('admin.mensualidades.edit');
    Route::put('/admin/mensualidades/{id}', [MensualidadController::class, 'update'])
        ->name('admin.mensualidades.update');



    // ✅ USUARIOS
    Route::get('/admin/usuarios', [UsersAdminController::class, 'index'])->name('admin.usuarios');
    Route::get('/admin/usuarios/create', [UsersAdminController::class, 'create'])->name('admin.usuarios.create');
    Route::post('/admin/usuarios', [UsersAdminController::class, 'store'])->name('admin.usuarios.store');
});



Route::prefix('usuario')->name('usuario.')->middleware('auth')->group(function () {
    Route::get('/', [UsuarioController::class, 'inicio'])->name('inicio');


    Route::get('/parqueaderos', [UsuarioController::class, 'parqueaderos'])->name('parqueaderos');
    Route::get('/transacciones', [TransaccionUsuarioController::class, 'index'])->name('transacciones');
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');


    // Mostrar todas las reservas del usuario
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');

    // Crear reserva para un parqueadero específico
    Route::get('/reservas/create/{parqueadero}', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');

    Route::delete('/reservas/{id}', [ReservaController::class, 'destroy'])
        ->name('reservas.destroy');




    // Vehículos
    Route::get('/vehiculos', [UsuarioController::class, 'vehiculos'])->name('vehiculos.index');
    Route::get('/vehiculos/create', [UsuarioController::class, 'vehiculosCreate'])->name('vehiculos.create');
    Route::post('/vehiculos', [UsuarioController::class, 'vehiculosStore'])->name('vehiculos.store');
    Route::delete('/vehiculos/{id}', [UsuarioController::class, 'vehiculosDestroy'])->name('vehiculos.destroy');


    // Mensualidad
    Route::get('/mensualidad/pagar/{parqueadero}', [MensualidadUsuarioController::class, 'create'])
        ->name('mensualidad.pagar');

    Route::post('/mensualidad/pagar', [MensualidadUsuarioController::class, 'store'])
        ->name('mensualidad.store');

    Route::get('/mensualidades', [MensualidadUsuarioController::class, 'index'])
        ->name('mensualidad.index');
});
