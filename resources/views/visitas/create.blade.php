<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrar Visita</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
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
        input, select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
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
        #prestamoForm {
            display: none;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Registrar Visita a Biblioteca</h2>
        <hr>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('visitas.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="matricula">Matrícula</label>
                <input type="text" name="matricula" id="matricula" value="{{ old('matricula') }}" required>
            </div>

            <div class="form-group">
                <label for="servicio">Servicio</label>
                <select name="servicio" id="servicio" onchange="togglePrestamoForm()" required>
                    <option value="" disabled selected>Seleccione un servicio</option>
                    <option value="computo" {{ old('servicio') == 'computo' ? 'selected' : '' }}>Computo</option>
                    <option value="acervo" {{ old('servicio') == 'acervo' ? 'selected' : '' }}>Acervo</option>
                    <option value="prestamo" {{ old('servicio') == 'prestamo' ? 'selected' : '' }}>Préstamo Externo</option>
                </select>
            </div>

            <!-- Formulario adicional que aparece cuando se selecciona "Préstamo Externo" -->
            <div id="prestamoForm">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}">
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo">
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="grado">Grado y Grupo</label>
                    <input type="text" name="grado" id="grado" value="{{ old('grado') }}">
                </div>

                <div class="form-group">
                    <label for="fecha_prestamo">Fecha de Préstamo</label>
                    <input type="date" name="fecha_prestamo" id="fecha_prestamo" value="{{ old('fecha_prestamo') }}">
                </div>

                <div class="form-group">
                    <label for="tipo_usuario">Tipo de Usuario</label>
                    <select name="tipo_usuario" id="tipo_usuario">
                        <option value="alumno" {{ old('tipo_usuario') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                        <option value="maestro" {{ old('tipo_usuario') == 'maestro' ? 'selected' : '' }}>Maestro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="carrera">Carrera</label>
                    <select name="carrera" id="carrera">
                        <option value="TSU" {{ old('carrera') == 'TSU' ? 'selected' : '' }}>TSU</option>
                        <option value="Ingeniería" {{ old('carrera') == 'Ingeniería' ? 'selected' : '' }}>Ingeniería</option>
                        <option value="Licenciatura" {{ old('carrera') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="titulo_libro">Título del Libro</label>
                    <input type="text" name="titulo_libro" id="titulo_libro" value="{{ old('titulo_libro') }}">
                </div>

                <div class="form-group">
                    <label for="autor">Autor(a)</label>
                    <input type="text" name="autor" id="autor" value="{{ old('autor') }}">
                </div>

                <div class="form-group">
                    <label for="no_clasificacion">No. de Clasificación</label>
                    <input type="text" name="no_clasificacion" id="no_clasificacion" value="{{ old('no_clasificacion') }}">
                </div>

                <div class="form-group">
                    <label for="renovacion">¿Renovación?</label>
                    <select name="renovacion" id="renovacion" onchange="toggleRenovacionFecha()">
                        <option value="no" {{ old('renovacion') == 'no' ? 'selected' : '' }}>No</option>
                        <option value="si" {{ old('renovacion') == 'si' ? 'selected' : '' }}>Sí</option>
                    </select>
                </div>

                <div id="fechaRenovacion" class="form-group" style="display: none;">
                    <label for="fecha_renovacion">Fecha de Renovación</label>
                    <input type="date" name="fecha_renovacion" id="fecha_renovacion" value="{{ old('fecha_renovacion') }}">
                </div>
            </div>

            <button type="submit" class="btn btn-success">Registrar</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function togglePrestamoForm() {
            var servicio = document.getElementById('servicio').value;
            var prestamoForm = document.getElementById('prestamoForm');
            if (servicio === 'prestamo') {
                prestamoForm.style.display = 'block';
            } else {
                prestamoForm.style.display = 'none';
            }
        }

        function toggleRenovacionFecha() {
            var renovacion = document.getElementById('renovacion').value;
            var fechaRenovacion = document.getElementById('fechaRenovacion');
            if (renovacion === 'si') {
                fechaRenovacion.style.display = 'block';
            } else {
                fechaRenovacion.style.display = 'none';
            }
        }

        // AJAX para obtener los datos de la matrícula
        $('#matricula').on('input', function() {
            var matricula = $(this).val();
            if (matricula.length > 0) {
                $.ajax({
                    url: '/visitas/usuario/' + matricula,
                    method: 'GET',
                    success: function(response) {
                        if (response) {
                            $('#nombre').val(response.nombre);
                            $('#sexo').val(response.sexo);
                            $('#grado').val(response.grado);
                            $('#tipo_usuario').val(response.tipo_usuario);
                            $('#carrera').val(response.carrera);
                        }
                    }
                });
            }
        });

        // Ejecutar la función al cargar la página si ya hay un servicio seleccionado
        togglePrestamoForm();
    </script>

</body>
</html>
