<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubNivel extends Model
{
    use HasFactory;
    protected $table = 'sub_nivels';
    protected $fillable = ['descripcion'];


    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'sub_nivel_id');
    }


}
