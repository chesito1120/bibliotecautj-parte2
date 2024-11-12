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
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}">
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="femenino" {{ old('sexo') == 'femenino' ? 'selected' : '' }}>Femenino</option>
                            <option value="otro" {{ old('sexo') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="grado">Grado y Grupo</label>
                        <input type="text" name="grado" id="grado" class="form-control" value="{{ old('grado') }}">
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
                        <select name="carrera" id="carrera" class="form-control">
                            <option value="TSU" {{ old('carrera') == 'TSU' ? 'selected' : '' }}>TSU</option>
                            <option value="Ingeniería" {{ old('carrera') == 'Ingeniería' ? 'selected' : '' }}>Ingeniería</option>
                            <option value="Licenciatura" {{ old('carrera') == 'Licenciatura' ? 'selected' : '' }}>Licenciatura</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="titulo_libro">Título del Libro</label>
                        <input type="text" name="titulo_libro" id="titulo_libro" class="form-control" value="{{ old('titulo_libro') }}">
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
                </div>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('visitas.index') }}" class="btn btn-info btn-lg">Ver Métricas</a>
            </div>
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

@endsection
