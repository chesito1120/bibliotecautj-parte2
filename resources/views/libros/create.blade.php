@extends('adminlte::page')

@section('content')

    <div class="container">
        <h2>Agregar Libro</h2>
        <hr>

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

        <!-- Formulario para agregar libro -->
        <form action="{{ route('libros.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" required>
            </div>
            <div class="form-group">
                <label for="editorial">Editorial:</label>
                <input type="text" name="editorial" id="editorial" required>
            </div>
            <div class="form-group">
                <label for="edicion">Edición:</label>
                <input type="text" name="edicion" id="edicion" required>
            </div>
            <div class="form-group">
                <label for="edicion">Class Dewey:</label>
                <input type="text" name="clas_dewey" id="clas_dewey" required>
            </div>
            <div class="form-group">
                <label for="area_conocimiento">Área de Conocimiento:</label>
                <input type="text" name="area_conocimiento" id="area_conocimiento" required>
            </div>
            <div class="form-group">
                <label for="pag">Páginas:</label>
                <input type="number" name="pag" id="pag" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" required>
            </div>
            <div class="form-group">
                <label for="area_sumario">Área de Sumario:</label>
                <input type="text" name="area_sumario" id="area_sumario" required>
            </div>
            <div class="form-group">
                <label for="donacion_compra">Donación/Compra:</label>
                <input type="text" name="donacion_compra" id="donacion_compra" required>
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="text" name="fecha_ingreso" id="fecha_ingreso" required>
            </div>

            <button type="submit" class="btn btn-success">Agregar Libro</button>
            <a href="{{ route('libros.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

@endsection
