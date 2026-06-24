<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenciaUsuario extends Model
{
    //
    use HasFactory;
    
    protected $table = 'preferencia_usuarios';

    protected $fillable = [
        'usuario_id',
        'tema',
        'idioma',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
