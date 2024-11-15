<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $table = 'alumnos';

    protected $fillable = [
        'matricula',
        'nombre',
        'carrera',
        'grado',
        'grupo',
        'turno',
        'sexo',
        'mail_institucional',
        'tipo_usuario',
    ];    
}

