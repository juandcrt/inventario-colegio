<!DOCTYPE html>
<html lang="es" class="h-full {{ auth()->check() && auth()->user()->theme === 'dark' ? 'dark bg-slate-950' : 'bg-[#F3F6F9]' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Mobiliario - I.E. Tungasuca</title>
    
    <!-- Script optimizado para el tema multiusuario desde la BD -->
    <script>
        if ("{{ auth()->check() && auth()->user()->theme === 'dark' }}" === "1") {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#0756A3',
                            hover: '#064681',
                            secondary: '#1689D4',
                            sky: '#48B9E8',
                            yellow: '#F5C542',
                            dark: '#172B4D',
                            bg: '#F3F6F9',
                            success: '#22A06B',
                            warning: '#F5C542',
                            danger: '#D64545',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@700;800;900&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        
        .text-gradient-brand {
            background: linear-gradient(135deg, #0284c7 0%, #1d4ed8 50%, #1e1b4b 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dark .text-gradient-brand {
            background: linear-gradient(135deg, #38bdf8 0%, #60a5fa 50%, #a5b4fc 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* EFECTO HOVER SHINE (Líneas blancas deslizantes al pasar el cursor) */
        .hover-shine {
            position: relative;
            overflow: hidden;
        }
        .hover-shine::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -60%;
            width: 20%;
            height: 200%;
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(30deg);
            transition: none;
        }
        .hover-shine:hover::after {
            left: 120%;
            transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1);
        }
    </style>
</head>
<body class="bg-[#F3F6F9] dark:bg-slate-950 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col md:flex-row selection:bg-sky-500 selection:text-white transition-colors duration-300 overflow-x-hidden">

    <!-- PANTALLA DE CARGA CON ESCUDO TUNGASUCA -->
    <div id="preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white/95 dark:bg-slate-950/95 backdrop-blur-md transition-opacity duration-500">
        <div class="absolute w-96 h-96 bg-sky-200/50 dark:bg-sky-900/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute w-64 h-64 bg-blue-300/30 dark:bg-blue-800/20 rounded-full blur-2xl animate-pulse delay-300"></div>

        <div class="relative flex items-center justify-center mb-8">
            <div class="w-32 h-32 border-4 border-sky-200 dark:border-sky-800 border-t-sky-600 dark:border-t-sky-400 rounded-full animate-spin"></div>
            <div class="absolute w-24 h-24 border-4 border-blue-100 dark:border-blue-900 border-b-blue-600 dark:border-b-blue-400 rounded-full animate-spin [animation-duration:1.2s]"></div>
            
            <div class="absolute transform hover:scale-110 transition drop-shadow-md">
                <svg class="w-12 h-12" viewBox="0 0 100 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 5 L90 20 V55 C90 80 50 105 50 105 C50 105 10 80 10 55 V20 Z" fill="#0756A3" stroke="#F5C542" stroke-width="4"/>
                    <path d="M50 8 L86 22 V53 C86 76 50 99 50 99 C50 99 14 76 14 53 V22 Z" stroke="white" stroke-width="3"/>
                    <path d="M50 18 C53 25 57 28 50 36 C43 28 47 25 50 18 Z" fill="#F39C12"/>
                    <path d="M50 23 C51.5 27 54 29 50 34 C46 29 48.5 27 50 23 Z" fill="#F5C542"/>
                    <path d="M50 48 L28 42 V68 L50 74 Z" fill="white" stroke="#0756A3" stroke-width="1.5"/>
                    <path d="M50 48 L72 42 V68 L50 74 Z" fill="white" stroke="#0756A3" stroke-width="1.5"/>
                    <path d="M50 51 L32 46 V67 L50 72 Z" stroke="#0756A3" stroke-width="1"/>
                    <path d="M50 51 L68 46 V67 L50 72 Z" stroke="#0756A3" stroke-width="1"/>
                    <path d="M30 80 Q50 86 70 80" stroke="white" stroke-width="2" fill="none"/>
                    <path d="M35 85 Q50 90 65 85" stroke="white" stroke-width="2" fill="none"/>
                </svg>
            </div>
        </div>
        
        <div class="text-center space-y-2 z-10">
            <span class="px-3.5 py-1 rounded-full text-[11px] font-extrabold tracking-widest bg-sky-100 dark:bg-sky-950 text-sky-800 dark:text-sky-300 border border-sky-200 dark:border-sky-800 uppercase shadow-sm">
                Gestión Institucional
            </span>
            <h2 class="font-heading text-3xl font-black text-slate-900 dark:text-white tracking-wide uppercase mt-2">I.E. TUNGASUCA</h2>
            <p class="text-sky-700 dark:text-sky-400 text-xs font-semibold tracking-wide flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-sky-500 animate-ping"></span>
                Cargando módulos de inventario...
            </p>
        </div>
    </div>

    <!-- SIDEBAR / MENÚ LATERAL IZQUIERDO (FIJO Y ESTÁTICO) -->
    <aside class="w-full md:w-72 bg-brand-dark dark:bg-slate-900 text-white flex flex-col justify-between p-6 shrink-0 shadow-xl border-r border-slate-800 z-40 sticky top-0 h-screen overflow-y-auto">
        <div>
            <!-- LOGO / CABECERA SIDEBAR -->
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-800">
                <div class="w-12 h-12 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center p-2 shadow-md shrink-0 border border-slate-700">
                    <svg class="w-full h-full" viewBox="0 0 100 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 5 L90 20 V55 C90 80 50 105 50 105 C50 105 10 80 10 55 V20 Z" fill="#0756A3" stroke="#F5C542" stroke-width="4"/>
                        <path d="M50 8 L86 22 V53 C86 76 50 99 50 99 C50 99 14 76 14 53 V22 Z" stroke="white" stroke-width="3"/>
                        <path d="M50 18 C53 25 57 28 50 36 C43 28 47 25 50 18 Z" fill="#F39C12"/>
                        <path d="M50 23 C51.5 27 54 29 50 34 C46 29 48.5 27 50 23 Z" fill="#F5C542"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-xs tracking-wide">I.E. TUNGASUCA</h2>
                    <p class="text-[10px] text-brand-sky font-semibold tracking-wider uppercase">Gestión Institucional</p>
                </div>
            </div>

            <!-- PERFIL DE USUARIO LOGUEADO -->
            <div class="bg-slate-800/60 dark:bg-slate-800/40 p-4 rounded-2xl mb-8 border border-slate-700/50 flex items-center gap-3">
                <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center font-bold text-white shadow shrink-0">
                    {{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'U' }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-[10px] text-slate-400">Bienvenido,</p>
                    <p class="text-xs font-bold truncate text-white">{{ auth()->check() ? auth()->user()->name : 'Invitado' }}</p>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[10px] text-emerald-400 font-medium">En línea</span>
                    </div>
                </div>
            </div>

            <!-- MÓDULOS DEL SISTEMA (MENÚ LATERAL CON EFECTO SHINE) -->
            <div class="space-y-1.5">
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 mb-3 px-2">Módulos del Sistema</p>

                <a href="{{ route('inventory.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-brand-blue text-white shadow-md shadow-brand-blue/20 transition-all">
                    <span>🪑</span> Mobiliario (Aulas)
                </a>

                <a href="{{ route('library.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📚</span> Biblioteca Escolar
                </a>

                <a href="{{ route('tic.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>💻</span> Equipos TIC & AIP
                </a>

                <a href="{{ route('inventory.dashboard') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📊</span> Dashboard Estadísticas
                </a>
            </div>
        </div>

        <!-- ACCIONES INFERIORES (ESTÁTICAS ABAJO EN EL SIDEBAR) -->
        <div class="pt-6 border-t border-slate-800 space-y-3 mt-6">
            <!-- Botón Cambio de Tema -->
            <button type="button" onclick="toggleDarkMode()" class="hover-shine w-full bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2.5 rounded-xl font-bold flex items-center justify-between text-xs transition cursor-pointer border border-slate-700">
                <span class="flex items-center gap-2">☀️ Modo Visual</span>
                <span class="text-[10px] bg-slate-700 px-2.5 py-1 rounded text-brand-sky font-mono uppercase" id="themeTextLabel">{{ auth()->check() && auth()->user()->theme === 'dark' ? 'Oscuro' : 'Claro' }}</span>
            </button>

            <!-- Botón Cerrar Sesión -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover-shine w-full bg-rose-500/10 hover:bg-rose-600 text-rose-400 hover:text-white px-4 py-2.5 rounded-xl font-bold flex items-center justify-center gap-2 text-xs transition cursor-pointer border border-rose-500/20">
                    <span>🚪</span> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENEDOR PRINCIPAL A LA DERECHA -->
    <div class="flex-grow p-6 md:p-10 overflow-y-auto max-w-7xl mx-auto w-full flex flex-col justify-between">
        
        <div class="w-full">
            <!-- HEADER -->
            <header class="mb-8 p-6 md:p-8 rounded-3xl bg-white dark:bg-slate-900 border border-sky-100 dark:border-slate-800 shadow-xl shadow-sky-900/5 dark:shadow-black/20 flex flex-col md:flex-row justify-between items-center gap-6 relative z-30 transition-colors duration-300">
                <div class="absolute inset-0 rounded-3xl overflow-hidden pointer-events-none">
                    <div class="absolute -right-10 -bottom-10 w-60 h-60 bg-sky-100/60 dark:bg-sky-900/10 rounded-full blur-2xl"></div>
                    <div class="absolute right-1/3 -top-10 w-40 h-40 bg-blue-50/80 dark:bg-blue-900/10 rounded-full blur-xl"></div>
                </div>
                
                <div class="z-10 flex items-center gap-5">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold bg-sky-100 dark:bg-sky-950 text-sky-800 dark:text-sky-300 border border-sky-200 dark:border-sky-800 uppercase tracking-wider">Módulo Activo</span>
                            <span class="text-xs text-slate-500 dark:text-slate-400 font-semibold tracking-wide">Gestión de Aulas</span>
                        </div>
                        <h1 class="font-heading text-3xl md:text-4xl font-black tracking-tight text-gradient-brand drop-shadow-sm">
                            I.E. TUNGASUCA
                        </h1>
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400 tracking-wider uppercase mt-0.5">Control & Inventario de Mobiliario</p>
                    </div>
                </div>
            </header>

            <!-- NOTIFICACIONES -->
            @if(session('success'))
                <div class="bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center gap-3">
                    <span class="text-xl">✅</span>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="bg-rose-50 dark:bg-rose-950/50 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 px-5 py-4 rounded-2xl mb-6 shadow-sm">
                    <div class="flex items-center gap-2 font-bold mb-2">
                        <span class="text-xl">⚠️</span>
                        <span>¡Atención! Revisa los siguientes campos:</span>
                    </div>
                    <ul class="list-disc pl-8 text-sm space-y-1 text-rose-700 dark:text-rose-400">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- FORMULARIO DE REGISTRO -->
                <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-sky-100 dark:border-slate-800 shadow-xl shadow-sky-900/5 dark:shadow-black/20 lg:col-span-1 self-start transition-colors duration-300">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                        <span class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-950 border border-sky-200 dark:border-sky-800 flex items-center justify-center text-sky-700 dark:text-sky-300 font-bold text-lg">➕</span>
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-wide">Registrar Mobiliario</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Añadir nuevos ítems al sistema</p>
                        </div>
                    </div>

                    <form action="{{ route('inventory.store') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        <div>
                            <label class="block text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-2">Aula / Sección</label>
                            <div class="relative">
                                <select name="classroom_id" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 text-sm focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200 dark:focus:ring-sky-900 transition appearance-none cursor-pointer font-medium">
                                    <option value="" class="bg-white dark:bg-slate-800">-- Seleccionar Sección --</option>
                                    @foreach($grades as $grade)
                                        <optgroup label="{{ $grade->name }}" class="bg-white dark:bg-slate-800 text-sky-700 dark:text-sky-400 font-bold">
                                            @foreach($grade->classrooms as $classroom)
                                                <option value="{{ $classroom->id }}" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">{{ $classroom->name }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-2">Tipo de Objeto</label>
                            <div class="relative">
                                <select name="objeto" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 text-sm focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200 dark:focus:ring-sky-900 transition appearance-none cursor-pointer font-medium">
                                    <option value="" class="bg-white dark:bg-slate-800">-- Seleccionar Objeto --</option>
                                    <option value="Ventana" class="bg-white dark:bg-slate-800">🪟 Ventana</option>
                                    <option value="Proyector" class="bg-white dark:bg-slate-800">📹 Proyector</option>
                                    <option value="Puerta" class="bg-white dark:bg-slate-800">🚪 Puerta</option>
                                    <option value="Pizarra" class="bg-white dark:bg-slate-800">📋 Pizarra</option>
                                    <option value="Estante" class="bg-white dark:bg-slate-800">🗄️ Estante</option>
                                    <option value="Casillero (Locker)" class="bg-white dark:bg-slate-800">🔒 Casillero (Locker)</option>
                                    <option value="Pupitre" class="bg-white dark:bg-slate-800">🪑 Pupitre</option>
                                    <option value="Equipo Tecnológico" class="bg-white dark:bg-slate-800">💻 Equipo Tecnológico</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-2">Cantidad</label>
                            <input type="number" name="cantidad" min="1" placeholder="Ej: 35" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 text-sm focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200 dark:focus:ring-sky-900 transition placeholder-slate-400 font-medium">
                        </div>

                        <div>
                            <label class="block text-slate-600 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-2">Condición / Estado</label>
                            <div class="relative">
                                <select name="condicion" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-800 dark:text-slate-100 text-sm focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200 dark:focus:ring-sky-900 transition appearance-none cursor-pointer font-medium">
                                    <option value="Bueno" class="bg-white dark:bg-slate-800">🟢 Bueno</option>
                                    <option value="Regular" class="bg-white dark:bg-slate-800">🟡 Regular</option>
                                    <option value="Malo" class="bg-white dark:bg-slate-800">🔴 Malo</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-sky-600 to-blue-600 hover:from-sky-700 hover:to-blue-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-md shadow-sky-600/20 transition-all duration-200 text-sm transform active:scale-95 flex items-center justify-center gap-2 mt-2 cursor-pointer">
                            <span>💾</span> Guardar Registro
                        </button>
                    </form>
                </div>

                <!-- TABLA DE REGISTROS CON BÚSQUEDA -->
                <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-sky-100 dark:border-slate-800 shadow-xl shadow-sky-900/5 dark:shadow-black/20 lg:col-span-2 transition-colors duration-300">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-wide">Inventario Actual</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Organizado jerárquicamente por aulas y secciones</p>
                        </div>
                        
                        <div class="relative w-full sm:w-72">
                            <input type="text" id="buscador" onkeyup="filtrarInventario()" placeholder="Buscar por aula u objeto..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-slate-700 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-sky-500 focus:ring-2 focus:ring-sky-200 dark:focus:ring-sky-900 transition font-medium">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔍</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-200/80 dark:border-slate-800">
                        <table class="w-full text-left border-collapse" id="tablaInventario">
                            <thead>
                                <tr class="bg-slate-100/70 dark:bg-slate-800/60 text-slate-600 dark:text-slate-300 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
                                    <th class="py-4 px-5">Objeto / Mobiliario</th>
                                    <th class="py-4 px-5 text-center">Cantidad</th>
                                    <th class="py-4 px-5 text-center">Estado</th>
                                    <th class="py-4 px-5 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800/60 text-slate-700 dark:text-slate-300 text-sm">
                                @forelse($itemsPorAula as $aula => $items)
                                    @php $slugAula = Str::slug($aula); @endphp
                                    <!-- Cabecera del Aula -->
                                    <tr class="bg-sky-50/80 dark:bg-slate-800/90 border-b border-sky-100 dark:border-slate-800 cursor-pointer hover:bg-sky-100/70 dark:hover:bg-slate-800 transition grupo-aula" data-aula="{{ $slugAula }}" onclick="toggleAula('{{ $slugAula }}')" data-text="{{ strtolower($aula) }}">
                                        <td colspan="4" class="py-3.5 px-5 font-bold text-sky-800 dark:text-sky-300">
                                            <div class="flex justify-between items-center">
                                                <span class="flex items-center gap-2">
                                                    <span class="text-base">🏫</span>
                                                    <span class="uppercase tracking-wide text-xs md:text-sm font-extrabold">Aula: {{ $aula }}</span>
                                                </span>
                                                <span id="flecha-{{ $slugAula }}" class="text-xs bg-white dark:bg-slate-900 px-2.5 py-1 rounded-lg text-sky-700 dark:text-sky-400 border border-sky-200 dark:border-slate-700 transition-transform duration-300 shadow-sm">🔽</span>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                    <!-- Elementos del aula -->
                                    @foreach($items as $item)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition fila-aula-{{ $slugAula }} item-fila" data-aula-parent="{{ $slugAula }}" data-text="{{ strtolower($item->objeto . ' ' . $aula) }}">
                                        <td class="py-3.5 px-5 font-medium text-slate-800 dark:text-slate-200 pl-8 flex items-center gap-2">
                                            <span class="text-slate-400 dark:text-slate-600">└</span>
                                            <span>{{ $item->objeto }}</span>
                                        </td>
                                        <td class="py-3.5 px-5 text-center font-bold text-slate-900 dark:text-slate-100">
                                            <span class="bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300 px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700 font-mono">{{ $item->cantidad }}</span>
                                        </td>
                                        <td class="py-3.5 px-5 text-center">
                                            @if($item->condicion == 'Bueno')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950/80 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Bueno
                                                </span>
                                            @elseif($item->condicion == 'Regular')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950/80 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Regular
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 dark:bg-rose-950/80 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Malo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-5 text-center">
                                            <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-600 text-rose-600 dark:text-rose-400 hover:text-white px-3 py-1.5 rounded-xl border border-rose-200 dark:border-rose-900/50 text-xs font-bold transition-all duration-200 flex items-center gap-1 mx-auto shadow-sm cursor-pointer">
                                                    <span>🗑️</span> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-slate-400">
                                            <div class="text-4xl mb-2">📦</div>
                                            <p class="text-sm font-medium">No hay mobiliario registrado todavía. ¡Agrega el primero!</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-12 py-6 border-t border-slate-200/80 dark:border-slate-800 bg-white/50 dark:bg-slate-900/50 text-center text-slate-500 dark:text-slate-400 text-xs transition-colors duration-300 rounded-2xl shadow-sm">
            <p>© {{ date('Y') }} <strong class="text-slate-700 dark:text-slate-200">I.E. Tungasuca</strong> - Sistema de Gestión Escolar. Todos los derechos reservados.</p>
        </footer>

    </div>

    <!-- SCRIPTS OPTIMIZADOS -->
    <script>
        // 0. CAMBIO DE TEMA PERSISTENTE POR USUARIO (BASE DE DATOS)
        function toggleDarkMode() {
            const htmlElement = document.documentElement;
            const isDark = htmlElement.classList.contains('dark');
            const newTheme = isDark ? 'light' : 'dark';

            if (isDark) {
                htmlElement.classList.remove('dark');
                document.getElementById('themeTextLabel').innerText = 'Claro';
            } else {
                htmlElement.classList.add('dark');
                document.getElementById('themeTextLabel').innerText = 'Oscuro';
            }

            // Guardar preferencia en MySQL vía AJAX
            fetch("{{ route('user.update-theme') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: newTheme })
            }).catch(error => console.error('Error al guardar el tema:', error));
        }

        // 1. CARGA RÁPIDA DE LA PÁGINA
        window.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.classList.add('opacity-0');
                setTimeout(() => preloader.remove(), 500);
            }
        });

        // 2. ACORDEÓN PARA AULAS
        function toggleAula(aulaSlug) {
            const filas = document.querySelectorAll('.fila-aula-' + aulaSlug);
            const flecha = document.getElementById('flecha-' + aulaSlug);
            
            let ocultando = false;
            filas.forEach(fila => {
                ocultando = fila.classList.toggle('hidden');
            });

            if (flecha) {
                flecha.style.transform = ocultando ? 'rotate(180deg)' : 'rotate(0deg)';
            }
        }

        // 3. BÚSQUEDA INSTANTÁNEA COMPATIBLE CON EL ACORDEÓN
        function filtrarInventario() {
            const input = document.getElementById('buscador').value.toLowerCase().trim();
            const filasItems = document.querySelectorAll('.item-fila');
            const gruposAulas = document.querySelectorAll('.grupo-aula');

            if (input === '') {
                filasItems.forEach(f => f.classList.remove('hidden'));
                gruposAulas.forEach(g => {
                    g.classList.remove('hidden');
                    const slug = g.getAttribute('data-aula');
                    const flecha = document.getElementById('flecha-' + slug);
                    if (flecha) flecha.style.transform = 'rotate(0deg)';
                });
                return;
            }

            gruposAulas.forEach(g => g.classList.add('hidden'));

            filasItems.forEach(fila => {
                const texto = fila.getAttribute('data-text');
                const parentSlug = fila.getAttribute('data-aula-parent');
                const headerAula = document.querySelector(`.grupo-aula[data-aula="${parentSlug}"]`);

                if (texto.includes(input)) {
                    fila.classList.remove('hidden');
                    if (headerAula) headerAula.classList.remove('hidden');
                } else {
                    fila.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>