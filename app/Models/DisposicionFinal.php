<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposicionFinal extends Model
{
    use HasFactory;
    protected $table = 'disposicion_finals';
    protected $fillable = ['nombre', 'descripcion'];

    public function tipoSolicitud()
    {
        return $this->hasMany(TipoSolicitud::class);
    }
}
