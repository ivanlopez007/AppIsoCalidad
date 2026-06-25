@extends('layout.layout')

@section('title', 'Panel de Aprobaciones')

@section('content')
{{-- Inicializamos Alpine.js incluyendo el estado para el filtro de áreas --}}
<div x-data="{ 
    modalDetalle: false, 
    modalPreview: false, 
    docSeleccionado: {}, 
    urlPreview: '',
    actionAprobar: '',
    actionRechazar: '',
    areaSeleccionada: '' {{-- Estado para controlar el filtro --}}
}"
    class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    {{-- Encabezado --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight flex items-center gap-2">
                Panel de Aprobaciones
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gestión, revisión y estatus de solicitudes de procedimientos vigentes asignados a su perfil.</p>
        </div>

        {{-- Select del Catálogo de Áreas enlazado a Alpine.js --}}
        <div class="relative w-full sm:w-72">
            <select id="selectArea"
                x-model="areaSeleccionada"
                class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-semibold transition-colors shadow-sm">
                <option value="">Todas las Áreas</option>
                @foreach($areas ?? [] as $ar)
                <option value="{{ $ar->id }}">{{ $ar->area ?? ($ar->nombre ?? '') }}</option>
                @endforeach
            </select>
        </div>
    </div>

    {{-- Filtros Rápidos superiores --}}
    <div class="flex flex-wrap gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/50 w-fit">
        <button class="flex items-center gap-2 px-5 py-2 rounded-xl text-xs font-bold transition-all bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 border border-amber-100 dark:border-amber-900/30 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Pendientes
            <span class="ml-1 bg-amber-600 dark:bg-amber-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">
                {{ $documentosPendientes->count() }}
            </span>
        </button>
    </div>

    {{-- Contenedor Principal de la Tabla --}}
    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Registros del Panel</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Folio</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4">Procedimiento</th>
                        <th class="px-6 py-4">Fecha Solicitud</th>
                        <th class="px-6 py-4">Solicitante</th>
                        <th class="px-6 py-4 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    @forelse($documentosPendientes as $doc)
                    {{-- Evaluamos de manera reactiva el ID del área asociada al documento --}}
                    <tr x-show="areaSeleccionada === '' || areaSeleccionada === '{{ $doc->area_id ?? ($doc->usuario->infoUsuario->area_id ?? '') }}'"
                        x-transition.opacity
                        class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">

                        {{-- Folio --}}
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="text-xs font-mono font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900 px-2.5 py-1 rounded-xl border border-gray-200/50 dark:border-gray-700/30">
                                #{{ $doc->folio }}
                            </span>
                        </td>

                        {{-- Tipo Solicitud --}}
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-xl text-[11px] font-semibold bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 border border-blue-100/40 dark:border-blue-900/30 uppercase tracking-wider">
                                {{ $doc->tipoSolicitud->tipo_solicitud ?? 'N/A' }}
                            </span>
                        </td>

                        {{-- Nombre del Procedimiento --}}
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 truncate max-w-[220px]">
                                {{ $doc->nombre_documento }}
                            </div>
                        </td>

                        {{-- Fecha Solicitud --}}
                        <td class="px-6 py-5 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            {{ $doc->created_at->format('d M, Y') }}
                        </td>

                        {{-- Solicitante --}}
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2.5">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($doc->usuario->infoUsuario->nombre ?? 'U') }}&background=6366f1&color=fff" class="h-8 w-8 rounded-xl object-cover" alt="Avatar">
                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">
                                    {{ $doc->usuario->infoUsuario->nombre ?? 'Sin Nombre' }} {{ $doc->usuario->infoUsuario->apellido_paterno ?? '' }}
                                </span>
                            </div>
                        </td>

                        {{-- Botones de Acción Internos --}}
                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-1.5">
                                {{-- Botón Pop-up Detalle Completo --}}
                                <button
                                    x-on:click="docSeleccionado = {{ json_encode([
                                        'folio' => $doc->folio,
                                        'nombre' => $doc->nombre_documento,
                                        'solicitante' => ($doc->usuario->infoUsuario->nombre ?? '').' '.($doc->usuario->infoUsuario->apellido_paterno ?? ''),
                                        'nivel' => $doc->nivel->descripcion ?? 'N/A',
                                        'subnivel' => $doc->subnivel->descripcion ?? 'N/A',
                                        'iso' => $doc->numero_iso ?? 'N/A',
                                        'version' => $doc->version ?? 'N/A',
                                        'retencion' => $doc->lugarRetencion->lugar_retencion ?? 'N/A',
                                        'periodo' => ($doc->periodoRetencion->tiempo ?? '').' '.($doc->periodoRetencion->unidad_tiempo ?? ''),
                                        'disposicion' => $doc->disposicionFinal->disposicion_final ?? 'N/A',
                                        'comentarios' => $doc->comentario ?? 'Sin observaciones.',
                                    ]) }}; 
                                    actionAprobar = '{{ route('admin.revision.aprobar', $doc->id) }}'; 
                                    actionRechazar = '{{ route('admin.revision.rechazar', $doc->id) }}'; 
                                    modalDetalle = true"
                                    class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all"
                                    title="Ver Información de Solicitud">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>

                                {{-- Botón Preview PDF --}}
                                @if($doc->url_documento)
                                <button
                                    x-on:click="urlPreview = '{{ $doc->url_documento }}'; modalPreview = true"
                                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all"
                                    title="Visualizar documento PDF">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                                @endif

                                {{-- Botón de Acción Directa: Aprobar --}}
                                <form action="{{ route('admin.revision.aprobar', $doc->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-green-500 hover:bg-green-50 dark:hover:bg-green-950/30 rounded-xl transition-all" title="Aprobar Solicitud">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                        </svg>
                                    </button>
                                </form>

                                {{-- Botón de Acción Directa: Rechazar --}}
                                <form action="{{ route('admin.revision.rechazar', $doc->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-all" title="Rechazar Solicitud">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </form>

                                @if($doc->url_documento)
                                <form action="{{ route('admin.revision.descargar_pdf', $doc->id) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="p-2 text-gray-400 hover:text-blue-500 hover:bg-blue-50 dark:hover:bg-blue-950/30 rounded-xl transition-all" title="Descargar PDF original">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400 dark:text-gray-500 text-sm">
                            No cuenta con solicitudes de cambio pendientes asignadas por el momento.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL 1: Pop-up con Información Completa del Documento --}}
    <div x-show="modalDetalle" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm" x-transition x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-3xl max-w-2xl w-full border border-gray-100 dark:border-gray-700 shadow-2xl overflow-hidden" x-on:click.away="modalDetalle = false">
            <div class="p-6 border-b border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-gray-900/20 flex justify-between items-center">
                <div>
                    <span class="text-xs font-mono font-bold bg-primary/10 text-primary px-2.5 py-1 rounded-lg" x-text="'#' + docSeleccionado.folio"></span>
                    <h3 class="text-base font-black text-gray-800 dark:text-white mt-1">Detalle General de la Solicitud</h3>
                </div>
                <button x-on:click="modalDetalle = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 text-xs">
                <div class="md:col-span-2 p-3.5 bg-gray-50 dark:bg-gray-900/40 rounded-xl border border-gray-100 dark:border-gray-700/50">
                    <span class="text-gray-400 font-bold block uppercase mb-1">Nombre del Procedimiento</span>
                    <span class="text-sm font-bold text-gray-800 dark:text-white" x-text="docSeleccionado.nombre"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Colaborador Solicitante</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.solicitante"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Clave / Número ISO</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.iso"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Estructura Nivel</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.nivel"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Subnivel Asociado</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.subnivel"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Lugar de Retención</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.retencion"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Periodo y Tiempo</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.periodo"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Disposición Final</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.disposicion"></span>
                </div>
                <div>
                    <span class="text-gray-400 font-bold block uppercase mb-0.5">Versión Actual</span>
                    <span class="font-semibold text-gray-800 dark:text-gray-200" x-text="docSeleccionado.version"></span>
                </div>
                <div class="md:col-span-2 p-3 bg-gray-50 dark:bg-gray-900/20 rounded-xl">
                    <span class="text-gray-400 font-bold block uppercase mb-1">Comentarios u Observaciones</span>
                    <p class="text-gray-600 dark:text-gray-300 font-medium" x-text="docSeleccionado.comentarios"></p>
                </div>
            </div>

            <div class="p-6 border-t border-gray-100 dark:border-gray-700/60 bg-gray-50/50 dark:bg-gray-900/20 flex justify-end gap-3">
                <button x-on:click="modalDetalle = false" type="button" class="px-5 py-2.5 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-bold text-xs uppercase tracking-wider">Cerrar</button>

                <form x-bind:action="actionRechazar" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white font-bold text-xs uppercase tracking-wider shadow-sm">Rechazar</button>
                </form>

                <form x-bind:action="actionAprobar" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-xs uppercase tracking-wider shadow-sm">Aprobar</button>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL 2: Vista Previa del PDF Integrada --}}
    <div x-show="modalPreview" class="fixed inset-0 z-50 overflow-y-auto flex items-center justify-center p-4 bg-black/70 backdrop-blur-sm" x-transition x-cloak>
        <div class="bg-white dark:bg-gray-800 rounded-3xl max-w-4xl w-full h-[85vh] border border-gray-100 dark:border-gray-700 shadow-2xl flex flex-col overflow-hidden" x-on:click.away="modalPreview = false">
            <div class="p-4 border-b border-gray-100 dark:border-gray-700 flex justify-between items-center bg-gray-50 dark:bg-gray-900/20">
                <h3 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                    </svg>
                    Visor de Documentos Oficiales
                </h3>
                <button x-on:click="modalPreview = false; urlPreview = ''" class="text-gray-400 hover:text-gray-600 dark:hover:text-white">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="flex-1 bg-gray-100 dark:bg-gray-900">
                <iframe x-bind:src="urlPreview" class="w-full h-full border-none rounded-b-3xl"></iframe>
            </div>
        </div>
    </div>

    {{-- Mensajes de Retroalimentación --}}
    @if(session('success'))
    <div x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 5000)"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="flex items-center justify-between p-4 bg-green-50 dark:bg-green-950/30 text-green-600 dark:text-green-400 border border-green-100 dark:border-green-900/30 rounded-2xl shadow-sm">
        <div class="flex items-center gap-3 text-xs font-bold">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('success') }}</span>
        </div>
        <button x-on:click="show = false" class="text-green-400 hover:text-green-600 dark:hover:text-green-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

    @if(session('error') || $errors->any())
    <div x-data="{ show: true }"
        x-show="show"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="flex items-center justify-between p-4 bg-red-50 dark:bg-red-950/30 text-red-600 dark:text-red-400 border border-red-100 dark:border-red-900/30 rounded-2xl shadow-sm">
        <div class="flex items-center gap-3 text-xs font-bold">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <span>{{ session('error') ?? $errors->first() }}</span>
        </div>
        <button x-on:click="show = false" class="text-red-400 hover:text-red-600 dark:hover:text-red-300 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    @endif

</div>
@endsection