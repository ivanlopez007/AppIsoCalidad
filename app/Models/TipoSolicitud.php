<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoSolicitud extends Model
{
    use HasFactory;   
    protected $table = 'tipo_solicituds';

    protected $fillable = ['nombre', 'descripcion'];

    public function tipoSolicitud()
    {
        return $this->belongsTo(DisposicionFinal::class);
    }
}
