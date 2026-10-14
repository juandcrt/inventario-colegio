<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Módulo Equipos TIC - I.E. Tungasuca</title>
    
    <!-- SCRIPT ANTI-PARPADEO MEDIANTE LOCALSTORAGE -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
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
                        },
                        sky: {
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            950: '#082f49',
                        },
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

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

    <!-- PANTALLA DE CARGA INSTITUCIONAL -->
    <div id="preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-slate-100 dark:bg-slate-950 transition-opacity duration-500">
        <div class="absolute w-96 h-96 bg-sky-500/10 dark:bg-sky-600/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute w-64 h-64 bg-cyan-500/10 rounded-full blur-2xl animate-pulse delay-300"></div>

        <div class="relative flex items-center justify-center mb-8">
            <div class="w-28 h-28 border-4 border-sky-500/20 border-t-sky-600 dark:border-sky-400/20 dark:border-t-sky-400 rounded-full animate-spin"></div>
            <div class="absolute w-20 h-20 border-4 border-cyan-500/20 border-b-cyan-500 dark:border-cyan-400/20 dark:border-b-cyan-400 rounded-full animate-spin [animation-duration:1.5s]"></div>
            <div class="absolute text-4xl transform hover:scale-110 transition">💻</div>
        </div>
        
        <div class="text-center space-y-2 z-10">
            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold tracking-widest bg-sky-500/10 text-sky-600 dark:text-sky-400 border border-sky-500/30 uppercase">
                Tecnología & Aulas TIC
            </span>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-wider uppercase mt-2">I.E. TUNGASUCA</h2>
            <p class="text-sky-600 dark:text-sky-300 text-xs font-medium tracking-wide flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-sky-500 dark:bg-sky-400 animate-ping"></span>
                Cargando inventario tecnológico y AIP...
            </p>
        </div>
    </div>

    <!-- SIDEBAR / MENÚ LATERAL IZQUIERDO -->
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

            <!-- MÓDULOS DEL SISTEMA -->
            <div class="space-y-1.5">
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 mb-3 px-2">Módulos del Sistema</p>

                <a href="{{ route('inventory.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>🪑</span> Mobiliario (Aulas)
                </a>

                <a href="{{ route('library.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📚</span> Biblioteca Escolar
                </a>

                <a href="{{ route('tic.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-brand-blue text-white shadow-md shadow-brand-blue/20 transition-all">
                    <span>💻</span> Equipos TIC & AIP
                </a>

                <a href="{{ route('inventory.dashboard') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📊</span> Dashboard Estadísticas
                </a>
            </div>
        </div>

        <!-- ACCIONES INFERIORES -->
        <div class="pt-6 border-t border-slate-800 space-y-3 mt-6">
            <!-- Botón Cambio de Tema Local -->
            <button type="button" onclick="toggleDarkMode()" class="hover-shine w-full bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2.5 rounded-xl font-bold flex items-center justify-between text-xs transition cursor-pointer border border-slate-700">
                <span class="flex items-center gap-2">☀️ Modo Visual</span>
                <span class="text-[10px] bg-slate-700 px-2.5 py-1 rounded text-brand-sky font-mono uppercase" id="themeTextLabel">Claro</span>
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
            <!-- HEADER INSTITUCIONAL -->
            <header class="mb-8 p-6 md:p-8 rounded-3xl bg-gradient-to-r from-sky-900 via-sky-800 to-sky-950 dark:from-slate-900 dark:via-sky-950 dark:to-slate-900 border border-sky-800/30 dark:border-slate-800 shadow-2xl flex flex-col md:flex-row justify-between items-center gap-6 relative z-30 transition-colors duration-300">
                
                <div class="absolute inset-0 rounded-3xl overflow-hidden pointer-events-none">
                    <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-sky-400/10 dark:bg-sky-500/10 rounded-full blur-3xl"></div>
                    <div class="absolute right-1/3 -top-12 w-48 h-48 bg-cyan-400/10 dark:bg-cyan-500/10 rounded-full blur-2xl"></div>
                </div>
                
                <div class="z-10 flex items-center gap-5">
                    <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-500 dark:from-sky-400 dark:to-sky-600 rounded-2xl flex items-center justify-center text-3xl shadow-lg shadow-amber-500/20 dark:shadow-sky-500/20 text-slate-950 border border-amber-300/50 dark:border-sky-300/50">
                        💻
                    </div>
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-3 py-0.5 rounded-full text-[11px] font-black bg-amber-400 text-slate-950 uppercase tracking-widest shadow-sm">I.E. Tungasuca</span>
                            <span class="text-xs text-sky-200 dark:text-sky-300 font-semibold tracking-wide">Secundaria & AIP</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Aulas TIC y Tecnología EdTech</h1>
                    </div>
                </div>
            </header>

            <!-- NOTIFICACIÓN DE ÉXITO -->
            @if(session('success'))
                <div id="alertSuccess" class="bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-300 dark:border-emerald-500/50 text-emerald-800 dark:text-emerald-300 px-5 py-4 rounded-2xl mb-6 shadow-xl backdrop-blur-md flex items-center justify-between transition-opacity duration-300">
                    <div class="flex items-center gap-3">
                        <span class="text-xl">✅</span>
                        <span class="font-semibold text-sm">{{ session('success') }}</span>
                    </div>
                    <button onclick="cerrarAlerta()" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-900 dark:hover:text-white font-bold text-lg cursor-pointer">&times;</button>
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- FORMULARIO DE REGISTRO TIC -->
                <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-xl backdrop-blur-md lg:col-span-1 self-start transition-colors duration-300">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                        <span class="w-10 h-10 rounded-xl bg-sky-100 dark:bg-sky-400/10 border border-sky-200 dark:border-sky-400/30 flex items-center justify-center text-sky-600 dark:text-sky-400 font-bold text-lg">➕</span>
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-wide">Registrar Equipo TIC</h2>
                    </div>

                    <form action="{{ route('tic.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label for="location" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Aula TIC / Asignación</label>
                            <div class="relative">
                                <select id="location" name="location" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white text-sm focus:outline-none focus:border-sky-500 transition appearance-none cursor-pointer">
                                    <option value="Aula TIC - Inglés">🇬🇧 Aula TIC - Inglés</option>
                                    <option value="Aula TIC - Matemática">📐 Aula TIC - Matemática</option>
                                    <option value="Aula TIC - Comunicación">📖 Aula TIC - Comunicación</option>
                                    <option value="Aula TIC - EPT">💻 Aula TIC - EPT / Cómputo</option>
                                    <option value="Aula TIC - CCSS">🌍 Aula TIC - CCSS</option>
                                    <option value="Aula TIC - CTA">🔬 Aula TIC - C.T.A. / Ciencias</option>
                                    <option value="Aula TIC - DPCC">⚖️ Aula TIC - DPCC</option>
                                    <option value="Aula TIC - Arte y Cultura">🎨 Aula TIC - Arte y Cultura</option>
                                    <option value="AIP General / Carrito CRT">🖥️ AIP General / Carrito CRT</option>
                                    <option value="Dirección / Subdirección">🏢 Dirección / Servidor</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                            </div>
                        </div>

                        <div>
                            <label for="objeto" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Tipo de Dispositivo</label>
                            <div class="relative">
                                <select id="objeto" name="objeto" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white text-sm focus:outline-none focus:border-sky-500 transition appearance-none cursor-pointer">
                                    <option value="Laptop Docente / Estudiante">💻 Laptop Docente / Estudiante</option>
                                    <option value="PC de Escritorio / Monitor">🖥️ PC de Escritorio / Monitor</option>
                                    <option value="Proyector Multimedia">📹 Proyector Multimedia</option>
                                    <option value="Ecran / Pantalla Proyección">📺 Ecran / Pantalla Proyección</option>
                                    <option value="Audífonos / Headsets">🎧 Audífonos / Headsets</option>
                                    <option value="Kit Robótica / Pizarra Digital">🤖 Kit Robótica / Pizarra Digital</option>
                                    <option value="Sistema de Audio / Parlantes">🔊 Sistema de Audio / Parlantes</option>
                                    <option value="Impresora / Escáner">🖨️ Impresora / Escáner</option>
                                    <option value="Carrito Móvil de Carga">🛒 Carrito Móvil de Carga</option>
                                    <option value="Otro Equipo TIC">🔌 Otro Equipo TIC</option>
                                </select>
                                <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                            </div>
                        </div>

                        <div>
                            <label for="barcode_serial" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Código Patrimonial / Serie</label>
                            <input type="text" id="barcode_serial" name="barcode_serial" placeholder="Ej: MINEDU-2026-88" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-sky-600 dark:text-sky-400 font-mono text-sm focus:outline-none focus:border-sky-500 transition placeholder-slate-400">
                        </div>

                        <div>
                            <label for="brand_model" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Marca y Modelo</label>
                            <input type="text" id="brand_model" name="brand_model" placeholder="Ej: Lenovo ThinkPad E11" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white text-sm focus:outline-none focus:border-sky-500 transition placeholder-slate-400">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label for="cantidad" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Cantidad</label>
                                <input type="number" id="cantidad" name="cantidad" min="1" value="1" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white font-bold text-sm focus:outline-none focus:border-sky-500 transition">
                            </div>
                            <div>
                                <label for="condicion" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Estado</label>
                                <div class="relative">
                                    <select id="condicion" name="condicion" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white text-sm focus:outline-none focus:border-sky-500 transition appearance-none cursor-pointer">
                                        <option value="Bueno">🟢 Bueno</option>
                                        <option value="Regular">🟡 Regular</option>
                                        <option value="Malo">🔴 Malo</option>
                                    </select>
                                    <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400 text-xs">▼</div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label for="details" class="block text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-2">Especificaciones Técnicas</label>
                            <textarea id="details" name="details" rows="2" placeholder="Ej: Intel Core i5, 8GB RAM, SSD 256GB" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-slate-800 dark:text-white text-sm focus:outline-none focus:border-sky-500 transition placeholder-slate-400"></textarea>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-sky-500 to-sky-600 hover:from-sky-600 hover:to-sky-700 text-white font-extrabold py-3.5 px-4 rounded-xl shadow-lg shadow-sky-500/20 transition-all duration-200 text-sm transform active:scale-95 flex items-center justify-center gap-2 mt-2 cursor-pointer">
                            <span>💾</span> Guardar Dispositivo TIC
                        </button>
                    </form>
                </div>

                <!-- TABLA DE EQUIPOS TIC E INVENTARIO -->
                <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-xl backdrop-blur-md lg:col-span-2 transition-colors duration-300">
                    
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                        <div>
                            <h2 class="text-lg font-bold text-slate-900 dark:text-white tracking-wide">Inventario Tecnológico</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">I.E. Tungasuca • Gestión de Activos Digitales</p>
                        </div>
                        
                        <div class="relative w-full sm:w-72">
                            <input type="text" id="buscador" placeholder="Buscar por aula, marca, serie..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700/80 rounded-xl text-sm text-slate-800 dark:text-slate-200 placeholder-slate-400 focus:outline-none focus:border-sky-500 transition">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔍</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800">
                        <table class="w-full text-left border-collapse" id="tablaTIC">
                            <thead>
                                <tr class="bg-slate-100 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
                                    <th class="py-4 px-5">Dispositivo & Ubicación</th>
                                    <th class="py-4 px-5">Marca / Specs</th>
                                    <th class="py-4 px-5 text-center">Cant.</th>
                                    <th class="py-4 px-5 text-center">Condición</th>
                                    <th class="py-4 px-5 text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-slate-700 dark:text-slate-300 text-sm">
                                @forelse($items as $item)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition item-fila" data-text="{{ strtolower($item->objeto . ' ' . $item->barcode_serial . ' ' . $item->brand_model . ' ' . $item->location) }}">
                                        <td class="py-3.5 px-5">
                                            <div class="font-bold text-slate-900 dark:text-white text-sm">{{ $item->objeto }}</div>
                                            <div class="text-xs text-sky-600 dark:text-sky-400 font-mono font-medium mt-0.5">🏷️ {{ $item->barcode_serial ?? 'S/N' }}</div>
                                            @if($item->location)
                                                <div class="inline-block px-2.5 py-0.5 rounded-md bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-[10px] font-semibold border border-slate-200 dark:border-slate-700 mt-1.5">📍 {{ $item->location }}</div>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-5">
                                            <div class="font-medium text-slate-800 dark:text-slate-200">{{ $item->brand_model ?? 'Genérico' }}</div>
                                            <div class="text-xs text-slate-400 dark:text-slate-500 italic line-clamp-1 mt-0.5">{{ $item->details ?? 'Sin detalles' }}</div>
                                        </td>
                                        <td class="py-3.5 px-5 text-center font-bold text-slate-900 dark:text-white">
                                            <span class="bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700">{{ $item->cantidad }}</span>
                                        </td>
                                        <td class="py-3.5 px-5 text-center">
                                            @if($item->condicion == 'Bueno')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 border border-emerald-300 dark:border-emerald-800/60">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Bueno
                                                </span>
                                            @elseif($item->condicion == 'Regular')
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-400 border border-amber-300 dark:border-amber-800/60">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span> Regular
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-rose-100 dark:bg-rose-950 text-rose-700 dark:text-rose-400 border border-rose-300 dark:border-rose-800/60">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span> Malo
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-3.5 px-5 text-center">
                                            <form action="{{ route('tic.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Desea eliminar este equipo TIC?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 dark:bg-rose-500/10 hover:bg-rose-500 text-rose-600 dark:text-rose-400 hover:text-white px-3 py-1.5 rounded-xl border border-rose-200 dark:border-rose-500/30 text-xs font-bold transition-all duration-200 flex items-center gap-1 mx-auto cursor-pointer">
                                                    <span>🗑️</span> Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="py-12 text-center text-slate-400">
                                            <div class="text-4xl mb-2">💻</div>
                                            <p class="text-sm font-medium">No se han registrado equipos TIC. ¡Agrega el primero!</p>
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
        <footer class="mt-12 py-6 border-t border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 text-center text-slate-500 dark:text-slate-400 text-xs font-medium transition-colors duration-300 rounded-2xl shadow-sm">
            <p>© {{ date('Y') }} I.E. Tungasuca - Sistema de Gestión Escolar. Todos los derechos reservados.</p>
        </footer>

    </div>

    <!-- SCRIPTS -->
    <script>
        // Ocultar Preloader
        window.addEventListener('load', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.classList.add('opacity-0');
                setTimeout(() => preloader.remove(), 500);
            }
        });

        // Sincronizar el texto del botón al cargar
        document.addEventListener("DOMContentLoaded", () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const themeLabel = document.getElementById('themeTextLabel');
            if (themeLabel) {
                themeLabel.innerText = currentTheme === 'dark' ? 'Oscuro' : 'Claro';
            }
        });

        // Cambio de tema local mediante navegador (localStorage)
        function toggleDarkMode() {
            const htmlElement = document.documentElement;
            const isDark = htmlElement.classList.contains('dark');

            if (isDark) {
                htmlElement.classList.remove('dark');
                document.getElementById('themeTextLabel').innerText = 'Claro';
                localStorage.setItem('theme', 'light');
            } else {
                htmlElement.classList.add('dark');
                document.getElementById('themeTextLabel').innerText = 'Oscuro';
                localStorage.setItem('theme', 'dark');
            }
        }

        // Buscador Filtro
        const buscador = document.getElementById('buscador');
        if (buscador) {
            buscador.addEventListener('input', function() {
                const query = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                const filas = document.querySelectorAll('.item-fila');
                
                filas.forEach(fila => {
                    const texto = (fila.getAttribute('data-text') || '').toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    if (texto.includes(query)) {
                        fila.classList.remove('hidden');
                    } else {
                        fila.classList.add('hidden');
                    }
                });
            });
        }

        // Cierre Alerta
        function cerrarAlerta() {
            const alert = document.getElementById('alertSuccess');
            if (alert) {
                alert.classList.add('opacity-0');
                setTimeout(() => alert.remove(), 300);
            }
        }
    </script>
</body>
</html>