<?php

namespace App\Http\Controllers;

use App\Models\Mensualidad;
use App\Models\Parqueadero;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MensualidadUsuarioController extends Controller
{

    public function index()
    {
        $mensualidades = Auth::user()->mensualidades()->with('parqueadero', 'vehiculo')->get();


        return view('usuario.mensualidad.index', compact('mensualidades'));
    }

    public function create(Parqueadero $parqueadero)
    {
        $vehiculos = Auth::user()->vehiculos;

        $tarifa = $parqueadero->tarifas()->first(); // ajusta según tu lógica

        if (!$tarifa || !$tarifa->valor_mensualidad) {
            return back()->with('error', 'No hay tarifa mensual configurada.');
        }

        $valorMensualidad = $tarifa->valor_mensualidad;




        return view('usuario.mensualidad.create', compact('parqueadero', 'vehiculos', 'valorMensualidad'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'parqueadero_id' => 'required|exists:parqueaderos,id'
        ]);

        $parqueadero = Parqueadero::findOrFail($request->parqueadero_id);

        $tarifa = $parqueadero->tarifas()
            ->where('tipo_vehiculo', $request->tipo_vehiculo ?? 'moto')
            ->first();

        if (!$tarifa || !$tarifa->valor_mensualidad) {
            return back()->with('error', 'La tarifa mensual no está disponible.');
        }

        $valor = $tarifa->valor_mensualidad;

        // Fechas
        $inicio = now();
        $fin = now()->addDays(30);

        // Registrar mensualidad
        $mensualidad = Mensualidad::create([
            'usuario_id' => Auth::id(),
            'vehiculo_id' => $request->vehiculo_id,
            'parqueadero_id' => $parqueadero->id,
            'fecha_inicio' => $inicio,
            'fecha_fin' => $fin,
            'valor' => $valor,
            'estado' => 'activa'
        ]);

        // Registrar transacción
        Transaccion::create([
            'usuario_id' => Auth::id(),
            'parqueadero_id' => $parqueadero->id,
            'vehiculo_id' => $request->vehiculo_id,
            'mensualidad_id' => $mensualidad->id,
            'tipo_transaccion' => 'mensualidad',
            'valor' => $valor,
            'metodo_pago' => 'PayU',
            'fecha' => now()
        ]);

        return redirect()->route('usuario.mensualidad.index')
            ->with('success', 'Mensualidad activada correctamente.');
    }
}
