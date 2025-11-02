<?php
use App\Http\Controllers\AdminController;
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
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
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
