<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarRetencion extends Model
{
    use HasFactory;
    protected $table = 'lugar_retencions';
    protected $fillable = ['nombre', 'descripcion'];

    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'lugar_retencion_id');
    }
}
