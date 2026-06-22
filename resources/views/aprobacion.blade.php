@extends('layout.layout')

@section('title', 'Panel de Aprobaciones')

@section('content')
<div class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight flex items-center gap-2">
                Panel de Aprobaciones
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Gestión, revisión y estatus de solicitudes de procedimientos vigentes.</p>
        </div>

        <div class="relative w-full sm:w-72">
            <select id="selectArea" class="w-full px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white font-semibold transition-colors shadow-sm">
                <option value="">Todas las Áreas</option>
                <option value="it">Sistemas / IT</option>
                <option value="rh">Recursos Humanos</option>
                <option value="calidad">Control de Calidad</option>
            </select>
        </div>
    </div>

    <div class="flex flex-wrap gap-2 bg-white dark:bg-gray-800 p-1.5 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/50 w-fit">
        <button class="flex items-center gap-2 px-5 py-2 rounded-xl text-xs font-bold transition-all bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 border border-emerald-100 dark:border-emerald-900/30 shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Aprobados
            <span class="ml-1 bg-emerald-600 dark:bg-emerald-500 text-white text-[10px] px-2 py-0.5 rounded-full font-bold">12</span>
        </button>
        
        <button class="flex items-center gap-2 px-5 py-2 rounded-xl text-xs font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
            <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            Rechazados
        </button>

        <button class="flex items-center gap-2 px-5 py-2 rounded-xl text-xs font-bold text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-all">
            <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
            </svg>
            Canceladas
        </button>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 bg-gray-50/50 dark:bg-gray-800/50">
            <h3 class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Registros del Panel</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Solicitud</th>
                        <th class="px-6 py-4">Área</th>
                        <th class="px-6 py-4">Tipo</th>
                        <th class="px-6 py-4">Procedimiento</th>
                        <th class="px-6 py-4">Fecha Solicitud</th>
                        <th class="px-6 py-4">Solicitante</th>
                        <th class="px-6 py-4 text-right">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="text-xs font-mono font-bold text-gray-500 dark:text-gray-400 bg-gray-100 dark:bg-gray-900 px-2.5 py-1 rounded-xl border border-gray-200/50 dark:border-gray-700/30">
                                #SOL-2026-04
                            </span>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-bold text-gray-800 dark:text-white">Control de Calidad</div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-xl text-[11px] font-semibold bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 border border-blue-100/40 dark:border-blue-900/30 uppercase tracking-wider">
                                Actualización
                            </span>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="text-sm font-semibold text-gray-700 dark:text-gray-300 truncate max-w-[220px]">
                                Manual de Auditoría ISO
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-xs text-gray-500 dark:text-gray-400">
                            13 Mayo, 2026
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap">
                            <div class="flex items-center gap-2.5">
                                <img src="https://ui-avatars.com/api/?name=Ivan+Lopez&background=6366f1&color=fff" class="h-8 w-8 rounded-xl object-cover" alt="Avatar">
                                <span class="text-xs font-bold text-gray-700 dark:text-gray-300">Ivan Lopez</span>
                            </div>
                        </td>

                        <td class="px-6 py-5 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <button class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all" title="Visualizar documento">
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