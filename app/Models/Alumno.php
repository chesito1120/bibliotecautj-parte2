<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumno extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricula',
        'nombre',
        'carrera_id',
        // otros campos
    ];

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
