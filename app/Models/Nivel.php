<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    use HasFactory;
    protected $fillable = ['nivel', 'descripcion'];
    protected $table = 'nivels';

    public function subNiveles()
    {
        return $this->hasMany(SubNivel::class, 'nivel_id');
    }
    public function documentos()
    {
        return $this->hasManyThrough(Documento::class, SubNivel::class, 'nivel_id', 'sub_nivel_id');
    }
    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'nivel_id');
    }
    
}
