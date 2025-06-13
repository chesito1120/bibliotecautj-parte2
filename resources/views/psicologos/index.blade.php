@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Psicologos</h1>
    <a href="{{ route('psicologos.create') }}">Nuevo</a>
    <ul>
        @foreach($psicologos as $psicologo)
            <li>{{ $psicologo->nombre }} - <a href="{{ route('psicologos.edit',$psicologo) }}">Editar</a></li>
        @endforeach
    </ul>
</div>
@endsection
