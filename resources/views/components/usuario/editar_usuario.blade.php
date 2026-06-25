@extends('layout.layout')

@section('title', 'Gestión de Usuarios')

@section('content')

<div class="w-full max-w-7xl mx-auto p-4 md:p-6 transition-colors duration-300">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">

        {{-- Encabezado modificado para Edición --}}
        <div class="bg-gray-50 dark:bg-gray-700/40 border-b border-gray-200 dark:border-gray-700 px-8 py-6 flex items-center gap-4">
            <div class="h-12 w-12 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-indigo-100 dark:shadow-none">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </div>
            <div>
                <h2 class="text-2xl font-black text-gray-800 dark:text-white uppercase tracking-wider">Modificar Perfil de Usuario</h2>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Actualiza las credenciales, datos organizacionales y de perfil del colaborador en el sistema</p>
            </div>
        </div>

        {{-- Formulario de actualización --}}
        <form action="{{ Route::has('admin.editar_usuario.put') ? route('admin.editar_usuario.put', $usuario->id) : '#' }}" method="POST" class="p-8 md:p-10 space-y-8">
            @csrf
            @method('PUT') {{-- Directiva obligatoria en Laravel para procesar actualizaciones --}}

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                {{-- Nombre --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Nombre(s)</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $usuario->infoUsuario->nombre ?? '') }}"
                        class="border @error('nombre') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Juan">
                    @error('nombre')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Apellido Paterno --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $usuario->infoUsuario->apellido_paterno ?? '') }}"
                        class="border @error('apellido_paterno') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Pérez">
                    @error('apellido_paterno')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Apellido Materno --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Materno</label>
                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $usuario->infoUsuario->apellido_materno ?? '') }}"
                        class="border @error('apellido_materno') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. García">
                    @error('apellido_materno')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Rol con selección --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Rol</label>
                    <select name="rol_id" class="border @error('rol_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled class="dark:bg-gray-800">Seleccione rol</option>
                        @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id', $usuario->rol_id) == $rol->id ? 'selected' : '' }} class="dark:bg-gray-800">{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                    @error('rol_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Área Seleccionable (Dinámica) --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Área</label>
                    <select name="area_id" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('area_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors shadow-sm">
                        <option value="" disabled>Seleccione área</option>
                        @foreach($areas as $ar)
                        <option value="{{ $ar->id }}" {{ old('area_id', $usuario->area_id) == $ar->id ? 'selected' : '' }}>
                            {{ $ar->area ?? ($ar->nombre ?? '') }}
                        </option>
                        @endforeach
                    </select>
                    @error('area_id')
                    <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Posición --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Posición</label>
                    <input type="text" name="posicion" value="{{ old('posicion', $usuario->infoUsuario->posicion ?? '') }}"
                        class="border @error('posicion') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Analista Jr">
                    @error('posicion')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Correo Electrónico --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email', $usuario->email) }}"
                        class="border @error('email') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="usuario@empresa.com">
                    @error('email')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Localidad Seleccionable (Dinámica) --}}
                <div class="flex flex-col space-y-2">
                    <label class="text-xs font-bold text-gray-400 dark:text-gray-500 uppercase tracking-wider">Localidad</label>
                    <select name="localidad_id" class="w-full px-4 py-3 text-sm bg-white dark:bg-gray-900 border @error('localidad_id') border-red-500 @else border-gray-200 dark:border-gray-700 @enderror rounded-2xl focus:outline-none focus:border-primary dark:text-white transition-colors shadow-sm">
                        <option value="" disabled>Seleccione localidad</option>
                        @foreach($localidades as $loc)
                        <option value="{{ $loc->id }}" {{ old('localidad_id', $usuario->localidad_id) == $loc->id ? 'selected' : '' }}>
                            {{ $loc->localidad ?? ($loc->nombre ?? '') }}
                        </option>
                        @endforeach
                    </select>
                    @error('localidad_id')
                    <span class="text-red-500 text-xs font-semibold mt-1">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Supervisor Directo --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Supervisor Directo</label>
                    <select name="jefe_inmediato_id" class="border @error('jefe_inmediato_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" {{ old('jefe_inmediato_id', $usuario->jefe_inmediato_id) == null ? 'selected' : '' }} class="dark:bg-gray-800 font-semibold italic text-indigo-500">Ninguno (Alto Mando)</option>
                        @foreach($supervisores as $sup)
                        <option value="{{ $sup->id }}" {{ old('jefe_inmediato_id', $usuario->jefe_inmediato_id) == $sup->id ? 'selected' : '' }} class="dark:bg-gray-800">
                            {{ $sup->infoUsuario->nombre ?? 'Usuario' }} {{ $sup->infoUsuario->apellido_paterno ?? '' }} ({{ $sup->email }})
                        </option>
                        @endforeach
                    </select>
                    @error('jefe_inmediato_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Nueva Contraseña <span class="text-[10px] text-amber-500 font-normal lowercase">(Dejar en blanco para conservar actual)</span></label>
                    <input type="password" name="password"
                        class="border @error('password') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="******">
                    @error('password')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirmar Contraseña --}}
                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="******">
                </div>

            </div>

            {{-- Botonera con retorno a gestión --}}
            <div class="mt-12 flex justify-end space-x-4 border-t border-gray-200 dark:border-gray-700 pt-8">
                <a href="{{ Route::has('admin.usuarios') ? route('admin.usuarios') : '#' }}" class="px-8 py-3.5 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition font-medium text-base text-center">
                    Cancelar
                </a>
                <button type="submit" class="px-8 py-3.5 bg-primary text-white rounded-xl hover:bg-indigo-700 shadow-lg shadow-indigo-100 dark:shadow-none transition font-bold text-base tracking-wide uppercase">
                    Actualizar Cambios
                </button>
            </div>
        </form>

    </div>
</div>

@endsection