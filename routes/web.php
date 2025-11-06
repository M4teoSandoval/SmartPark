<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\MovimientoController;

Route::get('/', function () {
    return view('welcome');
});

// Auth de Laravel UI
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');


// ✅ Panel Admin (solo para usuarios autenticados)
Route::middleware('auth')->group(function () {

    // Dashboard básico
    Route::get('/admin', [AdminController::class, 'index'])
        ->name('admin.dashboard');

    // Páginas del admin
    Route::get('/admin/tarifas', [AdminController::class, 'tarifas'])->name('admin.tarifas');
    Route::get('/admin/abonados', [AdminController::class, 'abonados'])->name('admin.abonados');
    Route::get('/admin/caja', [AdminController::class, 'caja'])->name('admin.caja');
    Route::get('/admin/pagos', [AdminController::class, 'pagos'])->name('admin.pagos');
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/admin/ajustes', [AdminController::class, 'ajustes'])->name('admin.ajustes');


    // ✅ MOVIMIENTOS (Controlador real)
    Route::get('/admin/movimientos', [MovimientoController::class, 'index'])
        ->name('admin.movimientos');

    Route::post('/admin/movimientos/entrada', [MovimientoController::class, 'registrarEntrada'])
        ->name('admin.movimientos.entrada');

    Route::post('/admin/movimientos/salida', [MovimientoController::class, 'registrarSalida'])
        ->name('admin.movimientos.salida');
});
