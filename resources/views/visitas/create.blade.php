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

                <!-- Formulario para "Préstamo Externo" -->
                <div id="prestamoForm" style="display: none;">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="{{ old('nombre') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="sexo">Sexo</label>
                        <input type="text" name="sexo" id="sexo" class="form-control" value="{{ old('sexo') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="grado">Grado</label>
                        <input type="text" name="grado" id="grado" class="form-control" value="{{ old('grado') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="grupo">Grupo</label>
                        <input type="text" name="grupo" id="grupo" class="form-control" value="{{ old('grupo') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="fecha_prestamo">Fecha de Préstamo</label>
                        <input type="date" name="fecha_prestamo" id="fecha_prestamo" class="form-control" value="{{ old('fecha_prestamo') }}">
                    </div>
                </div>

                <!-- Formulario para "Computo" y "Acervo" -->
                <div id="acervoComputoForm" style="display: none;">
                    <div class="form-group">
                        <label for="tipo_usuario">Tipo de Usuario</label>
                        <input type="text" name="tipo_usuario" id="tipo_usuario" class="form-control" value="{{ old('tipo_usuario') }}" readonly>
                    </div>

                    <div class="form-group">
                        <label for="carrera">Carrera</label>
                        <input type="text" name="carrera" id="carrera" class="form-control" value="{{ old('carrera') }}" readonly>
                    </div>
                </div>

                <!-- Formulario para Maestro -->
                <div id="formMaestro" style="display: none;">
                    <div class="form-group">
                        <label for="cantidad_hombres">Cantidad de Alumnos Hombres</label>
                        <input type="number" name="cantidad_hombres" id="cantidad_hombres" class="form-control" value="{{ old('cantidad_hombres') }}">
                    </div>

                    <div class="form-group">
                        <label for="cantidad_mujeres">Cantidad de Alumnos Mujeres</label>
                        <input type="number" name="cantidad_mujeres" id="cantidad_mujeres" class="form-control" value="{{ old('cantidad_mujeres') }}">
                    </div>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg mt-4">Registrar</button>
                    <a href="{{ route('visitas.store') }}" class="btn btn-info btn-lg">Ver Métricas</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Función para mostrar/ocultar el formulario basado en el servicio seleccionado
    function togglePrestamoForm() {
        var servicio = $('#servicio').val();
        var prestamoForm = $('#prestamoForm');
        var acervoComputoForm = $('#acervoComputoForm');
        var formMaestro = $('#formMaestro');

        if (servicio === 'prestamo') {
            prestamoForm.show();
            acervoComputoForm.hide();
            formMaestro.hide();
        } else {
            prestamoForm.hide();
            acervoComputoForm.show();

            // Si el tipo de usuario es maestro, mostrar el formulario correspondiente
            var matricula = $('#matricula').val().trim();
            if (matricula.length > 0) {
                $.ajax({
                    url: '/visitas/usuario/' + matricula,
                    method: 'GET',
                    success: function(response) {
                        $('#tipo_usuario').val(response.tipo_usuario);
                        $('#carrera').val(response.carrera);
                        if (response.tipo_usuario === 'maestro') {
                            formMaestro.show();
                        } else {
                            formMaestro.hide();
                        }
                    },
                    error: function() {
                        alert('Usuario no encontrado');
                    }
                });
            }
        }
    }

    $(document).ready(function() {
        // Inicializar el estado de los formularios al cargar la página
        togglePrestamoForm();
    });
</script>
@endsection
