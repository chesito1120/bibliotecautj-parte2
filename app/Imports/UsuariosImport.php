<?php

namespace App\Imports;

use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithValidation;

class UsuarioImport implements ToModel, WithValidation
{
    public function model(array $row)
    {
     

        

        return new Usuarios([
            'matricula' => $row[0],
            'nombre' => $row[1],
            'tipo_usuario' => $row[2],
            'sexo' => $row[3],
            'carrera' => $row[4],
            'turno' => $row[5],
            'carrera_id' => $carreraId,
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
            // Asegúrate de que el índice del carrera_id sea el correcto
        ];
    }
}
