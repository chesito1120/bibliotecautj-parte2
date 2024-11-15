@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Logo y Título -->
        <div class="col-12 text-center mb-4">
            <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" class="img-fluid" style="max-width: 950px;">
        </div>
        
        <!-- Formulario -->
        <div class="col-lg-8 col-md-10 col-sm-12">
            <form action="{{ route('visitas.store') }}" method="POST">
                @csrf
                
                <!-- Mensaje de éxito o error -->
                @if(session('success'))
                    <div class="alert alert-success mb-3">
                        {{ session('success') }}
                    </div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <h3 class="text-center mb-4">Registrar Visita a Biblioteca</h3>
                <hr>

                <div class="form-group">
                    <label for="matricula">Matrícula</label>
                    <input type="text" name="matricula" id="matricula" class="form-control" value="{{ old('matricula') }}" required>
                </div>

                <div class="form-group">
                    <label for="servicio">Servicio</label>
                    <select name="servicio" id="servicio" class="form-control" onchange="togglePrestamoForm()" required>
                        <option value="" disabled selected>Seleccione un servicio</option>
                        <option value="computo" {{ old('servicio') == 'computo' ? 'selected' : '' }}>Computo</option>
                        <option value="acervo" {{ old('servicio') == 'acervo' ? 'selected' : '' }}>Acervo</option>
                        <option value="prestamo" {{ old('servicio') == 'prestamo' ? 'selected' : '' }}>Préstamo Externo</option>
                    </select>
                </div>

                <!-- Formulario adicional para "Préstamo Externo" -->
                <div id="prestamoForm" style="display: none;">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }} "readonly>
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        {{-- <select name="sexo" id="sexo" class="form-control">
                            <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select> --}}
                        <input type="text" name="sexo" id="sexo" class="form-control" value="{{ old('sexo') }} "readonly>
                    </div>

                    <div class="form-group">
                        <label for="grado">Grado y Grupo</label>
                        <input type="text" name="grado" id="grado" class="form-control" value="{{ old('grado') }}"readonly>
                    </div>

                    <div class="form-group">
                        <label for="fecha_prestamo">Fecha de Préstamo</label>
                        <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo') }}">
                    </div>

                    <div class="form-group">
                        <label for="tipo_usuario">Tipo de Usuario</label>
                        <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                            <option value="alumno" {{ old('tipo_usuario') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                            <option value="maestro" {{ old('tipo_usuario') == 'maestro' ? 'selected' : '' }}>Maestro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        {{-- <select name="carrera" id="carrera" class="form-control">
                            <option value="TSU" {{ old('carrera') == 'TSU' ? 'selected' : '' }}>TSU</option>
                            <option value="Ingeniería" {{ old('carrera') == 'Ingeniería' ? 'selected' : '' }}>Ingeniería</option>
                            <option value="Licenciatura" {{ old('carrera') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                        </select> --}}
                        <input type="text" name="carrera" id="carrera" class="form-control" value="{{ old('carrera') }}" readonly>
                    </div>

                    <div class="form-group position-relative">
                        <label for="titulo_libro">Título del Libro</label>
                        <input type="text" name="titulo_libro" id="titulo_libro" class="form-control" value="{{ old('titulo_libro') }}">
                        <div id="suggestions" style="display: none; border: 1px solid #ccc; background: #fff; position: absolute; z-index: 1000; max-height: 150px; overflow-y: auto;"></div>
                    </div>

                    <div class="search-container mb-3">
                        <form action="{{ route('libros.index') }}" method="GET" class="d-flex">
                            <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ request('search') }}" class="form-control">
                            <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                        </form>
                    </div>

                    <div class="form-group">
                        <label for="autor">Autor(a)</label>
                        <input type="text" name="autor" id="autor" class="form-control" value="{{ old('autor') }}">
                    </div>

                    <div class="form-group">
                        <label for="no_clasificacion">No. de Clasificación</label>
                        <input type="text" name="no_clasificacion" id="no_clasificacion" class="form-control" value="{{ old('no_clasificacion') }}">
                    </div>

                    <div class="form-group">
                        <label for="renovacion">¿Renovación?</label>
                        <select name="renovacion" id="renovacion" class="form-control" onchange="toggleRenovacionFecha()">
                            <option value="no" {{ old('renovacion') == 'no' ? 'selected' : '' }}>No</option>
                            <option value="si" {{ old('renovacion') == 'si' ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>

                    <div id="fechaRenovacion" class="form-group" style="display: none;">
                        <label for="fecha_renovacion">Fecha de Renovación</label>
                        <input type="date" name="fecha_renovacion" id="fecha_renovacion" class="form-control" value="{{ old('fecha_renovacion') }}">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg mt-4">Registrar</button>
                    <a href="{{ route('visitas.index') }}" class="btn btn-info btn-lg">Ver Métricas</a>
                </div>
            </form>
        </div>
    </div>
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

    // Ejecutar la función al cargar la página si ya hay un servicio seleccionado
    togglePrestamoForm();
    </script>
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
                            $('#sexo').val(response.sexo);
                        },
                        error: function() {
                            $('#matricula').val('');
                            $('#nombre').val('');
                            $('#grado').val('');
                            $('#grupo').val('');
                            $('#carrera').val('');
                            $('#sexo').val('');
                            alert('Usuario no encontrado. Redirigiendo a la página de registro...');
                            window.location.href = '/alumnos/create';
                        }
                    });
                } else {
                    // Limpiar los campos si se borra el contenido de la matrícula
                    $('#matricula').val('');
                    $('#nombre').val('');
                    $('#grado').val('');
                    $('#grupo').val('');
                    $('#carrera').val('');
                    $('#sexo').val('');
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
                // Función para mostrar las sugerencias
                $('#titulo_libro').on('input', function() {
                    var query = $(this).val();
                    var suggestions = $('#suggestions');
                    
                    // Solo buscar si hay al menos 2 caracteres
                    if (query.length > 1) {
                        $.ajax({
                            url: '/libros/buscar',
                            method: 'GET',
                            data: { query: query },
                            success: function(response) {
                                suggestions.empty(); // Limpiar las sugerencias anteriores

                                if (response.length > 0) {
                                    // Mostrar las sugerencias
                                    response.forEach(function(libro) {
                                        var suggestionItem = `
                                            <div class="suggestion-item" style="padding: 8px; cursor: pointer;">
                                                <strong>${libro.titulo}</strong><br>
                                                Autor: ${libro.autor}<br>
                                                No. de Clasificación: ${libro.clas_dewey}
                                            </div>
                                        `;
                                        suggestions.append(suggestionItem);
                                    });
                                    suggestions.show(); // Asegurarse de que las sugerencias estén visibles
                                } else {
                                    suggestions.hide(); // Ocultar si no hay sugerencias
                                }
                            },
                            error: function() {
                                console.error('Error al realizar la búsqueda de libros.');
                            }
                        });
                    } else {
                        suggestions.hide(); // Ocultar sugerencias si el campo está vacío
                    }
                });

                // Rellenar los campos al hacer clic en una sugerencia
                $(document).on('click', '.suggestion-item', function() {
                    var tituloSeleccionado = $(this).find('strong').text();
                    var autorSeleccionado = $(this).text().split('Autor: ')[1].split('No. de Clasificación: ')[0].trim();
                    var clasificacionSeleccionada = $(this).text().split('No. de Clasificación: ')[1].trim();

                    // Rellenar los campos
                    $('#titulo_libro').val(tituloSeleccionado);
                    $('#autor').val(autorSeleccionado);
                    $('#no_clasificacion').val(clasificacionSeleccionada);

                    // Ocultar las sugerencias
                    $('#suggestions').hide();
                });
            });

        </script>
        
        
        {{-- <a href="{{ route('visitas.index') }}" class="btn btn-metricas">Ver Métricas</a> --}}
@endsection
