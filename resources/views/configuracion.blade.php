@extends('layout.layout') {{-- Aquí llamas al archivo base --}}

@section('title', 'Gestión de Usuarios') {{-- Cambia el título de la pestaña --}}
@section('header_title', 'Usuarios del Sistema')

@section('content')

<div class="max-w-6xl mx-auto">
    <div class="bg-white dark:bg-gray-800 rounded-4xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
        <div class="flex flex-col md:flex-row min-h-600px">

            <!-- Menú Lateral de Configuración -->
            <aside class="w-full md:w-64 bg-gray-50/50 dark:bg-gray-900/20 border-r border-gray-100 dark:border-gray-700 p-6">
                <nav class="space-y-2">
                    <a href="#" class="flex items-center px-4 py-3 bg-white dark:bg-gray-800 text-primary shadow-sm rounded-2xl font-bold transition-all">
                        <span class="mr-3">👤</span> Perfil
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-500 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800 rounded-2xl transition-all">
                        <span class="mr-3">🔒</span> Seguridad
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-500 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800 rounded-2xl transition-all">
                        <span class="mr-3">🔔</span> Notificaciones
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-500 dark:text-gray-400 hover:bg-white dark:hover:bg-gray-800 rounded-2xl transition-all">
                        <span class="mr-3">💳</span> Suscripción
                    </a>
                </nav>
            </aside>

            <!-- Formulario de Configuración -->
            <div class="flex-1 p-8 md:p-12">
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <section class="mb-10">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-6">Información Personal</h3>

                        <!-- Foto de Perfil -->
                        <div class="flex items-center gap-6 mb-8">
                            <div class="relative">
                                <img src="https://ui-avatars.com/api/?name=Ivan+Lopez&background=6366f1&color=fff" class="h-24 w-24 rounded-3xl object-cover ring-4 ring-gray-50 dark:ring-gray-700" alt="Avatar">
                                <button type="button" class="absolute -bottom-2 -right-2 bg-white dark:bg-gray-700 p-2 rounded-xl shadow-lg border border-gray-100 dark:border-gray-600 text-xs">
                                    📷
                                </button>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-700 dark:text-gray-200">Foto de perfil</h4>
                                <p class="text-xs text-gray-500">JPG, GIF o PNG. Máx 2MB.</p>
                            </div>
                        </div>

                        <!-- Inputs -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Nombre Completo</label>
                                <input type="text" value="Iván López" class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-primary outline-none dark:text-white transition-all">
                            </div>
                            <div class="space-y-2">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Correo Electrónico</label>
                                <input type="email" value="ivan@ejemplo.com" class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-primary outline-none dark:text-white transition-all">
                            </div>
                            <div class="space-y-2 md:col-span-2">
                                <label class="text-sm font-bold text-gray-700 dark:text-gray-300">Biografía (Opcional)</label>
                                <textarea rows="3" class="w-full px-4 py-3 rounded-2xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 focus:ring-2 focus:ring-primary outline-none dark:text-white transition-all">Desarrollador enfocado en Laravel y Tailwind CSS.</textarea>
                            </div>
                        </div>
                    </section>

                    <!-- Botones de Acción -->
                    <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-100 dark:border-gray-700">
                        <button type="button" class="px-6 py-3 text-sm font-bold text-gray-500 hover:text-gray-700 dark:text-gray-400 transition-all">
                            Descartar
                        </button>
                        <button type="submit" class="px-8 py-3 bg-primary text-white font-bold rounded-2xl shadow-lg shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 transition-all">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection