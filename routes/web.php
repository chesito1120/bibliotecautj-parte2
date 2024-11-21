<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\LibroController;
use App\Imports\UsuariosImport;
use App\Imports\AlumnosImport;
use App\Imports\MaestrosImport;
use App\Models\Alumno;  
use App\Models\Maestro;  
use App\Http\Controllers\PrestamoController;


// Rutas para el controlador de visitas
Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas.index');
Route::get('/', [VisitaController::class, 'create'])->name('visitas.create');
Route::post('/visitas', [VisitaController::class, 'store'])->name('visitas.store');
Route::get('/visitas/{id}', [VisitaController::class, 'show'])->name('visitas.show');
Route::get('/visitas/{id}/edit', [VisitaController::class, 'edit'])->name('visitas.edit');
Route::put('/visitas/{id}', [VisitaController::class, 'update'])->name('visitas.update');
Route::delete('/visitas/{id}', [VisitaController::class, 'destroy'])->name('visitas.destroy');

// Rutas para el controlador de usuarios
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index'); // Muestra todos los usuarios
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create'); // Muestra el formulario para crear un usuario
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store'); // Almacena un nuevo usuario

// Rutas para subir CSV de usuarios
Route::get('/usuarios/upload', [UsuariosController::class, 'showUploadForm'])->name('usuarios.upload.form'); // Muestra el formulario para cargar el CSV
Route::post('/usuarios/import', [UsuariosController::class, 'import'])->name('usuarios.import'); // Cambié a import, que es el método correcto
Route::post('/usuarios/import', [UsuariosController::class, 'import'])->name('usuarios.import');

// Rutas para subir CSV de alumnos
Route::get('/alumnos/upload', [AlumnoController::class, 'showUploadForm'])->name('alumnos.upload.form'); // Muestra el formulario para cargar el CSV de alumnos
Route::post('/alumnos/import', [AlumnoController::class, 'import'])->name('alumnos.import');

// Rutas para maestros
Route::get('/maestros/upload', [MaestroController::class, 'showUploadForm'])->name('maestros.upload.form'); 
Route::post('/maestros/import', [MaestroController::class, 'import'])->name('maestros.import'); 
Route::get('/maestros/create', [MaestroController::class, 'create'])->name('maestros.create');
Route::get('/maestros/{maestro}/edit', [MaestroController::class, 'edit'])->name('maestro.edit');
Route::get('/maestros/{maestro}', [MaestroController::class, 'show'])->name('maestro.show');
Route::delete('/maestros/{maestro}', [MaestroController::class, 'destroy'])->name('maestro.destroy');
Route::put('/maestros/{maestro}', [MaestroController::class, 'update'])->name('maestros.update');

Route::get('/maestros', [MaestroController::class, 'index'])->name('maestro.index');
Route::post('/maestros', [MaestroController::class, 'store'])->name('maestro.store');

// Rutas para subir CSV de libros
Route::get('libros/upload', [LibroController::class, 'showUploadForm'])->name('libros.upload.form');
Route::post('libros/upload', [LibroController::class, 'uploadCSV'])->name('libros.upload');

// CRUD libros
Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

// CRUD alumnos 
Route::resource('/alumnos', AlumnoController::class);  // Esto genera todas las rutas para el recurso de alumnos

Route::get('/libros/buscar', [LibroController::class, 'buscar'])->name('libros.buscar');

// Ruta para obtener datos del usuario por matrícula (alumno o maestro)
Route::get('/visitas/usuario/{matricula}', function ($matricula) {
    // Primero buscar en alumnos
    $usuario = Alumno::where('matricula', $matricula)->first();
    
    if (!$usuario) {
        // Si no se encuentra en alumnos, buscar en maestros (suponiendo que los maestros no tienen matrícula)
        $usuario = Maestro::where('matricula', $matricula)->first();
        
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }
    }

    // Retornar los datos del usuario (ya sea alumno o maestro)
    return response()->json($usuario);
});

// Route::get('/visitas/usuario/{matricula}', [VisitaController::class, 'showUserVisits'])->name('visitas.showUserVisits');

Route::get('visitas/buscar', [VisitaController::class, 'buscar'])->name('visitas.buscar');
Route::resource('visitas', VisitaController::class);

Route::get('/buscar-libros', [VisitaController::class, 'buscar'])->name('visitas.buscar');
Route::post('/guardar-prestamo', [VisitaController::class, 'buscar'])->name('visitas.prestamo_libro');
Route::get('/guardar-prestamo', [VisitaController::class, 'buscar'])->name('visitas.prestamo_libro');

Route::post('/prestamo/store', [PrestamoController::class, 'store'])->name('prestamo.store');

Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamo.index');
Route::put('/prestamos/{prestamo}/devolver', [PrestamoController::class, 'registrarDevolucion'])->name('prestamo.devolver');