<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Roles de negocio definidos en la Actividad 1 (Administrador del Campus,
     * Estudiante y Docente, agrupados como "Solicitante").
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Campo 'rol' del MER de la Actividad 1 (usuarios.rol).
            // default() -> todo usuario nuevo entra como 'estudiante' si no se especifica otro rol.
            $table->string('role', 20)->default('estudiante')->after('password');

            // index() -> las consultas por rol (ej. listar administradores) son frecuentes.
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role']);
            $table->dropColumn('role');
        });
    }
};
