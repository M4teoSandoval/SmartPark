<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Validación del formulario de registro
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            
            // ✅ Campos adicionales
            'tipo_documento' => ['required', 'string', 'max:10'],
            'numero_documento' => ['required', 'string', 'max:30'],
            'telefono' => ['required', 'string', 'max:20'],
            
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Crear el nuevo usuario
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            
            // ✅ Campos adicionales
            'tipo_documento' => $data['tipo_documento'],
            'numero_documento' => $data['numero_documento'],

            'numero_documento' => $data['numero_documento'],

            // ✅ Rol por defecto (usuario conductor)
            'role_id' => 2,

            'password' => Hash::make($data['password']),
        ]);
    }
}
