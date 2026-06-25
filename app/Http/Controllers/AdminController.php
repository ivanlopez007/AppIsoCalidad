<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\CambioDocumento;
use App\Models\DisposicionFinal;
use App\Models\Documento;
use App\Models\Localidad;
use App\Models\LugarRetencion;
use App\Models\Nivel;
use App\Models\PeriodoRetencion;
use App\Models\Rol;
use App\Models\SubNivel;
use App\Models\TipoSolicitud;
use App\Models\Usuario;
use App\Notifications\CreacionSolicitudNotificacion;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        $usuario->updated_at = now();
        $usuario->save();

        // Actualizar la información relacionada en la tabla info_usuario
        $infoUsuario = $usuario->infoUsuario;
        if ($infoUsuario) {
            $infoUsuario->nombre = $validatedData['nombre'];
            $infoUsuario->apellido_paterno = $validatedData['apellido_paterno'];
            $infoUsuario->apellido_materno = $validatedData['apellido_materno'] ?? null;
            $infoUsuario->updated_at = now();
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



















    public function showSolicitarCambio()
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



    public function solicitarCambio(Request $request)
    {
        try {
            // Variable para almacenar la ruta final del archivo
            $urlDocumento = null;

            // Validar y procesar la carga del archivo PDF
            if ($request->hasFile('url_documento') && $request->file('url_documento')->isValid()) {
                $archivo = $request->file('url_documento');

                // Guarda el archivo en storage/app/public/documentos_cambios con un nombre único autogenerado
                $rutaArchivo = $archivo->store('documentos_cambios', 'public');

                // Genera la URL accesible públicamente para guardarla en la base de datos (e.g., /storage/documentos_cambios/archivo.pdf)
                $urlDocumento = Storage::url($rutaArchivo);
            } else {
                // Si el archivo es obligatorio, puedes lanzar una excepción o mantener el valor del input tipo texto si aplica
                $urlDocumento = $request->input('url_documento');
            }

            $cambioDocumento = CambioDocumento::create([
                'folio' => $request->input('folio'),
                'nombre_documento' => $request->input('nombre_documento'),
                'usuario_id' => Auth::id(),
                'nivel_id' => $request->input('nivel_id'),
                'sub_nivel_id' => $request->input('sub_nivel_id'),
                'url_documento' => $urlDocumento, // <-- Guardamos la URL del archivo local procesado
                'version' => $request->input('version'),
                'numero_iso' => $request->input('numero_iso'),
                'aprobar_id' => Auth::user()->jefe_inmediato_id,
                'estatus_id' => 1,
                'localidad_id' => Auth::user()->localidad_id,
                'area_id' => Auth::user()->area_id,
                'tipo_solicitud_id' => $request->input('tipo_solicitud_id'),
                'lugar_retencion_id' => $request->input('lugar_retencion_id'),
                'periodo_retencion_id' => $request->input('periodo_retencion_id'),
                'disposicion_final_id' => $request->input('disposicion_final_id'),
                'comentario' => $request->input('comentario'),
            ]);
            // === CÓDIGO NUEVO PARA ENVIAR NOTIFICACIÓN ===
            try {
                // Buscamos al usuario aprobador mediante el id asignado
                $aprobador = Usuario::find($cambioDocumento->aprobar_id);
                if ($aprobador) {

                    Notification::route('mail', $aprobador->email)
                        ->notify(new CreacionSolicitudNotificacion($cambioDocumento));
                }
            } catch (\Exception $mailEx) {
                // Loggear el error si el correo falla, evitando romper el flujo principal del sistema
                Log::error('No se pudo enviar el correo de aprobación: ' . $mailEx->getMessage());
            }
            // ============================================

            return redirect()->route('admin.solicitar_cambio')->with('success', 'Solicitud de cambio enviada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Ocurrió un error al solicitar el cambio: ' . $e->getMessage());
        }
    }



    public function showAprobacion()
    {

        // Obtenemos TODOS los documentos procesados por el usuario (Aprobados = 2, Rechazados = 3)
        $documentosHistorial = CambioDocumento::with(['usuario.infoUsuario', 'tipoSolicitud', 'area'])
            ->where('aprobar_id', Auth::id())
            ->whereIn('estatus_id', [2, 3]) // Solo aprobados y rechazados
            ->orderBy('updated_at', 'desc')
            ->get();

        // Contadores reales para las burbujas
        $conteoAprobados  = $documentosHistorial->where('estatus_id', 2)->count();
        $conteoRechazados = $documentosHistorial->where('estatus_id', 3)->count();

        $areas = Area::orderBy('area', 'asc')->get();

        return view('components.documento.aprobacion', compact(
            'documentosHistorial',
            'areas',
            'conteoAprobados',
            'conteoRechazados'
        ));
    }
    public function historial()
    {
        return view('components.documento.historial');
    }
    public function formato()
    {
        return view('components.documento.formato');
    }

    public function showRevisionSolicitudes()
    {
        // 1. Obtener los documentos pendientes asignados al usuario logueado
        // Nota: Asegúrate de que las relaciones ('nivel', 'subNivel', etc.) coincidan con los métodos de tu modelo CambioDocumento
        $documentosPendientes = CambioDocumento::with([
            'usuario.infoUsuario',
            'nivel',
            'subNivel', // Ajustado a CamelCase o como lo tengas definido por el guion bajo
            'tipoSolicitud',
        ])
            ->where('aprobar_id', Auth::id())
            ->where('estatus_id', 1) // 1 = Pendiente
            ->orderBy('created_at', 'desc')
            ->get();

        // 2. Traer el catálogo de áreas para alimentar el <select id="selectArea"> de la vista
        $areas = Area::orderBy('area', 'asc')->get();

        // 3. Retornar la vista enviando ambas colecciones
        return view('components.documento.revision_solicitudes', compact('documentosPendientes', 'areas'));
    }

    public function aprobarSolicitud(int $id)
    {
        // Iniciamos la transacción para proteger la integridad de tus datos
        DB::beginTransaction();

        try {
            // 1. Buscar la solicitud pendiente asignada al aprobador actual
            $solicitud = CambioDocumento::where('id', $id)
                ->where('aprobar_id', Auth::id())
                ->firstOrFail();

            // 2. Crear el nuevo registro oficial en la tabla 'documentos'
            Documento::create([
                'nombre_documento'     => $solicitud->nombre_documento,
                'usuario_id'           => $solicitud->usuario_id,
                'nivel_id'             => $solicitud->nivel_id,
                'sub_nivel_id'         => $solicitud->sub_nivel_id,
                'url_documento'        => $solicitud->url_documento,
                'version'              => $solicitud->version,
                'numero_iso'           => $solicitud->numero_iso,
                'aprobar_id'           => $solicitud->aprobar_id,
                'localidad_id'         => $solicitud->localidad_id,
                'area_id'              => $solicitud->area_id,
                'lugar_retencion_id'   => $solicitud->lugar_retencion_id,
                'periodo_retencion_id' => $solicitud->periodo_retencion_id,
                'disposicion_final_id' => $solicitud->disposicion_final_id,
            ]);

            // 3. Actualizar el estatus de la solicitud a Aprobado (ID: 2)
            $solicitud->update([
                'estatus_id' => 2,
                'updated_at' => now()
            ]);

            // Guardamos de manera definitiva ambos movimientos en la BD
            DB::commit();

            return redirect()->back()->with('success', "La solicitud {$solicitud->folio} ha sido aprobada y el documento se ha creado correctamente.");
        } catch (\Exception $e) {
            // Si algo falla al crear el documento, cancelamos el cambio de estatus de la solicitud
            DB::rollBack();

            return redirect()->back()->with('error', 'Ocurrió un error al procesar la aprobación: ' . $e->getMessage());
        }
    }

    
    public function rechazarSolicitud(int $id)
    {
        $solicitud = CambioDocumento::where('id', $id)
            ->where('aprobar_id', Auth::id())
            ->firstOrFail();

        // Cambiamos el estatus a Rechazado (ID: 3)
        $solicitud->update(['estatus_id' => 3, 'updated_at' => now()]);

        return redirect()->back()->with('success', "La solicitud {$solicitud->folio} ha sido rechazada.");
    }

    public function descargarPdf(int $id)
    {
        // 1. Validar existencia y permisos
        $solicitud = CambioDocumento::where('id', $id)
            ->where('aprobar_id', Auth::id())
            ->firstOrFail();

        // Limpiar la ruta por si se guardó con prefijos de carpeta
        $rutaLimpia = str_replace(['public/', 'storage/'], '', $solicitud->url_documento);

        // 2. Verificar existencia en el disco
        if (blank($rutaLimpia) || !Storage::disk('public')->exists($rutaLimpia)) {
            return redirect()->back()->with('error', 'El archivo físico no se encuentra en el servidor.');
        }

        // 3. Crear nombre de descarga
        $nombreDescarga = 'Folio_' . $solicitud->folio . '_' . $solicitud->nombre_documento . '.pdf';

        // 4. Forzar descarga utilizando el helper nativo de Storage (más seguro)
        return Storage::disk('public')->download($rutaLimpia, $nombreDescarga, [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function RevisionSolicitud()
    {
        //Logica
        return view('components.documento.revision_solicitud');
    }
}
