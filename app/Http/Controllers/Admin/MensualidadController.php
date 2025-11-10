<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mensualidad;
use App\Models\Vehiculo;
use App\Models\Parqueadero;
use App\Models\User;
use App\Models\Tarifa;
use App\Models\Transaccion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MensualidadController extends Controller
{
    // ================================================
    // ✅ LISTAR MENSUALIDADES
    // ================================================
    public function index()
    {
        // Obtener todos los IDs de parqueaderos que le pertenecen al admin
        $parqueaderoIds = Parqueadero::where('propietario_id', Auth::id())->pluck('id');

        // Obtener todas las mensualidades de esos parqueaderos
        $mensualidades = Mensualidad::with(['usuario', 'vehiculo', 'parqueadero'])
            ->whereIn('parqueadero_id', $parqueaderoIds)
            ->orderBy('fecha_inicio', 'desc')
            ->get();

        return view('admin.mensualidades.index', compact('mensualidades'));
    }


    // ================================================
    // ✅ FORMULARIO PARA CREAR
    // ================================================
    public function create()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->firstOrFail();

        $vehiculos = Vehiculo::all();
        $usuarios = User::all();

        return view('admin.mensualidades.create', compact('usuarios', 'vehiculos'));
    }

    // ================================================
    // ✅ GUARDAR MENSUALIDAD
    // ================================================
    public function store(Request $request)
    {
        $request->validate([
            'usuario_id' => 'required|exists:users,id',
            'vehiculo_id' => 'required|exists:vehiculos,id',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,payu',
        ]);

        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->firstOrFail();

        $vehiculo = Vehiculo::findOrFail($request->vehiculo_id);

        // ✅ TARIFA AUTOMÁTICA
        $tarifa = Tarifa::where('parqueadero_id', $parqueadero->id)
            ->where('tipo_vehiculo', $vehiculo->tipo_vehiculo)
            ->firstOrFail();

        $valor = $tarifa->valor_mensualidad;

        // ✅ CREAR MENSUALIDAD
        $mensualidad = Mensualidad::create([
            'usuario_id'      => $request->usuario_id,
            'vehiculo_id'     => $vehiculo->id,
            'parqueadero_id'  => $parqueadero->id,
            'fecha_inicio'    => $request->fecha_inicio,
            'fecha_fin'       => $request->fecha_fin,
            'estado'          => 'activa',
            'valor'           => $valor,
            'metodo_pago'     => $request->metodo_pago,
        ]);

        // =====================================================
        // ✅ REGISTRAR TRANSACCIÓN AUTOMÁTICAMENTE
        // =====================================================
        Transaccion::create([
            'usuario_id'     => $request->usuario_id,
            'vehiculo_id'    => $vehiculo->id,
            'parqueadero_id' => $parqueadero->id,
            'tipo_transaccion'           => 'mensualidad',
            'valor'          => $valor,
            'fecha'          => now(),
            'metodo_pago'    => $request->metodo_pago,
        ]);

        return redirect()->route('admin.mensualidades')
            ->with('success', 'Mensualidad creada correctamente.');
    }

    // ================================================
    // ✅ MOSTRAR DETALLES
    // ================================================
    public function show($id)
    {
        $mensualidad = Mensualidad::with(['usuario', 'vehiculo'])->findOrFail($id);

        return view('admin.mensualidades.show', compact('mensualidad'));
    }

    // ================================================
    // ✅ FORM EDITAR
    // ================================================
    public function edit($id)
    {
        $mensualidad = Mensualidad::findOrFail($id);

        return view('admin.mensualidades.edit', compact('mensualidad'));
    }

    // ================================================
    // ✅ ACTUALIZAR
    // ================================================
    public function update(Request $request, $id)
    {
        $request->validate([
            'fecha_fin'   => 'required|date',
            'estado'      => 'required|in:activa,vencida,cancelada',
            'metodo_pago' => 'required|in:efectivo,tarjeta,transferencia,payu',
        ]);

        $mensualidad = Mensualidad::findOrFail($id);

        $mensualidad->update([
            'fecha_fin'   => $request->fecha_fin,
            'estado'      => $request->estado,
            'metodo_pago' => $request->metodo_pago,
        ]);

        return redirect()->route('admin.mensualidades')
            ->with('success', 'Mensualidad actualizada correctamente.');
    }
}
