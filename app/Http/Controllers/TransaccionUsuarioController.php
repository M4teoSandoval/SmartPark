<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use Illuminate\Support\Facades\Auth;

class TransaccionUsuarioController extends Controller
{
    public function index()
    {
        $transacciones = Transaccion::with(['vehiculo', 'parqueadero', 'mensualidad'])
            ->where('usuario_id', Auth::id())
            ->orderBy('fecha', 'desc')
            ->get();

        return view('usuario.transacciones.index', compact('transacciones'));
    }
}
