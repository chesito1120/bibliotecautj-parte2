@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
                <h2 style="color: #2F4F4F;">Agregar Nuevo Docente</h2>
            </div>
            
            <!-- Formulario -->
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

    @endsection
