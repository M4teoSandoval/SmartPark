<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $fillable = [
        'user_id',
        'placa',
        'tipo_vehiculo' // carro o moto
    ];

    // Relación con usuario
    public function usuario()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación con reservas
    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    // Relación con mensualidades
    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class);
    }

    // Relación con movimientos
    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    // Relación con transacciones
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
