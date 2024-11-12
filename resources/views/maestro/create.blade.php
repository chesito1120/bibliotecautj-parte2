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
                    <label for="carrera_ads" style="color: #2C6E49;">Carrera Asignada:</label>
                    <select class="form-control border border-success" id="carrera_ads" name="carrera_ads" required>
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
