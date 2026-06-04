@extends('layout.layout')

@section('title', 'Gestión de Usuarios')

@section('content')

<!-- Contenedor expandido a ancho completo (w-full) con un margen interno cómodo -->
<div class="w-full max-w-7xl mx-auto p-4 md:p-6 transition-colors duration-300">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">

        <!-- Encabezado más robusto y espaciado -->
        <div class="bg-gray-50 dark:bg-gray-700/40 border-b border-gray-200 dark:border-gray-700 px-8 py-6 flex items-center gap-4">
            <div class="h-12 w-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-indigo-100 dark:shadow-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-white uppercase tracking-wider">Registro de Colaborador</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Ingresa los datos generales del nuevo usuario para el alta en los sistemas</p>
            </div>
        </div>

        <form action="#" method="POST" class="p-8 md:p-10 space-y-8">
            @csrf

            <!-- Grid con columnas más amplias y mayor separación (gap-8) -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <!-- Nombre -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Nombre(s)</label>
                    <input type="text" name="nombre" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Juan">
                </div>

                <!-- Apellido Paterno -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Pérez">
                </div>

                <!-- Apellido Materno -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Materno</label>
                    <input type="text" name="apellido_materno" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. García">
                </div>

                <!-- Área -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Área</label>
                    <select name="area" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled selected class="dark:bg-gray-800">Seleccione área</option>
                        <option value="operaciones" class="dark:bg-gray-800">RH</option>
                        <option value="ventas" class="dark:bg-gray-800">Calidad</option>
                        <option value="marketing" class="dark:bg-gray-800">Marketing</option>
                        <option value="asistencia" class="dark:bg-gray-800">Sistemas</option>
                    </select>
                </div>

                <!-- Posición -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Posición</label>
                    <input type="text" name="posicion" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Analista Jr">
                </div>


                <!-- Teléfono -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Teléfono</label>
                    <input type="tel" name="telefono" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="5512345678">
                </div>

                <!-- Correo -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Correo Electrónico</label>
                    <input type="email" name="correo" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="usuario@empresa.com">
                </div>

                <!-- Supervisor -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Supervisor Directo</label>
                    <input type="text" name="supervisor" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Nombre del jefe">
                </div>

                <!-- Fecha Ingreso -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Fecha de Ingreso</label>
                    <input type="date" disabled value="{{ date('Y-m-d') }}" name="fecha_ingreso" class="disabled border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-700/30 p-3.5 rounded-xl text-gray-400 dark:text-gray-500 outline-none transition text-base cursor-not-allowed shadow-sm">
                </div>

                <!-- Fecha Nacimiento -->
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Fecha de Nacimiento</label>
                    <input type="date" name="fecha_nacimiento" class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition dark:[color-scheme:dark] shadow-sm">
                </div>

            </div>

            <!-- Botones de Acción proporcionales al nuevo tamaño -->
            <div class="mt-12 flex justify-end space-x-4 border-t border-gray-200 dark:border-gray-700 pt-8">
                <button type="reset" class="px-8 py-3.5 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition font-medium text-base">
                    Limpiar campos
                </button>
                <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 dark:shadow-none transition font-bold text-base tracking-wide uppercase">
                    Guardar Registro
                </button>
            </div>
        </form>
    </div>
</div>

@endsection