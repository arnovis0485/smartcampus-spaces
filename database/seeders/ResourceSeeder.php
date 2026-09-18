<?php

namespace Database\Seeders;

use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceSeeder extends Seeder
{
    public function run(): void
    {
        $recursos = [
            ['name' => 'Proyector', 'status' => 'operativo'],
            ['name' => 'Tablero Inteligente', 'status' => 'operativo'],
            ['name' => 'Aire Acondicionado', 'status' => 'operativo'],
            ['name' => 'Sistema de Sonido', 'status' => 'en_mantenimiento'],
            ['name' => 'Cámara de Videoconferencia', 'status' => 'operativo'],
        ];

        foreach ($recursos as $recurso) {
            Resource::create($recurso);
        }
    }
}
