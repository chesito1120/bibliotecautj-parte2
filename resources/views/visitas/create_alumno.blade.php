@extends('adminlte::page')

@section('content')

<div class="container mt-4">
    <div class="row justify-content-center">
        <!-- Logo y Título -->
        <div class="col-12 text-center mb-4">
            <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" class="img-fluid mb-3" style="max-width: 300px;">
            <h2 style="color: #2F4F4F;">Registrar Visita de Alumno</h2>
        </div>

        <!-- Mensajes de Éxito y Error -->
        @if(session('success'))
            <div class="alert alert-success col-md-8 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger col-md-8">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Formulario -->
        <div class="col-md-8">
            <form id="form-alumno" action="{{ route('visitas.store') }}" method="POST" class="p-4 shadow-sm rounded" style="background-color: #f9f9f9;">
                @csrf

                <!-- Matrícula -->
                <div class="form-group mb-3">
                    <label for="matricula" style="color: #2E8B57;">Matrícula:</label>
                    <input type="text" id="matricula" name="matricula" class="form-control" placeholder="Ingrese la matrícula" required>
                </div>

                <!-- Carrera -->
                <div class="form-group mb-3">
                    <label for="carrera" style="color: #2E8B57;">Carrera:</label>
                    <input type="text" id="carrera" name="carrera" class="form-control" readonly placeholder="Carrera se llenará automáticamente">
                </div>

                <!-- Servicio -->
                <div class="form-group mb-3">
                    <label for="servicio" style="color: #2E8B57;">Servicio:</label>
                    <select id="servicio" name="servicio" class="form-control" required>
                        <option value="" selected disabled>Seleccione un servicio</option>
                        <option value="computo">Cómputo</option>
                        <option value="acervo">Acervo</option>
                        <option value="prestamo">Préstamo</option>
                    </select>
                </div>

                <!-- Botones -->
                <div class="d-flex justify-content-between">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-block" style="max-width: 48%;">Cancelar</a>
                    <button type="submit" class="btn btn-success btn-block" style="max-width: 48%;">Registrar Visita</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript -->
<script>
    document.getElementById('matricula').addEventListener('blur', function () {
        const matricula = this.value;

        if (matricula) {
            fetch(`/alumnos/carrera/${matricula}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('carrera').value = data.carrera;
                    } else {
                        alert('Alumno no encontrado');
                        document.getElementById('carrera').value = '';
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

@endsection
