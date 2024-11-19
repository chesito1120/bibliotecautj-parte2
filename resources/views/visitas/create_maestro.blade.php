@extends('adminlte::page')

@section('content')

<div class="container">
    <div class="row">
        <!-- Encabezado -->
        <div class="col-12 text-center mb-4">
            <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
            <h2 style="color: #2F4F4F;">Registrar Visita de Maestro</h2>
        </div>

        <!-- Formulario -->
        <form action="{{ route('visitas.store_maestro') }}" method="POST" class="col-lg-7 mx-auto">
            @csrf

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

            <!-- Número de empleado -->
            <div class="form-group">
                <label for="numero_empleado" style="color: #2E8B57;">Número de Empleado:</label>
                <input type="text" id="numero_empleado" name="numero_empleado" required class="form-control">
            </div>

            <!-- Servicio -->
            <div class="form-group">
                <label for="servicio" style="color: #2E8B57;">Servicio:</label>
                <select name="servicio" id="servicio" class="form-control border border-success" required>
                    <option value="computo">Cómputo</option>
                    <option value="acervo">Acervo</option>
                    <option value="prestamo">Préstamo</option>
                </select>
            </div>

            <!-- Actividad -->
            <div class="form-group">
                <label for="actividad" style="color: #2E8B57;">Actividad:</label>
                <input type="text" id="actividad" name="actividad" required class="form-control">
            </div>

            <!-- Cantidad de hombres -->
            <div class="form-group">
                <label for="cantidad_hombres" style="color: #2E8B57;">Cantidad de Hombres:</label>
                <input type="number" id="cantidad_hombres" name="cantidad_hombres" required class="form-control">
            </div>

            <!-- Cantidad de mujeres -->
            <div class="form-group">
                <label for="cantidad_mujeres" style="color: #2E8B57;">Cantidad de Mujeres:</label>
                <input type="number" id="cantidad_mujeres" name="cantidad_mujeres" required class="form-control">
            </div>

            <!-- Carrera -->
            <div class="form-group">
                <label for="carrera" style="color: #2C6E49;">Carrera:</label>
                <select name="carrera" id="carrera" class="form-control border border-success">
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->carrera_ads }}">{{ $carrera->carrera_ads }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Grado -->
            <div class="form-group">
                <label for="grado" style="color: #2E8B57;">Grado:</label>
                <input type="text" id="grado" name="grado" required class="form-control">
            </div>

            <!-- Grupo -->
            <div class="form-group">
                <label for="grupo" style="color: #2E8B57;">Grupo:</label>
                <input type="text" id="grupo" name="grupo" required class="form-control">
            </div>

            <!-- Turno -->
            <div class="form-group">
                <label for="turno" style="color: #2E8B57;">Turno:</label>
                <select name="turno" id="turno" class="form-control border border-success" required>
                    <option value="matutino">Matutino</option>
                    <option value="vespertino">Vespertino</option>
                    <option value="mixto">Mixto</option>

                </select>
            </div>

            <!-- Sexo -->
            <div class="form-group">
                <label for="sexo" style="color: #2E8B57;">Sexo:</label>
                <select name="sexo" id="sexo" class="form-control border border-success" required>
                    <option value="masculino">Hombre</option>
                    <option value="femenino">Mujer</option>
                </select>
            </div>

            <!-- Botones -->
            <a href="{{ route('visitas.index') }}" class="btn" style="background-color: #556B2F; color: white; margin-right: 10px;">Cancelar</a>
            <button type="submit" class="btn" style="background-color: #6B8E23; color: white;">Registrar Visita</button>
        </form>
    </div>
</div>

@endsection
