<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaccion;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;

class TransaccionController extends Controller
{
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

        $transacciones = Transaccion::where('parqueadero_id', $parqueadero->id)
            ->orderBy('fecha', 'desc')
            ->get();

        return view('admin.transacciones', compact('transacciones'));
    }
}
