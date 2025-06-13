<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Psicologo;
use App\Models\Paciente;
use Illuminate\Http\Request;

class DiagnosticoController extends Controller
{
    public function index()
    {
        $diagnosticos = Diagnostico::with(['psicologo','paciente'])->get();
        return view('diagnosticos.index', compact('diagnosticos'));
    }

    public function create()
    {
        $psicologos = Psicologo::all();
        $pacientes = Paciente::all();
        return view('diagnosticos.create', compact('psicologos','pacientes'));
    }

    public function store(Request $request)
    {
        Diagnostico::create($request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]));

        return redirect()->route('diagnosticos.index');
    }

    public function edit(Diagnostico $diagnostico)
    {
        $psicologos = Psicologo::all();
        $pacientes = Paciente::all();
        return view('diagnosticos.edit', compact('diagnostico','psicologos','pacientes'));
    }

    public function update(Request $request, Diagnostico $diagnostico)
    {
        $diagnostico->update($request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'descripcion' => 'required',
            'fecha' => 'required|date',
        ]));

        return redirect()->route('diagnosticos.index');
    }

    public function destroy(Diagnostico $diagnostico)
    {
        $diagnostico->delete();
        return redirect()->route('diagnosticos.index');
    }
}
