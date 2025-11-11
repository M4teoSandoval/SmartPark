<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que se pueden llenar masivamente
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'tipo_documento',
        'numero_documento',
        'role_id',
    ];

    /**
     * Campos ocultos
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role && $this->role->nombre === 'admin';
    }

    /**
     * Casts de datos
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ============================
    //        RELACIONES
    // ============================

    /**
     * Un usuario pertenece a un rol
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Un usuario tiene muchos vehículos
     */
    public function vehiculos()
    {
        return $this->hasMany(Vehiculo::class);
    }

    /**
     * Un usuario tiene muchas reservas
     */
    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'usuario_id');
    }

    /**
     * Un usuario tiene muchas mensualidades
     */
    public function mensualidades()
    {
        return $this->hasMany(Mensualidad::class, 'usuario_id');
    }

    /**
     * Un usuario tiene muchas transacciones
     */
    public function transacciones()
    {
        return $this->hasMany(Transaccion::class, 'usuario_id');
    }

    /**
     * Un usuario puede ser propietario de parqueaderos
     */
    public function parqueaderosPropios()
    {
        return $this->hasMany(Parqueadero::class, 'propietario_id');
    }
}
