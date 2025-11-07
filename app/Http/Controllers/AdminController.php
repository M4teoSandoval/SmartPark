<?php

namespace App\Http\Controllers;

use App\Models\Parqueadero;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        return view('admin.inicio');
    }

    public function tarifas() {
        return view('admin.tarifas');
    }

    public function movimientos() {
        return view('admin.movimientos');
    }

    public function abonados() {
        return view('admin.abonados');
    }

    public function caja() {
        return view('admin.caja');
    }

    public function pagos() {
        return view('admin.pagos');
    }

    public function reportes() {
        return view('admin.reportes');
    }

    public function usuarios() {
        return view('admin.usuarios');
    }

    public function ajustes()
    {
        // Obtener el parqueadero del usuario logueado (por ahora el primero)
        $parqueadero = Parqueadero::first();

        return view('admin.ajustes', compact('parqueadero'));
    }
}
