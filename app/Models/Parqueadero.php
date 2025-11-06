<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Parqueadero extends Model
{
    protected $fillable = [
        'nombre',
        'direccion',
        'ciudad',
        'capacidad_carros',
        'capacidad_motos',
        'propietario_id'
    ];

    // Un parqueadero pertenece a un propietario
    public function propietario()
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }

    // Un parqueadero tiene muchas tarifas
    public function tarifas()
    {
        return $this->hasMany(Tarifa::class);
    }

    // Un parqueadero tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Un parqueadero tiene muchas mensualidades
    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class);
    }

    // Un parqueadero tiene muchos movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Un parqueadero tiene muchas transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
