@extends('adminlte::page')

@section('content')

<div class="container mt-5">
    <!-- Logo y Título -->
    <div class="text-center mb-4">
        <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 400px;">
        <h2 class="mt-3" style="color: #2F4F4F;">Detalles del Docente</h2>
    </div>
    
    <!-- Card para Detalles del Maestro -->
    <div class="card shadow-lg p-4" style="max-width: 600px; margin: auto;">
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

        <!-- Información del Docente -->
        <div class="container">
            <h4 class="text-center mb-4">{{ $maestro->nombre }}</h4>

            <p><strong>Nombre:</strong> {{ $maestro->nombre ?? 'N/A' }}</p>
            <p><strong>Número de Empleado:</strong> {{ $maestro->numero_empleado ?? 'N/A' }}</p>
            <p><strong>Carrera Asignada:</strong> {{ $maestro->carrera_ads ?? 'N/A' }}</p>
            <p><strong>Turno:</strong> {{ $maestro->turno ?? 'N/A' }}</p>
            <p><strong>Sexo:</strong> {{ $maestro->sexo ?? 'N/A' }}</p>
            <p><strong>Puesto:</strong> {{ $maestro->puesto ?? 'N/A' }}</p>
        </div>

        <!-- Botones de Acción -->
        <div class="text-center mt-4">
            <a href="{{ route('maestro.show', $maestro) }}" class="btn btn-primary">Editar</a>

            <form action="{{ route('maestro.destroy', $maestro) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Eliminar</button>
            </form>

            <a href="{{ route('maestro.index') }}" class="btn btn-secondary">Volver a la Lista</a>
        </div>
    </div>
</div>

@endsection
