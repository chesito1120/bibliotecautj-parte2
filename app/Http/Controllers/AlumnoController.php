<?php

namespace App\Http\Controllers;

use App\Imports\AlumnosImport;
use App\Models\Alumno; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Método para mostrar el formulario de carga de CSV
    public function showUploadForm()
    {
        return view('alumno.index'); // Cambia la referencia a la vista correcta
    }

    // Método para manejar la carga del archivo CSV
    public function uploadCSV(Request $request)
    {
        // Validación del archivo CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            // Importar el archivo CSV usando un import personalizado para Alumno
            Excel::import(new AlumnoImport, $request->file('file'));

            return back()->with('success', 'Estudiantes importados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar a los Estudiantes: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        // Recoge el valor del parámetro 'search' de la solicitud (si existe)
        $search = $request->input('search');

        // Si hay un valor de búsqueda, se filtran los alumnos por nombre o matrícula
        if ($search) {
            $alumnos = Alumno::where('nombre', 'like', "%{$search}%")
                            ->orWhere('matricula', 'like', "%{$search}%")
                            ->paginate(20);
        } else {
            // Si no hay búsqueda, obtenemos todos los alumnos con paginación
            $alumnos = Alumno::paginate(20);
        }

        // Retornar la vista con los alumnos paginados
        return view('alumnos.index', compact('alumnos'));
    }

    public function create()
    {
        // Muestra el formulario para crear un nuevo alumno
        return view('alumnos.create');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'matricula' => 'required|integer|unique:alumnos',
            'nombre' => 'required|string',
            'carrera' => 'required|string',
            'grado' => 'required|integer',
            'grupo' => 'required|string',
            'turno' => 'required|string',
            'sexo' => 'required|string',
            'mai_institucional' => 'required|string',
        ]);

        // Crear un nuevo alumno
        Alumno::create($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno creado exitosamente.');
    }

    public function show(Alumno $alumno)
    {
        // Muestra un alumno específico
        return view('alumnos.show', compact('alumno'));
    }

    public function edit(Alumno $alumno)
    {
        // Muestra el formulario para editar un alumno
        return view('alumnos.edit', compact('alumno'));
    }

    public function update(Request $request, Alumno $alumno)
    {
        // Validar la solicitud con condición en la validación de la matrícula
        $request->validate([
            'matricula' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($alumno) {
                    // Solo validar si la matrícula ha cambiado
                    if ($value !== $alumno->matricula && Alumno::where('matricula', $value)->exists()) {
                        $fail('La matrícula ya está en uso.');
                    }
                },
            ],
            'nombre' => 'required|string',
            'carrera' => 'required|string',
            'grado' => 'required|integer',
            'grupo' => 'required|string',
            'turno' => 'required|string',
            'sexo' => 'required|string',
            'mail_institucional' => 'required|string',      
            
        ]);

        // Actualizar el alumno
        $alumno->update($request->all());

        return redirect()->route('alumnos.index')->with('success', 'Alumno actualizado exitosamente.');
    }

    public function destroy(Alumno $alumno)
    {
        // Eliminar un alumno
        $alumno->delete();

        return redirect()->route('alumnos.index')->with('success', 'Alumno eliminado exitosamente.');
    }

    // Método para importar desde un CSV
    public function import(Request $request)
    {
        // Validación del archivo CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        // Cargar el archivo
        $file = $request->file('file');

        // Abrir el archivo y leer el contenido
        $handle = fopen($file, 'r');
        if ($handle) {
            // Saltar la primera fila si es un encabezado
            $firstRow = true;
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                // Verificar si los campos requeridos están vacíos
                if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
                    // Si faltan campos requeridos, saltar esta fila
                    continue;
                }

                // Guardar los datos del alumno
                $alumnoData = [
                    'matrícula' => $row[0],
                    'nombre' => $row[1],
                    'carrera' => $row[2],
                    'grado' => $row[3],
                    'grupo' => $row[4],
                    'turno' => $row[5],
                    'sexo' => $row[6],
                    'mail_institucional' => $row[7],
                ];

                // Crear el registro del alumno
                Alumno::create($alumnoData);
            }
            fclose($handle);
        }

        return back()->with('success', 'Alumnos importados exitosamente.');
    }
}
