<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Space>
 */
class SpaceFactory extends Factory
{
    public function definition(): array
    {
        $tipos = ['Laboratorio de Cómputo', 'Sala de Estudio', 'Auditorio', 'Sala de Reuniones', 'Aula'];

        return [
            'name' => fake()->randomElement($tipos).' '.fake()->numberBetween(1, 20),
            'capacity' => fake()->numberBetween(10, 120),
            'location_block' => 'Bloque '.fake()->randomElement(['A', 'B', 'C', 'D']),
            'status' => fake()->randomElement(['disponible', 'disponible', 'disponible', 'mantenimiento']),
        ];
    }
}
