<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\DisposicionFinal;
use App\Models\Localidad;
use App\Models\LugarRetencion;
use App\Models\Nivel;
use App\Models\PeriodoRetencion;
use App\Models\Rol;
use App\Models\SubNivel;
use App\Models\TipoSolicitud;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('components.usuario.usuarios', compact('usuarios', 'totalRoles', 'totalAreas', 'rolesLista'));
    }


    public function showCrearUsuario()
    {
        // Obtener datos necesarios para el formulario (roles, áreas, etc.)
        $localidades = Localidad::all();
        $roles = Rol::all();
        $areas = Area::all();
        $usuarios = Usuario::with('infoUsuario')->where('rol_id', '!=', 3)->get(); // Excluyo a los colaboradores


        // 2. Enviamos TODAS las variables a la vista, incluyendo ahora a los $supervisores
        return view('components.usuario.crear_usuario', compact('roles', 'areas', 'localidades', 'usuarios'));
    }

    public function eliminarUsuario(int $id)
    {

        if (Auth::user()->id === $id) {
            return redirect()->route('admin.usuarios')->with('error', 'No puedes eliminar tu propio usuario.');
        }
        //solo quiero eliminar al ususario
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado exitosamente.');
    }




    public function showEditarUsuario(int $id)
    {
        // Carga el usuario con toda su información estructural y sus datos personales en una sola consulta
        $usuario = Usuario::with(['infoUsuario', 'rol', 'area', 'localidad', 'jefeInmediato.infoUsuario'])->findOrFail($id);

        // Catálogos para llenar los elementos <select> del formulario
        $localidades = Localidad::all();
        $roles = Rol::all();
        $areas = Area::all();

        // Obtenemos los posibles jefes inmediatos cargando también su información personal
        // Nota: Si el rol_id de colaborador es el 3, los excluimos correctamente.
        $supervisores = Usuario::with('infoUsuario')
            ->where('rol_id', '!=', 3)
            ->where('id', '!=', $id) // Excluimos al mismo usuario para que no pueda ser su propio jefe
            ->get();

        return view('components.usuario.editar_usuario', compact('usuario', 'roles', 'areas', 'localidades', 'supervisores'));
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
        // Cargamos los catálogos normales
        $tiposSolicitud = TipoSolicitud::all();
        $niveles = Nivel::all();
        $subniveles = SubNivel::all();
        $lugaresRetencion = LugarRetencion::all();
        $periodosRetencion = PeriodoRetencion::all();
        $disposicionesFinales = DisposicionFinal::all();
        $colaboradores = Usuario::with('infoUsuario')->get();
        $areas = Area::all();
        $localidades = Localidad::all();

        // Obtener el usuario logueado con todas sus relaciones necesarias
        // Nota: Si 'localidad' y 'area' están dentro de 'infoUsuario', cámbialo a: 'infoUsuario.localidad', 'infoUsuario.area'
        $usuarioLogueado = Usuario::with(['jefeInmediato.infoUsuario', 'infoUsuario', 'localidad', 'area'])->find(Auth::id());
        $jefeInmediato = $usuarioLogueado->jefeInmediato;

        // Folio tentativo
        $conteo = 88;
        $proximoFolio = 'SOL-' . date('Y') . '-' . str_pad($conteo, 3, '0', STR_PAD_LEFT);
        $ultimosDocumentos = [];

        return view('components.documento.solicitar_cambio', compact(
            'tiposSolicitud',
            'niveles',
            'subniveles',
            'lugaresRetencion',
            'periodosRetencion',
            'disposicionesFinales',
            'colaboradores',
            'jefeInmediato',
            'usuarioLogueado', // 💡 Pasamos el usuario completo para identificar su área/localidad
            'areas',           // 💡 Aseguramos el envío de las áreas
            'localidades',     // 💡 Aseguramos el envío de las localidades
            'proximoFolio',
            'ultimosDocumentos'
        ));
    }
    public function aprobacion()
    {
        return view('components.documento.aprobacion');
    }
    public function historial()
    {
        return view('components.documento.historial');
    }
    public function formato()
    {
        return view('components.documento.formato');
    }
}
