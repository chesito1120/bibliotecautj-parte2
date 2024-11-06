<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Docente</title>
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
        input[type="text"], input[type="number"], select {
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
        <h2>Editar a un docente</h2>
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

        <!-- Formulario para editar docentes -->
        <form action="{{ route('maestros.update', $maestro) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="nombre">Nombre del Docente:</label>
                <input type="text" name="nombre" id="nombre" value="{{ $maestro->nombre }}" required>
            </div>
            <div class="form-group">
                <label for="numero_empleado">Número de empleado:</label>
                <input type="text" name="numero_empleado" id="numero_empleado" value="{{ $maestro->numero_empleado }}" required>
            </div>
            <div class="form-group">
                <label for="carrera_ads">Carrera Asignada:</label>
                <select class="form-control" id="carrera_ads" name="carrera_ads" required>
                        <option value="">Seleccione su carrera</option>
                        <option value="Licenciatura en Administración">Licenciatura en Administración</option>
                        <option value="TSU Gestión del Capital Humano">TSU Gestión del Capital Humano</option>
                        <option value="Ingeniería Ambiental y Sustentabilidad">Ingeniería Ambiental y Sustentabilidad</option>
                        <option value="TSU Gestión Ambiental">TSU Gestión Ambiental</option>
                        <option value="Ingeniería en Química Farmacéutica">Ingeniería en Química Farmacéutica</option>
                        <option value="TSU Química Tecnología Farmacéutica">TSU Química Tecnología Farmacéutica</option>
                        <option value="Licenciatura en Asesor Financiero">Licenciatura en Asesor Financiero</option>
                        <option value="TSU Asesor Financiero">TSU Asesor Financiero</option>
                        <option value="Ingeniería Mecatrónica">Ingeniería Mecatrónica</option>
                        <option value="TSU Automatización">TSU Automatización</option>
                        <option value="TSU Robótica">TSU Robótica</option>
                        <option value="Licenciatura en Negocios y Mercadotecnia">Licenciatura en Negocios y Mercadotecnia</option>
                        <option value="TSU Mercadotecnia">TSU Mercadotecnia</option>
                        <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                        <option value="TSU Automotriz">TSU Automotriz</option>
                        <option value="TSU Maquinados de Precisión">TSU Maquinados de Precisión</option>
                        <option value="TSU Moldeo de Plástico">TSU Moldeo de Plástico</option>
                        <option value="Ingeniería en Mantenimiento Industrial">Ingeniería en Mantenimiento Industrial</option>
                        <option value="TSU Mantenimiento a Maquinaria Pesada">TSU Mantenimiento a Maquinaria Pesada</option>
                        <option value="TSU Mantenimiento Industrial">TSU Mantenimiento Industrial</option>
                        <option value="Ingeniería en Tecnologías de la Información e Innovación Digital">Ingeniería en Tecnologías de la Información e Innovación Digital</option>
                        <option value="TSU Entornos Virtuales y Negocios Digitales">TSU Entornos Virtuales y Negocios Digitales</option>
                        <option value="TSU Desarrollo de Software Multiplataforma">TSU Desarrollo de Software Multiplataforma</option>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="turno">Turno:</label>
                <input type="text" name="turno" id="turno" value="{{ $maestro->turno }}" required>
            </div>
            <div class="form-group">
                <label for="sexo">Sexo:</label>
                <input type="text" name="sexo" id="sexo" value="{{ $maestro->sexo }}" required>
            </div>
            <div class="form-group">
                <label for="puesto">Puesto que desempeña:</label>
                <input type="text" name="puesto" id="puesto" value="{{ $maestro->puesto }}" required>
            </div>

            <button type="submit" class="btn btn-success">Actualizar Docente</button>
            <a href="{{ route('maestro.index') }}" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

</body>
</html>
