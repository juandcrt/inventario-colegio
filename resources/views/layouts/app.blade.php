<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'I.E. Tungasuca - Sistema de Inventario')</title>
    
    <!-- Bootstrap CSS 5.3 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- SCRIPT DE INICIALIZACIÓN RÁPIDA (Evita parpadeos al cambiar de página) -->
    <script>
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            document.documentElement.setAttribute('data-bs-theme', savedTheme);
        })();
    </script>
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
                    <!-- BOTÓN SWITCH MODO OSCURO / CLARO (LOCALSTORAGE) -->
                    <div class="form-check form-switch m-0 text-white">
                        <input class="form-check-input" type="checkbox" id="themeToggleBtn" role="switch" onclick="toggleTheme()">
                        <label class="form-check-label small" for="themeToggleBtn" id="themeLabel">
                            Modo Claro
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

    <!-- SCRIPT DE INTERACCIÓN Y PERSISTENCIA LOCAL (LOCALSTORAGE) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const currentTheme = localStorage.getItem('theme') || 'light';
            const toggleBtn = document.getElementById('themeToggleBtn');
            const toggleLabel = document.getElementById('themeLabel');

            // Sincroniza el estado visual del switch al cargar la vista
            if (currentTheme === 'dark') {
                toggleBtn.checked = true;
                toggleLabel.textContent = 'Modo Oscuro';
            } else {
                toggleBtn.checked = false;
                toggleLabel.textContent = 'Modo Claro';
            }
        });

        function toggleTheme() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            // Aplica el tema inmediatamente al HTML
            document.documentElement.setAttribute('data-bs-theme', newTheme);
            
            // Guarda la preferencia en el navegador del usuario
            localStorage.setItem('theme', newTheme);
            
            // Actualiza la etiqueta del switch
            const toggleLabel = document.getElementById('themeLabel');
            if (toggleLabel) {
                toggleLabel.textContent = newTheme === 'dark' ? 'Modo Oscuro' : 'Modo Claro';
            }
        }
    </script>

    @stack('scripts')
</body>
</html>