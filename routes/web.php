<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\UsuariosController;

// Rutas para el controlador de visitas
Route::get('/visitas', [VisitaController::class, 'index'])->name('visitas.index');
Route::get('/', [VisitaController::class, 'create'])->name('visitas.create');
Route::post('/visitas', [VisitaController::class, 'store'])->name('visitas.store');
Route::get('/visitas/{id}', [VisitaController::class, 'show'])->name('visitas.show');
Route::get('/visitas/{id}/edit', [VisitaController::class, 'edit'])->name('visitas.edit');
Route::put('/visitas/{id}', [VisitaController::class, 'update'])->name('visitas.update');
Route::delete('/visitas/{id}', [VisitaController::class, 'destroy'])->name('visitas.destroy');

// Rutas para el controlador de usuarios
Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
Route::post('/usuarios/store', [UsuariosController::class, 'store'])->name('usuarios.store');
