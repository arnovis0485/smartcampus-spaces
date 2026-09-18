<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Traducción de la entidad "espacios" del MER de la Actividad 1
     * (aulas, laboratorios, auditorios y salas de reunión).
     */
    public function up(): void
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id(); // PK estándar (id_espacio -> id)

            $table->string('name'); // nombre_espacio
            $table->unsignedInteger('capacity')->default(1); // capacidad, default() explícito
            $table->string('location_block', 50)->nullable(); // ubicacion_bloque, campo nulo permitido

            // estado_espacio: disponible | mantenimiento | fuera_de_servicio
            $table->string('status', 20)->default('disponible');

            $table->timestamps();

            // índice explícito: filtrar espacios disponibles es una consulta muy frecuente
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('spaces');
    }
};
