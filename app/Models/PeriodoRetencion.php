<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodoRetencion extends Model
{
    use HasFactory;
    protected $table = 'periodo_retencions';
    protected $fillable = ['tiempo', 'periodo_tiempo'];
    

    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'periodo_retencion_id');
    }

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'periodo_retencion_id');
    }


}
