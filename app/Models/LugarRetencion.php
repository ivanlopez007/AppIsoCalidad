<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LugarRetencion extends Model
{
    use HasFactory;
    protected $table = 'lugar_retencions';
    protected $fillable = ['lugar_retencion',];

    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'lugar_retencion_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'lugar_retencion_id');
    }
}
