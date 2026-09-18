<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Traducción de la entidad "recursos" del MER de la Actividad 1
     * (equipamiento tecnológico: proyectores, tableros inteligentes, A/C, etc.).
     */
    public function up(): void
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id(); // PK estándar (id_recurso -> id)

            $table->string('name'); // nombre_recurso

            // estado_recurso: operativo | dañado | en_mantenimiento
            $table->string('status', 20)->default('operativo');

            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resources');
    }
};
