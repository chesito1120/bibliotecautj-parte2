@extends('adminlte::page')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-10 col-md-12">
            <h3 class="text-center mb-4">Gestión de Préstamos</h3>
            <hr>

            <!-- Tabla de Préstamos -->
            <h4 class="mt-4">Lista de Préstamos</h4>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Libro</th>
                        <th>Matricula</th>
                        <th>Nombre</th>
                        <th>Fecha de Préstamo</th>
                        <th>Fecha de Devolución</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prestamos as $prestamo)
                        <tr>
                            <td>{{ $prestamo->id }}</td>
                            <td>{{ $prestamo->libro->titulo }}</td>
                            <td>{{ $prestamo->matricula }}</td>
                            <td>{{ $prestamo->nombre }}</td>
                            <td>{{ $prestamo->fecha_prestamo }}</td>
                            <td>
                                @if(is_null($prestamo->fecha_devolucion))
                                    <span class="text-warning">Préstamo Activo</span>
                                @else
                                    {{ $prestamo->fecha_devolucion }}
                                @endif
                            </td>
                            <td>
                                @if(is_null($prestamo->fecha_devolucion))
                                    <form action="{{ route('prestamo.devolver', $prestamo->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success btn-sm">Registrar Devolución</button>
                                    </form>
                                @else
                                    <span class="text-muted">Devolución Registrada</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Paginación -->
            <div class="pagination-container d-flex justify-content-center mb-3">
                <ul class="pagination">
                    <li class="page-item {{ $prestamos->onFirstPage() ? 'disabled' : '' }}">
                        <a class="page-link" href="{{ $prestamos->previousPageUrl() }}">Anterior</a>
                    </li>
                    @for ($i = 1; $i <= $prestamos->lastPage(); $i++)
                        <li class="page-item {{ $i == $prestamos->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $prestamos->url($i) }}">{{ $i }}</a>
                        </li>
                    @endfor
                    <li class="page-item {{ $prestamos->hasMorePages() ? '' : 'disabled' }}">
                        <a class="page-link" href="{{ $prestamos->nextPageUrl() }}">Siguiente</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
@endsection
