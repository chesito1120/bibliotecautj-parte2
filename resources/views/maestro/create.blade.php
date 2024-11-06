@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
                <h2 style="color: #2F4F4F;">Agregar Nuevo Docente</h2>
            </div>
            
            <!-- Formulario -->
            <form action="{{ route('maestro.store') }}" method="POST" class="col-lg-7 mx-auto">
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

                <div class="form-group">
                    <label for="nombre" style="color: #2E8B57;">Nombre del Docente:</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>

                <div class="form-group">
                    <label for="numero_empleado" style="color: #2E8B57;">Número de Empleado:</label>
                    <input type="text" class="form-control" id="numero_empleado" name="numero_empleado" required>
                </div>

                <div class="form-group">
                    <label for="carrera_ads" style="color: #2E8B57;">Carrera Asignada:</label>
                    <input type="text" class="form-control" id="carrera_ads" name="carrera_ads" required>
                </div>

                <div class="form-group">
                    <label for="turno" style="color: #2E8B57;">Turno:</label>
                    <input type="text" class="form-control" id="turno" name="turno" required>
                </div>

                <div class="form-group">
                    <label for="sexo" style="color: #2E8B57;">Sexo:</label>
                    <input type="text" class="form-control" id="sexo" name="sexo" required>
                </div>

                <div class="form-group">
                    <label for="puesto" style="color: #2E8B57;">Puesto:</label>
                    <input type="text" class="form-control" id="puesto" name="puesto" required>
                </div>

                <!-- Botones -->
                <a href="{{ route('maestros.create') }}" class="btn" style="background-color: #556B2F; color: white; margin-right: 10px;">Cancelar</a>
                <button type="submit" class="btn" style="background-color: #6B8E23; color: white;">Agregar Docente</button>
            </form>
        </div>
    </div>

@endsection
