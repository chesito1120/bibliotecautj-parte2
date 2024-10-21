<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_dewey', 'titulo', 'autor', 'editorial', 'edicion', 'area_conocimiento', 'pag', 'isbn', 'area_sumario', 'donacion_compra', 'fecha_ingreso'
    ];
}
