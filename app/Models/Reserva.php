<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $fillable = [
        'usuario_id',
        'vehiculo_id',
        'parqueadero_id',
        'fecha_reserva',
        'hora_inicio',
        'hora_fin',
        'estado'
    ];

    protected $casts = [
        'fecha_reserva' => 'date',
        'hora_inicio' => 'datetime:H:i', // si quieres manejarlo como hora
        'hora_fin' => 'datetime:H:i',
    ];


    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }

    public function transaccion()
    {
        return $this->hasOne(Transaccion::class);
    }
}
