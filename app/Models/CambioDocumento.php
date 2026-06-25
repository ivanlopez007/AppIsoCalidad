<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CambioDocumento extends Model
{
    protected $table = 'cambio_documentos';
    protected $fillable = [
        'folio',
        'nombre_documento',
        'usuario_id',
        'nivel_id',
        'sub_nivel_id',
        'url_documento',
        'version',
        'numero_iso',
        'aprobar_id',
        'localidad_id',
        'area_id',
        'tipo_solicitud_id',
        'lugar_retencion_id',
        'periodo_retencion_id',
        'disposicion_final_id',
        'comentario',
        'created_at',
        'updated_at',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function nivel()
    {
        return $this->belongsTo(Nivel::class, 'nivel_id');
    }
    public function subNivel()
    {
        return $this->belongsTo(SubNivel::class, 'sub_nivel_id');
    }

    public function aprobar()
    {
        return $this->belongsTo(Usuario::class, 'aprobar_id');
    }
    public function localidad()
    {
        return $this->belongsTo(Localidad::class, 'localidad_id');
    }
    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }
    public function tipoSolicitud()
    {
        return $this->belongsTo(TipoSolicitud::class, 'tipo_solicitud_id');
    }
    public function lugarRetencion()
    {
        return $this->belongsTo(LugarRetencion::class, 'lugar_retencion_id');
    }
    public function periodoRetencion()
    {
        return $this->belongsTo(PeriodoRetencion::class, 'periodo_retencion_id');
    }
    
    public function disposicionFinal()
    {
        return $this->belongsTo(DisposicionFinal::class, 'disposicion_final_id');
    }
}
