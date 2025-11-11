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
        'propietario_id',
        'imagen'
    ];

    public function propietario()
    {
        return $this->belongsTo(User::class, 'propietario_id');
    }

    public function tarifas()
    {
        return $this->hasMany(Tarifa::class);
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class);
    }

    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class);
    }

    public function movimientos()
    {
        return $this->hasMany(Movimiento::class);
    }

    public function transacciones()
    {
        return $this->hasMany(Transaccion::class);
    }

    // 🔹 Calcular vehículos dentro actualmente
    public function vehiculosEnParqueadero($tipo = null)
    {
        $query = $this->movimientos()->where('tipo', 'entrada')
            ->whereDoesntHave('movimientos', function ($q) {
                $q->where('tipo', 'salida');
            });

        if ($tipo) {
            $query->whereHas('vehiculo', function ($q) use ($tipo) {
                $q->where('tipo', $tipo);
            });
        }

        return $query->count();
    }

    public function plazasCarrosDisponibles()
    {
        // Movimientos de tipo 'entrada' de vehículos tipo carro que no han salido
        $ocupados = $this->movimientos()
            ->where('tipo', 'entrada')
            ->whereHas('vehiculo', fn($q) => $q->where('tipo', 'carro'))
            ->count()
            - $this->movimientos()
            ->where('tipo', 'salida')
            ->whereHas('vehiculo', fn($q) => $q->where('tipo', 'carro'))
            ->count();

        return $this->capacidad_carros - $ocupados;
    }

    public function plazasMotosDisponibles()
    {
        $ocupados = $this->movimientos()
            ->where('tipo', 'entrada')
            ->whereHas('vehiculo', fn($q) => $q->where('tipo', 'moto'))
            ->count()
            - $this->movimientos()
            ->where('tipo', 'salida')
            ->whereHas('vehiculo', fn($q) => $q->where('tipo', 'moto'))
            ->count();

        return $this->capacidad_motos - $ocupados;
    }
}
