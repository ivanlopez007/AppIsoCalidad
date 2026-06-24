<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DisposicionFinal extends Model
{
    use HasFactory;
    protected $table = 'disposicion_finals';
    protected $fillable = ['disposicion_final'];

    public function cambioDocumento()
    {
        return $this->hasMany(CambioDocumento::class, 'disposicion_final_id');
    }
}
