@extends('layout.layout')

@section('title', 'Historial de Procedimientos')

@section('content')
{{-- Inicializamos Alpine con variables para controlar el modal, el documento seleccionado y los filtros --}}
<div x-data="{ 
    openModal: false, 
    seleccionado: {},
    filtroLocalidad: '',
    filtroArea: '',
    filtroNivel: ''
}" class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight flex items-center gap-2">
                Historial de Procedimientos
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Consulta de versiones anteriores, trazabilidad y control de cambios de documentos.</p>
        </div>

        {{-- Selectores de Filtros Vinculados a Alpine mediante x-model --}}
        <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
            <div class="w-full sm:w-48">
                <select x-model="filtroLocalidad" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-semibold transition-colors shadow-sm">
                    <option value="">Todas las Localidades</option>
                    @foreach($documentos->pluck('localidad')->unique('id') as $loc)
                        @if($loc)
                            <option value="{{ $loc->id }}">{{ $loc->localidad ?? $loc->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-48">
                <select x-model="filtroArea" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-semibold transition-colors shadow-sm">
                    <option value="">Todas las Áreas</option>
                    @foreach($documentos->pluck('area')->unique('id') as $area)
                        @if($area)
                            <option value="{{ $area->id }}">{{ $area->area ?? $area->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="w-full sm:w-48">
                <select x-model="filtroNivel" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-semibold transition-colors shadow-sm">
                    <option value="">Todos los Niveles</option>
                    @foreach($documentos->pluck('nivel')->unique('id') as $nivel)
                        @if($nivel)
                            <option value="{{ $nivel->id }}">{{ $nivel->descripcion ?? $nivel->nombre }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    {{-- Tabla Principal de Documentos Oficiales --}}
    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Procedimiento</th>
                        <th class="px-6 py-4">No. Proc</th>
                        <th class="px-6 py-4 text-center">Versión Actual</th>
                        <th class="px-6 py-4 text-center">Fecha</th>
                        <th class="px-6 py-4">Área</th>
                        <th class="px-6 py-4 text-center">Historial</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    @forelse($documentos as $doc)
                        {{-- Evaluamos en tiempo real con Alpine si la fila debe mostrarse --}}
                        <tr x-show="(filtroLocalidad === '' || filtroLocalidad == '{{ $doc->localidad_id }}') && 
                                    (filtroArea === '' || filtroArea == '{{ $doc->area_id }}') && 
                                    (filtroNivel === '' || filtroNivel == '{{ $doc->nivel_id }}')"
                            class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors"
                            x-transition:enter="transition ease-out duration-200">
                            
                            <td class="px-6 py-5 font-bold text-gray-800 dark:text-white">
                                {{ $doc->nombre_documento }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <span class="text-xs font-mono font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900 px-2.5 py-1 rounded-xl border border-gray-200/50 dark:border-gray-700/30">
                                    {{ $doc->numero_iso ?? 'S/N' }}
                                </span>
                            </td>
                            <td class="px-6 py-5 text-center font-black text-gray-700 dark:text-gray-300">
                                v{{ $doc->version }}
                            </td>
                            <td class="px-6 py-5 text-center text-xs text-gray-500 dark:text-gray-400 font-semibold">
                                {{ $doc->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-5 whitespace-nowrap">
                                <div class="text-xs font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wider">
                                    {{ $doc->area->descripcion ?? 'Sin Área' }}
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <button @click="seleccionado = { 
                                            nombre: '{{ e($doc->nombre_documento) }}', 
                                            version: '{{ $doc->version }}',
                                            fecha: '{{ $doc->created_at->format('d/m/Y') }}',
                                            area: '{{ $doc->area->descripcion ?? 'N/A' }}'
                                        }; openModal = true" 
                                        class="text-gray-900 bg-amber-400 hover:bg-amber-500 transition-all p-2 rounded-xl shadow-sm flex items-center justify-center mx-auto group" 
                                        title="Ver logs de versiones">
                                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-400 dark:text-gray-500 font-semibold">
                                No se encontraron documentos registrados oficialmente.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Modal de Historial Dinámico (Permanece igual) --}}
    <div x-show="openModal"
        class="fixed inset-0 bg-gray-900/60 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 px-4"
        style="display: none;">

        <div @click.away="openModal = false"
            class="bg-white dark:bg-gray-800 w-full max-w-4xl rounded-3xl shadow-2xl overflow-hidden border border-gray-100 dark:border-gray-700/60">

            <div class="bg-gray-50 dark:bg-gray-900 px-6 py-5 flex justify-between items-center border-b border-gray-100 dark:border-gray-700/60">
                <div class="flex items-center gap-3">
                    <div class="bg-amber-400 p-2 rounded-xl text-gray-900">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4s.5 0 1 .5l3.5 3.5c.5.5.5 1 .5 1V7a2 2 0 01-2 2h-2.343M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h10a2 2 0 002-2v-3" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-gray-800 dark:text-white font-black uppercase text-sm tracking-tight">Historial de Versiones</h3>
                        <p x-text="seleccionado.nombre" class="text-gray-400 dark:text-gray-500 text-[11px] font-bold uppercase tracking-wider"></p>
                    </div>
                </div>
                <button @click="openModal = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                    </svg>
                </button>
            </div>

            <div class="p-6 space-y-6">
                <div class="overflow-hidden border border-gray-100 dark:border-gray-700/50 rounded-2xl shadow-sm bg-white dark:bg-gray-900">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 dark:bg-gray-800 text-[10px] font-black text-gray-400 dark:text-gray-500 uppercase tracking-widest border-b border-gray-100 dark:border-gray-700/40">
                                <th class="px-6 py-4">Procedimiento</th>
                                <th class="px-6 py-4">Formato</th>
                                <th class="px-6 py-4 text-center">Versión</th>
                                <th class="px-6 py-4 text-center">Fecha</th>
                                <th class="px-6 py-4">Área</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                            <tr class="bg-emerald-50/30 dark:bg-emerald-950/20">
                                <td x-text="seleccionado.nombre" class="px-6 py-4 font-bold text-gray-800 dark:text-emerald-400"></td>
                                <td class="px-6 py-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase italic">PDF / Digital</td>
                                <td x-text="'v' + seleccionado.version" class="px-6 py-4 text-center font-black text-emerald-600 dark:text-emerald-400"></td>
                                <td x-text="seleccionado.fecha" class="px-6 py-4 text-center text-xs text-gray-500 dark:text-gray-400 font-medium italic"></td>
                                <td x-text="seleccionado.area" class="px-6 py-4 text-xs font-bold text-gray-600 dark:text-gray-400 uppercase"></td>
                            </tr>
                            <tr>
                                <td colspan="5" class="px-6 py-5 text-center text-xs text-gray-400 dark:text-gray-500 font-bold italic bg-gray-50/20 dark:bg-gray-800/10">
                                    ℹ️ No se detectaron versiones anteriores o cambios previos registrados para este documento.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex justify-end">
                    <button @click="openModal = false" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-6 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider shadow-md hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                        Cerrar Historial
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection