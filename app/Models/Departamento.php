<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = [
        //Attributes name
        'nombre'
    ];

    public function municipios()
    {
        $this->hasMany(Municipio::class, 'departamento_id');
    }
}
