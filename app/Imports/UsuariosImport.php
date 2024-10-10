<?php

namespace App\Imports;

use App\Models\Usuarios;
use Maatwebsite\Excel\Concerns\ToModel;

class UsuariosImport implements ToModel {
    public function model(array $row) {
        // Validar que el tipo de usuario sea correcto
        if (!in_array($row[2], ['alumno', 'maestro'])) {
            throw new \Exception("El tipo de usuario '{$row[2]}' es inválido.");
        }

        // Validar que 'carrera_id' esté presente en la fila del CSV
        if (!isset($row[6]) || empty($row[6])) {
            throw new \Exception("El campo 'carrera_id' está ausente o es nulo en la fila del CSV.");
        }

        // Asegúrate de que 'carrera_id' es un entero
        $carreraId = (int)$row[6];

        // Validar que 'carrera_id' exista en la tabla 'carreras'
        if (!\App\Models\Carrera::find($carreraId)) {
            throw new \Exception("El 'carrera_id' '{$carreraId}' no existe en la tabla de carreras.");
        }

        // Insertar el nuevo registro de usuario
        return new Usuarios([
            'matricula' => $row[0],
            'nombre' => $row[1],
            'tipo_usuario' => $row[2],
            'sexo' => $row[3],
            'carrera' => $row[4],
            'turno' => $row[5],
            'carrera_id' => $carreraId,  // Asegúrate de que carrera_id se está asignando correctamente
        ]);
    }
}
