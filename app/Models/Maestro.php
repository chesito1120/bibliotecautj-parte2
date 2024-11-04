<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;
 

    protected $table = 'maestros';

    protected $fillable = [
        'nombre',
        'numero_empleado',
        'carrera_ads',
        'turno',
        'sexo',
        'puesto'
    ]; 
}
