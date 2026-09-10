<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario - I.E. Tungasuca</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto px-4 py-8">
        
        <!-- HEADER -->
        <header class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">🏫 Sistema de Inventario - I.E. Tungasuca</h1>
                <p class="text-gray-600">Control de Mobiliario, TIC y Biblioteca</p>
            </div>
            
            <div class="flex items-center space-x-4">
                <!-- Menú Desplegable de Módulos -->
                <div class="relative group">
                    <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 transition font-semibold flex items-center shadow-sm">
                        ⚙️ Cambiar Módulo
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-xl opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50 border border-gray-200">
                        <a href="{{ route('inventory.index') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 border-b font-medium">🪑 Mobiliario (Aulas)</a>
                        <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 border-b font-medium">📚 Biblioteca</a>
                        <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50 hover:text-indigo-600 font-medium">💻 Equipos TIC</a>
                    </div>
                </div>

                <a href="{{ route('inventory.dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-semibold shadow-sm">📊 Ver Dashboard</a>
            </div>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6 shadow-sm">
                <strong class="font-bold">¡Ups! Hay un problema con el registro:</strong>
                <ul class="list-disc pl-5 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Formulario de Registro -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-1">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Registrar Mobiliario</h2>
                <form action="{{ route('inventory.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Aula / Sección:</label>
                        <select name="classroom_id" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">-- Seleccionar Sección --</option>
                            @foreach($grades as $grade)
                                <optgroup label="{{ $grade->name }}">
                                    @foreach($grade->classrooms as $classroom)
                                        <option value="{{ $classroom->id }}">{{ $classroom->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tipo de Objeto:</label>
                        <select name="objeto" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="">-- Seleccionar Objeto --</option>
                            <option value="Ventana">Ventana</option>
                            <option value="Proyector">Proyector</option>
                            <option value="Puerta">Puerta</option>
                            <option value="Pizarra">Pizarra</option>
                            <option value="Estante">Estante</option>
                            <option value="Casillero (Locker)">Casillero (Locker)</option>
                            <option value="Pupitre">Pupitre</option>
                            <option value="Equipo Tecnológico">Equipo Tecnológico</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Cantidad:</label>
                        <input type="number" name="cantidad" min="1" placeholder="Ej: 37" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Condición:</label>
                        <select name="condicion" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Malo">Malo</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Guardar Registro</button>
                </form>
            </div>

            <!-- Tabla de Registros con Buscador -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-700">Inventario Actual por Aulas</h2>
                    
                    <!-- BARRA DE BÚSQUEDA INSTANTÁNEA -->
                    <input type="text" id="buscador" onkeyup="filtrarInventario()" placeholder="🔍 Buscar aula u objeto..." class="px-3 py-2 border rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 w-64">
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200" id="tablaInventario">
                        <thead>
                            <tr class="bg-gray-800 text-white uppercase text-xs leading-normal">
                                <th class="py-3 px-4 text-left">Objeto / Mobiliario</th>
                                <th class="py-3 px-4 text-center">Cantidad</th>
                                <th class="py-3 px-4 text-center">Estado</th>
                                <th class="py-3 px-4 text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($itemsPorAula as $aula => $items)
                                <!-- Cabecera del Aula -->
                                <tr class="bg-gray-200 border-b border-gray-300 cursor-pointer hover:bg-gray-300 transition grupo-aula" onclick="toggleAula('{{ Str::slug($aula) }}')" data-text="{{ strtolower($aula) }}">
                                    <td colspan="4" class="py-3 px-4 font-bold text-gray-800 uppercase">
                                        <div class="flex justify-between items-center">
                                            <span>🏫 Aula: {{ $aula }}</span>
                                            <span id="flecha-{{ Str::slug($aula) }}" class="text-lg transition-transform duration-200">🔽</span>
                                        </div>
                                    </td>
                                </tr>
                                
                                <!-- Elementos dentro del aula -->
                                @foreach($items as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100 fila-aula-{{ Str::slug($aula) }} item-fila" data-text="{{ strtolower($item->objeto . ' ' . $aula) }}">
                                    <td class="py-3 px-4 text-left font-medium pl-8">↳ {{ $item->objeto }}</td>
                                    <td class="py-3 px-4 text-center font-bold">{{ $item->cantidad }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold 
                                            {{ $item->condicion == 'Bueno' ? 'bg-green-100 text-green-700 border border-green-300' : ($item->condicion == 'Regular' ? 'bg-yellow-100 text-yellow-700 border border-yellow-300' : 'bg-red-100 text-red-700 border border-red-300') }}">
                                            ● {{ $item->condicion }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center">
                                        <form action="{{ route('inventory.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este registro?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-xs font-bold transition shadow-sm">
                                                🗑️ Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-gray-400">No hay mobiliario registrado todavía. ¡Agrega el primero!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPTS DE ACORDEÓN Y BÚSQUEDA -->
    <script>
        function toggleAula(aulaSlug) {
            const filas = document.querySelectorAll('.fila-aula-' + aulaSlug);
            const flecha = document.getElementById('flecha-' + aulaSlug);
            
            filas.forEach(fila => {
                fila.classList.toggle('hidden');
            });

            if (flecha.style.transform === 'rotate(-90deg)') {
                flecha.style.transform = 'rotate(0deg)';
            } else {
                flecha.style.transform = 'rotate(-90deg)';
            }
        }

        // BÚSQUEDA INSTANTÁNEA
        function filtrarInventario() {
            const input = document.getElementById('buscador').value.toLowerCase();
            const filasItems = document.querySelectorAll('.item-fila');
            const gruposAulas = document.querySelectorAll('.grupo-aula');

            if (input === '') {
                filasItems.forEach(f => f.classList.remove('hidden'));
                gruposAulas.forEach(g => g.classList.remove('hidden'));
                return;
            }

            filasItems.forEach(fila => {
                const texto = fila.getAttribute('data-text');
                if (texto.includes(input)) {
                    fila.classList.remove('hidden');
                } else {
                    fila.classList.add('hidden');
                }
            });
        }
    </script>
</body>
</html>