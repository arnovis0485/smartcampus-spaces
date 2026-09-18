<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Traducción de la entidad "incidentes" del MER de la Actividad 1.
     */
    public function up(): void
    {
        Schema::create('incidents', function (Blueprint $table) {
            $table->id(); // id_incidente -> id

            $table->foreignId('reservation_id')->constrained('reservations')->cascadeOnDelete(); // id_reserva
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // id_usuario (quien reporta)

            $table->text('description'); // descripcion
            $table->dateTime('reported_at')->useCurrent(); // fecha_reporte, default() = fecha/hora actual

            // Campo agregado respecto al MER original de la Act. 1 para poder
            // cumplir el objetivo del Módulo de Incidentes: "registro y CONTROL
            // DEL ESTADO de novedades". Sin este campo no habría forma de dar
            // seguimiento al incidente una vez reportado.
            $table->string('status', 20)->default('reportado'); // reportado | en_proceso | resuelto

            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
