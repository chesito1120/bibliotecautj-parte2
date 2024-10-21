<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Libro</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            margin-right: 10px;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 4px;
            font-size: 16px;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Editar Libro</h2>
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

        <!-- Formulario para editar libro -->
        <form action="{{ route('libros.update', $libro) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="titulo">Clas. Dewey</label>
                <input type="text" name="clas_dewey" id="clas_dewey" value="{{ $libro->clas_dewey }}" required>
            </div>
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" name="titulo" id="titulo" value="{{ $libro->titulo }}" required>
            </div>
            <div class="form-group">
                <label for="autor">Autor:</label>
                <input type="text" name="autor" id="autor" value="{{ $libro->autor }}" required>
            </div>
            <div class="form-group">
                <label for="editorial">Editorial:</label>
                <input type="text" name="editorial" id="editorial" value="{{ $libro->editorial }}" required>
            </div>
            <div class="form-group">
                <label for="edicion">Edición:</label>
                <input type="text" name="edicion" id="edicion" value="{{ $libro->edicion }}" required>
            </div>
            <div class="form-group">
                <label for="area_conocimiento">Área de Conocimiento:</label>
                <input type="text" name="area_conocimiento" id="area_conocimiento" value="{{ $libro->area_conocimiento }}" required>
            </div>
            <div class="form-group">
                <label for="pag">Páginas:</label>
                <input type="number" name="pag" id="pag" value="{{ $libro->pag }}" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN:</label>
                <input type="text" name="isbn" id="isbn" value="{{ $libro->isbn }}" required>
            </div>
            <div class="form-group">
                <label for="area_sumario">Área de Sumario:</label>
                <input type="text" name="area_sumario" id="area_sumario" value="{{ $libro->area_sumario }}" required>
            </div>
            <div class="form-group">
                <label for="donacion_compra">Donación/Compra:</label>
                <input type="text" name="donacion_compra" id="donacion_compra" value="{{ $libro->donacion_compra }}" required>
            </div>
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso:</label>
                <input type="text" name="fecha_ingreso" id="fecha_ingreso" value="{{ $libro->fecha_ingreso }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar Libro</button>
            <a href="{{ route('libros.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

</body>
</html>
