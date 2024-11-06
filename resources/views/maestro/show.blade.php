<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $maestro->nombre }}</title>
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
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-back:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>{{ $maestro->nombre }}</h2>

        <p><strong>Nombre:</strong> {{ $maestro->nombre ?? 'N/A' }}</p>
        <p><strong>Numero de empleado:</strong> {{ $maestro->numero_empleado ?? 'N/A' }}</p>
        <p><strong>Carrera Asignada:</strong> {{ $maestro->carrera_ads ?? 'N/A' }}</p>
        <p><strong>Turno:</strong> {{ $maestro->turno ?? 'N/A' }}</p>
        <p><strong>Sexo:</strong> {{ $maestro->sexo ?? 'N/A' }}</p>
        <p><strong>Puesto:</strong> {{ $maestro->puesto ?? 'N/A' }}</p>

        <a href="{{ route('maestro.show', $maestro) }}" class="btn btn-primary">Editar</a>

        <form action="{{ route('maestro.destroy', $maestro) }}" method="POST" style="display:inline; margin-top: 10px;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>

        <a href="{{ route('maestro.index') }}" class="btn btn-back">Volver a la lista</a>
    </div>

</body>
</html>
