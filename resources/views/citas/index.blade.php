@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Citas</h1>
    <a href="{{ route('citas.create') }}">Nueva Cita</a>
    <ul>
        @foreach($citas as $cita)
            <li>{{ $cita->fecha }} - {{ $cita->paciente->nombre }} con {{ $cita->psicologo->nombre }} - <a href="{{ route('citas.edit',$cita) }}">Editar</a></li>
        @endforeach
    </ul>
</div>
@endsection
