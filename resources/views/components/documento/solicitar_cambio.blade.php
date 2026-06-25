@extends('layout.layout')

@section('title', 'Control de Documentación')

@section('content')
<div class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    {{-- Encabezado de la Sección --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight">Control de Documentación</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Complete los campos para el registro oficial de procedimientos en el sistema.</p>
        </div>
    </div>

    {{-- Alertas de Notificación Dinámicas --}}
    @if (session('success'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition.duration.500ms
        class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 4000)"
        x-show="show"
        x-transition.duration.500ms
        class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- Contenedor Principal del Formulario --}}
    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50 flex items-center gap-3">
            <div class="w-10 h-10 bg-indigo-50 dark:bg-indigo-950/40 rounded-xl flex items-center justify-center text-primary">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <h3 class="text-sm font-bold text-gray-800 dark:text-white uppercase tracking-wider">Formulario de Registro</h3>
                <p class="text-xs text-gray-400">Estructura oficial alineada a normativas ISO</p>
            </div>
        </div>

        {{-- Formulario habilitado para archivos multipart --}}
        <form action="{{ route('admin.solicitar_cambio.post') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-8">
            @csrf

            {{-- Campo Oculto del ID de Usuario en Sesión --}}
            <input type="hidden" name="usuario_id" value="{{ auth()->id() }}">

            {{-- Bloque Metadatos Superiores --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                {{-- Folio Automático generado --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        No. Solicitud (Folio)
                    </label>
                    <input type="text" name="folio" readonly value="{{ $proximoFolio }}" class="w-full px-4 py-2.5 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 font-mono outline-none">
                </div>

                {{-- Solicitante en Sesión --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Solicitante
                    </label>
                    <input type="text" readonly value="{{ auth()->user()->infoUsuario->nombre ?? '' }} {{ auth()->user()->infoUsuario->apellido_paterno ?? '' }}" class="w-full px-4 py-2.5 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 outline-none">
                </div>

                {{-- Fecha de Solicitud --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fecha
                    </label>
                    <input type="date" name="fecha" value="{{ old('fecha', date('Y-m-d')) }}" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border @error('fecha') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                    @error('fecha') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Bloque de Clasificación Estructural con Filtrado Dinámico (Alpine.js) --}}
            <div x-data="{ 
                    nivelSeleccionado: '{{ old('nivel_id', '') }}',
                    subniveles: [
                        @foreach($subniveles as $snv)
                            { id: '{{ $snv->id }}', nivel_id: '{{ $snv->nivel_id }}', descripcion: '{{ $snv->descripcion }}' },
                        @endforeach
                    ],
                    get subnivelesFiltrados() {
                        if (!this.nivelSeleccionado) return [];
                        return this.subniveles.filter(sub => sub.nivel_id == this.nivelSeleccionado);
                    }
                 }"
                class="grid grid-cols-1 md:grid-cols-3 gap-5 p-5 bg-gray-50/50 dark:bg-gray-900/30 rounded-3xl border border-gray-100 dark:border-gray-700/40">

                {{-- Tipo de Solicitud (Nuevo, Actualizar, Eliminar) --}}
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Tipo de Solicitud</label>
                    <select name="tipo_solicitud_id" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border @error('tipo_solicitud_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option value="" disabled selected>Seleccione tipo</option>
                        @foreach($tiposSolicitud as $tipo)
                        <option value="{{ $tipo->id }}" {{ old('tipo_solicitud_id') == $tipo->id ? 'selected' : '' }}>{{ $tipo->tipo_solicitud }}</option>
                        @endforeach
                    </select>
                    @error('tipo_solicitud_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Niveles Documentales --}}
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Nivel</label>
                    <select name="nivel_id"
                        x-model="nivelSeleccionado"
                        class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border @error('nivel_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option value="" disabled selected>Seleccione nivel</option>
                        @foreach($niveles as $nv)
                        <option value="{{ $nv->id }}">Nivel {{ $nv->nivel }}: {{ $nv->descripcion }}</option>
                        @endforeach
                    </select>
                    @error('nivel_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Subniveles Reactivos --}}
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Subnivel</label>
                    <select name="sub_nivel_id"
                        :disabled="subnivelesFiltrados.length === 0"
                        class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border @error('sub_nivel_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors disabled:bg-gray-100 dark:disabled:bg-gray-800 disabled:text-gray-400 disabled:cursor-not-allowed">

                        <template x-if="subnivelesFiltrados.length === 0">
                            <option value="" selected>Primero seleccione un nivel...</option>
                        </template>

                        <template x-if="subnivelesFiltrados.length > 0">
                            <option value="" disabled selected>Seleccione subnivel</option>
                        </template>

                        <template x-for="sub in subnivelesFiltrados" :key="sub.id">
                            <option :value="sub.id"
                                :selected="sub.id == '{{ old('sub_nivel_id', '') }}'"
                                x-text="sub.descripcion">
                            </option>
                        </template>
                    </select>
                    @error('sub_nivel_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Parámetros Operativos del Documento --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                {{-- Título Completo --}}
                <div class="flex flex-col space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Procedimiento (Nombre Completo)</label>
                    <input type="text" name="nombre_documento" value="{{ old('nombre_documento') }}" placeholder="Ej. Procedimiento Operativo Estándar de Almacén" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('nombre_documento') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white font-bold tracking-tight transition-colors shadow-sm">
                    @error('nombre_documento') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Matriz Identificadora: Código y Versión --}}
                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 block truncate">Número de ISO</label>
                        <input type="text" name="numero_iso" value="{{ old('numero_iso') }}" placeholder="PR-ALM-01" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('numero_iso') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white font-mono transition-colors">
                    </div>
                    <div class="col-span-1">
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 block text-center">Ver.</label>
                        <input type="text" name="version" value="{{ old('version', '01') }}" placeholder="01" class="w-full px-2 py-3 text-sm bg-white dark:bg-gray-900 border @error('version') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white text-center transition-colors">
                    </div>
                    <div class="col-span-3">
                        @error('numero_iso') <span class="text-red-500 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                        @error('version') <span class="text-red-500 text-xs font-semibold block mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                {{-- Localidad del Usuario Autenticado (Read Only + Hidden) --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Localidad</label>
                    <div class="relative">
                        <input type="text" readonly
                            value="{{ auth()->user()->localidad->localidad ?? (auth()->user()->localidad->nombre ?? 'Sin Localidad Asignada') }}"
                            class="w-full px-4 py-3 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 font-medium outline-none shadow-sm cursor-not-allowed">
                        <input type="hidden" name="localidad_id" value="{{ auth()->user()->localidad_id }}">
                    </div>
                    @error('localidad_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Área del Usuario Autenticado (Read Only + Hidden) --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Área</label>
                    <div class="relative">
                        <input type="text" readonly
                            value="{{ auth()->user()->area->area ?? (auth()->user()->area->nombre ?? 'Sin Área Asignada') }}"
                            class="w-full px-4 py-3 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 font-medium outline-none shadow-sm cursor-not-allowed">
                        <input type="hidden" name="area_id" value="{{ auth()->user()->area_id }}">
                    </div>
                    @error('area_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Aprobación Autorizada (Jefe Inmediato Automatizado) --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Aprobar Por (Jefe Directo)</label>
                    @if($jefeInmediato)
                    <input type="text" readonly value="{{ $jefeInmediato->infoUsuario->nombre ?? '' }} {{ $jefeInmediato->infoUsuario->apellido_paterno ?? '' }}" class="w-full px-4 py-3 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 font-medium outline-none shadow-sm">
                    <input type="hidden" name="aprobar_id" value="{{ $jefeInmediato->id }}">
                    @else
                    <input type="text" readonly value="Dirección General / Sin Jerarquía" class="w-full px-4 py-3 text-sm bg-red-50/50 dark:bg-red-950/20 border border-red-200 dark:border-red-900/50 rounded-2xl text-red-500 italic outline-none">
                    <input type="hidden" name="aprobar_id" value="">
                    @endif
                    @error('aprobar_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Espacio de Retención Física o Digital --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Lugar de Retención</label>
                    <select name="lugar_retencion_id" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('lugar_retencion_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option value="" disabled selected>Seleccione lugar</option>
                        @foreach($lugaresRetencion as $lugar)
                        <option value="{{ $lugar->id }}" {{ old('lugar_retencion_id') == $lugar->id ? 'selected' : '' }}>{{ $lugar->lugar_retencion }}</option>
                        @endforeach
                    </select>
                    @error('lugar_retencion_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Límites de Tiempo Almacenado --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Periodo Retención</label>
                    <select name="periodo_retencion_id" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('periodo_retencion_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option value="" disabled selected>Seleccione periodo</option>
                        @foreach($periodosRetencion as $periodo)
                        <option value="{{ $periodo->id }}" {{ old('periodo_retencion_id') == $periodo->id ? 'selected' : '' }}>{{ $periodo->tiempo }} {{ $periodo->unidad_tiempo }}</option>
                        @endforeach
                    </select>
                    @error('periodo_retencion_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Criterio de Eliminación Segura ISO --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Disposición Final</label>
                    <select name="disposicion_final_id" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('disposicion_final_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option value="" disabled selected>Seleccione disposición</option>
                        @foreach($disposicionesFinales as $disp)
                        <option value="{{ $disp->id }}" {{ old('disposicion_final_id') == $disp->id ? 'selected' : '' }}>{{ $disp->disposicion_final }}</option>
                        @endforeach
                    </select>
                    @error('disposicion_final_id') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Input Especial para Carga de Documentos (Solo PDF) --}}
                <div class="flex flex-col space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        Documento Oficial (Solo formato PDF)
                    </label>
                    <input type="file" name="url_documento" accept=".pdf"
                        class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:uppercase file:bg-indigo-50 file:text-primary dark:file:bg-gray-900 dark:file:text-indigo-400 hover:file:opacity-90 border @error('url_documento') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl p-1.5 bg-white dark:bg-gray-900 transition-colors focus:outline-none">
                    @error('url_documento') <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span> @enderror
                </div>

                {{-- Notas de Control --}}
                <div class="flex flex-col space-y-2 md:col-span-4">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Comentarios / Observaciones</label>
                    <textarea name="comentario" rows="2" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white resize-none transition-colors">{{ old('comentario') }}</textarea>
                </div>
            </div>

            {{-- Botón de Envío Oficial --}}
            <div class="flex justify-end pt-2">
                <button type="submit" class="inline-flex items-center gap-2 bg-primary text-white font-bold px-6 py-3.5 rounded-2xl shadow-lg shadow-indigo-100 dark:shadow-none hover:opacity-90 transition-all text-sm uppercase tracking-wider">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Registrar Documento
                </button>
            </div>
        </form>
    </div>

    {{-- Bloque Inferior: Registro Histórico Auditoría --}}
    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Últimos Registros del Sistema</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Código (ISO)</th>
                        <th class="px-6 py-4">Procedimiento</th>
                        <th class="px-6 py-4 text-center">Localidad</th>
                        <th class="px-6 py-4">Solicitante</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    @forelse($ultimosDocumentos ?? [] as $doc)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-500 dark:text-gray-400">
                            {{ $doc->numero_iso }} <span class="text-indigo-500 font-bold">v{{ $doc->version }}</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-800 dark:text-white group-hover:text-primary transition-colors">
                            {{ $doc->nombre_documento }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-primary uppercase">
                                {{ $doc->localidad->localidad ?? ($doc->localidad->nombre ?? 'General') }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300 text-xs">
                            {{ $doc->usuario->infoUsuario->nombre ?? '' }} {{ $doc->usuario->infoUsuario->apellido_paterno ?? '' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ asset('storage/' . $doc->url_documento) }}" target="_blank" class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all" title="Ver PDF">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400 italic">No hay solicitudes de documentos registradas en este momento.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection