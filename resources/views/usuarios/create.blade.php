@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('alerta'))
            <div class="alert alert-warning">
                {{ session('alerta') }}
            </div>
        @endif

        <h1>Registro de Usuario</h1>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" name="matricula" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="tipo_usuario">Tipo de Usuario:</label>
                <select name="tipo_usuario" class="form-control">
                    <option value="alumno">Alumno</option>
                    <option value="maestro">Maestro</option>
                </select>
            </div>

            <!-- Otros campos como sexo, carrera, etc. -->
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
