<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar mediante asignación masiva
    protected $fillable = [
        'usuario_id',
        'tipo_usuario',
        'nombre_completo',
        'matricula',
        'numero_empleado',
        'carrera',
        'carrera_ads',
        'turno',
        'grupo',
        'grado',
        'actividad',
        'sexo',
        'servicio',
        'cantidad_hombres',
        'cantidad_mujeres',
    ];

    // Relación con el modelo Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class, 'usuario_id')->where('tipo_usuario', 'Estudiante');
    }

    // Relación con el modelo Maestro
    public function maestro()
    {
        return $this->belongsTo(Maestro::class, 'usuario_id')->where('tipo_usuario', 'Docente');
    }
}
