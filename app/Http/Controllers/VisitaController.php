<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\Carrera; 

class VisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // total de visitas
    $total_visitas = DB::table('visitas')->count();

    // total de alumnos y maestros
    $total_alumnos = DB::table('usuarios')
        ->where('tipo_usuario', 'alumno')
        ->count();
    $total_maestros = DB::table('usuarios')
        ->where('tipo_usuario', 'maestro')
        ->count();

    // visitas por servicio
    $visitas_acervo = DB::table('visitas')
        ->where('servicio', 'acervo')
        ->count();
    $visitas_computo = DB::table('visitas')
        ->where('servicio', 'computo')
        ->count();
    $prestamos_externos = DB::table('visitas')
        ->where('servicio', 'prestamo')
        ->count();

    // carrera con más visitas
    $carrera_mas_visitas = DB::table('usuarios')
        ->join('visitas', 'usuarios.id', '=', 'visitas.usuario_id')
        ->select('usuarios.carrera')
        ->groupBy('usuarios.carrera')
        ->orderByRaw('COUNT(visitas.id) DESC')
        ->limit(1)
        ->pluck('carrera')
        ->first();

     // Contar visitas y usuarios
     $total_visitas = DB::table('visitas')->count();
     $total_alumnos = DB::table('usuarios')->where('tipo_usuario', 'alumno')->count();
     $total_maestros = DB::table('usuarios')->where('tipo_usuario', 'maestro')->count();
     $visitas_acervo = DB::table('visitas')->where('servicio', 'acervo')->count();
     $visitas_computo = DB::table('visitas')->where('servicio', 'computo')->count();
     $prestamos_externos = DB::table('visitas')->where('servicio', 'prestamo')->count();

     //  carrera que más visitas recibe
     $carrera_mas_visitas = DB::table('usuarios')
         ->select('carrera', DB::raw('COUNT(*) as cantidad'))
         ->join('visitas', 'usuarios.id', '=', 'visitas.usuario_id')
         ->groupBy('usuarios.carrera')
         ->orderBy('cantidad', 'desc')
         ->first();

     // reporte detallado
     $datos_carreras = DB::table('usuarios')
         ->select('carrera', 'tipo_usuario', 'sexo', DB::raw('COUNT(*) as cantidad'))
         ->join('visitas', 'usuarios.id', '=', 'visitas.usuario_id')
         ->groupBy('carrera', 'tipo_usuario', 'sexo')
         ->get()
         ->groupBy('carrera');

     return view('visitas.index', [
         'total_visitas' => $total_visitas,
         'total_alumnos' => $total_alumnos,
         'total_maestros' => $total_maestros,
         'visitas_acervo' => $visitas_acervo,
         'visitas_computo' => $visitas_computo,
         'prestamos_externos' => $prestamos_externos,
         'carrera_mas_visitas' => $carrera_mas_visitas ? $carrera_mas_visitas->carrera : 'N/A',
         'datos_carreras' => $datos_carreras,
     ]);
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Cargar las carreras desde la base de datos
        $carreras = Carrera::all();
        return view('visitas.create', compact('carreras'));
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

    $usuario = DB::table('usuarios')->where('matricula', $validated['matricula'])->first();

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
}
