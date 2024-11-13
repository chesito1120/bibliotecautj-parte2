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
    <div class="container">
        <h2>Detalles del Alumno</h2>

        <p><strong>Matrícula:</strong> {{ $alumno->matricula }}</p>
        <p><strong>Nombre:</strong> {{ $alumno->nombre }}</p>
        <p><strong>Carrera:</strong> {{ $alumno->carrera }}</p>
        <p><strong>Grado:</strong> {{ $alumno->grado }}</p>
        <p><strong>Grupo:</strong> {{ $alumno->grupo }}</p>
        <p><strong>Turno:</strong> {{ $alumno->turno }}</p>
        <p><strong>Sexo:</strong> {{ $alumno->sexo }}</p>
        <p><strong>Email Institucional:</strong> {{ $alumno->mail_institucional }}</p>

        <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-primary">Editar</a>

        <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>

        <a href="{{ route('alumnos.index') }}" class="btn btn-danger">Volver a la lista</a>
    </div>

@endsection
