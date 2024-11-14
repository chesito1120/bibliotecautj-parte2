@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
      
            </div>
            
            <!-- Formulario -->
            <form action="{{ route('maestro.store') }}" method="POST" class="col-lg-7 mx-auto">
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


    <div class="container">
        <h2>Agregar Alumno</h2>
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

        <!-- Formulario para agregar alumno -->
        <form action="{{ route('alumnos.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="matricula">Matrícula:</label>
                <input type="number" name="matricula" id="matricula" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" id="carrera" required>
            </div>
            <div class="form-group">
                <label for="grado">Grado:</label>
                <input type="number" name="grado" id="grado" required>
            </div>
            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" name="grupo" id="grupo" required>
            </div>
            <div class="form-group">
                <label for="turno">Turno:</label>
                <input type="text" name="turno" id="turno" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="text" name="sexo" id="sexo" required>
            </div>
            <div class="form-group">
                <label for="mail_institucional">Email Institucional:</label>
                <input type="email" name="mail_institucional" id="mail_institucional" required>
            </div>

            <button type="submit" class="btn btn-success">Agregar Alumno</button>
            <a href="{{ route('alumnos.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

    @endsection
