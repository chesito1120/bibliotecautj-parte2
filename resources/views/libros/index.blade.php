@extends('adminlte::page')

@section('content')
    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
            </div>
            
            <!-- Formulario de Agregar Docente -->
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
            </form>
        </div>

        <div class="container">
            <h2 class="mt-4">Lista de Libros</h2>

            <!-- Formulario de Búsqueda -->
            <div class="search-container mb-3">
                <form action="{{ route('libros.index') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ request('search') }}" class="form-control">
                    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                </form>
            </div>

            <!-- Tabla de Libros -->
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($libros as $libro)
                        <tr>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>
                                <a href="{{ route('libros.show', $libro) }}" class="btn btn-info btn-sm">Ver</a>
                                <a href="{{ route('libros.edit', $libro) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No se encontraron libros</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <!-- Mensaje de Resultados -->
            <div class="results-info mb-3">
                <p class="text-muted">Mostrando {{ $libros->firstItem() }} a {{ $libros->lastItem() }} de {{ $libros->total() }} resultados</p>
            </div>

            <!-- Paginación -->
            <div class="pagination-container d-flex justify-content-center mb-3">
                <ul class="pagination">
                    <li class="page-item {{ $libros->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $libros->appends(['search' => request('search')])->previousPageUrl() }}">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $libros->lastPage(); $i++)
                        @if ($i >= $libros->currentPage() - 2 && $i <= $libros->currentPage() + 2)
                            <li class="page-item {{ $i == $libros->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $libros->appends(['search' => request('search')])->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                    <li class="page-item {{ $libros->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $libros->appends(['search' => request('search')])->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </div>

            <!-- Botón Agregar Nuevo Libro -->
            <div class="text-center mt-3">
                <a href="{{ route('libros.create') }}" class="btn btn-success">Agregar Nuevo Libro</a>
            </div>
        </div>
    </div>
@endsection
