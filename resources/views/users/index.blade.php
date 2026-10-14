<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - I.E. Tungasuca</title>
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
                            blue: '#0756A3', hover: '#064681', sky: '#48B9E8',
                            yellow: '#F5C542', dark: '#172B4D', success: '#22A06B', danger: '#D64545',
                        }
                    }
                }
            }
        }
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-[#F3F6F9] dark:bg-slate-950 text-brand-dark dark:text-slate-100 min-h-screen flex flex-col md:flex-row transition-colors duration-300">

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
                    <p class="text-xs font-bold truncate text-white">{{ auth()->user()->name }}</p>
                    <span class="text-[10px] text-emerald-400 font-medium">● En línea</span>
                </div>
            </div>

            <div class="space-y-1.5">
                <p class="text-[10px] font-extrabold uppercase tracking-widest text-slate-400 mb-3 px-2">Módulos</p>
                <a href="{{ route('inventory.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all"><span>🪑</span> Mobiliario</a>
                <a href="{{ route('library.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all"><span>📚</span> Biblioteca</a>
                <a href="{{ route('tic.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all"><span>💻</span> Equipos TIC</a>
                <a href="{{ route('inventory.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-slate-300 hover:bg-slate-800 hover:text-white transition-all"><span>📊</span> Dashboard</a>
                <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold bg-brand-blue text-white shadow-md transition-all"><span>👥</span> Usuarios</a>
            </div>
        </div>

        <div class="pt-6 border-t border-slate-800 space-y-3 mt-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full bg-rose-500/10 hover:bg-rose-600 text-rose-400 hover:text-white px-4 py-2.5 rounded-xl font-bold flex items-center justify-center gap-2 text-xs transition border border-rose-500/20">
                    <span>🚪</span> Cerrar Sesión
                </button>
            </form>
        </div>
    </aside>

    <!-- CONTENIDO -->
    <div class="flex-grow p-6 md:p-8 overflow-y-auto max-w-7xl mx-auto w-full">

        <header class="mb-8 p-6 md:p-8 rounded-3xl bg-brand-blue dark:bg-slate-900 text-white shadow-xl flex items-center gap-5">
            <div class="w-16 h-16 bg-gradient-to-br from-brand-yellow to-amber-500 rounded-2xl flex items-center justify-center text-3xl shadow-lg">
                👥
            </div>
            <div>
                <span class="px-3 py-0.5 rounded-full text-[11px] font-extrabold bg-brand-yellow text-brand-dark uppercase tracking-widest">I.E. Tungasuca</span>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight mt-1">Gestión de Usuarios</h1>
                <p class="text-xs text-brand-sky font-semibold mt-1">Administra los accesos y roles del sistema</p>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 px-5 py-4 rounded-2xl mb-6">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 px-5 py-4 rounded-2xl mb-6">
                ❌ {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- FORMULARIO -->
            <div class="bg-white dark:bg-slate-900 p-6 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm lg:col-span-1 self-start">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-200 dark:border-slate-800">
                    <span class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-slate-800 flex items-center justify-center text-brand-blue font-bold text-lg">➕</span>
                    <div>
                        <h2 class="text-lg font-bold text-brand-dark dark:text-white">Nuevo Usuario</h2>
                        <p class="text-xs text-slate-500">Registra un nuevo acceso</p>
                    </div>
                </div>

                <form action="{{ route('users.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Nombre Completo</label>
                        <input type="text" name="name" required placeholder="Ej: Juan Pérez" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:border-brand-blue transition">
                    </div>
                    <div>
                        <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">DNI</label>
                        <input type="text" name="dni" required placeholder="Ej: 12345678" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-mono focus:outline-none focus:border-brand-blue transition">
                    </div>
                    <div>
                        <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Contraseña</label>
                        <input type="text" name="password" required placeholder="Mínimo 6 caracteres" class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm font-mono focus:outline-none focus:border-brand-blue transition">
                    </div>
                    <div>
                        <label class="block text-slate-700 dark:text-slate-300 text-xs font-bold uppercase tracking-wider mb-1.5">Rol</label>
                        <select name="role" required class="w-full px-4 py-3 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:border-brand-blue transition cursor-pointer">
                            <option value="bibliotecario">📚 Bibliotecario (solo lectura)</option>
                            <option value="tic">💻 Encargado TIC (solo lectura)</option>
                            <option value="directiva">🏢 Directiva (acceso total)</option>
                            <option value="admin">👑 Administrador (acceso total)</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-brand-blue hover:bg-brand-hover text-white font-extrabold py-3.5 rounded-xl shadow-md transition-all text-sm mt-2">
                        💾 Crear Usuario
                    </button>
                </form>
            </div>

            <!-- TABLA DE USUARIOS -->
            <div class="bg-white dark:bg-slate-900 p-6 md:p-7 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm lg:col-span-2">
                <div class="mb-6 pb-4 border-b border-slate-200 dark:border-slate-800">
                    <h2 class="text-lg font-bold text-brand-dark dark:text-white">Usuarios Registrados</h2>
                    <p class="text-xs text-slate-500">Total: {{ $users->count() }} usuarios</p>
                </div>

                <div class="overflow-x-auto rounded-2xl border border-slate-200 dark:border-slate-800">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50 dark:bg-slate-950 text-slate-500 dark:text-slate-400 uppercase text-[11px] font-extrabold tracking-wider border-b border-slate-200 dark:border-slate-800">
                                <th class="py-4 px-5">Nombre</th>
                                <th class="py-4 px-5">DNI</th>
                                <th class="py-4 px-5 text-center">Rol</th>
                                <th class="py-4 px-5 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-800 text-sm">
                            @foreach($users as $user)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/40 transition">
                                    <td class="py-3.5 px-5">
                                        <div class="font-bold text-brand-dark dark:text-white">{{ $user->name }}</div>
                                        @if($user->id === auth()->id())
                                            <span class="text-[10px] text-emerald-600 font-bold">● Tú</span>
                                        @endif
                                    </td>
                                    <td class="py-3.5 px-5 font-mono text-slate-600 dark:text-slate-300">{{ $user->dni }}</td>
                                    <td class="py-3.5 px-5 text-center">
                                        <form action="{{ route('users.update', $user->id) }}" method="POST" class="flex items-center gap-2 justify-center">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="name" value="{{ $user->name }}">
                                            <select name="role" onchange="this.form.submit()" class="text-xs font-bold px-2 py-1 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-800 cursor-pointer">
                                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>👑 Admin</option>
                                                <option value="directiva" {{ $user->role === 'directiva' ? 'selected' : '' }}>🏢 Directiva</option>
                                                <option value="bibliotecario" {{ $user->role === 'bibliotecario' ? 'selected' : '' }}>📚 Bibliotecario</option>
                                                <option value="tic" {{ $user->role === 'tic' ? 'selected' : '' }}>💻 TIC</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="py-3.5 px-5 text-center">
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('¿Eliminar a {{ $user->name }}?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-rose-50 hover:bg-rose-600 text-rose-600 hover:text-white px-3 py-1.5 rounded-xl border border-rose-200 text-xs font-bold transition">
                                                    🗑️
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-slate-400 text-xs">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleDarkMode() {
            const html = document.documentElement;
            html.classList.toggle('dark');
            localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
        }
    </script>
</body>
</html>