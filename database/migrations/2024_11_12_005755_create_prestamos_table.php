<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('libro_id');
            $table->string('matricula');
            $table->string('nombre');
            $table->string('grado');
            $table->string('grupo');
            $table->string('carrera');
            $table->string('isbn');
            $table->string('clas_dewey');
            $table->date('fecha_prestamo');
            $table->date('fecha_devolucion')->nullable();
            $table->timestamps();

            // Claves foráneas
            $table->foreign('libro_id')->references('id')->on('libros')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
