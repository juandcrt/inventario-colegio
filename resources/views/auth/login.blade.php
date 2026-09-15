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
                            hover: '#064681',
                            secondary: '#1689D4',
                            sky: '#48B9E8',
                            yellow: '#F5C542',
                            dark: '#172B4D',
                            bg: '#F3F6F9',
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
<body class="h-full bg-brand-bg text-brand-dark flex flex-col justify-between relative overflow-x-hidden selection:bg-brand-sky selection:text-white">

    <!-- DECORACIÓN DE FONDO DINÁMICO (Paleta I.E. Tungasuca) -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <!-- Bloque degradado superior con curva SVG -->
        <div class="absolute top-0 left-0 right-0 h-96 bg-gradient-to-r from-brand-blue via-brand-secondary to-brand-sky">
            <svg class="absolute bottom-0 w-full h-24 text-brand-bg fill-current" viewBox="0 0 1440 320" preserveAspectRatio="none">
                <path d="M0,192L48,197.3C96,203,192,213,288,192C384,171,480,117,576,112C672,107,768,149,864,165.3C960,181,1056,171,1152,149.3C1248,128,1344,96,1392,80L1440,64L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>

        <!-- Orbes de luz decorativos -->
        <div class="absolute top-10 left-10 w-80 h-80 bg-brand-yellow/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-10 right-10 w-96 h-96 bg-brand-sky/30 rounded-full blur-3xl"></div>
    </div>

    <!-- ENCABEZADO INSTITUCIONAL SUPERIOR -->
    <header class="relative z-10 w-full px-6 py-4 flex justify-between items-center max-w-7xl mx-auto">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center border border-white/30 text-white font-bold text-xl shadow-sm">
                🏫
            </div>
            <div>
                <h2 class="text-white font-extrabold tracking-wide text-lg leading-tight">I.E. TUNGASUCA</h2>
                <p class="text-brand-yellow text-[11px] font-bold tracking-widest uppercase">Formación con visión de futuro</p>
            </div>
        </div>
    </header>

    <!-- CONTENEDOR CENTRAL / TARJETA DE LOGIN -->
    <main class="relative z-10 flex-grow flex items-center justify-center p-4 my-6">
        <div class="w-full max-w-md bg-white/95 backdrop-blur-md rounded-3xl shadow-2xl border border-white/80 p-8 md:p-10 relative overflow-hidden">
            
            <!-- Detalle decorativo superior en la tarjeta -->
            <div class="absolute top-0 left-0 right-0 h-2 bg-gradient-to-r from-brand-blue via-brand-sky to-brand-yellow"></div>

            <!-- Header de la tarjeta -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 bg-brand-blue/10 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-inner border border-brand-blue/10">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-contain" onerror="this.outerHTML='🏫'">
                </div>
                <h1 class="text-2xl font-black text-brand-dark tracking-tight">Acceso al Sistema</h1>
                <p class="text-xs text-slate-500 font-medium mt-1">Gestión integral de inventario vehicular y mobiliario</p>
            </div>

            <!-- Mensajes de Error -->
            @if ($errors->any())
                <div class="mb-6 p-4 bg-rose-50 border-l-4 border-rose-500 text-rose-700 rounded-2xl text-xs font-semibold shadow-sm flex items-center gap-2">
                    <span>⚠️</span>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Formulario de Entrada -->
            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Correo Electrónico</label>
                    <div class="relative">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus placeholder="usuario@tungasuca.edu.pe" 
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-brand-dark placeholder-slate-400 focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition shadow-sm">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-base">✉️</span>
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-[11px] font-extrabold uppercase tracking-wider text-slate-600 mb-1.5">Contraseña</label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required placeholder="••••••••" 
                            class="w-full pl-11 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl text-sm text-brand-dark placeholder-slate-400 focus:outline-none focus:border-brand-blue focus:ring-2 focus:ring-brand-blue/20 transition shadow-sm">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-base">🔒</span>
                    </div>
                </div>

                <button type="submit" class="w-full py-3.5 bg-brand-blue hover:bg-brand-hover text-white font-bold rounded-2xl shadow-lg shadow-brand-blue/25 hover:shadow-xl hover:shadow-brand-blue/30 transition-all text-sm flex items-center justify-center gap-2 group cursor-pointer mt-2">
                    <span>Ingresar al Dashboard</span>
                    <span class="group-hover:translate-x-1 transition-transform">➡️</span>
                </button>
            </form>
        </div>
    </main>

    <!-- PIE DE PÁGINA INSTITUCIONAL -->
    <footer class="relative z-10 py-4 text-center text-xs text-slate-500">
        <p class="font-handwriting text-brand-secondary text-lg mb-0.5">Más que una institución, una gran familia</p>
        <p>© {{ date('Y') }} <strong>I.E. Tungasuca</strong>. Todos los derechos reservados.</p>
    </footer>

</body>
</html>