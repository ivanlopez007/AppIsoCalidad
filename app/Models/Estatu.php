<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estatu extends Model
{
    protected $table = 'estatus';
    protected $fillable = [
        'estatus',
        'created_at',
        'updated_at',
    ];

    public function cambioDocumentos()
    {
        return $this->hasMany(CambioDocumento::class, 'estatus_id');
    }
}
