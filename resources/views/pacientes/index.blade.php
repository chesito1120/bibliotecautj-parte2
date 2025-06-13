@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Pacientes</h1>
    <a href="{{ route('pacientes.create') }}">Nuevo</a>
    <ul>
        @foreach($pacientes as $paciente)
            <li>{{ $paciente->nombre }} - <a href="{{ route('pacientes.edit',$paciente) }}">Editar</a></li>
        @endforeach
    </ul>
</div>
@endsection
