<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Parqueadero;
use App\Models\Vehiculo;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Reservas

        // ✅ Todas las reservas (esto te faltaba)
        $reservas = Reserva::where('usuario_id', $userId)->get();
        
        $reservasActivas = Reserva::where('usuario_id', $userId)
            ->where('estado', 'activa')
            ->get();

        $reservasPendientes = Reserva::where('usuario_id', $userId)
            ->where('estado', 'pendiente')
            ->get();

        $historial = Reserva::where('usuario_id', $userId)
            ->where('estado', '!=', 'pendiente')
            ->orderBy('fecha_reserva', 'desc')
            ->limit(6)
            ->get();

        // ================================
        // ✅ CÁLCULOS DE USO
        // ================================
        $movimientos = \App\Models\Movimiento::where('user_id', $userId)
            ->where('parqueadero_id', $res->parqueadero_id ?? null)
            ->orderBy('fecha_hora')
            ->get();

        $diasUsados = 0;
        $horasTotales = 0;

        $entradas = $movimientos->where('tipo', 'entrada')->values();
        $salidas  = $movimientos->where('tipo', 'salida')->values();

        foreach ($entradas as $index => $entrada) {

            if (!isset($salidas[$index])) {
                continue; // si no tiene salida no se cuenta
            }

            $salida = $salidas[$index];

            $inicio = Carbon\Carbon::parse($entrada->fecha_hora);
            $fin    = Carbon\Carbon::parse($salida->fecha_hora);

            $horas = $inicio->diffInHours($fin);
            $dias  = $inicio->isSameDay($fin) ? 1 : $inicio->diffInDays($fin) + 1;

            $horasTotales += $horas;
            $diasUsados   += $dias;
        }

        // Promedio diario
        $promedio = ($diasUsados > 0) ? round($horasTotales / $diasUsados, 2) : 0;

        return view('usuario.reservas.index', compact(
            'reservasActivas',
            'reservasPendientes',
            'historial',
            'reservasActivas',
            'diasUsados',
            'horasTotales',
            'promedio',
            'reservas'
        ));
    }





    public function create(Parqueadero $parqueadero)
    {
        $vehiculos = Auth::user()->vehiculos; // suponiendo que el usuario tiene vehículos asociados
        return view('usuario.reservas.create', compact('parqueadero', 'vehiculos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'parqueadero_id' => 'required|exists:parqueaderos,id',
            'fecha_reserva' => 'required|date',
            'hora_inicio' => 'required',
            'hora_fin' => 'required|after:hora_inicio',
        ]);

        Reserva::create([
            'usuario_id' => Auth::id(),
            'vehiculo_id' => $request->vehiculo_id,
            'parqueadero_id' => $request->parqueadero_id,
            'fecha_reserva' => $request->fecha_reserva,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin' => $request->hora_fin,
            'estado' => 'pendiente', // estado inicial
        ]);

        return redirect()->route('usuario.reservas.index')->with('success', 'Reserva creada con éxito');
    }


    public function destroy($id)
    {
        $reserva = Reserva::where('usuario_id', Auth::id())
            ->where('id', $id)
            ->first();

        if (!$reserva) {
            return redirect()->route('usuario.reservas.index')
                ->with('error', 'Reserva no encontrada o no autorizada.');
        }

        // Cambiar el estado
        $reserva->estado = 'cancelada';
        $reserva->save();

        return redirect()->route('usuario.reservas.index')
            ->with('success', 'Reserva cancelada correctamente.');
    }
}
