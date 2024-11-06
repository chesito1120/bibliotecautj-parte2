<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\MaestrosImport;
use App\Models\Maestro;
use Maatwebsite\Excel\Facades\Excel;



class MaestroController extends Controller
{
    
// Método para mostrar el formulario de carga de CSV
public function showUploadForm()
{
    return view('maestro.subir_maestros'); // Cambia la referencia a la vista correcta
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
        Excel::import(new MaestroImport, $request->file('file'));

        return back()->with('success', 'Docentes importados exitosamente.');
    } catch (\Exception $e) {
        return back()->with('error', 'Error al importar a los docentes: ' . $e->getMessage());
    }
}

public function index(Request $request)
{
    // Recoge el valor del parámetro 'search' de la solicitud (si existe)
    $search = $request->input('search');

    // Si hay un valor de búsqueda, se filtran los maestros por nombre o matrícula
    if ($search) {
        $maestros = Maestro::where('nombre', 'like', "%{$search}%")
                        ->orWhere('numero_empleado', 'like', "%{$search}%")
                        ->paginate(20);
    } else {
        $maestros = Maestro::paginate(20);
    }

    // Retornar la vista con los maestros paginados
    return view('maestro.index', compact('maestros'));
}

public function create()
{
    // Muestra el formulario para crear un nuevo master
    return view('maestro.create');
}

public function store(Request $request)
{
    // Validar la solicitud
    $request->validate([
        'nombre' => 'required|string',
        'numero_empleado' => 'required|integer|unique:maestros',
        'carrera_ads' => 'required|string',
        'turno' => 'required|string',
        'sexo' => 'required|string',
        'puesto' => 'required|string',
    ]);

    // Crear un nuevo maestro
    Maestro::create($request->all());

    return redirect()->route('maestros.create')->with('success', 'Maestro creado exitosamente.');
}

public function show(Maestro $maestro)
{
    // Muestra un maestro específico
    return view('maestro.show', compact('maestro'));
}

public function edit(Maestro $maestro)
{
    return view('maestro.edit', compact('maestro'));
}

public function update(Request $request, Maestro $maestro)
{
    // Validar la solicitud con condición en la validación de la matrícula
    $request->validate([
        'numero_empleado' => [
            'required',
            'integer',
            function ($attribute, $value, $fail) use ($maestro) {
                // Solo validar si la matrícula ha cambiado
                if ($value !== $maestro->numero_empleado && Maestro::where('numero_empleado', $value)->exists()) {
                    $fail('El numero de empleado ya está en uso.');
                }
            },
        ],
        'nombre' => 'required|string',
        'numero_empleado' => 'required|string',
        'carrera_ads' => 'required|integer',
        'turno' => 'required|string',
        'sexo' => 'required|string',
        'puesto' => 'required|string',      
        
    ]);

    // Actualizar el alumno
    $maestro->update($request->all());

    return redirect()->route('maestro.index')->with('success', 'Maestro actualizado exitosamente.');
}

public function destroy(Maestro $maestro)
{
    // Eliminar un alumno
    $maestro->delete();

    return redirect()->route('maestro.index')->with('success', 'Maestro eliminado exitosamente.');
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
            $maestroData = [
                'nombre' => $row[0],
                'numero_empleado' => $row[1],
                'carrera_ads' => $row[2],
                'turno' => $row[3],
                'sexo' => $row[4],
                'puesto' => $row[5],
            
            ];

            // Crear el registro del maestro
            Maestro::create($maestroData);
        }
        fclose($handle);
    }

    return back()->with('success', 'Docentes importados exitosamente.');
}




}//final de maestro controller
