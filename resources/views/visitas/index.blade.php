@extends('adminlte::page')
@section('title', 'Metricas Generales')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">Métricas de Visitas</h1>

        <!-- Sección de Visitas Generales -->
        <h3>Visitas Generales</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total de Visitas</td>
                    <td>{{ $total_visitas }}</td>
                </tr>
                <tr>
                    <td>Visitas por Servicio</td>
                    <td>Acervo: {{ $visitas_acervo }}, Cómputo: {{ $visitas_computo }}, Préstamos: {{ $prestamos_externos }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Sección de Usuarios -->
        <h3>Usuarios</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total de Alumnos</td>
                    <td>{{ $total_alumnos }}</td>
                </tr>
                <tr>
                    <td>Total de Maestros</td>
                    <td>{{ $total_maestros }}</td>
                </tr>
                <tr>
                    <td>Carrera con más Visitas</td>
                    <td>{{ $carrera_mas_visitas }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Sección de Detalles por Carrera y Sexo -->
        <h3>Reporte Detallado por Carrera y Sexo</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Carrera</th>
                    <th>Sexo</th>
                    <th>Tipo de Usuario</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos_carreras as $carrera => $grupo)
                    <tr>
                        <td colspan="4"><strong>{{ $carrera }}</strong></td>
                    </tr>
                    @foreach ($grupo as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->sexo }}</td>
                            <td>{{ $item->tipo_usuario }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Sección de Detalles por Carrera, Grado, Grupo y Sexo -->
        <h3>Reporte Detallado por Carrera, Grado, Grupo y Sexo</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Carrera</th>
                    <th>Grado</th>
                    <th>Grupo</th>
                    <th>Sexo</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($detalles_carreras_grado_grupo as $key => $grupo)
                    <tr>
                        <td colspan="5"><strong>{{ $key }}</strong></td>
                    </tr>
                    @foreach ($grupo as $item)
                        <tr>
                            <td></td>
                            <td>{{ $item->grado }}</td>
                            <td>{{ $item->grupo }}</td>
                            <td>{{ $item->sexo }}</td>
                            <td>{{ $item->cantidad }}</td>
                        </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>

        <!-- Sección de Usuarios por Servicio -->
        <h3>Usuarios por Servicio</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Servicio</th>
                    <th>Cantidad de Hombres</th>
                    <th>Cantidad de Mujeres</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cantidad_hombres_por_servicio as $servicio)
                    <tr>
                        <td>{{ $servicio->servicio }}</td>
                        <td>{{ $servicio->cantidad_hombres }}</td>
                        <td>{{ $servicio->cantidad_mujeres }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Sección de Última Visita -->
        <h3>Última Visita</h3>
        @if ($ultimo_usuario)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Descripción</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Último Usuario</td>
                        <td>{{ $ultimo_usuario->alumno->nombre ?? $ultimo_usuario->maestro->nombre }}</td>
                    </tr>
                    <tr>
                        <td>Servicio</td>
                        <td>{{ $ultimo_usuario->servicio }}</td>
                    </tr>
                    <tr>
                        <td>Fecha y Hora</td>
                        <td>{{ $ultimo_usuario->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        @else
            <p>No se han registrado visitas aún.</p>
        @endif

    </div>
@endsection
