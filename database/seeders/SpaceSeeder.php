<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\Space;
use Illuminate\Database\Seeder;

class SpaceSeeder extends Seeder
{
    public function run(): void
    {
        // Espacios base "conocidos" para la demo (nombres reales, no fake()).
        $espacios = [
            ['name' => 'Laboratorio de Cómputo 1', 'capacity' => 30, 'location_block' => 'Bloque A', 'status' => 'disponible'],
            ['name' => 'Auditorio Principal', 'capacity' => 150, 'location_block' => 'Bloque B', 'status' => 'disponible'],
            ['name' => 'Sala de Estudio 3', 'capacity' => 10, 'location_block' => 'Bloque C', 'status' => 'disponible'],
            ['name' => 'Sala de Reuniones Docentes', 'capacity' => 12, 'location_block' => 'Bloque A', 'status' => 'mantenimiento'],
        ];

        foreach ($espacios as $espacio) {
            $space = Space::create($espacio);

            // Asocia entre 1 y 3 recursos aleatorios existentes al espacio,
            // demostrando la relación N:M con atributo "quantity" en la pivote.
            $recursos = Resource::inRandomOrder()->take(random_int(1, 3))->get();

            foreach ($recursos as $recurso) {
                $space->resources()->syncWithoutDetaching([
                    $recurso->id => ['quantity' => random_int(1, 4)],
                ]);
            }
        }

        // Espacios adicionales generados con factory para tener más volumen de datos.
        Space::factory(6)->create()->each(function (Space $space) {
            $recursos = Resource::inRandomOrder()->take(random_int(0, 3))->get();

            foreach ($recursos as $recurso) {
                $space->resources()->syncWithoutDetaching([
                    $recurso->id => ['quantity' => random_int(1, 4)],
                ]);
            }
        });
    }
}
