@extends('adminlte::page')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Logo y Título -->
        <div class="col-12 text-center mb-5">
            <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 200px;">
            <h2 class="mt-4" style="color: #2C6E49;">Editar a un docente</h2>
            <hr style="border-top: 3px solid #2C6E49; width: 50px;">
        </div>

        <!-- Formulario -->
        <form action="{{ route('maestros.update', $maestro) }}" method="POST" class="col-lg-8">
            @csrf
            @method('PUT')
            
            <!-- Mensajes de éxito y error -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Campos del formulario -->
            <div class="form-group">
                <label for="nombre" style="color: #2C6E49;">Nombre del Docente:</label>
                <input type="text" name="nombre" id="nombre" value="{{ $maestro->nombre }}" class="form-control border border-success" required>
            </div>

            <div class="form-group">
                <label for="numero_empleado" style="color: #2C6E49;">Número de empleado:</label>
                <input type="text" name="numero_empleado" id="numero_empleado" value="{{ $maestro->numero_empleado }}" class="form-control border border-success" required>
            </div>

            <div class="form-group">
                <label for="carrera_ads" style="color: #2C6E49;">Carrera Asignada:</label>
                <select class="form-control border border-success" id="carrera_ads" name="carrera_ads" required>
                    <option value="">Seleccione su carrera</option>
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
                <label for="turno" style="color: #2C6E49;">Turno:</label>
                <select class="form-control border border-success" id="turno" name="turno" required>
                    <option value="">Seleccione su turno</option>
                    <option value="Matutino">Matutino</option>
                    <option value="Vespertino">Vespertino</option>
                </select>
            </div>

            <div class="form-group">
                <label for="sexo" style="color: #2C6E49;">Sexo:</label>
                <select class="form-control border border-success" id="sexo" name="sexo" required>
                    <option value="">Seleccione su sexo</option>
                    <option value="Hombre">Hombre</option>
                    <option value="Mujer">Mujer</option>
                </select>
            </div>

            <div class="form-group">
                <label for="puesto" style="color: #2C6E49;">Puesto que desempeña:</label>
                <select class="form-control border border-success" id="puesto" name="puesto" required>
                    <option value="">Seleccione su sexo</option>
                    <option value="Profesores de Asignatura">Profesores de Asignatura</option>
                    <option value="Profesores de Tiempo Completo">Profesores de Tiempo Completo</option>
                </select>
            </div>

            <!-- Botones de acción -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success mr-3">Actualizar Docente</button>
                <a href="{{ route('maestro.index') }}" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection
