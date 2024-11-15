<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    protected $table = 'maestros';

    // Asegúrate de que 'tipo_usuario' esté en el array $fillable
    protected $fillable = [
        'nombre',
        'numero_empleado',
        'carrera_ads',
        'turno',
        'sexo',
        'puesto',
        'tipo_usuario', // Añadido aquí para permitir la asignación masiva
    ];

    // Asigna 'Docente' como valor por defecto para tipo_usuario si no se proporciona
    protected $attributes = [
        'tipo_usuario' => 'Docente', // Valor por defecto
    ];
}
