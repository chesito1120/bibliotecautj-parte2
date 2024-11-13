@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 250px;" class="img-fluid">
                <h2 style="color: #2F4F4F; font-weight: bold;">Información del Libro</h2>
            </div>
            
            <!-- Información del Libro -->
            <div class="col-lg-8 mx-auto">
                <div class="card p-4 shadow">
                    <h3 class="text-center" style="color: #2F4F4F; font-weight: bold;">{{ $libro->titulo }}</h3>
                    
                    <hr class="my-4">
                    
                    <p><strong>Clasificación Dewey:</strong> {{ $libro->clas_dewey }}</p>
                    <p><strong>Autor:</strong> {{ $libro->autor }}</p>
                    <p><strong>Editorial:</strong> {{ $libro->editorial }}</p>
                    <p><strong>Edición:</strong> {{ $libro->edicion }}</p>
                    <p><strong>Área de Conocimiento:</strong> {{ $libro->area_conocimiento }}</p>
                    <p><strong>Páginas:</strong> {{ $libro->pag }}</p>
                    <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
                    <p><strong>Área de Sumario:</strong> {{ $libro->area_sumario }}</p>
                    <p><strong>Donación/Compra:</strong> {{ $libro->donacion_compra }}</p>
                    <p><strong>Fecha de Ingreso:</strong> {{ $libro->fecha_ingreso }}</p>

                    <div class="text-center mt-4">
                        <a href="{{ route('libros.edit', $libro) }}" class="btn btn-primary mr-2">
                            <i class="fas fa-edit"></i> Editar
                        </a>

                        <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-trash-alt"></i> Eliminar
                            </button>
                        </form>

                        <a href="{{ route('libros.index') }}" class="btn btn-secondary ml-2">
                            <i class="fas fa-arrow-left"></i> Volver a la lista
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
