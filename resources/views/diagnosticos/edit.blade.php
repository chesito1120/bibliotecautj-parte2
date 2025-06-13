@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Diagnostico</h1>
    <form method="POST" action="{{ route('diagnosticos.update',$diagnostico) }}">
        @csrf
        @method('PUT')
        <select name="psicologo_id" required>
            @foreach($psicologos as $psicologo)
                <option value="{{ $psicologo->id }}" @if($diagnostico->psicologo_id==$psicologo->id) selected @endif>{{ $psicologo->nombre }}</option>
            @endforeach
        </select>
        <select name="paciente_id" required>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}" @if($diagnostico->paciente_id==$paciente->id) selected @endif>{{ $paciente->nombre }}</option>
            @endforeach
        </select>
        <input type="date" name="fecha" value="{{ $diagnostico->fecha }}" required>
        <textarea name="descripcion" required>{{ $diagnostico->descripcion }}</textarea>
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
