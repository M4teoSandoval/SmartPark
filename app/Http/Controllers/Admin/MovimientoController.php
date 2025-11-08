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

        $entradas = Movimiento::where('user_id', Auth::id())
            ->where('parqueadero_id', $parqueadero->id)
            ->where('tipo', 'entrada')
            ->orderBy('fecha_hora', 'desc')
            ->take(10)
            ->get();

        $salidas = Movimiento::where('user_id', Auth::id())
            ->where('parqueadero_id', $parqueadero->id)
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

        // ✅ Buscar o crear vehículo
        $vehiculo = Vehiculo::firstOrCreate(
            ['placa' => $placa],
            [
                'tipo_vehiculo' => $request->tipo_vehiculo,
                'user_id' => Auth::id(), // dueño temporal
            ]
        );

        // ✅ Asociación al parqueadero (temporal: el primero)
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();
        if (!$parqueadero) {
            return back()->with('error', 'No existe un parqueadero registrado.');
        }

        // ✅ Verificar último movimiento
        $ultimoMovimiento = Movimiento::where('vehiculo_id', $vehiculo->id)
            ->where('parqueadero_id', $parqueadero->id)   // ← este es el cambio
            ->orderBy('fecha_hora', 'desc')
            ->first();

        // ❌ Si el último fue ENTRADA → YA ESTÁ DENTRO
        if ($ultimoMovimiento && $ultimoMovimiento->tipo === 'entrada') {
            return back()->with('error', "El vehículo {$placa} ya está dentro del parqueadero.");
        }

        // ✅ Registrar ENTRADA
        Movimiento::create([
            'vehiculo_id'    => $vehiculo->id,
            'parqueadero_id' => $parqueadero->id,
            'user_id'        => auth()->id(),
            'tipo'           => 'entrada',
            'fecha_hora'     => Carbon::now(),
        ]);


        return back()->with('success', "Entrada registrada correctamente para la placa {$placa}.");
    }

    /**
     * ✅ REGISTRAR UNA SALIDA
     */
    public function registrarSalida(Request $request)
    {
        $request->validate([
            'placa' => 'required|string|max:10',
            'metodo_pago' => 'required|string',
        ]);

        $placa = strtoupper(trim($request->placa));

        $vehiculo = Vehiculo::where('placa', $placa)->first();
        if (!$vehiculo) {
            return back()->with('error', "El vehículo {$placa} no existe en el sistema.");
        }

        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();
        if (!$parqueadero) {
            return back()->with('error', 'No existe un parqueadero registrado.');
        }

        // ✅ Obtener última ENTRADA en ESTE parqueadero
        $entrada = Movimiento::where('vehiculo_id', $vehiculo->id)
            ->where('parqueadero_id', $parqueadero->id)
            ->where('tipo', 'entrada')
            ->orderBy('fecha_hora', 'desc')
            ->first();

        if (!$entrada) {
            return back()->with('error', "El vehículo {$placa} no tiene una entrada registrada.");
        }

        // ✅ Tiempo total
        $minutos = $entrada->fecha_hora->diffInMinutes(now());

        // ✅ Obtener tarifa
        $tarifa = Tarifa::where('parqueadero_id', $parqueadero->id)
            ->where('tipo_vehiculo', $vehiculo->tipo_vehiculo)
            ->first();

        if (!$tarifa) {
            return back()->with('error', "No hay tarifa configurada para {$vehiculo->tipo_vehiculo}.");
        }

        // ✅ Calcular costo
        $costo = $minutos * $tarifa->valor_minuto;

        // ✅ Registrar salida con monto
        $salida = Movimiento::create([
            'vehiculo_id'    => $vehiculo->id,
            'parqueadero_id' => $parqueadero->id,
            'user_id'        => auth()->id(),
            'tipo'           => 'salida',
            'fecha_hora'     => now(),
            'monto'          => $costo,
            'metodo_pago'    => $request->metodo_pago,
        ]);

        // ✅ Registrar transacción con tu estructura real
        Transaccion::create([
            'usuario_id'     => auth()->id(),
            'parqueadero_id' => $parqueadero->id,
            'vehiculo_id'    => $vehiculo->id,
            'reserva_id'     => null,
            'mensualidad_id' => null,
            'tipo_transaccion' => 'salida',
            'valor'            => $costo,
            'metodo_pago'      => $request->metodo_pago,
            'fecha'            => now(),
        ]);

        return back()->with('success', "Salida registrada. Total a pagar: $" . number_format($costo, 0));
    }
}
