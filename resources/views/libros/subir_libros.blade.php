@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
            <!-- Logo y Título -->
            <div class="col-12 text-center mb-4">
                <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" style="max-width: 950px;">
            
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

    <div class="container">
        <h2>Subir Libros desde CSV</h2>
        <hr>

        <!-- Mensaje de éxito -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Mensaje de error -->
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulario para cargar CSV -->
        <form action="{{ route('libros.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Seleccionar archivo CSV:</label>
                <input type="file" name="file" id="file" required>
            </div>

            <button type="submit" class="btn btn-success">Subir CSV</button>
            <a href="/libros" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

@endsection