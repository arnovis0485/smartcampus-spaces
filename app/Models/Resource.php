<?php

namespace App\Models;

use Database\Factories\ResourceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Resource extends Model
{
    /** @use HasFactory<ResourceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
    ];

    /**
     * Relación N:M con espacios, a través de la tabla pivote resource_space.
     */
    public function spaces(): BelongsToMany
    {
        return $this->belongsToMany(Space::class, 'resource_space')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
