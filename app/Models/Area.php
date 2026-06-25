<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    use HasFactory;

    protected $table = 'areas'; // Esto le dice que use la tabla en plural
    protected $fillable = ['area'];


    public static function newFactory()
    {
        return \Database\Factories\AreaFactory::new();
    }

    public function usuarios()
    {
        return $this->hasOne(Usuario::class);
    }
    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'area_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'area_id');
    }
}
