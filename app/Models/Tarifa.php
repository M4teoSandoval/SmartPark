<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    protected $fillable = [
        'parqueadero_id',
        'tipo_vehiculo',
        'valor_minuto',
        'valor_hora',
        'valor_mensualidad'
    ];

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }
}
