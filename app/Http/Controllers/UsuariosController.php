<?php

namespace App\Http\Controllers;

use App\Imports\UsuariosImport;
use App\Models\Usuarios; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class UsuariosController extends Controller
{
    // Método para mostrar el formulario de carga de CSV
    public function showUploadForm()
    {
        return view('usuarios.index'); // Cambia la referencia a la vista correcta
    }

    // Método para manejar la carga del archivo CSV
    public function uploadCSV(Request $request)
    {
        // Validación del archivo CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);

        try {
            // Importar el archivo CSV usando UsuariosImport
            Excel::import(new UsuarioImport, $request->file('file'));

            return back()->with('success', 'Usuarios importados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al importar los usuarios: ' . $e->getMessage());
        }
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
    
        if ($search) {
            $usuarios = Usuarios::where('nombre', 'like', "%{$search}%")
                                ->orWhere('matricula', 'like', "%{$search}%")
                                ->paginate(20);
        } else {
            $usuarios = Usuarios::paginate(20);
        }
    
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'matricula' => 'required|string|unique:usuarios',
            'nombre' => 'required|string',
            'tipo_usuario' => 'required|string',
            'sexo' => 'required|string',
            'carrera' => 'required|string',
            'turno' => 'required|string',
            'carrera_id' => 'nullable|integer', 
        ]);

        // Crear un nuevo usuario
        Usuarios::create($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado exitosamente.');
    }

    public function show(Usuarios $usuario)
    {
        // Muestra un usuario específico
        return view('usuarios.show', compact('usuario'));
    }

    public function edit(Usuarios $usuario)
    {
        // Muestra el formulario para editar un usuario
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuarios $usuario)
    {
        // Validar la solicitud con condición en la validación de la matrícula
        $request->validate([
            'matricula' => [
                'required',
                'string',
                function ($attribute, $value, $fail) use ($usuario) {
                    // Solo validar si la matrícula ha cambiado
                    if ($value !== $usuario->matricula && Usuarios::where('matricula', $value)->exists()) {
                        $fail('La matrícula ya está en uso.');
                    }
                },
            ],
            'nombre' => 'required|string',
            'tipo_usuario' => 'required|string',
            'sexo' => 'required|string',
            'carrera' => 'required|string',
            'turno' => 'required|string',
            'carrera_id' => 'nullable|integer',
        ]);

        // Actualizar el usuario
        $usuario->update($request->all());

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuarios $usuario)
    {
        // Eliminar un usuario
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado exitosamente.');
    }

    // Método para importar desde un CSV
    public function import(Request $request)
    {
        // Validación del archivo CSV
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ]);
    
        // Cargar el archivo
        $file = $request->file('file');
    
        // Abrir el archivo y leer el contenido
        $handle = fopen($file, 'r');
        if ($handle) {
            // Saltar la primera fila si es un encabezado
            $firstRow = true;
            while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($firstRow) {
                    $firstRow = false;
                    continue;
                }
    
                // Verificar si los campos requeridos están vacíos
                if (empty($row[0]) || empty($row[1]) || empty($row[2])) {
                    // Si faltan campos requeridos, saltar esta fila
                    continue;
                }
    
                // Guardar los datos del usuario
                $usuarioData = [
                    'matricula' => $row[0],
                    'nombre' => $row[1],
                    'tipo_usuario' => $row[2],
                    'sexo' => $row[3],
                    'carrera' => $row[4],
                    'turno' => $row[5],
                ];
    
                // Crear el registro del usuario
                Usuarios::create($usuarioData);
            }
            fclose($handle);
        }
    
        return back()->with('success', 'Usuarios importados exitosamente.');
    }
}
