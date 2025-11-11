<?php

namespace App\Http\Controllers;

use App\Models\Parqueadero;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Vehiculo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function inicio()
    {
        $user = auth()->user();

        $mensualidad = auth()->user()->mensualidades()->latest('fecha_fin')->first();


        if ($mensualidad) {
            $hoy = \Carbon\Carbon::now()->startOfDay();
            $fechaFin = \Carbon\Carbon::parse($mensualidad->fecha_fin)->startOfDay();

            // Días restantes como entero
            $mensualidad->dias_restantes = max(0, $hoy->diffInDays($fechaFin));
        }

        $usageDays = Reserva::where('usuario_id', auth()->id())
            ->whereMonth('fecha_reserva', now()->month)
            ->distinct('fecha_reserva')
            ->count('fecha_reserva');

        $totalReservations = $user->reservas()->count();

        $movimientos = \App\Models\Movimiento::where('user_id', auth()->id())
            ->whereMonth('fecha_hora', now()->month)
            ->orderBy('fecha_hora')
            ->get();

        $totalMinutos = 0;
        $entradas = [];

        foreach ($movimientos as $mov) {
            if ($mov->tipo === 'entrada') {
                $entradas[$mov->vehiculo_id][] = $mov->fecha_hora;
            } elseif ($mov->tipo === 'salida' && isset($entradas[$mov->vehiculo_id]) && count($entradas[$mov->vehiculo_id]) > 0) {
                $entrada = array_shift($entradas[$mov->vehiculo_id]);
                $totalMinutos += Carbon::parse($entrada)->diffInMinutes($mov->fecha_hora);
            }
        }

        $totalHoras = round($totalMinutos / 60, 2);

        $averagePerDay = $usageDays ? round($totalHoras / $usageDays, 2) : 0;



        return view('usuario.inicio', [
            'mensualidad' => $mensualidad,
            'usageDays' => $usageDays,
            'totalHoras' => $totalHoras,
            'totalReservations' => $totalReservations,
            'averagePerDay' => $averagePerDay,
        ]);
    }

    public function parqueaderos()
    {
        // Traemos todos los parqueaderos con sus movimientos y vehículos
        $parqueaderos = Parqueadero::with('movimientos.vehiculo')->get();

        return view('usuario.parqueaderos', compact('parqueaderos'));
    }


    public function perfil()
    {
        return view('usuario.perfil.index');
    }

    public function editPerfil()
    {
        $user = Auth::user();
        return view('usuario.perfil.edit', compact('user'));
    }

    /**
     * Actualizar perfil del usuario
     */
    public function updatePerfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'tipo_documento' => 'nullable|string|max:10',
            'numero_documento' => 'nullable|string|max:50',
            'telefono' => 'nullable|string|max:20',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($user->imagen) {
                Storage::disk('public')->delete($user->imagen);
            }
            $user->imagen = $request->file('imagen')->store('usuarios', 'public');
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->tipo_documento = $request->tipo_documento;
        $user->numero_documento = $request->numero_documento;

        $user->save();

        return redirect()->route('usuario.perfil')->with('success', 'Perfil actualizado correctamente.');
    }

    public function transacciones()
    {
        return view('usuario.transacciones');
    }

    // Listar vehículos del usuario
    public function vehiculos()
    {
        $vehiculos = auth()->user()->vehiculos; // trae solo los del usuario
        return view('usuario.vehiculos.index', compact('vehiculos'));
    }

    // Formulario para crear vehículo
    public function vehiculosCreate()
    {
        return view('usuario.vehiculos.create');
    }

    // Guardar vehículo
    public function vehiculosStore(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa',
            'tipo_vehiculo' => 'required|in:carro,moto',
        ]);

        Vehiculo::create([
            'user_id' => auth()->id(),
            'placa' => strtoupper($request->placa),
            'tipo_vehiculo' => $request->tipo_vehiculo,
        ]);

        return redirect()->route('usuario.vehiculos.index')->with('success', 'Vehículo agregado correctamente');
    }

    // Formulario de edición
    public function vehiculosEdit($id)
    {
        $vehiculo = auth()->user()->vehiculos()->findOrFail($id);
        return view('usuario.vehiculos.edit', compact('vehiculo'));
    }

    // Actualizar vehículo
    public function vehiculosUpdate(Request $request, $id)
    {
        $vehiculo = auth()->user()->vehiculos()->findOrFail($id);

        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
            'tipo_vehiculo' => 'required|in:carro,moto',
        ]);

        $vehiculo->placa = strtoupper($request->placa);
        $vehiculo->tipo_vehiculo = $request->tipo_vehiculo;
        $vehiculo->save();

        return redirect()->route('usuario.vehiculos.index')->with('success', 'Vehículo actualizado correctamente.');
    }
}
