<?php

namespace App\Imports;

use App\Models\Alumno;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class AlumnosImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        return new Alumno([
           'matricula' => $row[0],
            'nombre' => $row[1],
            'carrera' => $row[2],
            'grado' => $row[3],
            'grupo' => $row[4],
            'turno' => $row[5],
            'sexo' => $row[6],
            'mail_institucional' => $row[7],
            'tipo_usuario' => $row[8],

        ]);
    }

    public function rules(): array
    {
        return [
            '0' => 'required', // matricula
            '1' => 'required', // nombre
            '2' => 'required', // tipo_usuario
            '3' => 'required', // sexo
            '4' => 'required', // carrera
            '5' => 'required', // turno
            '6' => 'required', // turno
            '7' => 'required', // turno
            '8' => 'required', // turno
        ];
    }
}
