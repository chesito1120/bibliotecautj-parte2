<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');  // Relaciona con el alumno o maestro
            $table->enum('tipo_usuario', ['Estudiante', 'Docente']);
            $table->string('nombre_completo')->default('Desconocido'); 
            $table->string('matricula')->nullable(); // Para alumnos
            $table->string('numero_empleado')->nullable(); // Para maestros
            $table->string('carrera'); // Unificado
            $table->string('turno');
            $table->string('grupo')->nullable();
            $table->string('grado')->nullable();
            $table->string('actividad')->nullable();
            $table->integer('cantidad_hombres')->nullable(); // Si aplica para el maestro
            $table->integer('cantidad_mujeres')->nullable(); // Si aplica para el maestro
            $table->string('sexo')->nullable();
            $table->enum('servicio', ['computo', 'acervo', 'prestamo']);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitas');
    }
};
