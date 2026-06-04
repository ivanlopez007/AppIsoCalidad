<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBg: '#111827',
                        darkCard: '#1f2937',
                    }
                }
            }
        }
    </script>

    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="h-full bg-gray-100 dark:bg-gray-900 transition-colors duration-500 flex items-center justify-center p-4">

    <!-- Tarjeta Principal Centrada -->
    <div class="w-full max-w-md bg-white dark:bg-gray-800 shadow-2xl border border-gray-100 dark:border-gray-700 rounded-3xl overflow-hidden">
        
        <div class="p-8 sm:p-10">
            <!-- Header dentro del cuadro -->
            <div class="text-center mb-8">
                <img class="mx-auto h-16 w-auto mb-4 rounded-full" src="https://static.vecteezy.com/system/resources/thumbnails/047/656/219/small_2x/abstract-logo-design-for-any-corporate-brand-business-company-vector.jpg" alt="Logo">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white tracking-tight">
                    Iniciar sesión
                </h2>
                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    ¿No tienes cuenta? 
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 font-semibold hover:underline">
                        Regístrate
                    </a>
                </p>
            </div>

            <!-- Formulario de Laravel -->
            <form action="{{ route('admin.login.post') }}" method="POST" class="space-y-5">
                @csrf

                <!-- Campo Correo -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        Correo electrónico
                    </label>
                    <input placeholder="Ejemplo: usuario@tuempresa.com" id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('email') border-red-500 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white dark:focus:bg-gray-600 transition-all outline-none">
                    @error('email')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Campo Contraseña -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1">
                        Contraseña
                    </label>
                    <input placeholder="********" id="password" name="password" type="password" required
                        class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-700 border @error('password') border-red-500 @else border-gray-200 dark:border-gray-600 @enderror rounded-xl text-gray-900 dark:text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-500 focus:bg-white dark:focus:bg-gray-600 transition-all outline-none">
                    @error('password')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Opciones -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center cursor-pointer group">
                        <input name="remember" type="checkbox" class="w-4 h-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 dark:bg-gray-700 dark:border-gray-600">
                        <span class="ml-2 text-gray-600 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white transition-colors">Recordarme</span>
                    </label>
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">
                        ¿Olvidaste tu contraseña?
                    </a>
                </div>

                <!-- Botón -->
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg shadow-indigo-200 dark:shadow-none transition-all transform active:scale-[0.98]">
                    Iniciar sesión
                </button>
            </form>
        </div>

        <!-- Footer del cuadro (Opcional, para un toque extra) -->
        <div class="bg-gray-50 dark:bg-gray-700/50 px-8 py-4 border-t border-gray-100 dark:border-gray-700 text-center">
            <button onclick="document.documentElement.classList.toggle('dark')" class="text-xs font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-white uppercase tracking-widest">
                🌓 Cambiar Tema
            </button>
        </div>
    </div>

</body>
</html>