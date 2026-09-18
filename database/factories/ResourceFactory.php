<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    public function definition(): array
    {
        $recursos = [
            'Proyector', 'Tablero Inteligente', 'Aire Acondicionado',
            'Computador de Escritorio', 'Sistema de Sonido', 'Cámara de Videoconferencia',
        ];

        return [
            'name' => fake()->randomElement($recursos),
            'status' => fake()->randomElement(['operativo', 'operativo', 'operativo', 'en_mantenimiento', 'dañado']),
        ];
    }
}
