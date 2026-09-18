<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tabla pivote que resuelve la relación N:M "espacio_recursos" del MER
     * de la Actividad 1 (un espacio tiene muchos recursos y un recurso puede
     * estar en muchos espacios).
     *
     * Convención de nombres para tablas pivote (Guía de Convenciones Laravel):
     * nombres de los dos modelos en singular, en estricto orden alfabético,
     * unidos por guion bajo -> Resource + Space => "resource_space".
     */
    public function up(): void
    {
        Schema::create('resource_space', function (Blueprint $table) {
            $table->id(); // id_espacio_recurso -> id

            // FKs en singular + _id, con borrado en cascada: si se elimina el
            // espacio o el recurso, sus asociaciones en la tabla pivote también
            // deben desaparecer (lógica de negocio: no dejar registros huérfanos).
            $table->foreignId('space_id')->constrained('spaces')->cascadeOnDelete();
            $table->foreignId('resource_id')->constrained('resources')->cascadeOnDelete();

            $table->unsignedInteger('quantity')->default(1); // cantidad, default() explícito

            $table->timestamps();

            // Un mismo recurso no debería registrarse dos veces para el mismo espacio.
            $table->unique(['space_id', 'resource_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('resource_space');
    }
};
