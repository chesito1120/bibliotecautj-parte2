@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Diagnosticos</h1>
    <a href="{{ route('diagnosticos.create') }}">Nuevo Diagnostico</a>
    <ul>
        @foreach($diagnosticos as $diag)
            <li>{{ $diag->fecha }} - {{ $diag->paciente->nombre }} por {{ $diag->psicologo->nombre }} - <a href="{{ route('diagnosticos.edit',$diag) }}">Editar</a></li>
        @endforeach
    </ul>
</div>
@endsection
