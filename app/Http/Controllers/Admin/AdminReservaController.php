<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reserva;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;

class AdminReservaController extends Controller
{
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        if (!$parqueadero) {
            return back()->with('error', 'No tienes un parqueadero registrado.');
        }

        // ✅ Reservas activas para este parqueadero
        $reservas = Reserva::where('parqueadero_id', $parqueadero->id)
            ->where('estado', 'pendiente')
            ->orderBy('fecha_reserva', 'asc')
            ->get();

        return view('admin.reservas.index', compact('reservas'));
    }

    public function aceptar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = 'activa';
        $reserva->save();

        return back()->with('success', 'Reserva aceptada correctamente.');
    }

    public function rechazar($id)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = 'rechazada';
        $reserva->save();

        return back()->with('success', 'Reserva rechazada.');
    }
}
