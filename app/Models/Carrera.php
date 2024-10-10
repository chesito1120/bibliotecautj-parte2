<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    // Añade 'nivel_educativo' a los campos asignables
    protected $fillable = ['nombre', 'nivel_educativo', 'created_at', 'updated_at'];
}
