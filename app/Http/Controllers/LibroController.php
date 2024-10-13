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

    public function uploadCSV(Request $request)
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

                // Guardar los datos del libro
                $libroData = [
                    'clas_dewey' => $row[0],
                    'titulo' => $row[1],
                    'autor' => $row[2],
                    'editorial' => $row[3],
                    'edicion' => $row[4],
                    'area_conocimiento' => $row[5],
                    'pag' => $row[6],
                    'isbn' => $row[7],
                    'area_sumario' => $row[8],
                    'donacion_compra' => $row[9],
                    'fecha_ingreso' => $row[10],
                ];

                Libro::create($libroData);
            }
            fclose($handle);
        }

        return back()->with('success', 'Libros importados exitosamente');
    }

    public function index()
    {
        // Obtener todos los libros
        $libros = Libro::all();
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
        // Validar la solicitud
        $request->validate([
            'clas_dewey' => 'required|string',
            'titulo' => 'required|string',
            'autor' => 'required|string',
            'editorial' => 'required|string',
            'edicion' => 'nullable|string',
            'area_conocimiento' => 'required|string',
            'pag' => 'nullable|integer',
            'isbn' => 'required|string|unique:libros,isbn,' . $libro->id,
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
