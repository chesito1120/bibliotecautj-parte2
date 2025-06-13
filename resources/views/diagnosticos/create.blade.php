@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Nuevo Diagnostico</h1>
    <form method="POST" action="{{ route('diagnosticos.store') }}">
        @csrf
        <select name="psicologo_id" required>
            @foreach($psicologos as $psicologo)
                <option value="{{ $psicologo->id }}">{{ $psicologo->nombre }}</option>
            @endforeach
        </select>
        <select name="paciente_id" required>
            @foreach($pacientes as $paciente)
                <option value="{{ $paciente->id }}">{{ $paciente->nombre }}</option>
            @endforeach
        </select>
        <input type="date" name="fecha" required>
        <textarea name="descripcion" required></textarea>
        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
