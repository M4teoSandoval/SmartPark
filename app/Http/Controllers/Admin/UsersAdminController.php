<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Parqueadero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersAdminController extends Controller
{
    // ✅ Mostrar usuarios relacionados al parqueadero del admin
    public function index()
    {
        $parqueadero = Parqueadero::where('propietario_id', Auth::id())->firstOrFail();

        // Usuarios con mensualidades en este parqueadero
        $usuariosMensualidades = User::whereHas('mensualidades', function($q) use ($parqueadero){
            $q->where('parqueadero_id', $parqueadero->id);
        });

        // Usuarios con movimientos en este parqueadero
        $usuariosMovimientos = User::whereHas('vehiculos.movimientos', function($q) use ($parqueadero){
            $q->where('parqueadero_id', $parqueadero->id);
        });

        $usuarios = $usuariosMensualidades
            ->union($usuariosMovimientos)
            ->distinct()
            ->get();

        return view('admin.usuarios.index', compact('usuarios'));
    }

    // ✅ Form para crear usuario manualmente
    public function create()
    {
        return view('admin.usuarios.create');
    }

    // ✅ Registrar usuario manualmente desde el admin
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'tipo_documento' => 'required',
            'numero_documento' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'tipo_documento' => $request->tipo_documento,
            'numero_documento' => $request->numero_documento,
            'role_id' => 2, // usuario normal
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.usuarios')
            ->with('success', 'Usuario creado correctamente.');
    }
}
