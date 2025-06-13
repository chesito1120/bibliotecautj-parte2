@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Editar Cita</h1>
    <form method="POST" action="{{ route('citas.update',$cita) }}">
        @csrf
        @method('PUT')
        <select name="psicologo_id" required>
            @foreach($psicologos as $psicologo)
                <option value="{{ $psicologo->id }}" @if($cita->psicologo_id==$psicologo->id) selected @endif>{{ $psicologo->nombre }}</option>
            @endforeach
        </select>
        <select name="paciente_id" required>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}" @if($cita->paciente_id==$paciente->id) selected @endif>{{ $paciente->nombre }}</option>
            @endforeach
        </select>
        <input type="datetime-local" name="fecha" value="{{ $cita->fecha }}" required>
        <input type="text" name="motivo" value="{{ $cita->motivo }}">
        <button type="submit">Actualizar</button>
    </form>
</div>
@endsection
