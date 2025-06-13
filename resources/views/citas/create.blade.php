@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Nueva Cita</h1>
    <form method="POST" action="{{ route('citas.store') }}">
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
        <input type="datetime-local" name="fecha" required>
        <input type="text" name="motivo" placeholder="Motivo">
        <button type="submit">Guardar</button>
    </form>
</div>
@endsection
