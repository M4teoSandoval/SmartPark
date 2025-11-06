<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $fillable = [
        'usuario_id',
        'vehiculo_id',
        'parqueadero_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'valor'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class);
    }

    public function parqueadero()
    {
        return $this->belongsTo(Parqueadero::class);
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }
}
