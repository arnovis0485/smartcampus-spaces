<?php

namespace Database\Seeders;

use App\Models\Incident;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class IncidentSeeder extends Seeder
{
    public function run(): void
    {
        // Solo algunas reservas (aprobadas) generan incidentes, simulando el
        // flujo real: "una reserva puede generar varios incidentes".
        $reservas = Reservation::where('status', 'aprobada')->inRandomOrder()->take(5)->get();

        foreach ($reservas as $reserva) {
            Incident::factory()->create([
                'reservation_id' => $reserva->id,
                'user_id' => $reserva->user_id,
            ]);
        }
    }
}
