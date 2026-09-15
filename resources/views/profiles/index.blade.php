<!DOCTYPE html>
<html lang="es" class="h-full {{ auth()->check() && auth()->user()->theme === 'dark' ? 'dark bg-slate-950' : 'bg-[#F3F6F9]' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Perfiles y Accesos - I.E. Tungasuca</title>
    
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
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

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
<body class="bg-[#F3F6F9] dark:bg-slate-950 text-brand-dark dark:text-slate-100 min-h-screen flex flex-col md:flex-row selection:bg-brand-sky selection:text-white transition-colors duration-300 overflow-x-hidden">

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
                    <p class="text-[10px] text-brand-sky font-semibold tracking-wider uppercase">Panel de Control</p>
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

            <!-- MÓDULOS DEL SISTEMA (MENÚ LATERAL) -->
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

                <a href="{{ route('inventory.dashboard') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all">
                    <span>📊</span> Dashboard Estadísticas
                </a>

                @if(in_array(auth()->user()->role, ['admin']))
                    <a href="{{ route('profiles.index') }}" class="hover-shine flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-brand-blue text-white shadow-md shadow-brand-blue/20 transition-all">
                        <span>🛡️</span> Gestión de Perfiles
                    </a>
                @endif
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
    <div class="flex-grow p-6 md:p-8 overflow-y-auto max-w-7xl mx-auto w-full flex flex-col justify-between">
        
        <div class="w-full">
            <!-- ENCABEZADO SUPERIOR -->
            <header class="mb-8 p-6 md:p-8 rounded-3xl bg-brand-blue dark:bg-slate-900 text-white shadow-xl shadow-brand-blue/15 flex flex-col md:flex-row justify-between items-center gap-6 relative z-30 transition-colors duration-300 border border-slate-800">
                <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-3xl">
                    <div class="absolute -right-12 -bottom-12 w-64 h-64 bg-brand-sky/20 rounded-full blur-3xl"></div>
                    <div class="absolute right-1/3 -top-12 w-48 h-48 bg-brand-yellow/20 rounded-full blur-2xl"></div>
                </div>
                
                <div class="z-10 flex items-center gap-5">
                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold bg-brand-yellow text-brand-dark uppercase tracking-widest shadow-sm">I.E. Tungasuca</span>
                            <span class="text-xs text-brand-sky font-semibold tracking-wide">Seguridad & Control</span>
                        </div>
                        <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">Administración de Perfiles y Accesos</h1>
                    </div>
                </div>

                <div class="z-30">
                    <a href="{{ route('inventory.dashboard') }}" class="bg-brand-hover hover:bg-white hover:text-brand-blue dark:bg-slate-700 dark:hover:bg-slate-600 dark:hover:text-white text-white border border-white/20 px-5 py-2.5 rounded-2xl font-bold flex items-center gap-2 transition-all shadow-md text-sm whitespace-nowrap">
                        <span>📊</span>
                        <span>Ir al Dashboard</span>
                    </a>
                </div>
            </header>

            <!-- NOTIFICACIÓN DE ÉXITO -->
            @if(session('success'))
                <div class="bg-emerald-50 dark:bg-emerald-950/50 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 px-5 py-4 rounded-2xl mb-6 shadow-sm flex items-center gap-3">
                    <span class="text-xl">✅</span>
                    <span class="font-semibold text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- TABLA DE GESTIÓN DE PERFILES -->
            <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200/80 dark:border-slate-800 shadow-sm transition-colors">
                <div class="mb-6 pb-4 border-b border-slate-100 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-brand-dark dark:text-white tracking-wide">Personal Institucional y Permisos</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Asigne el rol principal y active o desactive los módulos permitidos para cada usuario.</p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-200/80 dark:border-slate-800">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
                                <th class="py-4 px-5">Usuario / Correo</th>
                                <th class="py-4 px-5">Rol del Sistema</th>
                                <th class="py-4 px-5">Módulos Autorizados (Permisos)</th>
                                <th class="py-4 px-5 text-center">Acción</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-brand-dark dark:text-slate-200 text-sm">
                            @foreach($users as $u)
                                @php $userPerms = json_decode($u->permissions ?? '[]', true); @endphp
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                                    <td class="py-4 px-5 font-bold text-slate-800 dark:text-white">
                                        {{ $u->name }}
                                        <div class="text-xs font-normal text-slate-400">{{ $u->email }}</div>
                                    </td>
                                    <td class="py-4 px-5">
                                        <form action="{{ route('profiles.update-access', $u->id) }}" method="POST" class="flex flex-col xl:flex-row items-start xl:items-center gap-4">
                                            @csrf
                                            @method('PUT')

                                            <select name="role" class="px-3 py-2 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-xs font-bold text-sky-600 dark:text-sky-400 focus:outline-none cursor-pointer">
                                                <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Administrador General</option>
                                                <option value="directiva" {{ $u->role === 'directiva' ? 'selected' : '' }}>Directiva</option>
                                                <option value="bibliotecario" {{ $u->role === 'bibliotecario' ? 'selected' : '' }}>Bibliotecario</option>
                                                <option value="tic" {{ $u->role === 'tic' ? 'selected' : '' }}>Encargado TIC</option>
                                                <option value="aip" {{ $u->role === 'aip' ? 'selected' : '' }}>Encargado AIP</option>
                                                <option value="docente" {{ $u->role === 'docente' ? 'selected' : '' }}>Docente / Invitado</option>
                                            </select>
                                    </td>
                                    <td class="py-4 px-5">
                                        <div class="flex flex-wrap items-center gap-3 text-xs font-semibold">
                                            <label class="flex items-center gap-1.5 cursor-pointer bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700">
                                                <input type="checkbox" name="permissions[]" value="inventory" {{ in_array('inventory', $userPerms) ? 'checked' : '' }} class="rounded text-sky-600"> 🪑 Mobiliario
                                            </label>
                                            <label class="flex items-center gap-1.5 cursor-pointer bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700">
                                                <input type="checkbox" name="permissions[]" value="library" {{ in_array('library', $userPerms) ? 'checked' : '' }} class="rounded text-sky-600"> 📚 Biblioteca
                                            </label>
                                            <label class="flex items-center gap-1.5 cursor-pointer bg-slate-50 dark:bg-slate-800 px-3 py-2 rounded-xl border border-slate-200 dark:border-slate-700">
                                                <input type="checkbox" name="permissions[]" value="tic" {{ in_array('tic', $userPerms) ? 'checked' : '' }} class="rounded text-sky-600"> 💻 Equipos TIC
                                            </label>
                                        </div>
                                    </td>
                                    <td class="py-4 px-5 text-center">
                                            <button type="submit" class="bg-brand-blue hover:bg-brand-hover text-white px-4 py-2.5 rounded-xl text-xs font-bold transition shadow-sm cursor-pointer whitespace-nowrap">
                                                💾 Guardar Accesos
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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

    <!-- SCRIPT DE TEMA -->
    <script>
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

            fetch("{{ route('user.update-theme') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ theme: newTheme })
            }).catch(error => console.error('Error al guardar el tema:', error));
        }
    </script>
</body>
</html>