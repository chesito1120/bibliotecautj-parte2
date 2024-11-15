<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use Illuminate\Http\Request;

class AlumnoController extends Controller
{
    // Método para mostrar el formulario de carga de CSV
    public function showUploadForm()
    {
        return view('alumno.subir_alumnos');
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

    // Método para listar los alumnos con búsqueda
    public function index(Request $request)
    {
        // Recoge el valor del parámetro 'search' de la solicitud (si existe)
        $search = $request->input('search');

        // Si hay un valor de búsqueda, se filtran los alumnos por nombre o matricula
        if ($search) {
            $alumnos = Alumno::where('nombre', 'like', "%{$search}%")
                            ->orWhere('matricula', 'like', "%{$search}%")
                            ->paginate(20);
        } else {
            // Si no hay búsqueda, obtenemos todos los alumnos con paginación
            $alumnos = Alumno::paginate(20);
        }

        // Retornar la vista con los alumnos paginados
        return view('alumno.index', compact('alumnos'));
    }

    // Método para mostrar el formulario para agregar un nuevo alumno
    public function create()
    {
        return view('alumno.create');
    }

    // Método para almacenar un nuevo alumno
    public function store(Request $request)
    {
        // Validación de la solicitud
        $request->validate([
            'matricula' => 'required|integer|unique:alumnos',
            'nombre' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'grado' => 'required|integer',
            'grupo' => 'required|string|max:255',
            'turno' => 'required|string|max:255',
            'sexo' => 'required|string',
            'mail_institucional' => 'required|string|email|max:255',
        ]);

        // Asegurarse de que tipo_usuario tenga el valor "Estudiante"
        $data = $request->all();
        // Si el campo tipo_usuario no se proporciona, lo asignamos a "Estudiante"
        $data['tipo_usuario'] = $data['tipo_usuario'] ?? 'Estudiante';

        // Crear el alumno
        Alumno::create($data);

        return redirect()->route('alumno.index')->with('success', 'Alumno creado exitosamente.');
    }

    // Método para mostrar los detalles de un alumno
    public function show(Alumno $alumno)
    {
        return view('alumno.show', compact('alumno'));
    }

    // Método para mostrar el formulario de edición de un alumno
    public function edit(Alumno $alumno)
    {
        return view('alumno.edit', compact('alumno'));
    }

    // Método para actualizar un alumno
    public function update(Request $request, Alumno $alumno)
    {
        $request->validate([
            'matricula' => 'required|unique:alumnos,matricula,' . $alumno->id,
            'nombre' => 'required',
            'carrera' => 'required',
            'grado' => 'required',
            'grupo' => 'required',
            'turno' => 'required',
            'sexo' => 'required',
            'mail_institucional' => 'required|email',
        ]);

        // Asegurarse de que tipo_usuario tenga el valor "Estudiante"
        $data = $request->all();
        $data['tipo_usuario'] = $data['tipo_usuario'] ?? 'Estudiante';

        // Actualizar el alumno
        $alumno->update($data);

        return redirect()->route('alumno.index')->with('success', 'Alumno actualizado correctamente.');
    }

    // Método para eliminar un alumno
    public function destroy(Alumno $alumno)
    {
        // Eliminar el alumno
        $alumno->delete();

        return redirect()->route('alumno.index')->with('success', 'Alumno eliminado exitosamente.');
    }

    // Método para importar alumnos desde un CSV
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $handle = fopen($file, 'r');

        if ($handle) {
            $firstRow = true;
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
                    continue;
                }

                // Asignar tipo_usuario "Estudiante"
                $alumnoData = [
                    'matricula' => $row[0],
                    'nombre' => $row[1],
                    'carrera' => $row[2],
                    'grado' => $row[3],
                    'grupo' => $row[4],
                    'turno' => $row[5],
                    'sexo' => $row[6],
                    'mail_institucional' => $row[7],
                    'tipo_usuario' => 'Estudiante', // Asignación predeterminada
                ];

                // Crear el alumno
                Alumno::create($alumnoData);
            }
            fclose($handle);
        }

        return back()->with('success', 'Alumnos importados exitosamente.');
    }
}
