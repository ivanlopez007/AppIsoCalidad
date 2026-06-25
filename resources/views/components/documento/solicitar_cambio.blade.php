@extends('layout.layout')

@section('title', 'Control de Documentación')

@section('content')
<div class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight">Control de Documentación</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Complete los campos para el registro oficial de procedimientos en el sistema.</p>
        </div>
    </div>

    @if (session('success'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
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
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition.duration.500ms
        class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg z-50 flex items-center gap-2">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
        </svg>
        {{ session('error') }}
    </div>
    @endif

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

        <form action="#" method="POST" class="p-8 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                        </svg>
                        No. Solicitud
                    </label>
                    <input type="text" readonly value="SOL-2026-088" class="w-full px-4 py-2.5 text-sm bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700 rounded-2xl text-gray-500 font-mono outline-none">
                </div>
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Solicitante
                    </label>
                    <input type="text" placeholder="Nombre completo" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white placeholder-gray-400 transition-colors">
                </div>
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Fecha
                    </label>
                    <input type="date" value="2026-05-13" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 p-5 bg-gray-50/50 dark:bg-gray-900/30 rounded-3xl border border-gray-100 dark:border-gray-700/40">
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Tipo de Solicitud</label>
                    <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>Actualización de Documento</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Nivel</label>
                    <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>Nivel 2: Táctico</option>
                    </select>
                </div>
                <div class="flex flex-col space-y-1.5">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Subnivel</label>
                    <select class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>Administrativo</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-5">
                <div class="flex flex-col space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Procedimiento (Nombre Completo)</label>
                    <select class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-bold tracking-tight transition-colors shadow-sm">
                        <option>Procedimiento Operativo Estándar de Almacén</option>
                    </select>
                </div>

                <div class="grid grid-cols-3 gap-2">
                    <div class="col-span-2">
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 block truncate">No. Proc</label>
                        <input type="text" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-mono transition-colors">
                    </div>
                    <div class="col-span-1">
                        <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider mb-2 block text-center">Ver.</label>
                        <input type="text" placeholder="01" class="w-full px-2 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white text-center transition-colors">
                    </div>
                </div>

                <div class="flex flex-col space-y-2 md:col-span-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Dueño del Procedimiento</label>
                    <input type="text" placeholder="Nombre del responsable" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Aprobar Por:</label>
                    <input type="text" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Lugar de Retención</label>
                    <select class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>Archivo General</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Periodo Retención</label>
                    <select class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>3 Años</option>
                    </select>
                </div>

                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Disposición Final</label>
                    <select class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                        <option>Destrucción Documental</option>
                    </select>
                </div>

                <div class="hidden md:block"></div>

                <div class="flex flex-col space-y-2 md:col-span-4">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Comentarios / Observaciones</label>
                    <textarea rows="2" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white resize-none transition-colors"></textarea>
                </div>
            </div>

            <div class="flex justify-end pt-2">
                <button type="submit" class="inline-flex items-center gap-2 bg-primary text-white font-bold px-6 py-3.5 rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none hover:opacity-90 transition-all text-sm uppercase tracking-wider">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                    </svg>
                    Registrar Documento
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Últimos Registros del Sistema</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">No.</th>
                        <th class="px-6 py-4">Procedimiento</th>
                        <th class="px-6 py-4 text-center">Localidad</th>
                        <th class="px-6 py-4">Dueño</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap font-mono text-xs text-gray-500 dark:text-gray-400">
                            PR-012
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap font-bold text-gray-800 dark:text-white group-hover:text-primary transition-colors">
                            Manual de Seguridad e Higiene
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-primary uppercase">
                                Planta Saltillo
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300 text-xs">
                            Ing. Alberto Ramos
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection