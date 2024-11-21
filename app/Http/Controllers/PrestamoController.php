<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;

class PrestamoController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos recibidos
        $request->validate([
            'id_libro' => 'required|exists:libros,id',
            'matricula' => 'required|string|max:15',
            'nombre' => 'required|string|max:255',
            'grado' => 'required|string|max:5',
            'grupo' => 'required|string|max:1',
            'carrera' => 'required|string|max:255',
            'isbn' => 'required|string|max:13',
            'no_clasificacion' => 'required|string|max:50',
            'fecha_prestamo' => 'required|date',
            'tipo_usuario' => 'required|string',
        ]);

        // Crear el préstamo
        Prestamo::create([
            'libro_id' => $request->input('id_libro'),
            'matricula' => $request->input('matricula'),
            'nombre' => $request->input('nombre'),
            'grado' => $request->input('grado'),
            'grupo' => $request->input('grupo'),
            'carrera' => $request->input('carrera'),
            'isbn' => $request->input('isbn'),
            'clas_dewey' => $request->input('no_clasificacion'),
            'fecha_prestamo' => $request->input('fecha_prestamo'),
            'fecha_devolucion' => $request->input('fecha_renovacion', null), // Si no se envía, será NULL
        ]);

        // Redirigir o retornar una respuesta
        return redirect()->route('visitas.index')->with('success', 'Préstamo registrado correctamente.');
    }

    public function index()
    {
        // Obtener los préstamos con la relación a los libros y la paginación
        $prestamos = Prestamo::with('libro')->paginate(10);
        return view('prestamos.index', compact('prestamos'));
    }

    public function registrarDevolucion($id)
    {
        // Buscar el préstamo y registrar la fecha de devolución
        $prestamo = Prestamo::findOrFail($id);
        $prestamo->fecha_devolucion = now();  // Fecha actual
        $prestamo->save();

        return redirect()->route('prestamo.index')->with('success', 'Devolución registrada exitosamente.');
    }

}
