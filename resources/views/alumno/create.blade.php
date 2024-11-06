<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agregar Alumno</title>
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
        input[type="text"], input[type="number"], input[type="email"] {
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

</body>
</html>
