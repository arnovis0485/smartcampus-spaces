<?php

namespace Database\Seeders;

use App\Models\Reservation;
use App\Models\Space;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReservationSeeder extends Seeder
{
    public function run(): void
    {
        $solicitantes = User::where('role', '!=', 'administrador')->get();
        $espacios = Space::all();

        // Se pasan user_id/space_id directamente a create() para que las
        // reservas usen los usuarios y espacios ya sembrados, en lugar de
        // que la factory genere usuarios/espacios nuevos por su cuenta.
        foreach (range(1, 15) as $i) {
            Reservation::factory()->create([
                'user_id' => $solicitantes->random()->id,
                'space_id' => $espacios->random()->id,
            ]);
        }
    }
}
