<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Psicologo;
use App\Models\Paciente;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index()
    {
        $citas = Cita::with(['psicologo','paciente'])->get();
        return view('citas.index', compact('citas'));
    }

    public function create()
    {
        $psicologos = Psicologo::all();
        $pacientes = Paciente::all();
        return view('citas.create', compact('psicologos','pacientes'));
    }

    public function store(Request $request)
    {
        Cita::create($request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'motivo' => 'nullable',
        ]));

        return redirect()->route('citas.index');
    }

    public function edit(Cita $cita)
    {
        $psicologos = Psicologo::all();
        $pacientes = Paciente::all();
        return view('citas.edit', compact('cita','psicologos','pacientes'));
    }

    public function update(Request $request, Cita $cita)
    {
        $cita->update($request->validate([
            'psicologo_id' => 'required|exists:psicologos,id',
            'paciente_id' => 'required|exists:pacientes,id',
            'fecha' => 'required|date',
            'motivo' => 'nullable',
        ]));

        return redirect()->route('citas.index');
    }

    public function destroy(Cita $cita)
    {
        $cita->delete();
        return redirect()->route('citas.index');
    }
}
