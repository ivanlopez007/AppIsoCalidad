<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Localidad;
use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getUsuarios()
    {
        // 1. Cargar usuarios con sus relaciones eager loading
        $usuarios = Usuario::with(['rol', 'localidad', 'area', 'jefeInmediato'])->get();

        // 2. Obtener estadísticas globales de los catálogos
        $totalRoles = Rol::count();
        $totalAreas = Area::count();

        // 3. Obtener la lista completa de roles para llenar el select
        $rolesLista = Rol::all();

        // ✨ CORRECCIÓN: Quitamos el '.index' para que busque directamente 'usuarios.blade.php'
        return view('usuarios', compact('usuarios', 'totalRoles', 'totalAreas', 'rolesLista'));
    }


    public function showCrearUsuario()
    {
        // Obtener datos necesarios para el formulario (roles, áreas, etc.)
        $localidades = Localidad::all();
        $roles = Rol::all();
        $areas = Area::all();
        $usuarios = Usuario::with('infoUsuario')->where('rol_id', '!=', 3)->get(); // Excluyo a los colaboradores

        // 1. Obtenemos los usuarios que pertenezcan a los roles de Gerencia o Calidad
        // Nota: Ajusta 'Gerencia' y 'Calidad' según los nombres exactos que tengas en tu tabla de roles.
        $supervisores = Usuario::whereHas('rol', function ($query) {
            $query->whereIn('nombre', ['Gerencia', 'Calidad']);
        })->get();

        // 2. Enviamos TODAS las variables a la vista, incluyendo ahora a los $supervisores
        return view('crear_usuario', compact('roles', 'areas', 'localidades', 'supervisores', 'usuarios'));
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
