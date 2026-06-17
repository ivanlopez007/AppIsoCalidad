<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{

    use HasFactory;

    protected $table = 'area';
    protected $fillable = ['area'];


    public static function newFactory()
    {
        return \Database\Factories\AreaFactory::new();
    }

    public function usuarios()
    {
        return $this->hasOne(Usuario::class);
    }
}
