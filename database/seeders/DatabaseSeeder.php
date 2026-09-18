<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * NOTA: este DatabaseSeeder solo pobla las tablas del sistema
     * SmartCampus Spaces (Actividad 2). Las tablas "departamentos" y
     * "municipios" pertenecen a otro proyecto y no se tocan aquí.
     */
    public function run(): void
    {
        // Usuario administrador por defecto (Administrador del Campus).
        User::factory()->admin()->create([
            'name' => 'Admin SmartCampus',
            'email' => 'admin@smartcampus.edu',
        ]);

        // Usuario de prueba genérico (se conserva el que traía el starter kit).
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Más solicitantes (estudiantes y docentes) con datos falsos.
        User::factory(10)->create();

        $this->call([
            ResourceSeeder::class,
            SpaceSeeder::class,
            ReservationSeeder::class,
            IncidentSeeder::class,
        ]);
    }
}
