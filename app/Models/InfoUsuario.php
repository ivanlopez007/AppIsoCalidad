<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUsuario extends Model
{
    use HasFactory;

    protected $table = 'info_usuarios';

    protected $fillable = [
        'usuario_id',
        'nombre',
        'apellido_paterno',
        'apellido_materno',
    ];

    // Esto le avisa a Laravel exactamente qué Factory usar
   

      public function usuarios()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id', 'id');
    }

      protected static function newFactory()
    {
        return \Database\Factories\InfoUsuarioFactory::new();
    }
}
