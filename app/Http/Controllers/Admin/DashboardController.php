<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\Movimiento;
use App\Models\Transaccion;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        if (!$parqueadero) {
            return view('admin.dashboard', [
                'totalVehiculos' => 0,
                'entradasHoy' => 0,
                'salidasHoy' => 0,
                'totalTransacciones' => 0,
                'entradasRecientes' => collect(),
                'salidasRecientes' => collect(),
            ]);
        }

        $totalVehiculos = Movimiento::where('parqueadero_id', $parqueadero->id)
            ->distinct('vehiculo_id')
            ->count('vehiculo_id');

        $entradasHoy = Movimiento::where('tipo', 'entrada')->where('parqueadero_id', $parqueadero->id)->whereDate('fecha_hora', now())->count();
        $salidasHoy = Movimiento::where('tipo', 'salida')->where('parqueadero_id', $parqueadero->id)->whereDate('fecha_hora', now())->count();
        $totalTransacciones = Transaccion::where('parqueadero_id', $parqueadero->id)->count();
        $entradasRecientes = Movimiento::with('vehiculo')->where('tipo', 'entrada')->where('parqueadero_id', $parqueadero->id)->orderBy('fecha_hora', 'desc')->take(5)->get();
        $salidasRecientes = Movimiento::with('vehiculo')->where('tipo', 'salida')->where('parqueadero_id', $parqueadero->id)->orderBy('fecha_hora', 'desc')->take(5)->get();

        return view('admin.dashboard', compact(
            'totalVehiculos',
            'entradasHoy',
            'salidasHoy',
            'totalTransacciones',
            'entradasRecientes',
            'salidasRecientes'
        ));
    }
}
