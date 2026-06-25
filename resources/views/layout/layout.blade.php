<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full {{ Auth::user()->preferencias?->tema === 'dark' ? 'dark' : '' }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quasys - Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: '#6366f1'
                    },
                    borderRadius: {
                        '4xl': '2rem'
                    }
                }
            }
        }
    </script>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="h-full bg-gray-50 dark:bg-gray-900 transition-colors duration-300 overflow-hidden">

    @php
    $rol = Auth::user()->rol->nombre ?? null;

    $seccionNombre = '';
    $menuConfig = [];

    // Nota: Las rutas temporales se establecen en '#' para evitar errores de compilación de rutas.
    if ($rol == 'admin') {
    $seccionNombre = 'Gerencia';
    $menuConfig = [
    [
    'nombre' => 'Control de Documentos',
    'icono' => 'fas fa-chart-pie',
    'hijos' => [
    ['nombre' => 'Solicitud de cambios', 'ruta' => 'admin.solicitar_cambio'],
    ['nombre' => 'Aprobación de Solicitud', 'ruta' => 'admin.aprobacion'],
    ['nombre' => 'Revision de Solicitudes', 'ruta' => 'admin.revision'],
    ['nombre' => 'Consulta de documentos', 'ruta' => '#'],
    ['nombre' => 'Historial de documentos', 'ruta' => 'admin.historial'],
    ['nombre' => 'Matriz de documentos', 'ruta' => 'admin.formato'],
    ['nombre' => 'Revisión de documentos', 'ruta' => '#'],
    ['nombre' => 'Hoja de Tarea Estándar', 'ruta' => '#']
    ]
    ],
    [
    'nombre' => 'Training Tracker',
    'icono' => 'fas fa-graduation-cap',
    'ruta' => '#',
    'hijos' => []
    ]
    ];
    } elseif ($rol == 'calidad') {
    $seccionNombre = 'Calidad';
    $menuConfig = [
    [
    'nombre' => 'Control de Documentos',
    'icono' => 'fas fa-shield-halved',
    'hijos' => [
    ['nombre' => 'Solicitud de cambios', 'ruta' => '#'],
    ['nombre' => 'Aprobación de Solicitud', 'ruta' => '#'],
    ['nombre' => 'Revision de Solicitudes', 'ruta' => '#'],
    ['nombre' => 'Consulta de documentos', 'ruta' => '#'],
    ['nombre' => 'Historial de documentos', 'ruta' => '#'],
    ['nombre' => 'Matriz de documentos', 'ruta' => '#'],
    ['nombre' => 'Revisión de documentos', 'ruta' => '#'],
    ['nombre' => 'Hoja de Tarea Estándar', 'ruta' => '#']
    ]
    ],
    [
    'nombre' => 'Training Tracker',
    'icono' => 'fas fa-graduation-cap',
    'ruta' => '#',
    'hijos' => []
    ]
    ];
    } elseif ($rol == 'colaborador') {
    $seccionNombre = 'Colaborador';
    $menuConfig = [
    [
    'nombre' => 'Control de Documentos',
    'icono' => 'fas fa-user-tie',
    'hijos' => [
    ['nombre' => 'Solicitud de cambios', 'ruta' => '#'],
    ['nombre' => 'Aprobación de solicitudes de nivel superior', 'ruta' => '#'],
    ['nombre' => 'Aprobación de solicitudes THE', 'ruta' => '#'],
    ['nombre' => 'Estatus de Solicitudes', 'ruta' => '#'],
    ['nombre' => 'Consulta de documentos', 'ruta' => '#'],
    ['nombre' => 'Historial de documentos', 'ruta' => '#'],
    ['nombre' => 'Matriz de documentos', 'ruta' => '#'],
    ['nombre' => 'Revisión de documentos', 'ruta' => '#']
    ]
    ],
    [
    'nombre' => 'Training Tracker',
    'icono' => 'fas fa-graduation-cap',
    'ruta' => '#',
    'hijos' => []
    ]
    ];
    }

    @endphp

    <div class="flex h-screen overflow-hidden relative">

        <div id="sidebarOverlay" onclick="toggleSidebar()" class="fixed inset-0 bg-gray-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity duration-300 opacity-0"></div>

        <aside id="sidebar" class="fixed inset-y-0 left-0 w-72 bg-white dark:bg-gray-800 border-r border-gray-200 dark:border-gray-700 flex flex-col z-50 transform -translate-x-full lg:translate-x-0 lg:static lg:h-screen transition-transform duration-300 ease-in-out">

            <div class="h-20 flex items-center justify-between px-6 flex-shrink-0">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-primary rounded-xl flex items-center justify-center shadow-lg shadow-indigo-200 dark:shadow-none">
                        <i class="fas fa-layer-group text-white text-lg"></i>
                    </div>
                    <span class="text-xl font-black text-gray-800 dark:text-white tracking-tight">QUASYS</span>
                </div>
                <button onclick="toggleSidebar()" class="lg:hidden p-2 rounded-xl text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-2 space-y-4 overflow-y-auto no-scrollbar">
                @if(!empty($menuConfig))
                <div class="space-y-1">
                    <p class="text-[10px] font-bold text-gray-400 dark:text-slate-500 uppercase tracking-widest ml-4 mb-2">
                        *{{ $seccionNombre }}
                    </p>

                    @foreach ($menuConfig as $item)
                    @php
                    $tieneHijos = !empty($item['hijos']);

                    $menuAbierto = false;
                    if ($tieneHijos) {
                    foreach ($item['hijos'] as $hijo) {
                    if ($hijo['ruta'] !== '#' && Route::has($hijo['ruta']) && request()->routeIs($hijo['ruta'])) {
                    $menuAbierto = true;
                    break;
                    }
                    }
                    } else {
                    $menuAbierto = isset($item['ruta']) && $item['ruta'] !== '#' && Route::has($item['ruta']) && request()->routeIs($item['ruta']);
                    }
                    @endphp

                    <div x-data="{ open: {{ $menuAbierto ? 'true' : 'false' }} }" class="w-full">
                        @if($tieneHijos)
                        <button @click="open = !open" class="w-full flex items-center px-4 py-3 rounded-2xl transition-all duration-200 group text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50">
                            <i class="{{ $item['icono'] }} w-5 text-gray-400 group-hover:text-primary transition-transform group-hover:scale-110"></i>
                            <span class="ml-3 flex-1 text-left text-sm font-medium">{{ $item['nombre'] }}</span>
                            <i class="fas fa-chevron-down text-[10px] text-gray-400 transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" x-collapse class="flex flex-col pl-4 mt-1 space-y-1 border-l border-gray-200 dark:border-gray-700 ml-6">
                            @foreach ($item['hijos'] as $hijo)
                            @php
                            $hijoActivo = $hijo['ruta'] !== '#' && Route::has($hijo['ruta']) && request()->routeIs($hijo['ruta']);
                            @endphp
                            <a href="{{ ($hijo['ruta'] !== '#' && Route::has($hijo['ruta'])) ? route($hijo['ruta']) : '#' }}"
                                class="px-4 py-2 text-xs font-medium transition-all duration-200 rounded-xl {{ $hijoActivo ? 'text-primary dark:text-white font-bold bg-primary/10' : 'text-gray-500 dark:text-gray-400 hover:text-gray-800 dark:hover:text-white' }}">
                                — {{ $hijo['nombre'] }}
                            </a>
                            @endforeach
                        </div>
                        @else
                        <a href="{{ (isset($item['ruta']) && $item['ruta'] !== '#' && Route::has($item['ruta'])) ? route($item['ruta']) : '#' }}"
                            class="w-full flex items-center px-4 py-3 rounded-2xl transition-all duration-200 group {{ $menuAbierto ? 'bg-primary text-white font-bold shadow-lg shadow-primary/20' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700/50' }}">
                            <i class="{{ $item['icono'] }} w-5 {{ $menuAbierto ? 'text-white' : 'text-gray-400 group-hover:text-primary' }} transition-transform group-hover:scale-110"></i>
                            <span class="ml-3 text-sm font-medium">{{ $item['nombre'] }}</span>
                        </a>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </nav>

            <div class="p-4 border-t border-gray-100 dark:border-gray-700 relative group flex-shrink-0">
                <div class="absolute bottom-20 left-4 right-4 bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 rounded-2xl shadow-xl invisible opacity-0 scale-95 group-hover:visible group-hover:opacity-100 group-hover:scale-100 transition-all duration-200 z-50 p-2 space-y-1">

                    @if ( Auth::user()->rol->nombre === 'admin' || Auth::user()->rol->nombre === 'calidad' )

                    <a href="{{ Route::has('admin.usuarios') ? route('admin.usuarios') : '#' }}" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors font-medium">
                        <i class="fas fa-user-alt w-4"></i> <span>Usuarios</span>
                    </a>

                    @endif

                    <hr class="border-gray-100 dark:border-gray-700 my-1">

                    <button id="theme-toggle-desktop" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-gray-600 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-xl transition-colors font-medium">
                        <i class="fas fa-moon text-gray-400 w-4 dark:hidden"></i>
                        <i class="fas fa-sun text-gray-400 w-4 hidden dark:block"></i>
                        <span class="dark:hidden">Modo Oscuro</span>
                        <span class="hidden dark:block">Modo Claro</span>
                    </button>

                    <hr class="border-gray-100 dark:border-gray-700 my-1">

                    <form id="logout-form" action="{{ Route::has('auth.logout') ? route('auth.logout') : '#' }}" method="POST" style="display: none;">@csrf</form>
                    <a href="{{ Route::has('auth.logout') ? route('auth.logout') : '#' }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-xl transition-colors font-medium" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt w-4"></i> <span>Cerrar Sesión</span>
                    </a>

                </div>

                <div class="flex items-center gap-3 p-2 bg-gray-50 dark:bg-gray-700/50 rounded-2xl border border-gray-100 dark:border-gray-600 cursor-pointer group-hover:border-primary transition-all">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->nombre ?? Auth::user()->name ?? 'Usuario') }}&background=6366f1&color=fff" class="h-9 w-9 rounded-xl object-cover" alt="Avatar">
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-gray-800 dark:text-white truncate">{{ Auth::user()->email}}</p>
                        <p class="text-[10px] text-gray-500 uppercase tracking-wider font-semibold truncate">{{ Auth::user()->rol->nombre }}</p>
                    </div>
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-primary transition-transform group-hover:-translate-y-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </div>
        </aside>

        <main class="flex-1 flex flex-col min-w-0 overflow-hidden">
            <header class="h-16 bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between px-6 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button onclick="toggleSidebar()" class="p-2 -ml-2 rounded-xl text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none lg:hidden">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <a href="{{ url()->previous() === url()->current() ? '#' : url()->previous() }}"
                        onclick="if(this.getAttribute('href') === '#') { event.preventDefault(); window.history.back(); }"
                        class="flex items-center gap-2 px-3 py-1.5 text-xs font-semibold text-gray-600 dark:text-gray-300 bg-gray-100 dark:bg-gray-700/50 hover:bg-gray-200 dark:hover:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl transition-all shadow-sm group">
                        <i class="fas fa-arrow-left text-gray-500 dark:text-gray-400 group-hover:-translate-x-0.5 transition-transform"></i>
                        <span class="hidden sm:inline">Regresar</span>
                    </a>
                </div>

                <span class="text-md font-black text-gray-800 dark:text-white tracking-tight lg:hidden">QUASYS</span>

                <button id="theme-toggle-mobile" class="w-10 h-10 flex items-center justify-center rounded-xl bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-600 dark:text-gray-300 lg:hidden">
                    <i class="fas fa-moon text-md dark:hidden"></i>
                    <i class="fas fa-sun text-md hidden dark:block"></i>
                </button>
            </header>

            <div class="flex-1 overflow-y-auto p-6">
                @if(View::hasSection('content'))
                @yield('content')
                @else
                <div class="h-full bg-white dark:bg-gray-800 rounded-3xl border border-gray-200 dark:border-gray-700 border-dashed flex flex-col items-center justify-center text-gray-400 p-8">
                    <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-2xl mb-4">
                        <i class="fas fa-folder-open text-4xl text-primary"></i>
                    </div>
                    <p class="font-bold text-gray-700 dark:text-gray-200 tracking-tight text-lg mb-1">Bienvenido a Quasys</p>
                    <p class="text-sm text-gray-400 dark:text-gray-500 text-center max-w-xs">Selecciona una opción del panel izquierdo para cargar tus herramientas.</p>
                </div>
                @endif
            </div>
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');

            if (sidebar.classList.contains('-translate-x-full')) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
                overlay.classList.remove('hidden');
                setTimeout(() => {
                    overlay.classList.remove('opacity-0');
                    overlay.classList.add('opacity-100');
                }, 20);
            } else {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        function alternarModoOscuro() {
            const esModoOscuro = document.documentElement.classList.toggle('dark');
            const temaSeleccionado = esModoOscuro ? 'dark' : 'light';

            fetch('/preferencias/tema', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        tema: temaSeleccionado
                    })
                })
                .then(async response => {
                    const data = await response.json();
                    if (!response.ok) {
                        console.error('Error del servidor:', data);
                        throw new Error(data.message || 'Error desconocido');
                    }
                    console.log('Sincronizado con éxito:', data.message);
                })
                .catch(error => {
                    console.error('No se pudo guardar la preferencia:', error);
                });
        }

        const botonEscritorio = document.getElementById('theme-toggle-desktop');
        const botonMovil = document.getElementById('theme-toggle-mobile');

        if (botonEscritorio) botonEscritorio.addEventListener('click', alternarModoOscuro);
        if (botonMovil) botonMovil.addEventListener('click', alternarModoOscuro);
    </script>
</body>

</html>