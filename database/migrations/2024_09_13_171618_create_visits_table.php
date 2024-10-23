<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Tabla de usuarios (alumnos y maestros)
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('matricula', 20)->unique();
            $table->string('nombre');
            $table->enum('tipo_usuario', ['alumno', 'maestro']);
            $table->enum('sexo', ['masculino', 'femenino']);
            $table->string('carrera')->nullable();
            $table->enum('turno', ['matutino', 'vespertino'])->nullable();
            $table->timestamps();
        });

        // Tabla de visitas 
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            // Relación con la tabla de usuarios
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('servicio', ['computo', 'acervo', 'prestamo']);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitas');
        Schema::dropIfExists('usuarios');
    }
};
