<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $fillable = [
        'clas_dewey', 
        'titulo', 
        'autor', 
        'editorial', 
        'edicion', 
        'area_conocimiento', 
        'pag', 
        'isbn', 
        'area_sumario', 
        'donacion_compra', 
        'fecha_ingreso',
        'disponibilidad'
    ];

    public static function buscar($query)
    {
        return Libro::where('titulo', 'like', "%{$query}%")
                    ->orWhere('autor', 'like', "%{$query}%")
                    ->get(); // Devuelve los resultados de búsqueda
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class);
    }
}
