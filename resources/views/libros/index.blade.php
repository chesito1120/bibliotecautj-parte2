@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
            </div>

            <!-- Mensajes -->
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
        </div>

        <div class="container mt-4">
            <h2>Estadísticas de Visitas</h2>

            <!-- Formulario de Búsqueda (si aplica) -->
            <div class="search-container mb-3">
                <form action="{{ route('visitas.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="Buscar por nombre o matrícula..." value="{{ request('search') }}" class="form-control">
                    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                </form>
            </div>

            <!-- Total de visitas -->
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-white bg-info">
                        <div class="card-header">Total de Visitas</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $total_visitas }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-success">
                        <div class="card-header">Total de Alumnos</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $total_alumnos }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-white bg-warning">
                        <div class="card-header">Total de Maestros</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $total_maestros }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Visitas por servicio -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Visitas a Acervo</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $visitas_acervo }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Visitas a Cómputo</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $visitas_computo }}</h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">Visitas por Préstamo</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $prestamos_externos }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Carrera con más visitas -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">Carrera con más visitas</div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $carrera_mas_visitas ?? 'N/A' }}</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reporte por carrera, tipo de usuario y sexo -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Reporte Detallado por Carrera, Tipo de Usuario y Sexo</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Carrera</th>
                                <th>Tipo de Usuario</th>
                                <th>Sexo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($datos_carreras as $carrera => $datos)
                                @foreach ($datos as $dato)
                                    <tr>
                                        <td>{{ $carrera }}</td>
                                        <td>{{ $dato->tipo_usuario }}</td>
                                        <td>{{ $dato->sexo }}</td>
                                        <td>{{ $dato->cantidad }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Detalle por carrera, grado y grupo -->
            <div class="row mb-4">
                <div class="col-12">
                    <h4>Detalle por Carrera, Grado y Grupo</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Carrera - Grado - Grupo</th>
                                <th>Sexo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detalles_carreras_grado_grupo as $key => $datos)
                                @foreach ($datos as $dato)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $dato->sexo }}</td>
                                        <td>{{ $dato->cantidad }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginación -->
            <div class="pagination-container d-flex justify-content-center mb-3">
                {{ $libros->links() }}
            </div>

            <!-- Botón Agregar Nueva Visita -->
            <div class="text-center mt-3">
                <a href="{{ route('visitas.create') }}" class="btn btn-success">Agregar Nueva Visita</a>
            </div>
        </div>
    </div>
@endsection
