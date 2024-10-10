<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios'; // Asegúrate de que este nombre coincide con el de tu tabla

    // Define los campos que se pueden rellenar
    protected $fillable = [
        'matricula',
        'nombre',
        'tipo_usuario',
        'sexo',
        'carrera',
        'turno',
        'carrera_id',
    ];
}
