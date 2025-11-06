<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'user_id',
        'tipo_vehiculo',
        'placa'
    ];

    // Un vehículo pertenece a un usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Un vehículo tiene muchas reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Un vehículo tiene muchas mensualidades
    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class);
    }

    // Un vehículo tiene muchos movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Un vehículo tiene muchas transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
