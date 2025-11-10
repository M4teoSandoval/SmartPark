<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // <-- Asegúrate de importar Auth

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirige a los usuarios según su rol después del login
     */
    protected function redirectTo()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user(); // mejor que auth()->user() para Intelephense

        if ($user->role->id === 1) {
            return '/admin';
        }

        return '/usuario';
    }

    /**
     * Crear una nueva instancia del controlador.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
