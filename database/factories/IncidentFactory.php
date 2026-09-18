<?php

namespace Database\Factories;

use App\Models\Incident;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Incident>
 */
class IncidentFactory extends Factory
{
    public function definition(): array
    {
        $descripciones = [
            'El proyector no enciende.',
            'El aire acondicionado presenta fugas de agua.',
            'El tablero inteligente no responde al tacto.',
            'Faltan sillas respecto a la capacidad registrada.',
            'El sistema de sonido tiene interferencia.',
        ];

        return [
            'reservation_id' => Reservation::factory(),
            'user_id' => User::factory(),
            'description' => fake()->randomElement($descripciones),
            'reported_at' => fake()->dateTimeBetween('-1 week', 'now'),
            'status' => fake()->randomElement(['reportado', 'en_proceso', 'resuelto']),
        ];
    }
}
