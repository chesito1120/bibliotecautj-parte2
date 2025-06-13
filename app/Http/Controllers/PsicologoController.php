<?php

namespace App\Http\Controllers;

use App\Models\Psicologo;
use Illuminate\Http\Request;

class PsicologoController extends Controller
{
    public function index()
    {
        $psicologos = Psicologo::all();
        return view('psicologos.index', compact('psicologos'));
    }

    public function create()
    {
        return view('psicologos.create');
    }

    public function store(Request $request)
    {
        Psicologo::create($request->validate([
            'nombre' => 'required',
            'especialidad' => 'nullable',
        ]));

        return redirect()->route('psicologos.index');
    }

    public function show(Psicologo $psicologo)
    {
        return view('psicologos.show', compact('psicologo'));
    }

    public function edit(Psicologo $psicologo)
    {
        return view('psicologos.edit', compact('psicologo'));
    }

    public function update(Request $request, Psicologo $psicologo)
    {
        $psicologo->update($request->validate([
            'nombre' => 'required',
            'especialidad' => 'nullable',
        ]));

        return redirect()->route('psicologos.index');
    }

    public function destroy(Psicologo $psicologo)
    {
        $psicologo->delete();
        return redirect()->route('psicologos.index');
    }
}
