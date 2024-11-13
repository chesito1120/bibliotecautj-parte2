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
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
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
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" id="sexo">
                        <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                        <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                    </select>
                    <label for="grado">Grado</label>
                    <input type="text" name="grado" id="grado" value="{{ old('grado') }}" readonly>
                </div>

                <div class="form-group">
                    <label for="grado">Grado y Grupo</label>
                    <input type="text" name="grado" id="grado" value="{{ old('grado') }}">
                    <label for="grupo">Grupo</label>
                    <input type="text" name="grupo" id="grupo" value="{{ old('grupo') }}" readonly>
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
                    <input type="text" id="titulo_libro" placeholder="Buscar libro">
                    <div id="suggestions" style="display: none; border: 1px solid #ccc;"></div>
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
        $(document).ready(function() {
        // Establecer la fecha de préstamo como la fecha actual
        var today = new Date().toISOString().split('T')[0];  // Formato YYYY-MM-DD
        $('#fecha_prestamo').val(today);
        togglePrestamoForm();
        $('#tipo_usuario').on('change', function() {
            var tipoUsuario = $(this).val();
            if (tipoUsuario === 'maestro') {
                $('#grado').closest('.form-group').hide();
                $('#grupo').closest('.form-group').hide();
                $('#carrera').closest('.form-group').hide();
            } else {
                $('#grado').closest('.form-group').show();
                $('#grupo').closest('.form-group').show();
                $('#carrera').closest('.form-group').show();
            }
        });
        // Mostrar formulario de préstamo cuando el servicio sea "Préstamo Externo"
        $('#servicio').on('change', function() {
            togglePrestamoForm();
        });
        // AJAX para obtener los datos de la matrícula
        $('#matricula').on('change', function() {
            var matricula = $(this).val().trim();
            if (matricula.length > 0) {
                $.ajax({
                    url: '/visitas/usuario/' + matricula,
                    method: 'GET',
                    success: function(response) {
                        // Llenar los campos si la respuesta tiene datos
                        $('#nombre').val(response.nombre);
                        $('#grado').val(response.grado);
                        $('#grupo').val(response.grupo);
                        $('#carrera').val(response.carrera);
                    },
                    error: function() {
                        // Limpiar los campos si la matrícula no es válida
                        $('#nombre').val('');
                        $('#grado').val('');
                        $('#grupo').val('');
                        $('#carrera').val('');
                        alert('Usuario no encontrado. Verifique la matrícula.');
                    }
                });
            } else {
                // Limpiar los campos si se borra el contenido de la matrícula
                $('#nombre').val('');
                $('#grado').val('');
                $('#grupo').val('');
                $('#carrera').val('');
            }
        });
    });
    // Función para mostrar u ocultar formulario de préstamo
    function togglePrestamoForm() {
        var servicio = $('#servicio').val();
        if (servicio === 'prestamo') {
            $('#prestamoForm').show();
        } else {
            $('#prestamoForm').hide();
        }
    }
    // Mostrar fecha de renovación solo si se selecciona 'Sí'
    function toggleRenovacionFecha() {
        var renovacion = $('#renovacion').val();
        if (renovacion === 'si') {
            $('#fechaRenovacion').show();
        } else {
            $('#fechaRenovacion').hide();
        }
    }
    </script>
    
    <script>
    $(document).ready(function() {
        $('#titulo_libro').on('input', function() {
            var query = $(this).val();
            if (query.length > 1) { // Empieza a buscar cuando haya al menos 2 caracteres
                $.ajax({
                    url: '/libros/buscar', // Ruta correcta para hacer la búsqueda
                    method: 'GET',
                    data: { query: query },
                    success: function(response) {
                        var suggestions = $('#suggestions');
                        suggestions.empty(); // Limpiar las sugerencias anteriores
                        if (response.length > 0) {
                            response.forEach(function(libro) {
                                // Crear un item de sugerencia con los datos del libro
                                var suggestionItem = `
                                    <div class="suggestion-item" style="padding: 8px; cursor: pointer;">
                                        <strong>${libro.titulo}</strong><br>
                                        Autor: ${libro.autor}<br>
                                        No. de Clasificación: ${libro.no_clasificacion}
                                    </div>
                                `;
                                suggestions.append(suggestionItem); // Añadir la sugerencia a la lista
                            });
                            suggestions.show(); // Mostrar las sugerencias
                        } else {
                            suggestions.hide(); // Ocultar sugerencias si no hay resultados
                        }
                    },
                    error: function() {
                        // En caso de error en la solicitud
                        console.error('Error al realizar la búsqueda de libros.');
                    }
                });
            } else {
                $('#suggestions').hide(); // Ocultar sugerencias si el campo está vacío
            }
        });
        // Rellenar los campos al seleccionar una sugerencia
        $(document).on('click', '.suggestion-item', function() {
            var tituloSeleccionado = $(this).find('strong').text();
            var autorSeleccionado = $(this).find('div').eq(1).text().replace('Autor: ', '');
            var clasificacionSeleccionada = $(this).find('div').eq(2).text().replace('No. de Clasificación: ', '');
            // Rellenar los campos con los datos del libro seleccionado
            $('#titulo_libro').val(tituloSeleccionado);
            $('#autor').val(autorSeleccionado);
            $('#no_clasificacion').val(clasificacionSeleccionada);
            // Ocultar las sugerencias después de seleccionar un libro
            $('#suggestions').hide();
        });
    });
    </script>
    
    
    <a href="{{ route('visitas.index') }}" class="btn btn-metricas">Ver Métricas</a>
</body>
</html>