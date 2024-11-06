@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('alerta'))
            <div class="alert alert-warning">
                {{ session('alerta') }}
            </div>
        @endif

        <h1>Registro de Alumno</h1>

        <form action="{{ route('alumnos.store') }}" method="POST">
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
                <label for="sexo">Sexo:</label>
                <select name="sexo" class="form-control" required>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="carrera">Carrera:</label>
                <input type="text" name="carrera" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="grado">Grado:</label>
                <input type="number" name="grado" class="form-control" required min="1" max="10">
            </div>
            <div class="form-group">
                <label for="grupo">Grupo:</label>
                <input type="text" name="grupo" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar Alumno</button>
        </form>
    </div>

</body>
</html>
