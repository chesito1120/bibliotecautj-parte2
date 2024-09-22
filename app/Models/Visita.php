<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;

    // Definir los campos que se pueden llenar mediante asignación masiva
    protected $fillable = [
        'alumno_id',
        'maestro_id',
        'carrera_id',
        'servicio',
        'fecha',
    ];

    // Definir la relación con el modelo Alumno
    public function alumno()
    {
        return $this->belongsTo(Alumno::class);
    }

    // Definir la relación con el modelo Maestro
    public function maestro()
    {
        return $this->belongsTo(Maestro::class);
    }

    // Definir la relación con el modelo Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class);
    }
}
