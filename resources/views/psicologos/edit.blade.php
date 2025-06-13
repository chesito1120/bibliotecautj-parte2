@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Psicologo</h1>
    <form method="POST" action="{{ route('psicologos.update',$psicologo) }}">
        @csrf
        @method('PUT')
        <input type="text" name="nombre" value="{{ $psicologo->nombre }}" required>
        <input type="text" name="especialidad" value="{{ $psicologo->especialidad }}">
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
