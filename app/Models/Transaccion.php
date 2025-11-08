<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{   
    protected $table = 'transacciones';

    protected $fillable = [
        'usuario_id',
        'parqueadero_id',
        'vehiculo_id',
        'reserva_id',
        'mensualidad_id',
        'tipo_transaccion',
        'valor',
        'metodo_pago',
        'fecha'
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

    public function reserva()
    {
        return $this->belongsTo(Reserva::class);
    }

    public function mensualidad()
    {
        return $this->belongsTo(Mensualidad::class);
    }
}
