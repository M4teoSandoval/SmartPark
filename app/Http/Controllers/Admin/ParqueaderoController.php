<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParqueaderoController extends Controller
{
    /**
     * ✅ Mostrar la configuración del parqueadero
     * Solo muestra el parqueadero del usuario logueado.
     */
    public function index()
    {
        // Buscar parqueadero del usuario logueado
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        return view('admin.parqueadero.index', compact('parqueadero'));
    }

    /**
     * ✅ Crear parqueadero si aún no existe
     */
    public function store(Request $request)
    {
        // Si ya tiene parqueadero, no permitir crear otro
        if (Parqueadero::where('propietario_id', Auth::id())->exists()) {
            return back()->with('error', 'Ya tienes un parqueadero registrado.');
        }

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


    /**
     * ✅ Editar parqueadero existente (solo si es del usuario)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'capacidad_carros' => 'required|integer|min:0',
            'capacidad_motos' => 'required|integer|min:0',
        ]);

        // Buscar parqueadero del usuario
        $parqueadero = Parqueadero::where('id', $id)
            ->where('propietario_id', Auth::id())
            ->firstOrFail();

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
