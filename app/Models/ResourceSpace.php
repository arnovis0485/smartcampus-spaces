<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Modelo pivote explícito para la tabla resource_space (espacio_recursos en
 * el MER de la Actividad 1). Se usa Pivot en lugar de Model porque la tabla
 * tiene un atributo propio ("quantity") además de las dos llaves foráneas.
 */
class ResourceSpace extends Pivot
{
    protected $table = 'resource_space';

    protected $fillable = [
        'space_id',
        'resource_id',
        'quantity',
    ];
}
