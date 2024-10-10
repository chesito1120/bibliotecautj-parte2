<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\UsuariosImport;
use Maatwebsite\Excel\Facades\Excel;

class UsuariosController extends Controller
{
    public function index()
    {
        return view('usuarios.index'); // Vista para subir el CSV
    }

    public function import(Request $request) {
        // Validar el archivo CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Limitar el tamaño del archivo
        ]);
    
        try {
            // Importar los datos del CSV
            Excel::import(new UsuariosImport, $request->file('file'));
            return redirect()->back()->with('success', 'Alumnos importados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    
}
