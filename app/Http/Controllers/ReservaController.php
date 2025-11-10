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

        $reservasActivas = Reserva::where('usuario_id', $userId)
            ->where('estado', 'activa')
            ->whereDate('fecha_reserva', '>=', now())
            ->get();

        Reserva::where('usuario_id', $userId)
            ->where('estado', 'activa')
            ->whereDate('fecha_reserva', '<', now())
            ->update(['estado' => 'completada']);


        $historial = Reserva::where('usuario_id', $userId)
            ->where('estado', '!=', 'activa')
            ->orderBy('fecha_reserva', 'desc')
            ->limit(6)
            ->get();

        // Todas las reservas del usuario
        $reservas = Reserva::where('usuario_id', $userId)->get();

        return view('usuario.reservas.index', compact('reservasActivas', 'historial', 'reservas'));
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
            'estado' => 'activa', // estado inicial
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
