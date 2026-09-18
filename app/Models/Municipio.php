<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    //
    protected $fillable = [
        //Attributes name
        'departamento_id',
        'nombre',
    ];

    public function departameto()
    {
        $this->belongsTo(Departamento::class, 'departamento_id');
    }
}
