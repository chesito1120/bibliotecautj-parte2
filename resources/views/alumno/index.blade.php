@extends('adminlte::page')

@section('title', 'Lista de Estudiantes')

@section('content')
<div class="container">
    <div class="col-12 text-center mb-4">
        <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
    </div>
    <h2 class="text-center mb-4">Lista de Estudiantes</h2>

         <!-- Formulario de búsqueda -->
    <div class="search-container text-center mb-4">
        <form action="{{ route('alumnos.index') }}" method="GET" class="form-inline justify-content-center">
            <input type="text" name="search" placeholder="Buscar por nombre" value="{{ request('search') }}" class="form-control mr-2 w-50">
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>
    </div>

          <!-- Tabla de Docentes -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Matrícula</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($alumnos as $alumno)
                    <tr>
                        <td>{{ $alumno->id }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->matricula }}</td>
                        <td>{{ $alumno->carrera }}</td>
                        <td>
                            <a href="{{ route('alumnos.show', $alumno) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('alumnos.edit', $alumno) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('alumnos.destroy', $alumno) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align:center;">No se encontraron alumnos</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Mensaje de resultados -->
        <div class="results-info">
            Mostrando {{ $alumnos->firstItem() }} a {{ $alumnos->lastItem() }} de {{ $alumnos->total() }} resultados
        </div>

        <!-- Paginación -->
        <div class="pagination-container">
            {{ $alumnos->appends(['search' => request('search')])->links() }}
        </div>

        <!-- Botón para agregar nuevo alumno -->
        <div style="text-align: center;">
            <a href="{{ route('alumnos.create') }}" class="btn btn-success">Agregar Nuevo Alumno</a>
        </div>
    </div>
@endsection
