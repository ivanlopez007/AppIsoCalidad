@extends('layout.layout')

@section('title', 'Gestión de Usuarios')

@section('content')

<div class="w-full max-w-7xl mx-auto p-4 md:p-6 transition-colors duration-300">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-200 dark:border-gray-700">

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

        <form action="{{ route('admin.crear_usuario.post') }}" method="POST" class="p-8 md:p-10 space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Nombre(s)</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}"
                        class="border @error('nombre') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Juan">
                    @error('nombre')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Paterno</label>
                    <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno') }}"
                        class="border @error('apellido_paterno') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Pérez">
                    @error('apellido_paterno')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Apellido Materno</label>
                    <input type="text" name="apellido_materno" value="{{ old('apellido_materno') }}"
                        class="border @error('apellido_materno') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. García">
                    @error('apellido_materno')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Rol</label>
                    <select name="rol_id" class="border @error('rol_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled selected class="dark:bg-gray-800">Seleccione rol</option>
                        @foreach($roles as $rol)
                        <option value="{{ $rol->id }}" {{ old('rol_id') == $rol->id ? 'selected' : '' }} class="dark:bg-gray-800">{{ $rol->nombre }}</option>
                        @endforeach
                    </select>
                    @error('rol_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Área</label>
                    <select name="area_id" class="border @error('area_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled selected class="dark:bg-gray-800">Seleccione área</option>
                        @foreach($areas as $area)
                        <option value="{{ $area->id }}" {{ old('area_id') == $area->id ? 'selected' : '' }} class="dark:bg-gray-800">{{ $area->area }}</option>
                        @endforeach
                    </select>
                    @error('area_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Posición</label>
                    <input type="text" name="posicion" value="{{ old('posicion') }}"
                        class="border @error('posicion') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="Ej. Analista Jr">
                    @error('posicion')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Correo Electrónico</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="border @error('email') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="usuario@empresa.com">
                    @error('email')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Localidad</label>
                    <select name="localidad_id" class="border @error('localidad_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled selected class="dark:bg-gray-800">Seleccione localidad</option>
                        @foreach($localidades as $localidad)
                        <option value="{{ $localidad->id }}" {{ old('localidad_id') == $localidad->id ? 'selected' : '' }} class="dark:bg-gray-800">{{ $localidad->localidad }}</option>
                        @endforeach
                    </select>
                    @error('localidad_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Supervisor Directo</label>
                    <select name="jefe_inmediato_id" class="border @error('jefe_inmediato_id') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition cursor-pointer dark:bg-gray-800 shadow-sm">
                        <option value="" disabled selected class="dark:bg-gray-800">Seleccione supervisor</option>
                        @if(isset($usuarios))
                        @foreach($usuarios as $usr)
                        <option value="{{ $usr->id }}" {{ old('jefe_inmediato_id') == $usr->id ? 'selected' : '' }} class="dark:bg-gray-800">
                            {{ $usr->infoUsuario->nombre ?? 'Usuario' }} {{ $usr->infoUsuario->apellido_paterno ?? '' }}
                        </option>
                        @endforeach
                        @else
                        <option value="" disabled class="dark:bg-gray-800">Carga los supervisores en el controlador</option>
                        @endif
                    </select>
                    @error('jefe_inmediato_id')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Contraseña</label>
                    <input type="password" name="password"
                        class="border @error('password') border-red-500 dark:border-red-500 @else border-gray-200 dark:border-gray-700 @enderror bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="******">
                    @error('password')
                    <span class="text-red-500 text-xs mt-1 font-semibold">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex flex-col">
                    <label class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase mb-2 tracking-wide">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation"
                        class="border border-gray-200 dark:border-gray-700 bg-transparent p-3.5 rounded-xl text-gray-800 dark:text-white text-base focus:ring-2 focus:ring-primary focus:border-primary outline-none transition placeholder-gray-400 dark:placeholder-gray-500 shadow-sm" placeholder="******">
                </div>

            </div>

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