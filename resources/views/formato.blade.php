@extends('layout.layout')

@section('title', 'Información General del Formato')

@section('content')
<div x-data="{ openPreview: false }" class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight flex items-center gap-2">
                Información General del Formato
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Control unificado de parámetros, retención y disposición final de documentos vigentes.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <button @click="openPreview = true" class="w-full sm:w-auto bg-amber-400 hover:bg-amber-500 text-gray-950 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Ver Documento
            </button>
            <button class="w-full sm:w-auto bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-5 py-2.5 rounded-xl text-xs font-bold uppercase tracking-wider hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors shadow-sm flex items-center justify-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                </svg>
                Descargar PDF
            </button>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Nombre y No. Uso</th>
                        <th class="px-6 py-4 text-center">Versión / Nivel</th>
                        <th class="px-6 py-4">Área y Dueño</th>
                        <th class="px-6 py-4">Retención y Lugar</th>
                        <th class="px-6 py-4">Disposición Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-800 dark:text-white leading-tight mb-1.5">Checklist de Embarques Críticos</div>
                            <span class="text-xs font-mono font-bold text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-950/40 px-2.5 py-0.5 rounded-xl border border-blue-100/40 dark:border-blue-900/30">
                                FOR-LOG-022
                            </span>
                        </td>

                        <td class="px-6 py-5 text-center whitespace-nowrap">
                            <div class="text-sm font-black text-gray-700 dark:text-gray-300">v4.0</div>
                            <div class="text-[10px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-tight">Nivel 3 - Operativo</div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider">Logística</div>
                            <div class="text-xs text-gray-400 dark:text-gray-500 font-bold uppercase mt-0.5">Ivan Lopez</div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase flex items-center gap-1">
                                <svg class="w-3.5 h-3.5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                5 Años
                            </div>
                            <div class="text-xs text-gray-400 dark:text-gray-500 font-bold uppercase mt-0.5">Archivo Muerto Central</div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-flex items-center gap-1 text-[11px] font-bold text-rose-600 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/40 px-3 py-1 rounded-full border border-rose-100/40 dark:border-rose-900/30 uppercase tracking-wider">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                                Trituración
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openPreview"
        class="fixed inset-0 bg-gray-900/60 dark:bg-black/70 backdrop-blur-sm flex items-center justify-center z-50 px-4"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        style="display: none;">

        <div @click.away="openPreview = false"
            class="bg-gray-100 dark:bg-gray-900 w-full max-w-3xl rounded-3xl shadow-2xl overflow-hidden border border-gray-200/60 dark:border-gray-700/60"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="scale-95 translate-y-4"
            x-transition:enter-end="scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="scale-100 translate-y-0"
            x-transition:leave-end="scale-95 translate-y-4">

            <div class="bg-gray-50 dark:bg-gray-800 px-6 py-4 flex justify-between items-center border-b border-gray-200/50 dark:border-gray-700/50">
                <div class="flex items-center gap-2.5 text-gray-800 dark:text-white">
                    <svg class="w-5 h-5 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-xs font-black uppercase tracking-wider">Previsualización de Formato</span>
                </div>
                <button @click="openPreview = false" class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l18 18" />
                    </svg>
                </button>
            </div>

            <div class="p-6 sm:p-10 bg-gray-50 dark:bg-gray-950/40">
                <div class="bg-white dark:bg-gray-900 p-8 sm:p-12 shadow-sm rounded-xl relative border border-gray-200 dark:border-gray-800 overflow-hidden">

                    <div class="absolute inset-0 flex items-center justify-center opacity-[0.03] dark:opacity-[0.02] pointer-events-none select-none">
                        <span class="text-5xl font-black rotate-12 text-gray-900 dark:text-white uppercase tracking-widest">INDUSTRIAL HEFESTO</span>
                    </div>

                    <div class="relative z-10 space-y-8">
                        <div class="border-b-2 border-gray-900 dark:border-gray-300 pb-4 flex justify-between items-center">
                            <div class="px-3 py-1 bg-gray-900 dark:bg-gray-200 flex items-center justify-center rounded-lg">
                                <span class="text-[9px] text-white dark:text-gray-900 font-black italic tracking-tighter">HEFESTO</span>
                            </div>
                            <div class="text-right">
                                <h4 class="text-xs font-black text-gray-800 dark:text-white">FOR-LOG-022</h4>
                                <p class="text-[9px] text-gray-400 dark:text-gray-500 font-bold">VERSIÓN 4.0</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div class="h-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800 rounded"></div>
                            <div class="h-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800 rounded"></div>
                            <div class="h-4 bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800 rounded"></div>
                        </div>

                        <div class="grid grid-cols-2 gap-8 pt-6">
                            <div class="border-t border-gray-300 dark:border-gray-700 pt-2 text-center">
                                <span class="text-[9px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Firma de Elaboración</span>
                            </div>
                            <div class="border-t border-gray-300 dark:border-gray-700 pt-2 text-center">
                                <span class="text-[9px] font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Firma de Autorización</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <button @click="openPreview = false" class="bg-gray-900 dark:bg-white text-white dark:text-gray-900 px-8 py-2.5 rounded-xl text-xs font-bold uppercase tracking-widest shadow-md hover:bg-gray-800 dark:hover:bg-gray-100 transition-colors">
                        Cerrar Vista Previa
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection