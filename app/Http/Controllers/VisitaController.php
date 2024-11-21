<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\Libro;
use App\Models\Carrera; 
use App\Models\Alumno;
use App\Models\Maestro;

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Total de visitas
        $total_visitas = DB::table('visitas')->count();
    
        // Total de alumnos y maestros
        $total_alumnos = DB::table('usuarios')
            ->where('tipo_usuario', 'alumno')
            ->count();
        $total_maestros = DB::table('usuarios')
            ->where('tipo_usuario', 'maestro')
            ->count();
    
        // Visitas por servicio
        $visitas_acervo = DB::table('visitas')
            ->where('servicio', 'acervo')
            ->count();
        $visitas_computo = DB::table('visitas')
            ->where('servicio', 'computo')
            ->count();
        $prestamos_externos = DB::table('visitas')
            ->where('servicio', 'prestamo')
            ->count();
    
        // Carrera con más visitas
        $carrera_mas_visitas = DB::table('usuarios')
            ->join('visitas', 'usuarios.id', '=', 'visitas.usuario_id')
            ->select('usuarios.carrera')
            ->groupBy('usuarios.carrera')
            ->orderByRaw('COUNT(visitas.id) DESC')
            ->limit(1)
            ->pluck('carrera')
            ->first();
    
        // Reporte detallado por carrera, tipo de usuario y sexo
        $datos_carreras = DB::table('usuarios')
            ->select('carrera', 'tipo_usuario', 'sexo', DB::raw('COUNT(*) as cantidad'))
            ->join('visitas', 'usuarios.id', '=', 'visitas.usuario_id')
            ->groupBy('carrera', 'tipo_usuario', 'sexo')
            ->get()
            ->groupBy('carrera');
    
        // Renderizar la vista con los datos
        return view('visitas.index', [
            'total_visitas' => $total_visitas,
            'total_alumnos' => $total_alumnos,
            'total_maestros' => $total_maestros,
            'visitas_acervo' => $visitas_acervo,
            'visitas_computo' => $visitas_computo,
            'prestamos_externos' => $prestamos_externos,
            'carrera_mas_visitas' => $carrera_mas_visitas ?? 'N/A',
            'datos_carreras' => $datos_carreras,
        ]);
    }
    


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las carreras desde la tabla 'usuarios'
        $carreras = DB::table('usuarios')->select('carrera')->distinct()->get();

        $libros = Libro::paginate(10);  // Paginación de libros
        return view('visitas.create', compact('libros'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'servicio' => 'required',
            'nombre' => 'required_if:servicio,prestamo',
            'sexo' => 'required_if:servicio,prestamo',
            'grado' => 'required_if:servicio,prestamo',
            'fecha_prestamo' => 'required_if:servicio,prestamo',
            'tipo_usuario' => 'required_if:servicio,prestamo',
            'carrera' => 'required_if:servicio,prestamo',
            'titulo_libro' => 'required_if:servicio,prestamo',
            'autor' => 'required_if:servicio,prestamo',
            'no_clasificacion' => 'required_if:servicio,prestamo',
            'renovacion' => 'required_if:servicio,prestamo',
            'fecha_renovacion' => 'nullable|date',
        ]);
        
        $validated = $request->validate([
            'matricula' => 'required|string',
            'servicio' => 'required|in:computo,acervo,prestamo',
        ]);

        $usuario = DB::table('alumnos')->where('matricula', $validated['matricula'])->first();

        if (!$usuario) {
            return redirect()->route('usuarios.create')->with('alerta', 'Usuario no registrado, por favor complete el registro.');
        }

        // Guardar visita
        DB::table('visitas')->insert([
            'usuario_id' => $usuario->id,
            'servicio' => $validated['servicio'],
            'fecha' => now(),
        ]);

        return redirect()->route('visitas.index')->with('success', 'Visita registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

        public function guardarPrestamo(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'matricula' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'sexo' => 'required|string|max:255',
            'grado' => 'required|string|max:255',
            'grupo' => 'required|string|max:255',
            'fecha_prestamo' => 'required|date',
            'tipo_usuario' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'servicio' => 'required|string|in:computo,acervo,prestamo',
        ]);

        // Buscar el usuario en la base de datos usando la matrícula
        $usuario = DB::table('alumnos')->where('matricula', $validatedData['matricula'])->first();

        // Si el usuario no existe, redirigir con un mensaje
        if (!$usuario) {
            return redirect()->route('usuarios.create')->with('alerta', 'Usuario no registrado, por favor complete el registro.');
        }

        // Pasar los datos del usuario junto con los datos validados al formulario
        return view('visitas.prestamo_libro', [
            'usuario' => $usuario, // Pasar los datos del usuario
            'servicio' => $validatedData['servicio'],
            'fecha_prestamo' => $validatedData['fecha_prestamo'],
            // Incluir cualquier otro dato que necesites pasar a la vista
        ]);
    }

    public function buscar(Request $request)
    {
        // Validar la entrada
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);
    
        // Capturar parámetros adicionales
        $params = $request->all();
    
        // Capturar el término de búsqueda
        $query = $request->input('search');
        $libros = Libro::query();
    
        // Filtrar resultados si hay búsqueda
        if ($query) {
            $libros->where('titulo', 'like', "%{$query}%")
                   ->orWhere('autor', 'like', "%{$query}%");
        }
    
        // Paginación y persistencia de parámetros
        $libros = $libros->paginate(10)->appends($params);
    
        // Retornar la vista con los libros y todos los parámetros
        return view('visitas.prestamo_libro', compact('libros', 'params'))->with('search', $query);
    }
    

}
