<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ParqueaderoController extends Controller
{
    /**
     * Mostrar la configuración del parqueadero
     */
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        return view('admin.ajustes', compact('parqueadero'));
    }

    /**
     * Crear parqueadero si aún no existe
     */
    public function store(Request $request)
    {
        if (Parqueadero::where('propietario_id', Auth::id())->exists()) {
            return back()->with('error', 'Ya tienes un parqueadero registrado.');
        }

        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'capacidad_carros' => 'required|integer|min:0',
            'capacidad_motos' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // ✅ Validación de imagen
        ]);

        $imagenPath = $request->hasFile('imagen') ? $request->file('imagen')->store('parqueaderos', 'public') : null;

        Parqueadero::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'ciudad' => $request->ciudad,
            'capacidad_carros' => $request->capacidad_carros,
            'capacidad_motos' => $request->capacidad_motos,
            'propietario_id' => Auth::id(),
            'imagen' => $imagenPath,
        ]);

        return redirect()->route('admin.ajustes')->with('success', 'Parqueadero creado correctamente.');
    }

    /**
     * Editar parqueadero existente (solo si es del usuario)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'capacidad_carros' => 'required|integer|min:0',
            'capacidad_motos' => 'required|integer|min:0',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $parqueadero = Parqueadero::where('id', $id)
            ->where('propietario_id', Auth::id())
            ->firstOrFail();

        // Subir nueva imagen si se envía
        if ($request->hasFile('imagen')) {
            // Borrar imagen anterior si existe
            if ($parqueadero->imagen) {
                Storage::disk('public')->delete($parqueadero->imagen);
            }
            $parqueadero->imagen = $request->file('imagen')->store('parqueaderos', 'public');
        }

        // Asignar los demás campos
        $parqueadero->nombre = $request->nombre;
        $parqueadero->direccion = $request->direccion;
        $parqueadero->ciudad = $request->ciudad;
        $parqueadero->capacidad_carros = $request->capacidad_carros;
        $parqueadero->capacidad_motos = $request->capacidad_motos;

        // Guardar todos los cambios
        $parqueadero->save();

        return redirect()->route('admin.ajustes')->with('success', 'Parqueadero actualizado correctamente.');
    }
}
