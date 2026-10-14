<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Inventario I.E. Tungasuca</title>
    
    <!-- Script optimizado para leer el tema desde el navegador (localStorage) sin usar la BD -->
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Chart.js & DataLabels Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    
    <!-- Librerías para Exportar a PDF profesional -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.8.2/jspdf.plugin.autotable.min.js"></script>

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

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
<body class="bg-[#F3F6F9] dark:bg-slate-950 text-brand-dark dark:text-slate-100 min-h-screen flex flex-col md:flex-row selection:bg-brand-sky selection:text-white transition-colors duration-300 overflow-x-hidden">

    <!-- PRELOADER DEDICADO DE DASHBOARD -->
    <div id="preloader" class="fixed inset-0 z-[9999] flex flex-col items-center justify-center bg-white dark:bg-slate-950 transition-opacity duration-500">
        <div class="absolute w-96 h-96 bg-brand-sky/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute w-64 h-64 bg-brand-yellow/30 rounded-full blur-2xl animate-pulse delay-300"></div>

        <div class="relative flex items-center justify-center mb-8">
            <div class="w-28 h-28 border-4 border-brand-blue/20 border-t-brand-blue rounded-full animate-spin"></div>
            <div class="absolute w-20 h-20 border-4 border-brand-yellow/30 border-b-brand-yellow rounded-full animate-spin [animation-duration:1.5s]"></div>
            <div class="absolute flex items-center justify-center p-2">
                <svg class="w-12 h-12" viewBox="0 0 100 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M50 5 L90 20 V55 C90 80 50 105 50 105 C50 105 10 80 10 55 V20 Z" fill="#0756A3" stroke="#F5C542" stroke-width="4"/>
                    <path d="M50 8 L86 22 V53 C86 76 50 99 50 99 C50 99 14 76 14 53 V22 Z" stroke="white" stroke-width="3"/>
                    <path d="M50 18 C53 25 57 28 50 36 C43 28 47 25 50 18 Z" fill="#F39C12"/>
                    <path d="M50 23 C51.5 27 54 29 50 34 C46 29 48.5 27 50 23 Z" fill="#F5C542"/>
                </svg>
            </div>
        </div>
        
        <div class="text-center space-y-2 z-10">
            <span class="px-3.5 py-1 rounded-full text-[11px] font-extrabold tracking-widest bg-brand-blue/10 dark:bg-brand-blue/30 text-brand-blue dark:text-brand-sky border border-brand-blue/20 uppercase">
                Estadísticas & Métricas
            </span>
            <h2 class="text-2xl font-black text-brand-blue dark:text-white tracking-wider uppercase mt-2">I.E. TUNGASUCA</h2>
            <p class="text-brand-secondary dark:text-slate-400 text-xs font-semibold tracking-wide flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-brand-yellow animate-ping"></span>
                Cargando métricas e inventario en vivo...
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

                <a href="{{ route('tic.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>💻</span> Equipos TIC & AIP
                </a>

                <a href="{{ route('inventory.dashboard') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-brand-blue text-white shadow-md shadow-brand-blue/20 transition-all">
                    <span>📊</span> Dashboard Estadísticas
                </a>
            </div>
        </div>

        <!-- ACCIONES INFERIORES -->
        <div class="pt-6 border-t border-slate-800 space-y-3 mt-6">
            <button type="button" onclick="toggleDarkMode()" class="hover-shine w-full bg-slate-800 hover:bg-slate-700 text-slate-200 px-4 py-2.5 rounded-xl font-bold flex items-center justify-between text-xs transition cursor-pointer border border-slate-700">
                <span class="flex items-center gap-2">☀️ Modo Visual</span>
                <span class="text-[10px] bg-slate-700 px-2.5 py-1 rounded text-brand-sky font-mono uppercase" id="themeTextLabel">Claro</span>
            </button>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="hover-shine w-full bg-rose-500/10 hover:bg-rose-600 text-rose-400 hover:text-white px-4 py-2.5 rounded-xl font-bold flex items-center justify-center gap-2 text-xs transition cursor-pointer border border-rose-500/20">
                    <span>🚪</span> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENEDOR PRINCIPAL A LA DERECHA -->
    <div class="flex-grow p-6 md:p-8 overflow-y-auto max-w-7xl mx-auto w-full">
        
        <div id="dashboard-reporte">
            <!-- ENCABEZADO SUPERIOR DE LA VISTA -->
            <header class="mb-8 p-6 md:p-8 rounded-3xl bg-brand-blue dark:bg-slate-900 text-white shadow-xl shadow-brand-blue/15 flex flex-col md:flex-row justify-between items-center gap-6 relative z-30 transition-colors duration-300 border border-slate-800">
                
                <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl">
                    <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-brand-sky/20 rounded-full blur-3xl"></div>
                    <div class="absolute right-1/3 -top-12 w-48 h-48 bg-brand-yellow/20 rounded-full blur-2xl"></div>
                </div>
                
                <div class="z-10 flex items-center gap-5">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold bg-brand-yellow text-brand-dark uppercase tracking-widest shadow-sm">I.E. Tungasuca</span>
                            <span class="text-xs text-brand-sky font-semibold tracking-wide">Panel de Métricas</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Estadísticas del Inventario</h1>
                    </div>
                </div>

                <!-- FILTRO DE AULAS Y ACCIONES -->
                <div class="flex flex-wrap items-center gap-3 z-30 relative w-full md:w-auto justify-end">
                    
                    <form method="GET" action="{{ route('inventory.dashboard') }}" id="formAulaFilter" class="relative w-full sm:w-auto z-50">
                        <input type="hidden" name="classroom_id" id="inputClassroomId" value="{{ request('classroom_id') }}">

                        <button type="button" onclick="toggleAulaDropdown()" id="btnAulaDropdown" class="w-full sm:w-auto px-4 py-2.5 bg-white dark:bg-slate-800 text-brand-dark dark:text-slate-100 border border-white/30 dark:border-slate-700 rounded-2xl text-sm font-semibold focus:outline-none transition flex items-center justify-between gap-3 shadow-md cursor-pointer">
                            <div class="flex items-center gap-2 overflow-hidden">
                                <span id="selectedAulaLabel" class="truncate">
                                    @if(request('classroom_id'))
                                        Aula: {{ $classroomsList->firstWhere('id', request('classroom_id'))->name ?? 'Seleccionada' }}
                                    @else
                                        Vista General (Todo el Colegio)
                                    @endif
                                </span>
                            </div>
                            <span class="text-brand-blue dark:text-brand-sky text-xs transition-transform duration-200" id="arrowAulaDropdown">▼</span>
                        </button>

                        <div id="menuAulaDropdown" class="hidden absolute right-0 w-full sm:w-72 mt-2 bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-2xl shadow-2xl z-50 overflow-hidden py-1 text-slate-800 dark:text-slate-100">
                            <button type="button" onclick="selectAula('')" class="w-full px-4 py-2.5 text-left text-sm font-medium hover:bg-brand-blue/10 dark:hover:bg-slate-800 flex items-center gap-2.5 transition cursor-pointer">
                                <span class="font-bold truncate">🌐 Vista General (Todo el Colegio)</span>
                            </button>

                            <div class="border-t border-slate-100 dark:border-slate-800 my-1"></div>

                            @foreach($classroomsList as $room)
                                <button type="button" onclick="selectAula('{{ $room->id }}')" class="w-full px-4 py-2.5 text-left text-sm font-medium hover:bg-brand-blue/10 dark:hover:bg-slate-800 flex items-center gap-2.5 transition cursor-pointer">
                                    <span class="text-base">🏫</span>
                                    <span class="truncate">Aula: {{ $room->name }}</span>
                                </button>
                            @endforeach
                        </div>
                    </form>

                    <a href="{{ route('inventory.index') }}" class="bg-brand-hover hover:bg-white hover:text-brand-blue dark:bg-slate-700 dark:hover:bg-slate-600 dark:hover:text-white text-white border border-white/20 px-5 py-2.5 rounded-2xl font-bold flex items-center gap-2 transition-all shadow-md text-sm whitespace-nowrap">
                        <span>⬅️</span>
                        <span>Volver al Registro</span>
                    </a>
                </div>
            </header>

            <!-- TARJETAS DE MÉTRICAS -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-blue shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <p class="text-xs text-slate-500 dark:text-slate-400 font-extrabold uppercase tracking-wider">Total de Recursos</p>
                        <span class="p-2.5 rounded-2xl bg-brand-blue/10 dark:bg-brand-blue/30 text-brand-blue dark:text-brand-sky text-lg font-bold">📦</span>
                    </div>
                    <h3 class="text-4xl font-black text-brand-dark dark:text-white mt-3 font-mono counter-val" data-target="{{ $totalCantidad }}">0</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-medium">Unidades registradas</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-success shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <p class="text-xs text-brand-success font-extrabold uppercase tracking-wider">Buen Estado</p>
                        <span class="p-2.5 rounded-2xl bg-emerald-50 dark:bg-emerald-950/40 text-brand-success text-lg">🟢</span>
                    </div>
                    <h3 class="text-4xl font-black text-brand-success mt-3 font-mono counter-val" data-target="{{ $cantBueno }}">0</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-medium">Operativos al 100%</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-yellow shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <p class="text-xs text-amber-600 dark:text-amber-400 font-extrabold uppercase tracking-wider">Estado Regular</p>
                        <span class="p-2.5 rounded-2xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 text-lg">🟡</span>
                    </div>
                    <h3 class="text-4xl font-black text-amber-500 dark:text-amber-400 mt-3 font-mono counter-val" data-target="{{ $cantRegular }}">0</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-medium">Mantenimiento preventivo</p>
                </div>

                <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-danger shadow-sm hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <p class="text-xs text-brand-danger font-extrabold uppercase tracking-wider">Mal Estado</p>
                        <span class="p-2.5 rounded-2xl bg-rose-50 dark:bg-rose-950/40 text-brand-danger text-lg">🔴</span>
                    </div>
                    <h3 class="text-4xl font-black text-brand-danger mt-3 font-mono counter-val" data-target="{{ $cantMalo }}">0</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 font-medium">Requieren reemplazo/reparación</p>
                </div>
        </div>

            <!-- ZONA DE GRÁFICOS REDISEÑADA -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
    
    <!-- GRÁFICO 1: TOP 10 OBJETOS (BARRAS HORIZONTALES) -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm lg:col-span-2 flex flex-col transition-colors overflow-hidden">
        <div class="flex flex-wrap justify-between items-center mb-4 pb-3 border-b border-slate-100 dark:border-slate-800 gap-2">
            <div>
                <h2 class="text-base font-bold text-brand-dark dark:text-white">Top 10 Objetos con Mayor Cantidad</h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Volumen acumulado por tipo de objeto</p>
            </div>
            <div class="flex items-center gap-2">
                <span class="px-3 py-1 rounded-full bg-brand-blue/10 text-brand-blue text-xs font-bold whitespace-nowrap">
                    {{ $classroomId ? 'Aula Filtrada' : 'Todo el Colegio' }}
                </span>
                <a href="{{ route('inventory.objetos', $classroomId ? ['classroom_id' => $classroomId] : []) }}"
                   class="hover-shine bg-brand-blue hover:bg-brand-hover text-white px-3 py-1.5 rounded-xl text-xs font-bold flex items-center gap-1.5 transition shadow-md whitespace-nowrap">
                    <span>📋</span>
                    <span>Ver todos</span>
                </a>
            </div>
        </div>
        <div class="relative w-full" style="height: 380px;">
            <canvas id="graficoTopObjetos"></canvas>
        </div>
    </div>

    <!-- GRÁFICO 2: SALUD DEL INVENTARIO (DONA) -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm flex flex-col transition-colors overflow-hidden">
        <div class="mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
            <h2 class="text-base font-bold text-brand-dark dark:text-white">Salud del Inventario</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Distribución por condición</p>
        </div>
        <div class="relative w-full flex-1" style="min-height: 240px;">
            <canvas id="graficoSaludDona"></canvas>
        </div>
        <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 text-center">
            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">
                Total: <strong class="text-brand-dark dark:text-white">{{ $totalCantidad }}</strong> unidades
            </span>
        </div>
    </div>

    <!-- GRÁFICO 3: DISTRIBUCIÓN POR CONDICIÓN (BARRAS APILADAS) -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm lg:col-span-3 flex flex-col transition-colors overflow-hidden">
        <div class="mb-4 pb-3 border-b border-slate-100 dark:border-slate-800">
            <h2 class="text-base font-bold text-brand-dark dark:text-white">Comparativa de Condición por Objeto (Top 10)</h2>
            <p class="text-xs text-slate-500 dark:text-slate-400">Bueno / Regular / Malo por cada objeto</p>
        </div>
        <div class="relative w-full" style="height: 380px;">
            <canvas id="graficoCondicionesApiladas"></canvas>
        </div>
    </div>
</div>
            <!-- TABLA DE DESGLOSE PROFESIONAL -->
            <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm transition-colors">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <div>
                        <h2 class="text-lg font-bold text-brand-dark dark:text-white tracking-wide">Detalle Estructural por Aula</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Listado jerárquico de mobiliario y recursos asignados</p>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-3 w-full md:w-auto">
                        <div class="relative flex-grow sm:flex-grow-0 sm:w-64">
                            <input type="text" id="buscadorTabla" onkeyup="filtrarTabla()" placeholder="Buscar aula u objeto..." aria-label="Buscar en la tabla" class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-brand-dark dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:border-brand-blue focus:ring-1 focus:ring-brand-blue transition">
                            <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔍</span>
                        </div>

                        <button type="button" onclick="exportarPDF()" class="bg-rose-50 dark:bg-rose-950/40 hover:bg-rose-600 text-rose-600 dark:text-rose-400 hover:text-white border border-rose-200 dark:border-rose-900 px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition text-xs shadow-sm cursor-pointer">
                            <span>📄</span>
                            <span>Exportar PDF</span>
                        </button>

                        <button type="button" onclick="exportarCSV()" class="bg-emerald-50 dark:bg-emerald-950/40 hover:bg-emerald-600 text-emerald-600 dark:text-emerald-400 hover:text-white border border-emerald-200 dark:border-emerald-900 px-4 py-2.5 rounded-xl font-bold flex items-center gap-2 transition text-xs shadow-sm cursor-pointer">
                            <span>📊</span>
                            <span>Exportar CSV</span>
                        </button>
                    </div>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-200/80 dark:border-slate-800">
                    <table class="w-full text-left border-collapse" id="tablaDetalle">
                        <thead>
    <tr class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
        <th scope="col" class="py-4 px-5">Objeto / Mobiliario</th>
        <th scope="col" class="py-4 px-3 text-center">🟢 Bueno</th>
        <th scope="col" class="py-4 px-3 text-center">🟡 Regular</th>
        <th scope="col" class="py-4 px-3 text-center">🔴 Malo</th>
        <th scope="col" class="py-4 px-5 text-right">Total</th>
    </tr>
</thead>
<tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-brand-dark dark:text-slate-200 text-sm">
    @forelse($detalleAula as $aula => $objetos)
        <tr class="bg-slate-100/70 dark:bg-slate-800/50 bloque-aula" data-aula="{{ strtolower($aula) }}">
            <td colspan="5" class="py-3 px-5 font-extrabold text-brand-blue dark:text-brand-sky uppercase tracking-wide border-y border-slate-200 dark:border-slate-800">
                🏫 Aula / Sección: {{ $aula ?: 'Sin Asignar' }}
            </td>
        </tr>
        @foreach($objetos as $obj)
        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition fila-objeto"
            data-objeto="{{ strtolower($obj->objeto) }}"
            data-parent-aula="{{ strtolower($aula) }}">
            <td class="py-3.5 px-5 pl-10 text-slate-700 dark:text-slate-300 font-medium flex items-center gap-2">
                <span class="text-slate-400">↳</span>
                <span>{{ $obj->objeto }}</span>
            </td>
            <td class="py-3.5 px-3 text-center">
                @if($obj->buenas > 0)
                    <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 text-xs font-bold border border-emerald-200 dark:border-emerald-800">{{ $obj->buenas }}</span>
                @else
                    <span class="text-slate-300 dark:text-slate-600">—</span>
                @endif
            </td>
            <td class="py-3.5 px-3 text-center">
                @if($obj->regulares > 0)
                    <span class="inline-block px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 text-xs font-bold border border-amber-200 dark:border-amber-800">{{ $obj->regulares }}</span>
                @else
                    <span class="text-slate-300 dark:text-slate-600">—</span>
                @endif
            </td>
            <td class="py-3.5 px-3 text-center">
                @if($obj->malas > 0)
                    <span class="inline-block px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 text-xs font-bold border border-rose-200 dark:border-rose-800">{{ $obj->malas }}</span>
                @else
                    <span class="text-slate-300 dark:text-slate-600">—</span>
                @endif
            </td>
            <td class="py-3.5 px-5 text-brand-dark dark:text-white font-bold text-right font-mono">
                <span class="bg-slate-100 dark:bg-slate-800 px-3 py-1 rounded-lg border border-slate-200 dark:border-slate-700 text-slate-700 dark:text-slate-300">{{ $obj->total }} uds.</span>
            </td>
        </tr>
        @endforeach
    @empty
        <tr id="filaSinDatos">
            <td colspan="5" class="py-12 text-center text-slate-400">
                <div class="text-4xl mb-2">📊</div>
                <p class="text-sm">No hay datos de inventario disponibles para esta selección.</p>
            </td>
        </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- FOOTER -->
        <footer class="mt-12 py-6 bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 text-center text-xs transition-colors rounded-2xl shadow-sm">
            <p class="font-serif italic text-brand-secondary dark:text-brand-sky text-sm mb-1">Más que una institución, una gran familia</p>
            <p class="text-slate-400 dark:text-slate-500">© {{ date('Y') }} <strong>I.E. Tungasuca</strong> - Sistema de Gestión Escolar. Todos los derechos reservados.</p>
        </footer>

    </div>

    <!-- LÓGICA DE CONTROL JS -->
    <script>
        const rawChartData = {
            labels: {!! json_encode($nombresObjetos ?? []) !!},
            bueno: {!! json_encode($datosBueno ?? []) !!},
            regular: {!! json_encode($datosRegular ?? []) !!},
            malo: {!! json_encode($datosMalo ?? []) !!},
            totales: {!! json_encode($cantidadesObjetos ?? []) !!},
            totalesGlobales: [
                {{ $cantBueno ?? 0 }},
                {{ $cantRegular ?? 0 }},
                {{ $cantMalo ?? 0 }}
            ]
        };

        let chartEstado, chartSalud, chartObjetos;

        function toggleAulaDropdown() {
            const menu = document.getElementById('menuAulaDropdown');
            const arrow = document.getElementById('arrowAulaDropdown');
            menu.classList.toggle('hidden');
            arrow.classList.toggle('rotate-180');
        }

        function selectAula(id) {
            document.getElementById('inputClassroomId').value = id;
            document.getElementById('formAulaFilter').submit();
        }

        document.addEventListener('click', function(event) {
            const dropdown = document.getElementById('formAulaFilter');
            if (dropdown && !dropdown.contains(event.target)) {
                document.getElementById('menuAulaDropdown')?.classList.add('hidden');
                document.getElementById('arrowAulaDropdown')?.classList.remove('rotate-180');
            }
        });

        document.addEventListener("DOMContentLoaded", () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const themeLabel = document.getElementById('themeTextLabel');
            if (themeLabel) {
                themeLabel.innerText = currentTheme === 'dark' ? 'Oscuro' : 'Claro';
            }
        });

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

            actualizarColoresGraficos(!isDark);
        }

        function actualizarColoresGraficos(isDark) {
    const textColor = isDark ? '#F1F5F9' : '#172B4D';
    const gridColor = isDark ? '#334155' : '#E2E8F0';

    [chartEstado, chartObjetos].forEach(chart => {
        if (chart) {
            chart.options.scales.x.ticks.color = textColor;
            chart.options.scales.y.ticks.color = isDark ? '#94A3B8' : '#64748B';
            if (chart.options.scales.y.grid) {
                chart.options.scales.y.grid.color = gridColor;
            }
            if (chart.options.scales.x.grid) {
                chart.options.scales.x.grid.color = gridColor;
            }
            if (chart.options.plugins.legend?.labels) {
                chart.options.plugins.legend.labels.color = textColor;
            }
            if (chart.options.plugins.datalabels) {
                chart.options.plugins.datalabels.color = textColor;
            }
            chart.update();
        }
    });

    if (chartSalud) {
        chartSalud.options.plugins.legend.labels.color = textColor;
        chartSalud.update();
    }
}

        window.addEventListener('DOMContentLoaded', () => {
            const preloader = document.getElementById('preloader');
            if (preloader) {
                preloader.classList.add('opacity-0');
                setTimeout(() => {
                    preloader.remove();
                    iniciarContadores();
                }, 500);
            } else {
                iniciarContadores();
            }

            renderizarGraficos();
        });

        function iniciarContadores() {
            const contadores = document.querySelectorAll('.counter-val');
            contadores.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target')) || 0;
                if (target === 0) {
                    counter.innerText = '0';
                    return;
                }
                
                const duration = 800;
                const startTime = performance.now();

                function updateCounter(currentTime) {
                    const elapsedTime = currentTime - startTime;
                    const progress = Math.min(elapsedTime / duration, 1);
                    counter.innerText = Math.floor(progress * target);

                    if (progress < 1) {
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.innerText = target;
                    }
                }
                requestAnimationFrame(updateCounter);
            });
        }

        function filtrarTabla() {
            const query = document.getElementById('buscadorTabla').value.toLowerCase().trim();
            const filasObjeto = document.querySelectorAll('.fila-objeto');
            const bloquesAula = document.querySelectorAll('.bloque-aula');

            filasObjeto.forEach(fila => {
                const objeto = fila.getAttribute('data-objeto');
                const aula = fila.getAttribute('data-parent-aula');

                if (objeto.includes(query) || aula.includes(query)) {
                    fila.classList.remove('hidden');
                } else {
                    fila.classList.add('hidden');
                }
            });

            bloquesAula.forEach(bloque => {
                const aulaName = bloque.getAttribute('data-aula');
                let tieneVisibles = false;

                filasObjeto.forEach(fila => {
                    if (fila.getAttribute('data-parent-aula') === aulaName && !fila.classList.contains('hidden')) {
                        tieneVisibles = true;
                    }
                });

                if (tieneVisibles || aulaName.includes(query)) {
                    bloque.classList.remove('hidden');
                } else {
                    bloque.classList.add('hidden');
                }
            });
        }

       function renderizarGraficos() {
    Chart.register(ChartDataLabels);
    const isDark = document.documentElement.classList.contains('dark');
    const textColor = isDark ? '#F1F5F9' : '#172B4D';
    const gridColor = isDark ? '#334155' : '#E2E8F0';

    // ============================================================
    // GRÁFICO 1: TOP 10 OBJETOS (Barras horizontales)
    // ============================================================
    const ctxTop = document.getElementById('graficoTopObjetos').getContext('2d');

    const coloresBarras = [
        '#0756A3', '#1068BD', '#1A7AD6', '#1689D4', '#2298E0',
        '#2FA5E6', '#48B9E8', '#5FC4EC', '#7CCFEF', '#99D9F2'
    ];

    chartObjetos = new Chart(ctxTop, {
        type: 'bar',
        data: {
            labels: rawChartData.labels,
            datasets: [{
                label: 'Cantidad',
                data: rawChartData.totales,
                backgroundColor: coloresBarras.slice(0, rawChartData.labels.length),
                borderRadius: 8,
                borderSkipped: false,
                barThickness: 'flex',
                maxBarThickness: 32,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { right: 60 } },
            scales: {
                x: {
                    ticks: { color: isDark ? '#94A3B8' : '#64748B', font: { size: 11, weight: '600' } },
                    grid: { color: gridColor, drawBorder: false },
                    beginAtZero: true
                },
                y: {
                    ticks: {
                        color: textColor,
                        font: { size: 11, weight: '600' },
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return label.length > 30 ? label.substring(0, 28) + '…' : label;
                        }
                    },
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: 'rgba(23, 43, 77, 0.95)',
                    titleFont: { size: 13, weight: 'bold' },
                    bodyFont: { size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        title: (items) => items[0].label,
                        label: (context) => '📦 Total: ' + context.parsed.x + ' unidades'
                    }
                },
                datalabels: {
                    color: textColor,
                    anchor: 'end',
                    align: 'right',
                    offset: 6,
                    font: { weight: 'bold', size: 12 },
                    formatter: (val) => val > 0 ? val : ''
                }
            }
        }
    });

    // ============================================================
    // GRÁFICO 2: SALUD DEL INVENTARIO (Dona)
    // ============================================================
    const ctxSalud = document.getElementById('graficoSaludDona').getContext('2d');

    chartSalud = new Chart(ctxSalud, {
        type: 'doughnut',
        data: {
            labels: ['Bueno', 'Regular', 'Malo'],
            datasets: [{
                data: rawChartData.totalesGlobales,
                backgroundColor: ['#22A06B', '#F5C542', '#D64545'],
                borderWidth: 3,
                borderColor: isDark ? '#0f172a' : '#ffffff',
                hoverOffset: 12
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: textColor,
                        font: { family: 'Plus Jakarta Sans', weight: '600', size: 12 },
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(23, 43, 77, 0.95)',
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const pct = total > 0 ? ((context.parsed * 100) / total).toFixed(1) : 0;
                            return ` ${context.label}: ${context.parsed} (${pct}%)`;
                        }
                    }
                },
                datalabels: {
                    color: '#ffffff',
                    font: { weight: 'bold', size: 13 },
                    formatter: (val, ctx) => {
                        let sum = ctx.dataset.data.reduce((a, b) => a + b, 0);
                        if (sum === 0 || val === 0) return '';
                        return ((val * 100) / sum).toFixed(0) + "%";
                    }
                }
            }
        }
    });

    // ============================================================
    // GRÁFICO 3: BARRAS APILADAS POR CONDICIÓN (Top 10)
    // ============================================================
    const ctxApiladas = document.getElementById('graficoCondicionesApiladas').getContext('2d');

    chartEstado = new Chart(ctxApiladas, {
        type: 'bar',
        data: {
            labels: rawChartData.labels,
            datasets: [
                {
                    label: '🟢 Bueno',
                    data: rawChartData.bueno,
                    backgroundColor: '#22A06B',
                    borderRadius: { topLeft: 6, topRight: 6 },
                    barPercentage: 0.7,
                },
                {
                    label: '🟡 Regular',
                    data: rawChartData.regular,
                    backgroundColor: '#F5C542',
                    borderRadius: { topLeft: 6, topRight: 6 },
                    barPercentage: 0.7,
                },
                {
                    label: '🔴 Malo',
                    data: rawChartData.malo,
                    backgroundColor: '#D64545',
                    borderRadius: { topLeft: 6, topRight: 6, bottomLeft: 6, bottomRight: 6 },
                    barPercentage: 0.7,
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: { padding: { top: 20 } },
            scales: {
                x: {
                    stacked: true,
                    ticks: {
                        color: textColor,
                        font: { size: 10, weight: '600' },
                        maxRotation: 45,
                        minRotation: 30,
                        callback: function(value) {
                            const label = this.getLabelForValue(value);
                            return label.length > 20 ? label.substring(0, 18) + '…' : label;
                        }
                    },
                    grid: { display: false }
                },
                y: {
                    stacked: true,
                    ticks: { color: isDark ? '#94A3B8' : '#64748B', font: { size: 11, weight: '600' } },
                    grid: { color: gridColor },
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: textColor,
                        font: { family: 'Plus Jakarta Sans', weight: '600', size: 12 },
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(23, 43, 77, 0.95)',
                    padding: 12,
                    cornerRadius: 8,
                    mode: 'index',
                    intersect: false,
                    callbacks: {
                        title: (items) => items[0].label,
                        footer: (items) => {
                            const total = items.reduce((sum, item) => sum + item.parsed.y, 0);
                            return 'Total: ' + total + ' unidades';
                        }
                    }
                },
                datalabels: {
                    color: '#ffffff',
                    font: { weight: 'bold', size: 10 },
                    display: (context) => context.dataset.data[context.dataIndex] > 3
                }
            }
        }
    });
}

        // ============================================================
// EXPORTAR PDF PROFESIONAL CON JSPDF + AUTOTABLE
// ============================================================
function exportarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF({ orientation: 'portrait', unit: 'mm', format: 'a4' });

    const pageWidth = doc.internal.pageSize.getWidth();

    // Encabezado
    doc.setFillColor(7, 86, 163);
    doc.rect(0, 0, pageWidth, 28, 'F');

    doc.setTextColor(255, 255, 255);
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(16);
    doc.text('I.E. TUNGASUCA', pageWidth / 2, 12, { align: 'center' });

    doc.setFont('helvetica', 'normal');
    doc.setFontSize(10);
    doc.text('Reporte Oficial de Inventario y Aulas', pageWidth / 2, 19, { align: 'center' });

    const fecha = new Date().toLocaleDateString('es-PE', {
        day: '2-digit', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit'
    });
    doc.setFontSize(8);
    doc.text(`Generado el: ${fecha}`, pageWidth - 10, 25, { align: 'right' });

    // Recolectar datos
    const filas = [];
    let aulaActual = '';

    document.querySelectorAll('#tablaDetalle tbody tr').forEach(tr => {
        if (tr.classList.contains('bloque-aula')) {
            const celda = tr.querySelector('td');
            let texto = celda ? celda.textContent : '';
            texto = texto
                .replace(/[\u{1F300}-\u{1FAFF}\u{2600}-\u{27BF}]/gu, '')
                .replace(/Aula\s*\/\s*Sección\s*:/gi, '')
                .replace(/Aula\s*:/gi, '')
                .replace(/\s+/g, ' ')
                .trim();
            aulaActual = texto || 'Sin Asignar';
        } else if (tr.classList.contains('fila-objeto')) {
            const celdas = tr.querySelectorAll('td');
            if (celdas.length >= 5) {
                const objeto = celdas[0].textContent.replace(/↳/g, '').replace(/\s+/g, ' ').trim();
                const bueno = celdas[1].textContent.replace('—', '0').trim();
                const regular = celdas[2].textContent.replace('—', '0').trim();
                const malo = celdas[3].textContent.replace('—', '0').trim();
                const total = celdas[4].textContent.replace('uds.', '').replace('unidades', '').trim();
                filas.push([aulaActual, objeto, bueno, regular, malo, total]);
            }
        }
    });

    if (filas.length === 0) {
        doc.setTextColor(100);
        doc.setFontSize(12);
        doc.text('No hay datos disponibles para exportar.', pageWidth / 2, 60, { align: 'center' });
        doc.save('Reporte_Inventario_IE_Tungasuca.pdf');
        return;
    }

    // Tabla
    doc.autoTable({
        startY: 35,
        head: [['Aula / Sección', 'Objeto / Mobiliario', 'Bueno', 'Regular', 'Malo', 'Total']],
        body: filas,
        theme: 'grid',
        styles: {
            font: 'helvetica',
            fontSize: 8,
            cellPadding: 2.5,
            textColor: [23, 43, 77],
            lineColor: [200, 200, 200],
            lineWidth: 0.2,
        },
        headStyles: {
            fillColor: [7, 86, 163],
            textColor: [255, 255, 255],
            fontStyle: 'bold',
            halign: 'center',
            fontSize: 9,
        },
        alternateRowStyles: {
            fillColor: [243, 246, 249],
        },
        columnStyles: {
            0: { cellWidth: 30, fontStyle: 'bold', textColor: [7, 86, 163], fontSize: 7 },
            1: { cellWidth: 'auto' },
            2: { cellWidth: 16, halign: 'center', textColor: [34, 160, 107], fontStyle: 'bold' },
            3: { cellWidth: 16, halign: 'center', textColor: [200, 150, 30], fontStyle: 'bold' },
            4: { cellWidth: 16, halign: 'center', textColor: [214, 69, 69], fontStyle: 'bold' },
            5: { cellWidth: 16, halign: 'center', fontStyle: 'bold' },
        },
        didDrawPage: function () {
            const pageCount = doc.internal.getNumberOfPages();
            const currentPage = doc.internal.getCurrentPageInfo().pageNumber;
            doc.setFontSize(8);
            doc.setTextColor(120);
            doc.text(
                `Página ${currentPage} de ${pageCount}  |  I.E. Tungasuca - Sistema de Gestión`,
                pageWidth / 2,
                doc.internal.pageSize.getHeight() - 8,
                { align: 'center' }
            );
        }
    });

    doc.save('Reporte_Inventario_IE_Tungasuca.pdf');
}

        // ============================================================
// EXPORTAR CSV CORREGIDO (con BOM UTF-8 y escape correcto)
// ============================================================
function exportarCSV() {
    const escaparCSV = (valor) => {
        if (valor === null || valor === undefined) return '';
        let str = String(valor).trim();
        if (str.includes(',') || str.includes('"') || str.includes('\n')) {
            str = '"' + str.replace(/"/g, '""') + '"';
        }
        return str;
    };

    const filas = [];
    let aulaActual = '';

    document.querySelectorAll('#tablaDetalle tbody tr').forEach(tr => {
        if (tr.classList.contains('bloque-aula')) {
            const celda = tr.querySelector('td');
            let texto = celda ? celda.textContent : '';
            texto = texto
                .replace(/[\u{1F300}-\u{1FAFF}\u{2600}-\u{27BF}]/gu, '')
                .replace(/Aula\s*\/\s*Sección\s*:/gi, '')
                .replace(/Aula\s*:/gi, '')
                .replace(/\s+/g, ' ')
                .trim();
            aulaActual = texto || 'Sin Asignar';
        } else if (tr.classList.contains('fila-objeto')) {
            const celdas = tr.querySelectorAll('td');
            if (celdas.length >= 5) {
                const objeto = celdas[0].textContent.replace(/↳/g, '').replace(/\s+/g, ' ').trim();
                const bueno = celdas[1].textContent.replace('—', '0').trim();
                const regular = celdas[2].textContent.replace('—', '0').trim();
                const malo = celdas[3].textContent.replace('—', '0').trim();
                const total = celdas[4].textContent.replace('uds.', '').replace('unidades', '').trim();
                filas.push([aulaActual, objeto, bueno, regular, malo, total]);
            }
        }
    });

    if (filas.length === 0) {
        alert('No hay datos para exportar.');
        return;
    }

    const encabezados = ['Aula / Sección', 'Objeto / Mobiliario', 'Bueno', 'Regular', 'Malo', 'Total'];
    let csvContent = encabezados.map(escaparCSV).join(',') + '\r\n';

    filas.forEach(fila => {
        csvContent += fila.map(escaparCSV).join(',') + '\r\n';
    });

    const BOM = '\uFEFF';
    const blob = new Blob([BOM + csvContent], { type: 'text/csv;charset=utf-8;' });

    const url = URL.createObjectURL(blob);
    const link = document.createElement('a');
    link.setAttribute('href', url);
    link.setAttribute('download', `Inventario_IE_Tungasuca_${new Date().toISOString().slice(0,10)}.csv`);
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(url);
}
    </script>
</body>
</html>