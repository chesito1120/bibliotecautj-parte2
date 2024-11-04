<?php

namespace App\Imports;

use App\Models\Maestro;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class MaestrosImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
        return new Maestro([
           'nombre' => $row[0],
            'numero_empleado' => $row[1],
            'carrera_ads' => $row[2],
            'turno' => $row[3],
            'sexo' => $row[4],
            'puesto' => $row[5],
        ]);
    }


    public function rules(): array
    {
        return [
            '0' => 'required', 
            '1' => 'required', 
            '2' => 'required', 
            '3' => 'required', 
            '4' => 'required', 
            '5' => 'required', 

        ];
    }
}
