<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MovimientoController;
use App\Http\Controllers\Admin\ParqueaderoController;
use App\Http\Controllers\Admin\TarifaController;
use App\Http\Controllers\Admin\TransaccionController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\HomeController;

// Página principal
Route::get('/', function () {
    return view('welcome');
});

// Laravel UI Auth
Auth::routes();

// Home
Route::get('/home', [HomeController::class, 'index'])->name('home');

// ✅ RUTAS DEL ADMIN (solo usuarios autenticados)
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');

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

    // ✅ Otras secciones
    Route::get('/admin/abonados', [AdminController::class, 'abonados'])->name('admin.abonados');
    Route::get('/admin/caja', [AdminController::class, 'caja'])->name('admin.caja');
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

    Route::delete('/admin/vehiculos/{id}', [VehiculoController::class, 'destroy'])
        ->name('admin.vehiculos.delete');

    //Transacciones
    Route::get('/admin/transacciones', [TransaccionController::class, 'index'])
        ->name('admin.transacciones');



    

});
