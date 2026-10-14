<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado Completo de Objetos - I.E. Tungasuca</title>

    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') document.documentElement.classList.add('dark');
            else document.documentElement.classList.remove('dark');
        })();
    </script>

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
                            sky: '#48B9E8',
                            yellow: '#F5C542',
                            dark: '#172B4D',
                            success: '#22A06B',
                            danger: '#D64545',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hover-shine { position: relative; overflow: hidden; }
        .hover-shine::after {
            content: ''; position: absolute; top: -50%; left: -60%; width: 20%; height: 200%;
            background: rgba(255, 255, 255, 0.2); transform: rotate(30deg); transition: none;
        }
        .hover-shine:hover::after { left: 120%; transition: all 0.6s cubic-bezier(0.19, 1, 0.22, 1); }
    </style>
</head>
<body class="bg-[#F3F6F9] dark:bg-slate-950 text-brand-dark dark:text-slate-100 min-h-screen flex flex-col md:flex-row transition-colors duration-300 overflow-x-hidden">

    <!-- SIDEBAR -->
    <aside class="w-full md:w-72 bg-brand-dark dark:bg-slate-900 text-white flex flex-col justify-between p-6 shrink-0 shadow-xl border-r border-slate-800 z-40 sticky top-0 h-screen overflow-y-auto">
        <div>
            <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-800">
                <div class="w-12 h-12 bg-white dark:bg-slate-800 rounded-2xl flex items-center justify-center p-2 shadow-md shrink-0 border border-slate-700">
                    <svg class="w-full h-full" viewBox="0 0 100 110" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M50 5 L90 20 V55 C90 80 50 105 50 105 C50 105 10 80 10 55 V20 Z" fill="#0756A3" stroke="#F5C542" stroke-width="4"/>
                        <path d="M50 8 L86 22 V53 C86 76 50 99 50 99 C50 99 14 76 14 53 V22 Z" stroke="white" stroke-width="3"/>
                    </svg>
                </div>
                <div>
                    <h2 class="font-black text-xs tracking-wide">I.E. TUNGASUCA</h2>
                    <p class="text-[10px] text-brand-sky font-semibold tracking-wider uppercase">Gestión Institucional</p>
                </div>
            </div>

            <div class="bg-slate-800/60 dark:bg-slate-800/40 p-4 rounded-2xl mb-8 border border-slate-700/50 flex items-center gap-3">
                <div class="w-10 h-10 bg-brand-blue rounded-full flex items-center justify-center font-bold text-white shadow shrink-0">
                    {{ auth()->check() ? substr(auth()->user()->name, 0, 1) : 'U' }}
                </div>
                <div class="overflow-hidden">
                    <p class="text-[10px] text-slate-400">Bienvenido,</p>
                    <p class="text-xs font-bold truncate text-white">{{ auth()->check() ? auth()->user()->name : 'Invitado' }}</p>
                </div>
            </div>

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
                <a href="{{ route('inventory.objetos') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📋</span> Listado de Objetos
                </a>
            </div>
        </div>

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

    <!-- CONTENIDO -->
    <div class="flex-grow p-6 md:p-8 overflow-y-auto max-w-7xl mx-auto w-full">

        <!-- HEADER -->
        <header class="mb-8 p-6 md:p-8 rounded-3xl bg-brand-blue dark:bg-slate-900 text-white shadow-xl shadow-brand-blue/15 flex flex-col md:flex-row justify-between items-center gap-6 relative z-30 border border-slate-800">
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl">
                <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-brand-sky/20 rounded-full blur-3xl"></div>
                <div class="absolute right-1/3 -top-12 w-48 h-48 bg-brand-yellow/20 rounded-full blur-2xl"></div>
            </div>

            <div class="z-10">
                <div class="flex items-center gap-2 mb-1">
                    <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold bg-brand-yellow text-brand-dark uppercase tracking-widest shadow-sm">I.E. Tungasuca</span>
                    <span class="text-xs text-brand-sky font-semibold tracking-wide">Catálogo completo</span>
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Listado Completo de Objetos</h1>
                <p class="text-sm text-brand-sky mt-1">{{ $objetos->count() }} tipos diferentes de objetos registrados</p>
            </div>

            <div class="flex flex-wrap items-center gap-3 z-30 relative">
                <form method="GET" action="{{ route('inventory.objetos') }}" class="flex items-center gap-2">
                    <select name="classroom_id" onchange="this.form.submit()" class="px-4 py-2.5 bg-white dark:bg-slate-800 text-brand-dark dark:text-slate-100 border border-white/30 dark:border-slate-700 rounded-2xl text-sm font-semibold focus:outline-none cursor-pointer">
                        <option value="">🌐 Todo el Colegio</option>
                        @foreach($classroomsList as $room)
                            <option value="{{ $room->id }}" {{ $classroomId == $room->id ? 'selected' : '' }}>
                                🏫 {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </form>
                <a href="{{ route('inventory.dashboard') }}" class="bg-white/10 hover:bg-white/20 text-white border border-white/20 px-5 py-2.5 rounded-2xl font-bold flex items-center gap-2 transition-all shadow-md text-sm whitespace-nowrap">
                    <span>⬅️</span>
                    <span>Volver al Dashboard</span>
                </a>
            </div>
        </header>

        <!-- TARJETAS DE RESUMEN -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-blue shadow-sm">
                <p class="text-xs text-slate-500 dark:text-slate-400 font-extrabold uppercase tracking-wider">Total</p>
                <h3 class="text-3xl font-black text-brand-dark dark:text-white mt-2 font-mono">{{ $totalGeneral }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Unidades</p>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-success shadow-sm">
                <p class="text-xs text-brand-success font-extrabold uppercase tracking-wider">Bueno</p>
                <h3 class="text-3xl font-black text-brand-success mt-2 font-mono">{{ $totalBueno }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Operativos</p>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-yellow shadow-sm">
                <p class="text-xs text-amber-600 font-extrabold uppercase tracking-wider">Regular</p>
                <h3 class="text-3xl font-black text-amber-500 mt-2 font-mono">{{ $totalRegular }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">A revisar</p>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200/80 dark:border-slate-800 border-l-4 border-l-brand-danger shadow-sm">
                <p class="text-xs text-brand-danger font-extrabold uppercase tracking-wider">Malo</p>
                <h3 class="text-3xl font-black text-brand-danger mt-2 font-mono">{{ $totalMalo }}</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Reemplazo</p>
            </div>
        </div>

        <!-- TABLA COMPLETA -->
        <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                <div>
                    <h2 class="text-lg font-bold text-brand-dark dark:text-white tracking-wide">Todos los Objetos</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Listado jerárquico por cantidad total</p>
                </div>
                <div class="relative w-full md:w-72">
                    <input type="text" id="buscador" placeholder="Buscar objeto..." class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 rounded-xl text-sm text-brand-dark dark:text-slate-100 placeholder-slate-400 focus:outline-none focus:border-brand-blue transition">
                    <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔍</span>
                </div>
            </div>

            <div class="overflow-x-auto rounded-2xl border border-slate-200/80 dark:border-slate-800">
                <table class="w-full text-left border-collapse" id="tablaObjetos">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
                            <th class="py-4 px-5">#</th>
                            <th class="py-4 px-5">Objeto</th>
                            <th class="py-4 px-5 text-center">Bueno</th>
                            <th class="py-4 px-5 text-center">Regular</th>
                            <th class="py-4 px-5 text-center">Malo</th>
                            <th class="py-4 px-5 text-right">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                        @forelse($objetos as $i => $obj)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition objeto-fila" data-text="{{ strtolower($obj->objeto) }}">
                            <td class="py-3.5 px-5 font-mono text-slate-400 text-xs">{{ $i + 1 }}</td>
                            <td class="py-3.5 px-5 font-semibold text-brand-dark dark:text-white">{{ $obj->objeto }}</td>
                            <td class="py-3.5 px-5 text-center">
                                @if($obj->buenas > 0)
                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/50 text-emerald-700 dark:text-emerald-400 text-xs font-bold border border-emerald-200 dark:border-emerald-800">{{ $obj->buenas }}</span>
                                @else
                                    <span class="text-slate-300 dark:text-slate-600">—</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-center">
                                @if($obj->regulares > 0)
                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-amber-50 dark:bg-amber-950/50 text-amber-700 dark:text-amber-400 text-xs font-bold border border-amber-200 dark:border-amber-800">{{ $obj->regulares }}</span>
                                @else
                                    <span class="text-slate-300 dark:text-slate-600">—</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-center">
                                @if($obj->malas > 0)
                                    <span class="inline-block px-2.5 py-1 rounded-lg bg-rose-50 dark:bg-rose-950/50 text-rose-700 dark:text-rose-400 text-xs font-bold border border-rose-200 dark:border-rose-800">{{ $obj->malas }}</span>
                                @else
                                    <span class="text-slate-300 dark:text-slate-600">—</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-right font-black text-brand-blue dark:text-brand-sky font-mono text-base">{{ $obj->total }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-12 text-center text-slate-400">
                                <div class="text-4xl mb-2">📋</div>
                                <p class="text-sm">No hay objetos registrados para esta selección.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const label = document.getElementById('themeTextLabel');
            if (label) label.innerText = currentTheme === 'dark' ? 'Oscuro' : 'Claro';
        });

        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            if (isDark) {
                html.classList.remove('dark');
                document.getElementById('themeTextLabel').innerText = 'Claro';
                localStorage.setItem('theme', 'light');
            } else {
                html.classList.add('dark');
                document.getElementById('themeTextLabel').innerText = 'Oscuro';
                localStorage.setItem('theme', 'dark');
            }
        }

        const buscador = document.getElementById('buscador');
        if (buscador) {
            buscador.addEventListener('input', function() {
                const q = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                document.querySelectorAll('.objeto-fila').forEach(fila => {
                    const t = (fila.getAttribute('data-text') || '').normalize("NFD").replace(/[\u0300-\u036f]/g, "");
                    fila.classList.toggle('hidden', !t.includes(q));
                });
            });
        }
    </script>
</body>
</html>