@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
            </div>
            
            <!-- Formulario -->
            <form action="{{ route('alumnos.import') }}" method="POST" class="col-lg-7 mx-auto" enctype="multipart/form-data">
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

                <h2>Subir Estudiantes desde CSV</h2>
                <hr>

                <div class="form-group">
                    <label for="file">Seleccionar archivo CSV:</label>
                    <input type="file" name="file" id="file" required>
                </div>

                <button type="submit" class="btn btn-success">Subir CSV</button>
                <a href="/" class="btn btn-danger">Cancelar</a>
            </form>
        </div>
    </div>

@endsection