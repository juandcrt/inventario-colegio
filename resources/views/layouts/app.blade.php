<!DOCTYPE html>
<html lang="es" data-bs-theme="{{ auth()->check() ? (auth()->user()->theme ?? 'light') : 'light' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'I.E. Tungasuca - Sistema de Inventario')</title>
    
    <!-- Bootstrap CSS 5.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- NAV / BARRA DE NAVEGACIÓN -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">I.E. Tungasuca</a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <!-- Menú desplegable de Módulos del Sistema -->
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle active" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            📦 Módulos del Sistema
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('inventory.index') }}">🪑 Mobiliario (Aulas)</a></li>
                            <li><a class="dropdown-item" href="{{ route('library.index') }}">📚 Biblioteca Escolar</a></li>
                            <li><a class="dropdown-item" href="{{ route('tic.index') }}">💻 Equipos TIC & AIP</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="{{ route('inventory.dashboard') }}">📊 Panel de Estadísticas</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="d-flex align-items-center gap-3">
                    <!-- BOTÓN SWITCH MODO OSCURO / CLARO (BD) -->
                    <div class="form-check form-switch m-0 text-white">
                        <input class="form-check-input" type="checkbox" id="themeToggleBtn" role="switch" onclick="toggleTheme()" {{ (auth()->check() && auth()->user()->theme === 'dark') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="themeToggleBtn" id="themeLabel">
                            {{ (auth()->check() && auth()->user()->theme === 'dark') ? 'Modo Oscuro' : 'Modo Claro' }}
                        </label>
                    </div>

                    <!-- BOTÓN DE CERRAR SESIÓN GLOBAL -->
                    <form action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">
                            Cerrar Sesión
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO DINÁMICO DE CADA VISTA -->
    <main class="container mb-5">
        @yield('content')
    </main>

    <!-- Scripts JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT DE INTERACCIÓN Y PERSISTENCIA EN BASE DE DATOS (MULTIUSUARIO) -->
    <script>
        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            // Aplica el tema inmediatamente al HTML
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            
            // Actualiza la etiqueta del switch
            const toggleLabel = document.getElementById('themeLabel');
            if (toggleLabel) {
                toggleLabel.textContent = newTheme === 'dark' ? 'Modo Oscuro' : 'Modo Claro';
            }
            
            // Guarda la preferencia de forma independiente en MySQL vía AJAX
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

    @stack('scripts')
</body>
</html>