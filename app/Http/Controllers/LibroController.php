<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function showUploadForm()
    {
        // Cambia la referencia a la vista correcta
        return view('libros.subir_libros');
    }

    public function uploadCSV(Request $request){
    // Validación del archivo CSV
    $request->validate([
        'file' => 'required|mimes:csv,txt|max:2048',
    ]);

    // Cargar el archivo
    $file = $request->file('file');

    // Variables para llevar el conteo de duplicados y registros agregados
    $duplicateCount = 0;
    $addedCount = 0;

    // Abrir el archivo y leer el contenido
    $handle = fopen($file, 'r');
    if ($handle) {
        // Saltar la primera fila si es un encabezado
        $firstRow = true;
        while (($row = fgetcsv($handle, 1000, ",")) !== false) {
            if ($firstRow) {
                $firstRow = false;
                continue;
            }

            // Verificar si el campo 'clas_dewey' o 'titulo' está vacío
            if (empty($row[0]) || empty($row[1])) {
                continue; // Si 'clas_dewey' o 'titulo' está vacío, saltar esta fila
            }

            // Almacenar el valor original de 'clas_dewey'
            $originalClasDewey = $row[0];

            // Buscar el número de duplicados existentes
            $existingCount = Libro::where('clas_dewey', 'LIKE', "{$originalClasDewey}%")->count();

            // Si ya existe al menos un libro con la misma 'clas_dewey', agregar un sufijo numérico
            if ($existingCount > 0) {
                $row[0] = "{$originalClasDewey}-" . ($existingCount + 1); // Ejemplo: "123.45-2"
                $duplicateCount++;
            }

            // Guardar los datos del libro
            $libroData = [
                'clas_dewey' => $row[0],
                'titulo' => $row[1],
                'autor' => $row[2] ?? null,
                'editorial' => $row[3] ?? null,
                'edicion' => $row[4] ?? null,
                'area_conocimiento' => $row[5] ?? null,
                'pag' => $row[6] ?? null,
                'isbn' => $row[7] ?? null,
                'area_sumario' => $row[8] ?? null,
                'donacion_compra' => $row[9] ?? null,
                'fecha_ingreso' => $row[10] ?? null,
            ];

            // Crear el registro del libro
            Libro::create($libroData);

            // Incrementar el contador de libros agregados
            $addedCount++;
        }
        fclose($handle);
    }

    // Mostrar un mensaje con el resumen de la operación
    return back()->with('success', "Libros importados exitosamente. $addedCount libros añadidos, $duplicateCount duplicados con sufijo identificador.");

}

    

    public function index(Request $request)
    {
        // Recoge el valor del parámetro 'search' de la solicitud (si existe)
        $search = $request->input('search');
    
        // Si hay un valor de búsqueda, se filtran los libros por título o autor
        if ($search) {
            $libros = Libro::where('titulo', 'like', "%{$search}%")
                           ->orWhere('autor', 'like', "%{$search}%")
                           ->paginate(20);
        } else {
            // Si no hay búsqueda, obtenemos todos los libros con paginación
            $libros = Libro::paginate(20);
        }
    
        // Retornar la vista con los libros paginados
        return view('libros.index', compact('libros'));
    }
        


    public function create()
    {
        // Muestra el formulario para crear un nuevo libro
        return view('libros.create');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'clas_dewey' => 'required|string',
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'editorial' => 'required|string',
            'edicion' => 'nullable|string',
            'area_conocimiento' => 'required|string',
            'pag' => 'nullable|integer',
            'isbn' => 'required|string|unique:libros',
            'area_sumario' => 'nullable|string',
            'donacion_compra' => 'required|string',
            'fecha_ingreso' => 'required|string',
        ]);

        // Crear un nuevo libro
        Libro::create($request->all());

        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }

    public function show(Libro $libro)
    {
        // Muestra un libro específico
        return view('libros.show', compact('libro'));
    }

    public function edit(Libro $libro)
    {
        // Muestra el formulario para editar un libro
        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
        // Validar la solicitud con condición en la validación del ISBN
        $request->validate([
            'clas_dewey' => 'required|string',
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'editorial' => 'required|string',
            'edicion' => 'nullable|string',
            'area_conocimiento' => 'required|string',
            'pag' => 'nullable|integer',
            'isbn' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($libro) {
                    // Solo validar si el ISBN ha cambiado
                    if ($value !== $libro->isbn && Libro::where('isbn', $value)->exists()) {
                        $fail('El ISBN ya está en uso.');
                    }
                },
            ],
            'area_sumario' => 'nullable|string',
            'donacion_compra' => 'required|string',
            'fecha_ingreso' => 'required|string',
        ]);
    
        // Actualizar el libro
        $libro->update($request->all());
    
        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente.');
    }
    


    public function destroy(Libro $libro)
    {
        // Eliminar un libro
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente.');
    }
}
