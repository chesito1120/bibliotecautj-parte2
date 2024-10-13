<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $libro->titulo }}</title>
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
        <h2>{{ $libro->titulo }}</h2>

        <p><strong>Clas. Dewey:</strong> {{ $libro->clas_dewey }}</p>
        <p><strong>Autor:</strong> {{ $libro->autor }}</p>
        <p><strong>Editorial:</strong> {{ $libro->editorial }}</p>
        <p><strong>Edición:</strong> {{ $libro->edicion }}</p>
        <p><strong>Área de Conocimiento:</strong> {{ $libro->area_conocimiento }}</p>
        <p><strong>Páginas:</strong> {{ $libro->pag }}</p>
        <p><strong>ISBN:</strong> {{ $libro->isbn }}</p>
        <p><strong>Área Sumario:</strong> {{ $libro->area_sumario }}</p>
        <p><strong>Donación/Compra:</strong> {{ $libro->donacion_compra }}</p>
        <p><strong>Fecha de Ingreso:</strong> {{ $libro->fecha_ingreso }}</p>

        <a href="{{ route('libros.edit', $libro) }}" class="btn btn-primary">Editar</a>

        <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Eliminar</button>
        </form>

        <a href="{{ route('libros.index') }}" class="btn btn-danger">Volver a la lista</a>
    </div>

</body>
</html>
