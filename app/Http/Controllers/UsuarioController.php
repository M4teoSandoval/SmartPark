<?php

namespace App\Http\Controllers;

use App\Models\Parqueadero;
use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Vehiculo;

class UsuarioController extends Controller
{
    public function inicio()
    {
        return view('usuario.inicio');
    }


    public function parqueaderos()
    {
        // Traemos todos los parqueaderos con sus movimientos y vehículos
        $parqueaderos = Parqueadero::with('movimientos.vehiculo')->get();

        return view('usuario.parqueaderos', compact('parqueaderos'));
    }


    public function perfil()
    {
        return view('usuario.perfil');
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

    // Eliminar vehículo
    public function vehiculosDestroy($id)
    {
        $vehiculo = auth()->user()->vehiculos()->findOrFail($id);
        $vehiculo->delete();

        return redirect()->route('usuario.vehiculos.index')->with('success', 'Vehículo eliminado correctamente');
    }
}
