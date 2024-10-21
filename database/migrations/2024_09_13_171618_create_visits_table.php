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
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('servicio', ['computo', 'acervo', 'prestamo']);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });

        // Tabla de carreras 
        Schema::create('carreras', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->timestamps();
        });

        // Actualizar la tabla de usuarios para referenciar a la tabla de carreras
        Schema::table('usuarios', function (Blueprint $table) {
            $table->foreignId('carrera_id')->nullable()->constrained('carreras')->onDelete('set null');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->dropForeign(['carrera_id']);
            $table->dropColumn('carrera_id');
        });

        Schema::dropIfExists('carreras');
        Schema::dropIfExists('visitas');
        Schema::dropIfExists('usuarios');
    }
};
