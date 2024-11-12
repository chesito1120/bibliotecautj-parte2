@extends('adminlte::page')

@section('content')

<div class="container mt-5">
    <!-- Logo y Título -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 500px;">
    </div>
    
    <!-- Formulario -->
    <div class="card shadow-lg p-4" style="max-width: 600px; margin: auto;">
        <form action="{{ route('maestro.store') }}" method="POST">
            @csrf

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Mensaje de error -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group mb-3">
                <label for="clas_dewey">Clas. Dewey</label>
                <input type="text" class="form-control" name="clas_dewey" id="clas_dewey" value="{{ $libro->clas_dewey }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="titulo">Título</label>
                <input type="text" class="form-control" name="titulo" id="titulo" value="{{ $libro->titulo }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="autor">Autor</label>
                <input type="text" class="form-control" name="autor" id="autor" value="{{ $libro->autor }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="editorial">Editorial</label>
                <input type="text" class="form-control" name="editorial" id="editorial" value="{{ $libro->editorial }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="edicion">Edición</label>
                <input type="text" class="form-control" name="edicion" id="edicion" value="{{ $libro->edicion }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="area_conocimiento">Área de Conocimiento</label>
                <input type="text" class="form-control" name="area_conocimiento" id="area_conocimiento" value="{{ $libro->area_conocimiento }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="pag">Páginas</label>
                <input type="number" class="form-control" name="pag" id="pag" value="{{ $libro->pag }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="isbn">ISBN</label>
                <input type="text" class="form-control" name="isbn" id="isbn" value="{{ $libro->isbn }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="area_sumario">Área de Sumario</label>
                <input type="text" class="form-control" name="area_sumario" id="area_sumario" value="{{ $libro->area_sumario }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="donacion_compra">Donación/Compra</label>
                <input type="text" class="form-control" name="donacion_compra" id="donacion_compra" value="{{ $libro->donacion_compra }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" class="form-control" name="fecha_ingreso" id="fecha_ingreso" value="{{ $libro->fecha_ingreso }}" required>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success me-2">Actualizar Libro</button>
                <a href="{{ route('libros.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
