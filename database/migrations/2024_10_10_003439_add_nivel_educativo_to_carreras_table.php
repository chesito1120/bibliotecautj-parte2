<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNivelEducativoToCarrerasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('carreras', function (Blueprint $table) {
            $table->string('nivel_educativo')->nullable(); // O usa $table->enum() si prefieres limitar los valores
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carreras', function (Blueprint $table) {
            $table->dropColumn('nivel_educativo');
        });
    }
}
