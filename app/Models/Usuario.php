<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable;

    // Fuerza a Laravel a usar la tabla en singular
    protected $table = 'usuarios';

    /**
     * Los atributos que son asignables en masa.
     */
    protected $fillable = [
        'email',
        'password',
        'rol_id',
        'localidad_id',
        'area_id',
        'jefe_inmediato_id',
    ];

    /**
     * Los atributos que deben ocultarse para la serialización (como en APIs).
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
        static::created(function($usuario){
            $usuario->preferencias()->create([
                'tema' => 'light', // Por defecto, el tema es 'light'
                'idioma' => 'es',
            ]);
        });
    }

    /**
     * Relación: Un usuario pertenece a un Rol
     */
    public function rol(): BelongsTo
    {
        return $this->belongsTo(Rol::class, 'rol_id');
    }

    /**
     * Relación: Un usuario pertenece a una Localidad
     */
    public function localidad(): BelongsTo
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }

    /**
     * Relación: Un usuario pertenece a un Área
     */
    public function area(): BelongsTo
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    /**
     * Relación: Un usuario tiene un Jefe Inmediato (Auto-relación)
     */
    public function jefeInmediato(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'jefe_inmediato_id');
    }

    /**
     * Relación: Un usuario puede tener muchos subordinados (empleados a su cargo)
     */
    public function subordinados(): HasMany
    {
        return $this->hasMany(Usuario::class, 'jefe_inmediato_id');
    }

    public function infoUsuario()
    {
        return $this->hasOne(InfoUsuario::class, 'usuario_id');
    }

    public function preferencias()
    {
        return $this->hasOne(PreferenciaUsuario::class, 'usuario_id');
    }
    public function cambiosDocumento()
    {
        return $this->hasMany(CambioDocumento::class, 'usuario_id');
    }
    public function cambiosDocumentoAprobados()
    {
        return $this->hasMany(CambioDocumento::class, 'aprobar_id');
    }
}
