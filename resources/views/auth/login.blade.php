<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - I.E. Tungasuca</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            blue: '#0756A3',
                            hover: '#054380',
                            secondary: '#1689D4',
                            sky: '#48B9E8',
                            yellow: '#F5C542',
                            dark: '#172B4D',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Caveat:wght@600&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .font-handwriting { font-family: 'Caveat', cursive; }
    </style>
</head>
<body class="h-full bg-slate-900 text-brand-dark flex flex-col justify-between relative overflow-x-hidden selection:bg-brand-sky selection:text-white">

    <!-- IMAGEN DE FONDO INSTITUCIONAL CON EFECTO BORROSO (BLUR) -->
    <div class="fixed inset-0 z-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?q=80&w=1920&auto=format&fit=crop" 
             alt="I.E. Tungasuca Fondo" 
             class="w-full h-full object-cover filter blur-sm scale-105 opacity-30">
        <!-- Capa de superposición con tinte azul institucional para unificar el color -->
        <div class="absolute inset-0 bg-gradient-to-tr from-[#0756A3]/95 via-[#0F2C59]/85 to-[#172B4D]/95 mix-blend-multiply"></div>
    </div>

    <!-- ELEMENTOS DECORATIVOS LUMÍNICO-FLOTANTES -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-32 -left-32 w-80 h-80 bg-brand-sky/20 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-brand-yellow/15 rounded-full blur-3xl"></div>
    </div>

    <!-- ENCABEZADO INSTITUCIONAL SUPERIOR -->
    <header class="relative z-10 w-full px-6 py-5 flex justify-between items-center max-w-7xl mx-auto">
        <div class="flex items-center gap-3.5 group cursor-default">
            <!-- Icono SVG Institucional (Escuela) -->
            <div class="w-11 h-11 bg-white/10 backdrop-blur-md rounded-2xl flex items-center justify-center border border-white/25 text-white shadow-lg shadow-black/10 group-hover:scale-105 transition-transform">
                <svg class="w-6 h-6 text-brand-yellow" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-white font-extrabold tracking-wider text-base md:text-lg leading-tight drop-shadow-md">I.E. TUNGASUCA</h2>
                <p class="text-brand-yellow text-[11px] font-bold tracking-widest uppercase drop-shadow">Formación con visión de futuro</p>
            </div>
        </div>
        <div class="hidden sm:flex items-center gap-2 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 text-white text-xs font-semibold shadow-sm">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
            <span>Sistema en Línea</span>
        </div>
    </header>

    <!-- CONTENEDOR CENTRAL / TARJETA DE LOGIN -->
    <main class="relative z-10 flex-grow flex items-center justify-center p-4 my-4">
        <div class="w-full max-w-md bg-white/95 backdrop-blur-2xl rounded-3xl shadow-[0_25px_60px_rgba(0,0,0,0.4)] border border-white/60 p-8 md:p-10 relative overflow-hidden transition-all duration-300">
            
            <!-- Barra superior decorativa brillante -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-brand-yellow via-brand-sky to-brand-secondary"></div>

            <!-- Header de la tarjeta con SVG de Seguridad / Candado -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-gradient-to-tr from-brand-blue/10 to-brand-sky/20 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-inner border border-brand-blue/10">
                    <svg class="w-8 h-8 text-brand-blue" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-black text-brand-dark tracking-tight">Iniciar Sesión</h1>
                <p class="text-xs text-slate-500 font-medium mt-1.5">Introduce tu DNI institucional para acceder al sistema</p>
            </div>

            <!-- Mensajes de Error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-2xl text-xs font-semibold shadow-sm flex items-center gap-2.5">
                    <span class="text-base font-bold">!</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Formulario de Entrada (Actualizado a DNI) -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <div>
                    <label for="dni" class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-600 mb-1.5 ml-1">Número de DNI</label>
                    <div class="relative group">
                        <input type="text" id="dni" name="dni" value="{{ old('dni') }}" required autofocus maxlength="8" placeholder="Ingrese su DNI (8 dígitos)" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/90 border border-slate-200 rounded-2xl text-sm text-brand-dark placeholder-slate-400 focus:outline-none focus:bg-white focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/15 transition-all shadow-sm">
                        <!-- Icono SVG DNI / Identificación -->
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within:text-brand-blue transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8h2m-2 4h6m-2-4h.01M17 16h.01"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-600 mb-1.5 ml-1">Contraseña</label>
                    <div class="relative group">
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full pl-11 pr-4 py-3.5 bg-slate-50/90 border border-slate-200 rounded-2xl text-sm text-brand-dark placeholder-slate-400 focus:outline-none focus:bg-white focus:border-brand-blue focus:ring-4 focus:ring-brand-blue/15 transition-all shadow-sm">
                        <!-- Icono SVG Candado -->
                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none group-focus-within:text-brand-blue transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="pt-3">
                    <button type="submit" class="w-full py-4 bg-brand-blue hover:bg-brand-hover text-white font-extrabold rounded-2xl shadow-lg shadow-brand-blue/30 hover:shadow-xl hover:shadow-brand-blue/40 transition-all duration-300 text-sm flex items-center justify-center gap-2.5 group cursor-pointer active:scale-[0.99]">
                        <span>Ingresar al Sistema</span>
                        <!-- Icono SVG Flecha -->
                        <svg class="w-4 h-4 group-hover:translate-x-1.5 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </div>
            </form>

            <!-- Pie de tarjeta secundario -->
            <div class="mt-6 pt-5 border-t border-slate-100 text-center">
                <p class="text-[11px] text-slate-400 font-medium">Panel de Control y Gestión Institucional</p>
            </div>
        </div>
    </main>

    <!-- PIE DE PÁGINA INSTITUCIONAL -->
    <footer class="relative z-10 py-5 text-center text-xs text-white/80 bg-black/20 backdrop-blur-md border-t border-white/10">
        <p class="font-handwriting text-brand-yellow text-xl mb-1 tracking-wide drop-shadow">Más que una institución, una gran familia</p>
        <p class="text-[11px] font-medium text-white/70">© {{ date('Y') }} <strong class="text-white">I.E. Tungasuca</strong>. Todos los derechos reservados.</p>
    </footer>

</body>
</html>