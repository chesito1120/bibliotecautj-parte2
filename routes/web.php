<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\MaestroController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\LibroController;
use App\Models\Alumno;  
use App\Models\Maestro;  
use App\Models\Libro;

// Rutas de visitas
Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas.index');
Route::get('/', [VisitaController::class, 'create'])->name('visitas.create');
Route::post('/visitas', [VisitaController::class, 'store'])->name('visitas.store');
Route::get('/visitas/{id}', [VisitaController::class, 'show'])->name('visitas.show');
Route::get('/visitas/{id}/edit', [VisitaController::class, 'edit'])->name('visitas.edit');
Route::put('/visitas/{id}', [VisitaController::class, 'update'])->name('visitas.update');
Route::delete('/visitas/{id}', [VisitaController::class, 'destroy'])->name('visitas.destroy');

// Rutas de usuarios
Route::get('/usuarios', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
Route::get('/usuarios/upload', [UsuariosController::class, 'showUploadForm'])->name('usuarios.upload.form');
Route::post('/usuarios/import', [UsuariosController::class, 'import'])->name('usuarios.import');

// Rutas de alumnos
Route::resource('/alumnos', AlumnoController::class);
Route::get('/alumnos/upload', [AlumnoController::class, 'showUploadForm'])->name('alumnos.upload.form');
Route::post('/alumnos/import', [AlumnoController::class, 'import'])->name('alumnos.import');

// Rutas de maestros
Route::resource('/maestros', MaestroController::class);
Route::get('/maestros/upload', [MaestroController::class, 'showUploadForm'])->name('maestros.upload.form');
Route::post('/maestros/import', [MaestroController::class, 'import'])->name('maestros.import');

// Rutas de libros
Route::get('/libros', [LibroController::class, 'index'])->name('libros.index');
Route::get('/libros/create', [LibroController::class, 'create'])->name('libros.create');
Route::post('/libros', [LibroController::class, 'store'])->name('libros.store');
Route::get('/libros/{libro}', [LibroController::class, 'show'])->name('libros.show');
Route::get('/libros/{libro}/edit', [LibroController::class, 'edit'])->name('libros.edit');
Route::put('/libros/{libro}', [LibroController::class, 'update'])->name('libros.update');
Route::delete('/libros/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');
Route::get('libros/upload', [LibroController::class, 'showUploadForm'])->name('libros.upload.form');
Route::post('libros/upload', [LibroController::class, 'uploadCSV'])->name('libros.upload');

// Ruta de búsqueda de libros
Route::get('/libros/buscar', [LibroController::class, 'buscar']);

// Ruta para buscar usuario por matrícula
Route::get('/visitas/usuario/{matricula}', function ($matricula) {
    $usuario = Alumno::where('matricula', $matricula)->first() ?? Maestro::where('matricula', $matricula)->first();
    if (!$usuario) {
        return response()->json(['error' => 'Usuario no encontrado'], 404);
    }
    return response()->json($usuario);
});

Route::prefix('api')->group(function() {
    Route::get('/libros/buscar', [LibroController::class, 'buscar']);
});