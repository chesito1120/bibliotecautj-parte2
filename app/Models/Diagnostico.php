<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente_id',
        'psicologo_id',
        'descripcion',
        'fecha',
    ];

    public function psicologo()
    {
        return $this->belongsTo(Psicologo::class);
    }

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}
