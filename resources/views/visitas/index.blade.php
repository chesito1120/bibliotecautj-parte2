@extends('adminlte::page')

@section('content')
    <div class="container">
        <h2 class="text-center mb-4">Métricas de Visitas</h2>

        <!-- Total de Visitas -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total de Visitas</h5>
                        <p class="card-text">{{ $total_visitas }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Alumnos -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total de Alumnos</h5>
                        <p class="card-text">{{ $total_alumnos }}</p>
                    </div>
                </div>
            </div>

            <!-- Total de Maestros -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Total de Maestros</h5>
                        <p class="card-text">{{ $total_maestros }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visitas por Servicio -->
        <h4>Visitas por Servicio</h4>
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Acervo</h5>
                        <p class="card-text">{{ $visitas_acervo }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Cómputo</h5>
                        <p class="card-text">{{ $visitas_computo }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Préstamos Externos</h5>
                        <p class="card-text">{{ $prestamos_externos }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Carrera con Más Visitas -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h4>Carrera con Más Visitas</h4>
                <p>{{ $carrera_mas_visitas }}</p>
            </div>
        </div>

        <!-- Reporte Detallado por Carrera, Tipo de Usuario y Sexo -->
        <div class="row mb-4">
            <div class="col-12">
                <h4>Reporte Detallado por Carrera, Tipo de Usuario y Sexo</h4>
                @foreach($datos_carreras as $carrera => $datos)
                    <h5>{{ $carrera }}</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tipo de Usuario</th>
                                <th>Sexo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datos as $dato)
                                <tr>
                                    <td>{{ $dato->tipo_usuario }}</td>
                                    <td>{{ $dato->sexo }}</td>
                                    <td>{{ $dato->cantidad }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>

        <!-- Reporte Detallado por Carrera, Grado, Grupo y Sexo -->
        <div class="row mb-4">
            <div class="col-12">
                <h4>Reporte Detallado por Carrera, Grado, Grupo y Sexo</h4>
                @foreach($detalles_carreras_grado_grupo as $carrera_grado_grupo => $detalles)
                    <h5>{{ $carrera_grado_grupo }}</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Sexo</th>
                                <th>Cantidad</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detalles as $detalle)
                                <tr>
                                    <td>{{ $detalle->sexo }}</td>
                                    <td>{{ $detalle->cantidad }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            </div>
        </div>

        <!-- Cantidad de Hombres por Servicio -->
        <div class="row mb-4">
            <div class="col-md-6">
                <h4>Cantidad de Hombres por Servicio</h4>
                <ul>
                    @foreach($cantidad_hombres_por_servicio as $servicio)
                        <li>{{ $servicio->servicio }}: {{ $servicio->cantidad }}</li>
                    @endforeach
                </ul>
            </div>

            <!-- Cantidad de Mujeres por Servicio -->
            <div class="col-md-6">
                <h4>Cantidad de Mujeres por Servicio</h4>
                <ul>
                    @foreach($cantidad_mujeres_por_servicio as $servicio)
                        <li>{{ $servicio->servicio }}: {{ $servicio->cantidad }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- Último Usuario que Visitó -->
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h4>Último Usuario que Visitó</h4>
                @if($ultimo_usuario)
                    <p>
                        <strong>Usuario:</strong> 
                        {{ $ultimo_usuario->alumno ? $ultimo_usuario->alumno->nombre : $ultimo_usuario->maestro->nombre }}<br>
                        <strong>Servicio:</strong> {{ $ultimo_usuario->servicio }}<br>
                        <strong>Fecha:</strong> {{ $ultimo_usuario->created_at->format('d/m/Y H:i') }}
                    </p>
                @else
                    <p>No hay visitas registradas.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
