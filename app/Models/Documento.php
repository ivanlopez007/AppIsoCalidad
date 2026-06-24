<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $fillable = [
        'nombre',
        'descripcion',
        'fecha_creacion',
        'fecha_modificacion',
        'estado',
        'sub_nivel_id',
    ];

    public function subNivel()
    {
        return $this->belongsTo(SubNivel::class, 'sub_nivel_id');
    }

    public function cambioDocumento()
    {
        return $this->hasMany(CambioDocumento::class, 'documento_id');
    }
}
