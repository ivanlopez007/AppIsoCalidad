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
        $usuarios = Usuario::with('infoUsuario')->get();

        // 1. Obtenemos los usuarios que pertenezcan a los roles de Gerencia o Calidad
        // Nota: Ajusta 'Gerencia' y 'Calidad' según los nombres exactos que tengas en tu tabla de roles.
        $supervisores = Usuario::whereHas('rol', function ($query) {
            $query->whereIn('nombre', ['Gerencia', 'Calidad']);
        })->get();

        // 2. Enviamos TODAS las variables a la vista, incluyendo ahora a los $supervisores
        return view('crear_usuario', compact('roles', 'areas', 'localidades', 'supervisores', 'usuarios'));
    }
}
