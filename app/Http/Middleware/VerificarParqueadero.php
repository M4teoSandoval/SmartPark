<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Parqueadero;
use Illuminate\Support\Facades\Auth;

class VerificarParqueadero
{
    public function handle(Request $request, Closure $next)
    {
        // Solo aplica para usuarios administradores (role_id = 1)
        if (Auth::check() && Auth::user()->role_id == 1) {

            $parqueadero = Parqueadero::where('propietario_id', Auth::id())->first();

            // Si NO tiene parqueadero, enviarlo a registrar
            if (!$parqueadero && !$request->is('admin/parqueadero*')) {
                return redirect()->route('admin.parqueadero.form')
                                 ->with('warning', 'Debes registrar tu parqueadero antes de continuar.');
            }
        }

        return $next($request);
    }
}
