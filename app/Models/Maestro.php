<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maestro extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'carrera_id',
        // otros campos
    ];

    public function visitas()
    {
        return $this->hasMany(Visita::class);
    }
}
