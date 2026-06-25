@extends('layout.layout')

@section('title', 'Gestión de Usuarios')

@section('content')
<div class="flex-1 overflow-y-auto p-8 no-scrollbar space-y-6">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-black text-gray-800 dark:text-white tracking-tight">Gestión de Usuarios</h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">Administra los accesos, roles y permisos de los usuarios del sistema.</p>
        </div>

        <a href="{{ route('admin.crear_usuario') }}">
            <butto class="inline-flex items-center gap-2 bg-primary text-white font-bold px-5 py-3 rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none hover:opacity-90 transition-all text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Nuevo Usuario
                </button>
        </a>

    </div>



    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-950/40 rounded-2xl flex items-center justify-center text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Usuarios</p>
                <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $usuarios->count() }}</h4>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-950/40 rounded-2xl flex items-center justify-center text-emerald-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Total Áreas</p>
                <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $totalAreas ?? 0 }}</h4>
            </div>
        </div>
        <div class="bg-white dark:bg-gray-800 p-5 rounded-3xl border border-gray-100 dark:border-gray-700/50 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 dark:bg-amber-950/40 rounded-2xl flex items-center justify-center text-amber-500">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            <div>
                <p class="text-xs font-medium text-gray-400 uppercase tracking-wider">Roles Definidos</p>
                <h4 class="text-xl font-bold text-gray-800 dark:text-white">{{ $totalRoles ?? 0 }}</h4>
            </div>
        </div>
    </div>
    @if (session('success'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition.duration.500ms
        class="fixed bottom-5 right-5 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">

        {{ session('success') }}

    </div>
    @endif

    @if (session('error'))
    <div x-data="{ show: true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition.duration.500ms
        class="fixed bottom-5 right-5 bg-red-500 text-white px-6 py-3 rounded-lg shadow-lg z-50">

        {{ session('error') }}

    </div>
    @endif

    <div class="bg-white dark:bg-gray-800 rounded-4xl border border-gray-100 dark:border-gray-700/70 shadow-sm overflow-hidden">

        <div class="p-6 border-b border-gray-100 dark:border-gray-700/50 flex flex-col sm:flex-row justify-between items-center gap-4 bg-gray-50/50 dark:bg-gray-800/50">
            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-gray-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </span>
                <input type="text" id="inputBusqueda" placeholder="Buscar usuario por email..." class="w-full pl-11 pr-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white placeholder-gray-400 transition-colors">
            </div>
            <div class="flex items-center gap-2 w-full sm:w-auto justify-end">
                <select id="selectRol" class="px-4 py-2.5 text-sm bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors">
                    <option value="todos">Todos los roles</option>
                    @foreach($rolesLista ?? [] as $r)
                    <option value="{{ Str::slug($r->nombre) }}">{{ $r->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>

                    <tr class="border-b border-gray-100 dark:border-gray-700/50 text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider bg-gray-50/30 dark:bg-gray-800/30">
                        <th class="px-6 py-4">Usuario (Correo)</th>
                        <th class="px-6 py-4">Rol / Área / Localidad</th>
                        <th class="px-6 py-4">Jefe Inmediato</th>
                        <th class="px-6 py-4">Fecha de Registro</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>

                </thead>
                <tbody id="tablaUsuarios" class="divide-y divide-gray-100 dark:divide-gray-700/40 text-sm">


                    @forelse($usuarios as $usuario)
                    <tr data-email="{{ $usuario->email }}" data-role="{{ $usuario->infousuario->nombre ?? '' }}" class="hover:bg-gray-50/50 dark:hover:bg-gray-700/20 transition-colors group">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                {{-- Avatar dinámico usando las primeras letras del correo o un patrón estandarizado --}}
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->correo) }}&background=6366f1&color=fff" class="h-10 w-10 rounded-xl object-cover" alt="Avatar">
                                <div>
                                    <p class="font-bold text-gray-800 dark:text-white group-hover:text-primary transition-colors truncate max-w-xs">
                                        {{ $usuario->email }}
                                    </p>
                                    <span class="text-xs text-gray-400">ID: #{{ $usuario->id }}</span>
                                    <!-- <span class="text-xs text-gray-400">NOMBRE: #{{ $usuario->nombre }}</span>  ahorita poner-->
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap space-y-1">
                            <span class="inline-flex items-center px-2.5 py-1 rounded-xl text-xs font-semibold bg-indigo-50 dark:bg-indigo-950/50 text-primary">
                                {{ $usuario->rol->nombre ?? 'Sin Rol' }}
                            </span>
                            <div class="text-xs text-gray-400">
                                <span>📍 {{ $usuario->localidad->localidad ?? 'N/A' }}</span> |
                                <span>💼 {{ $usuario->area->area ?? 'N/A' }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300 text-xs">
                            @if($usuario->jefeInmediato)
                            <span class="font-medium text-gray-700 dark:text-gray-200">{{ $usuario->jefeInmediato->email }}</span>
                            @else
                            <span class="text-gray-400 italic">Ninguno (Alto Mando)</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-gray-500 dark:text-gray-400 text-xs">
                            {{ $usuario->created_at ? $usuario->created_at->format('d M, Y') : 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.editar_usuario', ['id' => $usuario->id]) }}">
                                    <button class="p-2 text-gray-400 hover:text-primary hover:bg-gray-100 dark:hover:bg-gray-700 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                        </svg>
                                    </button>
                                </a>
                                <form action="{{ route('admin.eliminar_usuario.delete', ['id' => $usuario->id]) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar al usuario {{ $usuario->infoUsuario->nombre ?? '' }} {{ $usuario->infoUsuario->apellido_paterno ?? '' }}? Esta acción no se puede deshacer.');">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                        title="Eliminar usuario"
                                        class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="sinResultadosServidor">
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="font-bold">No hay usuarios registrados en el sistema</p>
                        </td>
                    </tr>
                    @endforelse

                    {{-- Elemento reservado para el filtrado JS interactivo --}}
                    <tr id="sinResultados" class="hidden">
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400 dark:text-gray-500">
                            <svg class="w-12 h-12 mx-auto mb-3 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            <p class="font-bold">No se encontraron usuarios</p>
                            <p class="text-xs">Intenta cambiando los criterios de búsqueda o filtros.</p>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        {{-- Paginación / Contador --}}
        <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700/50 bg-gray-50/30 dark:bg-gray-800/30 flex justify-between items-center">
            <span id="contadorVisual" class="text-xs text-gray-500">
                Mostrando {{ $usuarios->count() }} de {{ $usuarios->count() }} resultados
            </span>
            <div class="flex gap-2">
                <button class="px-3 py-1.5 text-xs bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-400 cursor-not-allowed" disabled>Anterior</button>
                <button class="px-3 py-1.5 text-xs bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-700 dark:text-gray-300 hover:border-primary transition-colors">Siguiente</button>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const inputBusqueda = document.getElementById("inputBusqueda");
        const selectRol = document.getElementById("selectRol");
        const filas = document.querySelectorAll("#tablaUsuarios tr:not(#sinResultados):not(#sinResultadosServidor)");
        const filaSinResultados = document.getElementById("sinResultados");
        const contadorVisual = document.getElementById("contadorVisual");

        function filtrar() {
            const busqueda = inputBusqueda.value.toLowerCase().trim();
            const rolSeleccionado = selectRol.value;
            let visibles = 0;

            filas.forEach(fila => {
                const email = fila.getAttribute("data-email") || "";
                const rol = fila.getAttribute("data-role") || "";

                const coincideBusqueda = email.includes(busqueda);
                const coincideRol = (rolSeleccionado === "todos") || (rol === rolSeleccionado);

                if (coincideBusqueda && coincideRol) {
                    fila.classList.remove("hidden");
                    visibles++;
                } else {
                    fila.classList.add("hidden");
                }
            });

            if (visibles === 0 && filas.length > 0) {
                filaSinResultados.classList.remove("hidden");
            } else {
                filaSinResultados.classList.add("hidden");
            }

            contadorVisual.textContent = `Mostrando ${visibles} de ${filas.length} resultados`;
        }

        inputBusqueda.addEventListener("input", filtrar);
        selectRol.addEventListener("change", filtrar);
    });
</script>
@endsection