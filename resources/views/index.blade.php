<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AppIsoCalidad - Sistema de Gestión de Calidad Inteligente</title>
    <!-- Tailwind CSS desde CDN para desarrollo rápido -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Iconos Lucide/FontAwesome para los detalles visuales -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-slate-50 text-slate-800 font-sans antialiased">

    <!-- 1. NAVBAR DE NAVEGACIÓN -->
    <header class="sticky top-0 z-50 backdrop-blur-md bg-white/80 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-blue-600 text-white p-2.5 rounded-xl shadow-md shadow-blue-200">
                    <i class="fa-solid fa-layer-group text-xl"></i>
                </div>
                <span class="text-2xl font-black tracking-tight text-slate-900">AppIso<span class="text-blue-600">Calidad</span></span>
            </div>

            <nav class="hidden md:flex items-center gap-8 font-medium text-slate-600">
                <a href="#caracteristicas" class="hover:text-blue-600 transition-colors">Características</a>
                <a href="#beneficios" class="hover:text-blue-600 transition-colors">Beneficios</a>
                <a href="#modulos" class="hover:text-blue-600 transition-colors">Módulos</a>
                <a href="#precios" class="hover:text-blue-600 transition-colors">Precios</a>
            </nav>

            <div class="flex items-center gap-4">
                <a href="#" class="text-sm font-semibold text-slate-700 hover:text-blue-600 transition-colors hidden sm:block">Iniciar Sesión</a>
                <a href="#contacto" class="bg-slate-900 hover:bg-blue-600 text-white px-5 py-2.5 rounded-xl font-medium transition-all shadow-sm">
                    Agendar Demo
                </a>
            </div>
        </div>
    </header>

    <main>
        <!-- 2. HERO SECTION (Sección Principal) -->
        <section class="relative overflow-hidden py-20 lg:py-32 bg-linear-to-b from-blue-50/50 via-white to-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid lg:grid-cols-12 gap-12 items-center">

                <!-- Texto Principal -->
                <div class="lg:col-span-6 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 bg-blue-50 border border-blue-200 text-blue-700 px-3 py-1.5 rounded-full text-sm font-semibold">
                        <span class="flex h-2 w-2 rounded-full bg-blue-500 animate-pulse"></span>
                        Listo para Auditorías ISO 9001:2015
                    </div>
                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight text-slate-900 leading-tight">
                        Digitaliza tu gestión de calidad <br>
                        <span class="text-transparent bg-clip-text bg-linear-to-r from-blue-600 to-indigo-600">sin papeleo ni caos.</span>
                    </h1>
                    <p class="text-lg text-slate-600 max-w-xl mx-auto lg:mx-0">
                        La plataforma todo en uno para centralizar tus auditorías, controlar documentos, gestionar hallazgos y automatizar el cumplimiento normativo de tu empresa de forma ágil.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-4">
                        <a href="#contacto" class="w-full sm:w-auto text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-4 rounded-xl shadow-lg shadow-blue-500/20 transition-all transform hover:-translate-y-0.5">
                            Prueba Gratis 14 Días
                        </a>
                        <a href="#modulos" class="w-full sm:w-auto text-center bg-white hover:bg-slate-100 border border-slate-300 text-slate-700 font-semibold px-8 py-4 rounded-xl transition-all">
                            Ver Módulos <i class="fa-solid fa-arrow-right ml-2 text-sm"></i>
                        </a>
                    </div>
                </div>

                <!-- Mockup Visual / Previsualización -->
                <div class="lg:col-span-6 relative">
                    <div class="absolute inset-0 bg-blue-400 rounded-3xl filter blur-3xl opacity-10 transform -rotate-6"></div>
                    <div class="relative bg-white border border-slate-200 rounded-2xl shadow-2xl p-4 transform lg:rotate-2 hover:rotate-0 transition-transform duration-500">
                        <!-- Barra superior simulando navegador -->
                        <div class="flex items-center gap-2 mb-4 border-b border-slate-100 pb-3">
                            <span class="w-3 h-3 rounded-full bg-red-400"></span>
                            <span class="w-3 h-3 rounded-full bg-yellow-400"></span>
                            <span class="w-3 h-3 rounded-full bg-green-400"></span>
                            <span class="text-xs text-slate-400 ml-4 bg-slate-100 px-4 py-1 rounded-md w-full max-w-xs truncate">appisocalidad.com/dashboard</span>
                        </div>
                        <!-- Mini maqueta del Dashboard -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="col-span-3 h-32 bg-gradient-to-r from-blue-600 to-indigo-600 rounded-xl p-4 text-white flex flex-col justify-between">
                                <span class="text-xs uppercase font-bold tracking-wider opacity-80">Cumplimiento General</span>
                                <span class="text-3xl font-black">94.8%</span>
                            </div>
                            <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-3 text-center">
                                <i class="fa-solid fa-circle-check text-emerald-600 text-xl mb-1"></i>
                                <div class="text-xs text-slate-500">Auditorías OK</div>
                                <div class="font-bold text-slate-800">12</div>
                            </div>
                            <div class="bg-amber-50 border border-amber-200 rounded-xl p-3 text-center">
                                <i class="fa-solid fa-triangle-exclamation text-amber-600 text-xl mb-1"></i>
                                <div class="text-xs text-slate-500">No Conformidades</div>
                                <div class="font-bold text-slate-800">2</div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-3 text-center">
                                <i class="fa-solid fa-file-lines text-blue-600 text-xl mb-1"></i>
                                <div class="text-xs text-slate-500">Docs. Vigentes</div>
                                <div class="font-bold text-slate-800">148</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- 3. CARACTERÍSTICAS DESTACADAS -->
        <section id="caracteristicas" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-3xl mx-auto mb-16 space-y-4">
                    <h2 class="text-xs uppercase font-extrabold tracking-widest text-blue-600">¿Por qué elegirnos?</h2>
                    <p class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight">Todo lo que necesitas para aprobar tus auditorías con éxito</p>
                    <p class="text-slate-600 text-lg">Diseñado específicamente para Directores de Calidad que buscan eliminar las hojas de cálculo infinitas y el desorden.</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Tarjeta 1 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition-all hover:shadow-xl hover:shadow-blue-500/5 group">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-shield-halved text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Centralización Segura</h3>
                        <p class="text-slate-600">Toda la documentación de tu SGC guardada en un solo lugar protegido, accesible en la nube 24/7 de forma jerárquica.</p>
                    </div>

                    <!-- Tarjeta 2 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition-all hover:shadow-xl hover:shadow-blue-500/5 group">
                        <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Control de Versiones</h3>
                        <p class="text-slate-600">Olvídate de usar archivos duplicados como "procedimiento_v2_final_FINAL.pdf". Gestiona revisiones y aprobaciones con un clic.</p>
                    </div>

                    <!-- Tarjeta 3 -->
                    <div class="p-8 rounded-2xl bg-slate-50 border border-slate-100 hover:border-blue-200 transition-all hover:shadow-xl hover:shadow-blue-500/5 group">
                        <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-amber-600 group-hover:text-white transition-all">
                            <i class="fa-solid fa-bell text-xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Alertas Automáticas</h3>
                        <p class="text-slate-600">El sistema te avisa por correo electrónico automáticamente cuando un documento expira o cuando una tarea de mejora está vencida.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. SECCIÓN DE MÓDULOS DEL SOFTWARE -->
        <section id="modules" class="py-24 bg-slate-50 border-t border-slate-100">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-slate-900">Estructura modular adaptada a tu organización</h2>
                    <p class="text-slate-600 mt-2">Activa los módulos que requieras según la madurez de tu sistema de gestión.</p>
                </div>

                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="flex gap-4 p-4 bg-white border border-slate-200 rounded-xl shadow-sm">
                            <div class="text-blue-600 mt-1"><i class="fa-solid fa-folder-tree text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-slate-900">Módulo de Estructura Documental</h4>
                                <p class="text-sm text-slate-600">Controla manuales, procedimientos, instrucciones de trabajo y formatos de manera automatizada.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 p-4 bg-white border border-slate-200 rounded-xl shadow-sm">
                            <div class="text-indigo-600 mt-1"><i class="fa-solid fa-clipboard-check text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-slate-900">Auditorías e Inspecciones</h4>
                                <p class="text-sm text-slate-600">Planifica el calendario anual de auditorías internas, genera listas de verificación y reporta hallazgos directo en campo.</p>
                            </div>
                        </div>
                        <div class="flex gap-4 p-4 bg-white border border-slate-200 rounded-xl shadow-sm">
                            <div class="text-amber-600 mt-1"><i class="fa-solid fa-chart-line text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-slate-900">Acciones Correctivas (CAPA) y No Conformidades</h4>
                                <p class="text-sm text-slate-600">Análisis de causa raíz mediante metodologías integradas (5 Porqués, Diagrama de Ishikawa) y seguimiento de planes de acción.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Lado Derecho: Indicadores de beneficio rápido -->
                    <div class="bg-slate-900 text-white rounded-3xl p-8 lg:p-12 space-y-8 relative overflow-hidden">
                        <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-blue-600 rounded-full filter blur-3xl opacity-20"></div>
                        <h3 class="text-2xl font-bold">Impacto medible desde el primer mes</h3>
                        <div class="space-y-6">
                            <div class="border-l-4 border-blue-500 pl-4">
                                <div class="text-3xl font-black text-blue-400">-75%</div>
                                <p class="text-sm text-slate-300">Tiempo invertido en buscar y archivar registros físicos.</p>
                            </div>
                            <div class="border-l-4 border-emerald-500 pl-4">
                                <div class="text-3xl font-black text-emerald-400">100%</div>
                                <p class="text-sm text-slate-300">Garantía de control y orden frente a auditores externos.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 5. SECCIÓN DE PRECIOS (PRICING) -->
        <section id="precios" class="py-24 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl font-bold text-slate-900">Planes simples y transparentes</h2>
                    <p class="text-slate-600 mt-2">Escala tu plan a medida que tu organización crezca.</p>
                </div>

                <div class="grid md:grid-cols-2 max-w-4xl mx-auto gap-8">
                    <!-- Plan Básico -->
                    <div class="border border-slate-200 rounded-2xl p-8 bg-white flex flex-col justify-between hover:shadow-lg transition-all">
                        <div>
                            <span class="text-sm uppercase font-bold text-slate-400 tracking-wider">Crecimiento</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">Plan Profesional</h3>
                            <p class="text-slate-500 text-sm mt-2">Perfecto para PyMEs que inician su camino a la certificación.</p>
                            <div class="mt-6 flex items-baseline text-slate-900">
                                <span class="text-5xl font-black tracking-tight">$149</span>
                                <span class="ml-1 text-xl font-semibold text-slate-500">/mes</span>
                            </div>
                            <ul class="mt-6 space-y-4 text-slate-600 text-sm">
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Hasta 20 usuarios activos</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Control de Documentos (10 GB)</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Módulo de No Conformidades</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Soporte por correo electrónico</li>
                            </ul>
                        </div>
                        <a href="#contacto" class="mt-8 block text-center bg-slate-900 hover:bg-slate-800 text-white font-medium py-3 rounded-xl transition-colors">Empezar Ahora</a>
                    </div>

                    <!-- Plan Corporativo (Destacado) -->
                    <div class="border-2 border-blue-600 rounded-2xl p-8 bg-white relative flex flex-col justify-between shadow-xl shadow-blue-500/5">
                        <span class="absolute -top-3.5 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-xs uppercase font-extrabold px-3 py-1 rounded-full tracking-wider">Más Popular</span>
                        <div>
                            <span class="text-sm uppercase font-bold text-blue-600 tracking-wider">Multi-planta</span>
                            <h3 class="text-2xl font-bold text-slate-900 mt-1">Plan Enterprise</h3>
                            <p class="text-slate-500 text-sm mt-2">Para organizaciones maduras con necesidades avanzadas.</p>
                            <div class="mt-6 flex items-baseline text-slate-900">
                                <span class="text-5xl font-black tracking-tight">$299</span>
                                <span class="ml-1 text-xl font-semibold text-slate-500">/mes</span>
                            </div>
                            <ul class="mt-6 space-y-4 text-slate-600 text-sm">
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> <strong>Usuarios Ilimitados</strong></li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Almacenamiento Ilimitado</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Todos los módulos incluidos</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> APIs e Integraciones personalizadas</li>
                                <li class="flex items-center gap-3"><i class="fa-solid fa-check text-emerald-500"></i> Soporte Prioritario 24/7</li>
                            </ul>
                        </div>
                        <a href="#contacto" class="mt-8 block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition-all shadow-md shadow-blue-500/10">Solicitar Demo</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- 6. FORMULARIO DE CONTACTO / CAPTACIÓN DE LEADS -->
        <section id="contacto" class="py-24 bg-slate-900 text-white relative overflow-hidden">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <h2 class="text-3xl sm:text-4xl font-bold mb-4 tracking-tight">¿Listo para transformar la gestión de calidad en tu empresa?</h2>
                <p class="text-slate-400 mb-8 max-w-xl mx-auto">Déjanos tus datos y un especialista te guiará en una demostración personalizada adaptada a tu industria.</p>

                <!-- Formulario -->
                <form class="grid sm:grid-cols-3 gap-4 text-left max-w-2xl mx-auto bg-slate-800 p-6 rounded-2xl border border-slate-700 shadow-xl">
                    <div class="sm:col-span-3">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Nombre Completo</label>
                        <input type="text" placeholder="Ej. Juan Pérez" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Correo Corporativo</label>
                        <input type="email" placeholder="juan@empresa.com" class="w-full bg-slate-900 border border-slate-700 rounded-xl px-4 py-3 text-white placeholder-slate-500 focus:outline-none focus:border-blue-500 transition-colors">
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-xl transition-colors shadow-lg shadow-blue-500/20">
                            Enviar Info
                        </button>
                    </div>
                </form>
            </div>
        </section>
    </main>

    <!-- 7. FOOTER -->
    <footer class="bg-slate-950 text-slate-500 text-sm py-12 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center gap-2">
                <span class="text-lg font-bold text-white tracking-tight">AppIso<span class="text-blue-500">Calidad</span></span>
                <span class="text-xs">&copy; 2026 Todos los derechos reservados.</span>
            </div>
            <div class="flex gap-6">
                <a href="#" class="hover:text-white transition-colors">Aviso de Privacidad</a>
                <a href="#" class="hover:text-white transition-colors">Términos del Servicio</a>
            </div>
        </div>
    </footer>

</body>

</html>