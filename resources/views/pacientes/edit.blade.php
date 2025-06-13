@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Paciente</h1>
    <form method="POST" action="{{ route('pacientes.update',$paciente) }}">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ $paciente->nombre }}" required>
        <input type="date" name="fecha_nacimiento" value="{{ $paciente->fecha_nacimiento }}">
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
