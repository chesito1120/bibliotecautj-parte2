<?php

namespace App\Imports;

use App\Models\Maestro;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MaestrosImport implements ToModel, WithValidation, WithHeadingRow
{
    public function model(array $row)
    {
        return new Maestro([
            'nombre' => $row['nombre'],
            'numero_empleado' => $row['numero_empleado'],
            'carrera_ads' => $row['carrera_ads'],
            'turno' => $row['turno'],
            'sexo' => $row['sexo'],
            'puesto' => $row['puesto'],
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string',
            'numero_empleado' => 'required|integer|unique:maestros,numero_empleado',
            'carrera_ads' => 'required|string',
            'turno' => 'required|string',
            'sexo' => 'required|string',
            'puesto' => 'required|string',
        ];
    }
}
