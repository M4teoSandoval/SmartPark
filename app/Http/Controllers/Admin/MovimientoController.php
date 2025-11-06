<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;

class MovimientoController extends Controller
{
    /**
     * Mostrar vista de movimientos (entradas y salidas del día)
     */
    public function index()
    {
        // ✅ Filtrar ENTRADAS del día
        $entradas = Movimiento::where('tipo', 'entrada')
            ->orderBy('fecha_hora', 'desc')
            ->take(10)
            ->get();

        // ✅ Filtrar SALIDAS del día
        $salidas = Movimiento::where('tipo', 'salida')
            ->orderBy('fecha_hora', 'desc')
            ->take(10)
            ->get();

        return view('admin.movimientos', compact('entradas', 'salidas'));
    }

    /**
     * ✅ REGISTRAR UNA ENTRADA
     */
    public function registrarEntrada(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'tipo_vehiculo' => 'required|in:carro,moto',
        ]);

        // ✅ Buscar si el vehículo ya existe
        $vehiculo = Vehiculo::firstOrCreate(
            ['placa' => strtoupper($request->placa)],
            [
                'tipo_vehiculo' => $request->tipo_vehiculo,
                'user_id' => Auth::id(), // por ahora el dueño es el admin
            ]
        );

        // ✅ Tomar el parqueadero que administra este usuario
        // TEMPORAL: Si aún no tienes esa lógica usa uno por defecto
        $parqueadero = Parqueadero::first();

        if (!$parqueadero) {
            return back()->with('error', 'No existe un parqueadero registrado.');
        }

        // ✅ Registrar el movimiento
        Movimiento::create([
            'vehiculo_id'     => $vehiculo->id,
            'parqueadero_id'  => $parqueadero->id,
            'tipo'            => 'entrada',
            'fecha_hora'      => now(),
        ]);

        return back()->with('success', 'Entrada registrada correctamente.');
    }

    /**
     * ✅ REGISTRAR UNA SALIDA
     */
    public function registrarSalida(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
        ]);

        $vehiculo = Vehiculo::where('placa', strtoupper($request->placa))->first();

        if (!$vehiculo) {
            return back()->with('error', 'El vehículo no existe.');
        }

        $parqueadero = Parqueadero::first();

        if (!$parqueadero) {
            return back()->with('error', 'No existe un parqueadero registrado.');
        }

        Movimiento::create([
            'vehiculo_id'     => $vehiculo->id,
            'parqueadero_id'  => $parqueadero->id,
            'tipo'            => 'salida',
            'fecha_hora'      => now(),
        ]);

        return back()->with('success', 'Salida registrada correctamente.');
    }
}
