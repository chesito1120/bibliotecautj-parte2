<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    public function showUploadForm()
    {
        return view('libros.subir_libros');
    }

    public function uploadCSV(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $duplicateCount = 0;
        $addedCount = 0;

        $handle = fopen($file, 'r');
        if ($handle) {
            $firstRow = true;
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }

                if (empty($row[0]) || empty($row[1])) {
                    continue;
                }

                $originalClasDewey = $row[0];
                $existingCount = Libro::where('clas_dewey', 'LIKE', "{$originalClasDewey}%")->count();

                if ($existingCount > 0) {
                    $row[0] = "{$originalClasDewey}-" . ($existingCount + 1);
                    $duplicateCount++;
                }

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
                    'disponible' => true,
                ];

                Libro::create($libroData);
                $addedCount++;
            }
            fclose($handle);
        }

        return back()->with('success', "Libros importados exitosamente. $addedCount libros añadidos, $duplicateCount duplicados con sufijo identificador.");
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        if ($search) {
            $libros = Libro::where('titulo', 'like', "%{$search}%")
                           ->orWhere('autor', 'like', "%{$search}%")
                           ->paginate(20);
        } else {
            $libros = Libro::paginate(20);
        }

        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        return view('libros.create');
    }

    public function store(Request $request)
    {
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
            'disponible' => 'boolean',
        ]);

        $libroData = $request->all();
        $libroData['disponible'] = $request->has('disponible') ? $request->input('disponible') : true; // Por defecto, disponible es true

        Libro::create($libroData);

        return redirect()->route('libros.index')->with('success', 'Libro creado exitosamente.');
    }

    public function show(Libro $libro)
    {
        return view('libros.show', compact('libro'));
    }

    public function edit(Libro $libro)
    {
        return view('libros.edit', compact('libro'));
    }

    public function update(Request $request, Libro $libro)
    {
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
                    if ($value !== $libro->isbn && Libro::where('isbn', $value)->exists()) {
                        $fail('El ISBN ya está en uso.');
                    }
                },
            ],
            'area_sumario' => 'nullable|string',
            'donacion_compra' => 'required|string',
            'fecha_ingreso' => 'required|string',
            'disponible' => 'boolean', // Validación del nuevo campo
        ]);

        $libroData = $request->all();
        $libro->update($libroData);

        return redirect()->route('libros.index')->with('success', 'Libro actualizado exitosamente.');
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();

        return redirect()->route('libros.index')->with('success', 'Libro eliminado exitosamente.');
    }

    // Método para realizar la búsqueda de libros
    public function buscar(Request $request)
    {
        $query = $request->get('query');
        $libros = DB::table('libros')
            ->where('titulo', 'LIKE', "%{$query}%")
            ->orWhere('autor', 'LIKE', "%{$query}%")
            ->orWhere('clas_dewey', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();

        return response()->json($libros);
    }



}
