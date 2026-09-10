<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Inventario Institucional</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="container mx-auto px-4 py-8">
        <header class="mb-8 text-center">
            <h1 class="text-3xl font-bold text-gray-800">🏫 Sistema de Inventario Escolar</h1>
            <p class="text-gray-600">Control de Mobiliario y Acceso Rápido para Docentes</p>
        </header>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6">
                {{ session('success') }}
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
                        <input type="text" name="classroom_section" placeholder="Ej: Aula 101 - 3ro B" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Tipo de Objeto:</label>
                        <input type="text" name="item_type" placeholder="Ej: Silla, Carpeta, Ventana" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Cantidad:</label>
                        <input type="number" name="quantity" min="1" required class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2">Condición:</label>
                        <select name="condition" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="Bueno">Bueno</option>
                            <option value="Regular">Regular</option>
                            <option value="Malo">Malo</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-2 px-4 rounded-lg hover:bg-blue-700 transition">Guardar Registro</button>
                </form>
            </div>

            <!-- Tabla de Registros -->
            <div class="bg-white p-6 rounded-lg shadow-md md:col-span-2">
                <h2 class="text-xl font-semibold mb-4 text-gray-700">Inventario Actual en Aulas</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-xs leading-normal">
                                <th class="py-3 px-4 text-left">Aula</th>
                                <th class="py-3 px-4 text-left">Objeto</th>
                                <th class="py-3 px-4 text-center">Cantidad</th>
                                <th class="py-3 px-4 text-center">Estado</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse($items as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-4 text-left font-medium">{{ $item->classroom_section }}</td>
                                    <td class="py-3 px-4 text-left">{{ $item->item_type }}</td>
                                    <td class="py-3 px-4 text-center">{{ $item->quantity }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-2 py-1 rounded text-xs font-semibold 
                                            {{ $item->condition == 'Bueno' ? 'bg-green-200 text-green-800' : ($item->condition == 'Regular' ? 'bg-yellow-200 text-yellow-800' : 'bg-red-200 text-red-800') }}">
                                            {{ $item->condition }}
                                        </span>
                                    </td>
                                </tr>
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
</body>
</html>