<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/tarifas', [AdminController::class, 'tarifas'])->name('admin.tarifas');
    Route::get('/admin/ingresos', [AdminController::class, 'ingresos'])->name('admin.ingresos');
    Route::get('/admin/salidas', [AdminController::class, 'salidas'])->name('admin.salidas');
    Route::get('/admin/abonados', [AdminController::class, 'abonados'])->name('admin.abonados');
    Route::get('/admin/caja', [AdminController::class, 'caja'])->name('admin.caja');
    Route::get('/admin/pagos', [AdminController::class, 'pagos'])->name('admin.pagos');
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/admin/ajustes', [AdminController::class, 'ajustes'])->name('admin.ajustes');
});



Route::prefix('usuario')->name('usuario.')->middleware('auth')->group(function () {
    Route::get('/', [UsuarioController::class, 'inicio'])->name('inicio');                  // /usuario -> usuario.inicio
    Route::get('/reservas', [UsuarioController::class, 'reservas'])->name('reservas');      // /usuario/reservas -> usuario.reservas
    Route::get('/parqueaderos', [UsuarioController::class, 'parqueaderos'])->name('parqueaderos'); // /usuario/parqueaderos
    Route::get('/transacciones', [UsuarioController::class, 'transacciones'])->name('transacciones'); // /usuario/transacciones
    Route::get('/perfil', [UsuarioController::class, 'perfil'])->name('perfil');            // /usuario/perfil
});
