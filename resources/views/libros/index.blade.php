<<<<<<< HEAD
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
=======
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Alumnos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ced4da;
            text-align: left;
            font-size: 16px;
        }
        th {
            background-color: #f8f9fa;
            color: #495057;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin: 5px 0;
        }
        .btn-success {
            background-color: #28a745;
            color: white;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
        }
        .btn-info {
            background-color: #17a2b8;
            color: white;
        }
        .btn-warning {
            background-color: #ffc107;
            color: black;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }
        .search-container input[type="text"] {
            padding: 10px;
            width: 70%;
            border: 1px solid #ced4da;
            border-radius: 4px;
            font-size: 16px;
        }
        .search-container button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .search-container button:hover {
            opacity: 0.9;
        }
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            list-style-type: none;
            padding: 0;
            margin: 20px 0;
        }
        .pagination button, .pagination a {
            padding: 10px 15px;
            border: 1px solid #007bff;
            border-radius: 4px;
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            background-color: white;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
            margin: 0 5px;
        }
        .pagination button:hover, .pagination a:hover {
            background-color: #007bff;
            color: white;
        }
        .results-info {
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>

    <div class="container">
        {{-- <h2>Lista de Libros</h2> --}}

        <!-- Formulario de búsqueda -->
        <div class="search-container">
            <form action="{{ route('libros.index') }}" method="GET">
                <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ request('search') }}">
                <button type="submit">Buscar</button>
>>>>>>> 5279744be2d1f10580a179cd2b2565f5bce54672
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
<<<<<<< HEAD
@endsection
=======
</body>
</html>
>>>>>>> 5279744be2d1f10580a179cd2b2565f5bce54672
