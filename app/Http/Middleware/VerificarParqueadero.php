<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\Parqueadero;

class VerificarParqueadero
{
    public function handle($request, Closure $next)
    {
        $user = Auth::user();

        // ✅ Si no hay usuario autenticado
        if (!$user) {
            return redirect('/login');
        }

        // ✅ Verificar si el usuario tiene un parqueadero registrado
        $parqueadero = Parqueadero::where('propietario_id', $user->id)->first();

        if (!$parqueadero) {
            return redirect()->route('admin.parqueadero')
                ->with('error', 'Debes registrar los datos de tu parqueadero antes de continuar.');
        }

        return $next($request);
    }
}
