<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParqueaderoController extends Controller
{
    // ✅ Mostrar configuración del parqueadero
    public function index()
    {
        // Por ahora tomamos el primer parqueadero
        // Luego lo relacionamos con el admin logueado
        $parqueadero = Parqueadero::first();

        return view('admin.parqueadero.index', compact('parqueadero'));
    }

    // ✅ Crear parqueadero si aún no existe
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'capacidad_carros' => 'required|integer|min:0',
            'capacidad_motos' => 'required|integer|min:0',
        ]);

        Parqueadero::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'capacidad_carros' => $request->capacidad_carros,
            'capacidad_motos' => $request->capacidad_motos,
            'propietario_id' => Auth::id(),
        ]);

        return back()->with('success', 'Parqueadero registrado correctamente.');
    }


    // ✅ Actualizar parqueadero existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'capacidad_carros' => 'required|integer|min:0',
            'capacidad_motos' => 'required|integer|min:0',
        ]);

        $parqueadero = Parqueadero::findOrFail($id);

        $parqueadero->update([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'capacidad_carros' => $request->capacidad_carros,
            'capacidad_motos' => $request->capacidad_motos,
        ]);

        return back()->with('success', 'Parqueadero actualizado correctamente.');
    }
}
    