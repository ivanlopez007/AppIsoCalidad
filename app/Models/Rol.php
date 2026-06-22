<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\Factory; // <- Añade esta importación

class Rol extends Model
{
    use HasFactory;

    protected $table = 'rols'; // Esto le dice que use la tabla en plural
    protected $fillable = ['nombre'];

    /**
     * Fuerza al modelo a usar el factory en singular sin adivinar.
     */
    protected static function newFactory(): Factory
    {
        return \Database\Factories\RolFactory::new();
    }

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'rol_id');
    }
}
