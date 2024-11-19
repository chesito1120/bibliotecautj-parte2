<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Visita;
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
    $total_visitas = Visita::count();
    
    // Total de alumnos y maestros
    $total_alumnos = Alumno::count();
    $total_maestros = Maestro::count();
    
    // Visitas por servicio
    $visitas_acervo = Visita::where('servicio', 'acervo')->count();
    $visitas_computo = Visita::where('servicio', 'computo')->count();
    $prestamos_externos = Visita::where('servicio', 'prestamo')->count();
    
    // Carrera con más visitas (por alumnos)
    $carrera_mas_visitas = Alumno::join('visitas', 'alumnos.id', '=', 'visitas.usuario_id')
        ->select('alumnos.carrera')
        ->groupBy('alumnos.carrera')
        ->orderByRaw('COUNT(visitas.id) DESC')
        ->limit(1)
        ->pluck('carrera')
        ->first();

    // Reporte detallado por carrera, tipo de usuario y sexo (alumnos)
    $datos_carreras = Alumno::select('alumnos.carrera', 'alumnos.tipo_usuario', 'alumnos.sexo', DB::raw('COUNT(*) as cantidad'))
    ->join('visitas', 'alumnos.id', '=', 'visitas.usuario_id')
    ->groupBy('alumnos.carrera', 'alumnos.tipo_usuario', 'alumnos.sexo')
    ->get()
    ->groupBy('alumnos.carrera');


    // Reporte detallado por carrera, grado, grupo, y sexo (alumnos)
    $detalles_carreras_grado_grupo = Alumno::select('alumnos.carrera', 'alumnos.grado', 'alumnos.grupo', 'alumnos.sexo', DB::raw('COUNT(*) as cantidad'))
    ->join('visitas', 'alumnos.id', '=', 'visitas.usuario_id')
    ->groupBy('alumnos.carrera', 'alumnos.grado', 'alumnos.grupo', 'alumnos.sexo')
    ->get()
    ->groupBy(function($item) {
        return $item->carrera . ' - ' . $item->grado . ' - ' . $item->grupo;
    });


    // Cantidad de hombres y mujeres por servicio
    $cantidad_hombres_por_servicio = Visita::where('sexo', 'masculino')
        ->select('servicio', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('servicio')
        ->get();

    $cantidad_mujeres_por_servicio = Visita::where('sexo', 'femenino')
        ->select('servicio', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('servicio')
        ->get();

    // Obtener la información del último usuario que visitó
    $ultimo_usuario = Visita::orderBy('created_at', 'desc')
        ->with(['alumno', 'maestro']) // Asumiendo que existe la relación con Alumno y Maestro
        ->first();

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
        'detalles_carreras_grado_grupo' => $detalles_carreras_grado_grupo,
        'cantidad_hombres_por_servicio' => $cantidad_hombres_por_servicio,
        'cantidad_mujeres_por_servicio' => $cantidad_mujeres_por_servicio,
        'ultimo_usuario' => $ultimo_usuario,
    ]);

    $visitas_diarias = Visita::whereDate('created_at', Carbon::today())->count();
    $visitas_semanales = Visita::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
    $visitas_mensuales = Visita::whereMonth('created_at', Carbon::now()->month)->count();
    $usuarios_frecuentes = Visita::select('usuario_id', DB::raw('COUNT(*) as cantidad'))
        ->groupBy('usuario_id')
        ->orderBy('cantidad', 'desc')
        ->limit(5) // Puedes ajustar el límite a lo que necesites
        ->get();


    $promedio_visitas = Visita::count() / Visita::distinct('usuario_id')->count();

    $tendencias_servicios = Visita::select(DB::raw('DATE(created_at) as fecha'), 'servicio', DB::raw('COUNT(*) as cantidad'))
    ->groupBy(DB::raw('DATE(created_at)'), 'servicio')
    ->orderBy('fecha')
    ->get();

    $total_servicios = Visita::count();
    $porcentaje_acervo = ($visitas_acervo / $total_servicios) * 100;
$porcentaje_computo = ($visitas_computo / $total_servicios) * 100;
$porcentaje_prestamo = ($prestamos_externos / $total_servicios) * 100;


}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener las carreras desde los alumnos y maestros
        $carreras = Alumno::select('carrera')->distinct()->get();

        return view('visitas.create', compact('carreras'));
    }

    public function mCreate()
{
    // Obtener las carreras desde los maestros
    $carreras = Maestro::select('carrera_ads')->distinct()->get();

    return view('visitas.create_maestro', compact('carreras'));
}

public function aCreate()
{
    // Obtener las carreras desde los alumnos
    $carreras = Alumno::select('carrera')->distinct()->get();

    return view('visitas.create_alumno', compact('carreras'));
}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validación de los datos
    $validated = $request->validate([
        'matricula' => 'required|string',
        'servicio' => 'required|in:computo,acervo,prestamo',
        'numero_empleado' => 'nullable|string', // También puede estar vacío
    ]);

    $usuario = null;

    // Si es alumno, buscar en la tabla de alumnos
    if ($validated['matricula']) {
        $usuario = Alumno::where('matricula', $validated['matricula'])->first();
    }

    // Si no es alumno, buscar en la tabla de maestros
    if (!$usuario && $validated['numero_empleado']) {
        $usuario = Maestro::where('numero_empleado', $validated['numero_empleado'])->first();
    }

    if (!$usuario) {
        return redirect()->back()->with('error', 'Usuario no encontrado.');
    }

    // Obtener los datos del usuario para guardar la visita
    $nombre_completo = $usuario->nombre;
    $carrera = $usuario->carrera;
    $turno = $usuario->turno;
    $matricula = $usuario->matricula;
    $numero_empleado = $usuario->numero_empleado;
    $grupo = $usuario->grupo;
    $actividad = $usuario->actividad;
    $cantidad_hombres = $usuario->cantidad_hombres;
    $cantidad_mujeres = $usuario->cantidad_mujeres;
    $sexo = $usuario->sexo;
    $grado = $usuario->grado;

    // Guardar la visita
    Visita::create([
        'usuario_id' => $usuario->id,
        'servicio' => $validated['servicio'],
        'nombre_completo' => $nombre_completo,
        'carrera' => $carrera,
        'matricula' => $matricula,
        'numero_empleado' => $numero_empleado,
        'grupo' => $grupo,
        'actividad' => $actividad,
        'cantidad_hombres' => $cantidad_hombres,
        'cantidad_mujeres' => $cantidad_mujeres,
        'sexo' => $sexo,
        'turno' => $turno,
        'grado' => $grado,
        'fecha' => now(),
    ]);

    return redirect()->route('visitas.acreate')->with('success', 'Visita registrada exitosamente.');
}
public function store_maestro1(Request $request)
{
    // Validación de los datos del formulario
    $validated = $request->validate([
        'numero_empleado' => 'required|string|max:255',
        'servicio' => 'required|string|max:255',
        'actividad' => 'required|string|max:255',
        'cantidad_hombres' => 'required|integer',
        'cantidad_mujeres' => 'required|integer',
        'carrera_ads' => 'required|string|max:255',
        'grado' => 'required|string|max:255',
        'grupo' => 'required|string|max:255',
        'turno' => 'required|string|max:255',
        'sexo' => 'required|string|max:255',
    ]);

    // Crear un nuevo registro de visita para maestro
    Visita::create([
        'numero_empleado' => $validated['numero_empleado'],
        'servicio' => $validated['servicio'],
        'actividad' => $validated['actividad'],
        'cantidad_hombres' => $validated['cantidad_hombres'],
        'cantidad_mujeres' => $validated['cantidad_mujeres'],
        'carrera_ads' => $validated['carrera'],
        'grado' => $validated['grado'],
        'grupo' => $validated['grupo'],
        'turno' => $validated['turno'],
        'sexo' => $validated['sexo'],
    ]);

    // Redirigir o devolver respuesta
    return redirect()->route('visitas.index')->with('success', 'Visita registrada correctamente');
}


public function store_maestro(Request $request)
{
    // Validación de los datos
    $validated = $request->validate([
        'numero_empleado' => 'required|string', // Número de empleado es obligatorio
        'servicio' => 'required|in:computo,acervo,prestamo', // Servicios válidos
        'actividad' => 'required|string',
        'cantidad_hombres' => 'required|integer',
        'cantidad_mujeres' => 'required|integer',
        'carrera' => 'required|string',
        'grado' => 'required|string',
        'grupo' => 'required|string',
        'turno' => 'required|string',
        'tipo_usuario' => 'required|string',
        'sexo' => 'required|string|in:masculino,femenino,otro',
    ]);

    // Verificar que el maestro existe en la base de datos
    $usuario = Maestro::where('numero_empleado', $validated['numero_empleado'])->first();

    if (!$usuario) {
        return redirect()->back()->with('error', 'Maestro no encontrado.');
    }

    // Guardar la visita usando los datos del formulario
    Visita::create([
        'usuario_id' => $usuario->id, // ID del maestro
        'servicio' => $validated['servicio'],
        'nombre_completo' => $usuario->nombre,
        'carrera' => $validated['carrera'], // Se toma del formulario
        'numero_empleado' => $usuario->numero_empleado,
        'grupo' => $validated['grupo'], // Del formulario
        'actividad' => $validated['actividad'], // Del formulario
        'cantidad_hombres' => $validated['cantidad_hombres'], // Del formulario
        'cantidad_mujeres' => $validated['cantidad_mujeres'], // Del formulario
        'sexo' => $validated['sexo'], // Del formulario
        'turno' => $validated['turno'], // Del formulario
        'grado' => $validated['grado'], // Del formulario
        'tipo_usuario' => $validated['tipo_usuario'], // Del formulario
        'fecha' => now(),
    ]);

    // Redirigir con un mensaje de éxito
    return redirect()->route('visitas.mcreate')->with('success', 'Visita registrada exitosamente.');
}


public function getCarreraPorMatricula($matricula)
{
    $alumno = Alumno::where('matricula', $matricula)->first();

    if ($alumno) {
        return response()->json([
            'success' => true,
            'carrera' => $alumno->carrera,
        ]);
    }
}

}
