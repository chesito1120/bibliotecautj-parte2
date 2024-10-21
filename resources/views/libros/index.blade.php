<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de Libros</title>
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
        /* Estilos del buscador */
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

        /* Estilos para la paginación */
        .pagination {
            display: flex;
            justify-content: center; /* Centrar los elementos */
            align-items: center; /* Alinear verticalmente */
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
            margin: 0 5px; /* Espaciado entre los botones */
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
        <h2>Lista de Libros</h2>

        <!-- Formulario de búsqueda -->
        <div class="search-container">
            <form action="{{ route('libros.index') }}" method="GET">
                <input type="text" name="search" placeholder="Buscar por título o autor..." value="{{ request('search') }}">
                <button type="submit">Buscar</button>
            </form>
        </div>

        <!-- Tabla de libros -->
        <table>
            <thead>
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
                            <a href="{{ route('libros.show', $libro) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('libros.edit', $libro) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('libros.destroy', $libro) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="text-align:center;">No se encontraron libros</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Mensaje de resultados -->
        <div class="results-info">
            Mostrando {{ $libros->firstItem() }} a {{ $libros->lastItem() }} de {{ $libros->total() }} resultados
        </div>

        <!-- Paginación -->
        <div class="pagination-container">
            <ul class="pagination">
                <li>
                    <button class="prev" {{ $libros->onFirstPage() ? 'disabled' : '' }} 
                        onclick="window.location='{{ $libros->appends(['search' => request('search')])->previousPageUrl() }}'">
                        Anterior
                    </button>
                </li>

                <!-- Números de página -->
                @for ($i = 1; $i <= $libros->lastPage(); $i++)
                    @if ($i >= $libros->currentPage() - 4 && $i <= $libros->currentPage() + 4) 
                        <li>
                            <button class="{{ $i == $libros->currentPage() ? 'active' : '' }}" 
                                onclick="window.location='{{ $libros->appends(['search' => request('search')])->url($i) }}'">
                                {{ $i }}
                            </button>
                        </li>
                    @endif
                @endfor

                <li>
                    <button class="next" {{ $libros->hasMorePages() ? '' : 'disabled' }} 
                        onclick="window.location='{{ $libros->appends(['search' => request('search')])->nextPageUrl() }}'">
                        Siguiente
                    </button>
                </li>
            </ul>
        </div>


        <div style="text-align: center;">
            <a href="{{ route('libros.create') }}" class="btn btn-success">Agregar Nuevo Libro</a>
        </div>        
    </div>

</body>
</html>
