<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $fillable = [
        'vehiculo_id',
        'parqueadero_id',
        'user_id',
        'tipo',
        'fecha_hora'
    ];

    protected $casts = [
        'fecha_hora' => 'datetime',
    ];


    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }
}
