<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologo_id',
        'paciente_id',
        'fecha',
        'motivo',
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
