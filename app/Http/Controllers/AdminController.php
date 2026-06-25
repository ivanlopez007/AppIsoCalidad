<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Localidad;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function showUsuarios()
    {
        // 1. Cargar usuarios con sus relaciones eager loading
        $usuarios = Usuario::with(['rol', 'localidad', 'area', 'jefeInmediato'])->get();

        // 2. Obtener estadísticas globales de los catálogos
        $totalRoles = Rol::count();
        $totalAreas = Area::count();

        // 3. Obtener la lista completa de roles para llenar el select
        $rolesLista = Rol::all();

        // ✨ CORRECCIÓN: Quitamos el '.index' para que busque directamente 'usuarios.blade.php'
        return view('components.usuarios', compact('usuarios', 'totalRoles', 'totalAreas', 'rolesLista'));
    }


    public function showCrearUsuario()
    {
        // Obtener datos necesarios para el formulario (roles, áreas, etc.)
        $localidades = Localidad::all();
        $roles = Rol::all();
        $areas = Area::all();
        $usuarios = Usuario::with('infoUsuario')->where('rol_id', '!=', 3)->get(); // Excluyo a los colaboradores


        // 2. Enviamos TODAS las variables a la vista, incluyendo ahora a los $supervisores
        return view('components.crear_usuario', compact('roles', 'areas', 'localidades', 'usuarios'));
    }

    public function showEditarUsuario(int $id)
    {
        $usuario = Usuario::with('infoUsuario')->findOrFail($id);
        $localidades = Localidad::all();
        $roles = Rol::all();
        $areas = Area::all();
        $usuarios = Usuario::with('infoUsuario')->where('rol_id', '!=', 3)->get(); // Excluyo a los colaboradores

        return view('components.editar_usuario', compact('usuario', 'roles', 'areas', 'localidades', 'usuarios'));
    }
    public function updateUsuario(Request $request, int $id)
    {
        $usuario = Usuario::findOrFail($id);

        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'password' => 'nullable|string|min:6|confirmed',
            'rol_id' => 'required|exists:rols,id',
            'area_id' => 'required|exists:areas,id',
            'localidad_id' => 'required|exists:localidads,id',
            'jefe_inmediato_id' => 'nullable|exists:usuarios,id',
        ]);

        // Actualizar los datos del usuario
        $usuario->email = $validatedData['email'];
        if (!empty($validatedData['password'])) {
            $usuario->password = bcrypt($validatedData['password']);
        }
        $usuario->rol_id = $validatedData['rol_id'];
        $usuario->area_id = $validatedData['area_id'];
        $usuario->localidad_id = $validatedData['localidad_id'];
        $usuario->jefe_inmediato_id = $validatedData['jefe_inmediato_id'] ?? null;
        $usuario->save();

        // Actualizar la información relacionada en la tabla info_usuario
        $infoUsuario = $usuario->infoUsuario;
        if ($infoUsuario) {
            $infoUsuario->nombre = $validatedData['nombre'];
            $infoUsuario->apellido_paterno = $validatedData['apellido_paterno'];
            $infoUsuario->apellido_materno = $validatedData['apellido_materno'] ?? null;
            $infoUsuario->save();
        }

        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado exitosamente.');
    }


    public function crearUsuario(Request $request)
    {

        try {
            // Validar los datos del formulario
            $validatedData = $request->validate([
                'nombre' => 'required|string|max:255',
                'apellido_paterno' => 'required|string|max:255',
                'apellido_materno' => 'nullable|string|max:255',
                'email' => 'required|email|unique:usuarios,email',
                'password' => 'required|string|min:6|confirmed',
                'rol_id' => 'required|exists:rols,id',
                'area_id' => 'required|exists:areas,id',
                'localidad_id' => 'required|exists:localidads,id',
                'jefe_inmediato_id' => 'nullable|exists:usuarios,id',
            ]);


            //Crear el usuario        
            $usuario = Usuario::create([
                'email' => $validatedData['email'],
                'password' => bcrypt($validatedData['password']),
                'rol_id' => $validatedData['rol_id'],
                'area_id' => $validatedData['area_id'],
                'localidad_id' => $validatedData['localidad_id'],
                'jefe_inmediato_id' => $validatedData['jefe_inmediato_id'] ?? null,
            ]);

            // Crear la información relacionada en la tabla info_usuario
            $infoUsuario = $usuario->infoUsuario()->create([
                'nombre' => $validatedData['nombre'],
                'apellido_paterno' => $validatedData['apellido_paterno'],
                'apellido_materno' => $validatedData['apellido_materno'] ?? null,
            ]);

            // Guardar el usuario y su información relacionada
            $usuario->save();
            $infoUsuario->save();

            return redirect()->route('admin.usuarios')->with('success', 'Usuario creado exitosamente.');
        } catch (\Exception $e) {
            // Manejar cualquier error que ocurra durante la creación del usuario
            return redirect()->route('admin.usuarios')->with('error', 'Ocurrió un error al crear el usuario: ' . $e->getMessage());
        }
    }



























    public function solicitarCambio()
    {
        return view('solicitar_cambio');
    }
    public function aprobacion()
    {
        return view('aprobacion');
    }
    public function historial()
    {
        return view('historial');
    }
    public function formato()
    {
        return view('formato');
    }
}
