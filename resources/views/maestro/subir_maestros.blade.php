@extends('adminlte::page')

@section('content')

    <div class="container">
        <div class="row">
        
            
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
        <!-- Logo -->
        <img src="{{ asset('images/Logo-UTJ-Verde.png') }}" alt="Logo" class="logo">

        <h2>Importar Docentes desde CSV</h2>
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
        <form action="{{ route('maestros.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="file">Seleccionar archivo CSV:</label>
                <input type="file" name="file" id="file" required>
            </div>

            <button type="submit" class="btn btn-success">Importar CSV</button>
            <a href="/" class="btn btn-danger">Cancelar</a>
        </form>
    </div>

    @endsection