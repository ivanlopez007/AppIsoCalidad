<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;

    protected $table = 'localidads'; // Esto le dice que use la tabla en plural
    protected $fillable = ['localidad'];

    /**
     * Fuerza al modelo a usar su factory en singular sin adivinar.
     */
    protected static function newFactory()
    {
        return \Database\Factories\LocalidadFactory::new();
    }

    public function usuarios()
    {
        return $this->hasMany(Usuario::class, 'localidad_id');
    }

    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'localidad_id');
    }
}
