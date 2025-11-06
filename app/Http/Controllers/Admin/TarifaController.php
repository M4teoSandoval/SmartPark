<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tarifa;
use App\Models\Parqueadero;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    public function index()
    {
        // Obtener el parqueadero del admin (por ahora el primero)
        $parqueadero = Parqueadero::first();

        // Obtener tarifas relacionadas
        $tarifas = Tarifa::where('parqueadero_id', $parqueadero->id)->get();

        return view('admin.tarifas', compact('tarifas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_vehiculo' => 'required',
            'valor_hora' => 'required|numeric|min:0',
            'valor_minuto' => 'required|numeric|min:0',
            'valor_mensualidad' => 'required|numeric|min:0',
        ]);

        $parqueadero = Parqueadero::first();

        Tarifa::create([
            'tipo_vehiculo' => $request->tipo_vehiculo,
            'valor_hora' => $request->valor_hora,
            'valor_minuto' => $request->valor_minuto,
            'valor_mensualidad' => $request->valor_mensualidad,
            'parqueadero_id' => $parqueadero->id,
        ]);

        return back()->with('success', 'Tarifa registrada correctamente.');
    }

    public function destroy($id)
    {
        Tarifa::destroy($id);

        return back()->with('success', 'Tarifa eliminada.');
    }
}
