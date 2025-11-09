<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\Movimiento;
use App\Models\Transaccion;
use App\Models\Mensualidad;
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
                'carrosDisponibles' => 0,
                'motosDisponibles' => 0,
                'parqueadero' => null
            ]);
        }

        // ✅ Vehículos actualmente dentro del parqueadero
        $vehiculosDentro = Movimiento::select('vehiculo_id', 'tipo')
            ->where('parqueadero_id', $parqueadero->id)
            ->orderBy('fecha_hora', 'desc')
            ->get()
            ->groupBy('vehiculo_id')
            ->map(fn($movs) => $movs->first()->tipo)
            ->toArray();

        $carrosOcupados = collect($vehiculosDentro)->filter(fn($t) => $t === 'entrada')->count();
        $motosOcupadas = $carrosOcupados; // Si deseas separar por tipo de vehículo se modifica aquí

        // ✅ Plazas disponibles
        $carrosDisponibles = max($parqueadero->capacidad_carros - $carrosOcupados, 0);
        $motosDisponibles = max($parqueadero->capacidad_motos - $motosOcupadas, 0);

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
            'salidasRecientes',
            'carrosDisponibles',
            'motosDisponibles',
            'parqueadero'
        ));
    }
}
