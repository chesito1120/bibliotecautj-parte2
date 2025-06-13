@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Nuevo Paciente</h1>
    <form method="POST" action="{{ route('pacientes.store') }}">
        @csrf
        <input type="text" name="nombre" placeholder="Nombre" required>
        <input type="date" name="fecha_nacimiento">
        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
