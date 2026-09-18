<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Reservation>
 */
class ReservationFactory extends Factory
{
    public function definition(): array
    {
        $inicio = fake()->numberBetween(7, 18);

        return [
            'user_id' => User::factory(),
            'space_id' => Space::factory(),
            'date' => fake()->dateTimeBetween('-1 week', '+2 weeks')->format('Y-m-d'),
            'start_time' => sprintf('%02d:00:00', $inicio),
            'end_time' => sprintf('%02d:00:00', $inicio + 1),
            'status' => fake()->randomElement(['pendiente', 'aprobada', 'aprobada', 'rechazada', 'cancelada']),
        ];
    }
}
