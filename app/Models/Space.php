<?php

namespace App\Models;

use Database\Factories\SpaceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Space extends Model
{
    /** @use HasFactory<SpaceFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'location_block',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'capacity' => 'integer',
        ];
    }

    /**
     * Un espacio puede tener muchas reservas.
     */
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Relación N:M con recursos, a través de la tabla pivote resource_space.
     * Laravel asume por convención el orden alfabético del nombre de la pivote.
     */
    public function resources(): BelongsToMany
    {
        return $this->belongsToMany(Resource::class, 'resource_space')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
