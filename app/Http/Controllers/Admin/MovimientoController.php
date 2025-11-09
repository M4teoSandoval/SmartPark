<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movimiento;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Tarifa;
use App\Models\Transaccion;

class MovimientoController extends Controller
{
    /**
     * Mostrar vista de movimientos
     */
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        $entradas = Movimiento::where('parqueadero_id', $parqueadero->id)
            ->where('tipo', 'entrada')
            ->orderBy('fecha_hora', 'desc')
            ->take(10)
            ->get();

        $salidas = Movimiento::where('parqueadero_id', $parqueadero->id)
            ->where('tipo', 'salida')
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

        $placa = strtoupper(trim($request->placa));

        // Crear o encontrar vehículo
        $vehiculo = Vehiculo::firstOrCreate(
            ['placa' => $placa],
            [
                'tipo_vehiculo' => $request->tipo_vehiculo,
                'user_id'       => Auth::id(),
            ]
        );

        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();
        if (!$parqueadero) return back()->with('error', 'No existe un parqueadero registrado.');

        // Verificar última entrada
        $ultimoMovimiento = Movimiento::where('vehiculo_id', $vehiculo->id)
            ->where('parqueadero_id', $parqueadero->id)
            ->orderBy('fecha_hora', 'desc')
            ->first();

        if ($ultimoMovimiento && $ultimoMovimiento->tipo === 'entrada') {
            return back()->with('error', "El vehículo {$placa} ya está dentro.");
        }

        // Registrar entrada
        Movimiento::create([
            'vehiculo_id'    => $vehiculo->id,
            'parqueadero_id' => $parqueadero->id,
            'user_id'        => auth()->id(),
            'tipo'           => 'entrada',
            'fecha_hora'     => now(),
        ]);

        return back()->with('success', "Entrada registrada correctamente.");
    }


    /**
     * ✅ REGISTRAR UNA SALIDA (con mensualidad detectada)
     */
    public function registrarSalida(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'metodo_pago' => 'nullable|string',
        ]);

        $placa = strtoupper(trim($request->placa));

        $vehiculo = Vehiculo::where('placa', $placa)->first();
        if (!$vehiculo) return back()->with('error', "El vehículo {$placa} no existe.");

        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();
        if (!$parqueadero) return back()->with('error', 'No existe parqueadero.');

        // ✅ Última entrada
        $entrada = Movimiento::where('vehiculo_id', $vehiculo->id)
            ->where('parqueadero_id', $parqueadero->id)
            ->where('tipo', 'entrada')
            ->orderBy('fecha_hora', 'desc')
            ->first();

        if (!$entrada) {
            return back()->with('error', "Este vehículo no tiene entrada registrada.");
        }

        // ✅ Verificar mensualidad activa
        $mensualidadActiva = $vehiculo->mensualidades()
            ->where('estado', 'activa')
            ->whereDate('fecha_inicio', '<=', now())
            ->whereDate('fecha_fin', '>=', now())
            ->first();

        // ✅ Registrar salida SIEMPRE
        Movimiento::create([
            'vehiculo_id'    => $vehiculo->id,
            'parqueadero_id' => $parqueadero->id,
            'user_id'        => auth()->id(),
            'tipo'           => 'salida',
            'fecha_hora'     => now(),
        ]);

        // ✅ SI TIENE MENSUALIDAD ACTIVA → NO COBRAR
        if ($mensualidadActiva) {
            return back()->with('success', "Salida registrada. Vehículo con mensualidad activa, no hay cobro.");
        }

        // ✅ SI NO TIENE MENSUALIDAD → Calcular costo
        $minutos = $entrada->fecha_hora->diffInMinutes(now());

        $tarifa = Tarifa::where('parqueadero_id', $parqueadero->id)
            ->where('tipo_vehiculo', $vehiculo->tipo_vehiculo)
            ->firstOrFail();

        $costo = $minutos * $tarifa->valor_minuto;

        // Validar método de pago SOLO si no tiene mensualidad
        if (!$request->metodo_pago) {
            return back()->with('error', 'Debe seleccionar un método de pago.');
        }

        // Registrar transacción
        Transaccion::create([
            'usuario_id'        => $vehiculo->user_id,
            'parqueadero_id'    => $parqueadero->id,
            'vehiculo_id'       => $vehiculo->id,
            'tipo_transaccion'  => 'salida',
            'valor'             => $costo,
            'metodo_pago'       => $request->metodo_pago,
            'fecha'             => now(),
        ]);

        return back()->with('success', "Salida registrada. Total a pagar: $" . number_format($costo, 0));
    }
}
