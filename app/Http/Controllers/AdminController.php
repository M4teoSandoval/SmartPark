<?php

namespace App\Http\Controllers;

use App\Models\Parqueadero;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Movimiento;
use App\Models\Transaccion;

class AdminController extends Controller
{
   

    public function tarifas()
    {
        return view('admin.tarifas');
    }

    public function movimientos()
    {
        return view('admin.movimientos');
    }

    public function abonados()
    {
        return view('admin.abonados');
    }

    public function caja()
    {
        return view('admin.caja');
    }

    public function transacciones()
    {
        return view('admin.transacciones');
    }

    public function reportes()
    {
        return view('admin.reportes');
    }

    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function ajustes()
    {
        // Obtener el parqueadero del usuario logueado (por ahora el primero)
        $parqueadero = Parqueadero::first();

        return view('admin.ajustes', compact('parqueadero'));
    }

}
