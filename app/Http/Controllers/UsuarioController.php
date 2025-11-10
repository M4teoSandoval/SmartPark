<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function inicio() {
        return view('usuario.inicio');
    }

    public function reservas() {
        return view('usuario.reservas');
    }

    public function parqueaderos() {
        return view('usuario.parqueaderos');
    }

    public function perfil() {
        return view('usuario.perfil');
    }


    public function transacciones() {
        return view('usuario.transacciones');
    }
}