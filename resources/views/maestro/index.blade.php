<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Importar Docentes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e8f5e9; /* Verde suave */
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            max-width: 600px;
            background-color: #ffffff;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }
        .logo {
            width: 500px;
            margin: 0 auto 20px;
        }
        h2 {
            color: #2e7d32; /* Verde más oscuro */
            margin-bottom: 20px;
        }
        hr {
            border: none;
            height: 2px;
            background-color: #2e7d32;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }
        label {
            font-weight: bold;
            color: #2e7d32;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            outline: none;
            margin-top: 5px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            width: 48%;
            display: inline-block;
        }
        .btn-success {
            background-color: #4caf50;
            color: white;
        }
        .btn-danger {
            background-color: #d32f2f;
            color: white;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .alert {
            padding: 10px;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 20px;
        }
        .alert-success {
            background-color: #c8e6c9; /* Verde claro */
            color: #2e7d32; /* Verde más oscuro */
        }
        .alert-danger {
            background-color: #ffcdd2;
            color: #c62828;
        }
    </style>    
</head>
<body>  
        
    <div class="container">
        <!-- Logo -->
        <img src="{{ asset('images/logo_utj.png') }}" alt="Logo" class="logo">

        <h2>Importar Docentes desde CSV</h2>
        <hr>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulario para cargar CSV -->
        <form action="{{ route('maestros.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Seleccionar archivo CSV:</label>
                <input type="file" name="file" id="file" required>
            </div>

            <button type="submit" class="btn btn-success">Importar CSV</button>
            <a href="/" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

</body>
</html>
