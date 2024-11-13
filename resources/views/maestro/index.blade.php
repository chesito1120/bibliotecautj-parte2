@extends('adminlte::page')

@section('title', 'Lista de Docentes')

@section('content')
<div class="container">
    <div class="col-12 text-center mb-4">
        <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
    </div>
    <h2 class="text-center mb-4">Lista de Docentes</h2>

    <!-- Formulario de búsqueda -->
    <div class="search-container text-center mb-4">
        <form action="{{ route('maestro.index') }}" method="GET" class="form-inline justify-content-center">
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
                    <th>Numero de empleado</th>
                    <th>Carrera</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($maestros as $maestro)
                    <tr>
                        <td class="text-center">{{ $maestro->id }}</td>
                        <td>{{ $maestro->nombre }}</td>
                        <td>{{ $maestro->numero_empleado }}</td>
                        <td>{{ $maestro->carrera_ads }}</td>
                        <td class="text-center">
                            <a href="{{ route('maestro.show', $maestro) }}" class="btn btn-info btn-sm">Ver</a>
                            <a href="{{ route('maestro.edit', $maestro) }}" class="btn btn-warning btn-sm">Editar</a>
                            <form action="{{ route('maestro.destroy', $maestro) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No se encontraron docentes</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Mensaje de resultados -->
    @if($maestros->total() > 0)
        <div class="results-info text-center my-3">
            Mostrando {{ $maestros->firstItem() }} a {{ $maestros->lastItem() }} de {{ $maestros->total() }} resultados
        </div>
    @endif

    <!-- Paginación -->
    <div class="d-flex justify-content-center mt-3">
        {{ $maestros->appends(['search' => request('search')])->links() }}
    </div>

    <!-- Botón para agregar nuevo docente -->
    <div class="text-center mt-4">
        <a href="{{ route('maestros.create') }}" class="btn btn-success">Agregar Nuevo Docente</a>
    </div>
</div>
@endsection
