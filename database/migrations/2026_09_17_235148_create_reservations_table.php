<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Traducción de la entidad "reservas" del MER de la Actividad 1.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // id_reserva -> id

            // FKs en singular + _id. Cascada: si se borra el usuario o el
            // espacio, sus reservas históricas se eliminan con él.
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();

            $table->date('date'); // fecha
            $table->time('start_time'); // hora_inicio
            $table->time('end_time'); // hora_fin

            // estado_reserva: pendiente | aprobada | rechazada | cancelada
            $table->string('status', 20)->default('pendiente');

            $table->timestamps();

            // Índice compuesto: la consulta más frecuente del sistema es
            // "disponibilidad de un espacio en una fecha" (Módulo de Reservas).
            $table->index(['space_id', 'date']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
