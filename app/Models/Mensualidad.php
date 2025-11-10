<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mensualidad extends Model
{
    protected $table = 'mensualidades'; // ✅ FIX

    protected $fillable = [
        'usuario_id',
        'vehiculo_id',
        'parqueadero_id',
        'fecha_inicio',
        'fecha_fin',
        'estado',
        'valor'
    ];
    public function getDiasRestantesAttribute()
    {
        if (!$this->fecha_fin) return null;

        $fin = Carbon::parse($this->fecha_fin);
        $hoy = Carbon::now();
        $diff = $hoy->diffInDays($fin, false);

        return $diff > 0 ? $diff : 0;
    }

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
