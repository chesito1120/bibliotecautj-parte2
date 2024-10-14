<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('libros', function (Blueprint $table) {
            $table->id();
            $table->string('clas_dewey');
            $table->string('titulo');
            $table->string('autor');
            $table->string('editorial');
            $table->string('edicion')->nullable();
            $table->string('area_conocimiento');
            $table->string('pag')->nullable();
            $table->string('isbn');
            $table->string('area_sumario')->nullable();
            $table->string('donacion_compra'); 
            $table->string('fecha_ingreso'); 
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('libros');
    }
}
