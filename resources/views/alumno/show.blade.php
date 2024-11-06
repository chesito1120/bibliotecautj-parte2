<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detalles del Alumno - {{ $alumno->nombre }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 10px;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

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

</body>
</html>
