<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
use App\Models\Movimiento;
use Illuminate\Http\Request;
use App\Models\Parqueadero;



class VehiculoController extends Controller
{
    // ✅ Listar vehículos
    public function index()
    {


        $parqueadero = Parqueadero::where('propietario_id', auth()->id())->first();

        $vehiculos = Vehiculo::where('user_id', auth()->id())->get();

        return view('admin.vehiculos.index', compact('vehiculos'));
    }

    // ✅ Mostrar detalles + historial
    public function show($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        $historial = Movimiento::where('vehiculo_id', $id)
            ->orderBy('fecha_hora', 'desc')
            ->get();

        return view('admin.vehiculos.show', compact('vehiculo', 'historial'));
    }

    // ✅ Form para crear
    public function create()
    {
        return view('admin.vehiculos.create');
    }

    // ✅ Guardar vehículo
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa',
            'tipo_vehiculo' => 'required|in:carro,moto',
        ]);

        Vehiculo::create([
            'placa' => strtoupper($request->placa),
            'tipo_vehiculo' => $request->tipo_vehiculo,
            'user_id' => auth()->id(), // dueño opcional
        ]);

        return redirect()->route('admin.vehiculos')->with('success', 'Vehículo registrado.');
    }

    // ✅ Form para editar
    public function edit($id)
    {
        $vehiculo = Vehiculo::findOrFail($id);
        return view('admin.vehiculos.edit', compact('vehiculo'));
    }

    // ✅ Actualizar vehículo
    public function update(Request $request, $id)
    {
        $vehiculo = Vehiculo::findOrFail($id);

        $request->validate([
            'placa' => "required|unique:vehiculos,placa,$id",
            'tipo_vehiculo' => 'required|in:carro,moto',
        ]);

        $vehiculo->update([
            'placa' => strtoupper($request->placa),
            'tipo_vehiculo' => $request->tipo_vehiculo,
        ]);

        return redirect()->route('admin.vehiculos')->with('success', 'Vehículo actualizado.');
    }
}
