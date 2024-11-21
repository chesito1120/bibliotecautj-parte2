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
                <form action="{{ route('visitas.prestamo_libro') }}" method="POST"> 
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
                            <input type="text" name="sexo" id="sexo" class="form-control" value="{{ old('sexo') }} "readonly>
                        </div>

                        <div class="form-group">
                            <label for="grado">Grado</label>
                            <input type="text" name="grado" id="grado" class="form-control" value="{{ old('grado') }}"readonly>
                        </div>
                        <div class="form-group">
                            <label for="grado">Grupo</label>
                            <input type="text" name="grupo" id="grupo" class="form-control" value="{{ old('grupo') }}"readonly>
                        </div>

                        <div class="form-group">
                            <label for="fecha_prestamo">Fecha de Préstamo</label>
                            <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo') }}">
                        </div>

                        <div class="form-group">
                            <label for="tipo_usuario">Tipo de Usuario</label>
                            {{-- <select name="tipo_usuario" id="tipo_usuario" class="form-control">
                                <option value="alumno" {{ old('tipo_usuario') == 'alumno' ? 'selected' : '' }}>Alumno</option>
                                <option value="maestro" {{ old('tipo_usuario') == 'maestro' ? 'selected' : '' }}>Maestro</option>
                            </select> --}}
                            <input type="text" name="tipo_usuario" id="tipo_usuario" class="form-control" value="{{ old('tipo_usuario') }}" readonly>
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

                    <div class="text-center">
                        <button type="submit" class="btn btn-success btn-lg mt-4">Continuar</button>
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

        // Ejecutar la función al cargar la página si ya hay un servicio seleccionado
        togglePrestamoForm();
    </script>
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
                                $('#tipo_usuario').val(response.tipo_usuario);
                            },
                            error: function() {
                                $('#matricula').val('');
                                $('#nombre').val('');
                                $('#grado').val('');
                                $('#grupo').val('');
                                $('#carrera').val('');
                                $('#sexo').val('');
                                $('#tipo_usuario').val('');
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

    @endsection
