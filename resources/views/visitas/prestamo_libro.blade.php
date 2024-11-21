@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <h3 class="text-center mb-4">Seleccionar Libros</h3>
            <hr>

            <!-- Formulario para buscar libros -->
            <h4 class="mt-4">Buscar Libros</h4>
            <div class="search-container mb-3">
                <form action="{{ route('visitas.buscar') }}" method="GET" class="d-flex">
                    <input type="text" name="search" placeholder="Buscar por título o autor..." class="form-control" value="{{ old('search', request('search')) }}">
                    @foreach (request()->except('search', 'page') as $key => $value)
                        <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                    @endforeach
                    <button type="submit" class="btn btn-primary ml-2">Buscar</button>
                </form>   
            </div>

            <!-- Mostrar tabla de libros -->
            @if($libros && $libros->isNotEmpty())
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
                    @foreach($libros as $libro)
                        <tr>
                            <td>{{ $libro->id }}</td>
                            <td>{{ $libro->titulo }}</td>
                            <td>{{ $libro->autor }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm select-book"
                                        data-titulo="{{ $libro->titulo }}"
                                        data-autor="{{ $libro->autor }}"
                                        data-clasificacion="{{ $libro->clas_dewey }}"
                                        data-id_libro="{{ $libro->id }}"
                                        data-isbn="{{ $libro->isbn }}">
                                    Seleccionar
                                </button>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="pagination-container d-flex justify-content-center mb-3">
                <ul class="pagination">
                    <li class="page-item {{ $libros->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $libros->appends(request()->except('page'))->previousPageUrl() }}">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $libros->lastPage(); $i++)
                        @if ($i >= $libros->currentPage() - 2 && $i <= $libros->currentPage() + 2)
                            <li class="page-item {{ $i == $libros->currentPage() ? 'active' : '' }}">
                                <a class="page-link" href="{{ $libros->appends(request()->except('page'))->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                    <li class="page-item {{ $libros->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $libros->appends(request()->except('page'))->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </div>
            @else
                <p>No se encontraron libros.</p>
            @endif

            <!-- Formulario para registrar el préstamo -->
            <h4 class="mt-4">Registrar Préstamo</h4>
            <form action="{{ route('prestamo.store') }}" method="POST">
                @csrf
                <input type="hidden" name="id_libro" id="id_libro">
                <input type="hidden" name="matricula" value="{{ request('matricula') }}">
                <input type="hidden" name="nombre" value="{{ request('nombre') }}">
                <input type="hidden" name="grado" value="{{ request('grado') }}">
                <input type="hidden" name="grupo" value="{{ request('grupo') }}">
                <input type="hidden" name="carrera" value="{{ request('carrera') }}">
                <input type="hidden" name="tipo_usuario" value="{{ request('tipo_usuario') }}">
                <input type="hidden" name="fecha_prestamo" value="{{ request('fecha_prestamo') }}">

                <div class="form-group position-relative">
                    <label for="titulo_libro">Título del Libro</label>
                    <input type="text" name="titulo_libro" id="titulo_libro" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="autor">Autor(a)</label>
                    <input type="text" name="autor" id="autor" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="no_clasificacion">No. de Clasificación</label>
                    <input type="text" name="no_clasificacion" id="no_clasificacion" class="form-control" readonly>
                </div>

                <div class="form-group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" id="isbn" class="form-control" readonly>
                </div>

                <div id="fechaRenovacion" class="form-group" style="display: none;">
                    <label for="fecha_renovacion">Fecha de Renovación</label>
                    <input type="date" name="fecha_renovacion" id="fecha_renovacion" class="form-control" readonly>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success btn-lg mt-4">Registrar</button>
                    <a href="{{ route('visitas.index') }}" class="btn btn-info btn-lg">Ver Métricas</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Maneja el evento de clic en el botón "Seleccionar"
        $(document).on('click', '.select-book', function() {
            var titulo = $(this).data('titulo');
            var autor = $(this).data('autor');
            var clasificacion = $(this).data('clasificacion');
            var id_libro = $(this).data('id_libro');
            var isbn = $(this).data('isbn');

            $('#titulo_libro').val(titulo);
            $('#autor').val(autor);
            $('#no_clasificacion').val(clasificacion);
            $('#id_libro').val(id_libro);
            $('#isbn').val(isbn);

            $('html, body').animate({ scrollTop: $("#titulo_libro").offset().top }, 500);
        });
    });
</script>

@endsection
