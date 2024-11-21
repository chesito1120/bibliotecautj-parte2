<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

    protected $fillable = [
        'libro_id',
        'matricula',
        'nombre',
        'grado',
        'grupo',
        'carrera',
        'isbn',
        'clas_dewey',
        'fecha_prestamo',
        'fecha_devolucion',
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class);
    }
}
