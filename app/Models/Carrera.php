<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    // Puedes definir la tabla si no sigue la convención de nombres
    protected $table = 'carreras';

    // Definir los campos que pueden ser llenados
    protected $fillable = ['nombre', 'nivel'];
}
