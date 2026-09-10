<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Inventario Escolar</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">📊 Panel de Control y Estadísticas</h1>
                <p class="text-gray-600">Resumen general del mobiliario escolar - I.E. Tungasuca</p>
            </div>
            <a href="{{ route('inventory.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition font-semibold">⬅️ Volver al Registro</a>
        </div>

        <!-- Tarjetas Superiores (Totales Globales) -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-blue-500">
                <p class="text-sm text-gray-500 font-medium">Total de Muebles (General)</p>
                <h3 class="text-3xl font-bold text-gray-800 mt-2">{{ $totalCantidad }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-green-500">
                <p class="text-sm text-gray-500 font-medium">Total en Buen Estado</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $cantBueno }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-yellow-500">
                <p class="text-sm text-gray-500 font-medium">Total en Estado Regular</p>
                <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $cantRegular }}</h3>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md border-l-4 border-red-500">
                <p class="text-sm text-gray-500 font-medium">Total en Mal Estado</p>
                <h3 class="text-3xl font-bold text-red-600 mt-2">{{ $cantMalo }}</h3>
            </div>
        </div>

        <!-- Zona de Gráficos de Barras -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Gráfico 1: Estado General -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Condición General del Colegio</h2>
                <div class="w-full h-64">
                    <canvas id="graficoEstado"></canvas>
                </div>
            </div>

            <!-- Gráfico 2: Desglose Visual por Objeto (El que le gustará a la directora) -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold text-gray-700 mb-4 border-b pb-2">Estado Específico por Tipo de Objeto</h2>
                <div class="w-full h-64">
                    <canvas id="graficoObjetos"></canvas>
                </div>
            </div>

        </div>

        <!-- Tabla Completa Inferior (Desglose por Aula) -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Ubicación y Desglose por Aula</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b text-gray-600 uppercase text-sm">
                            <th class="p-3">Objeto / Mobiliario</th>
                            <th class="p-3 text-right">Cantidad Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($detalleAula as $aula => $objetos)
                            <tr class="bg-gray-200 border-b">
                                <td colspan="2" class="p-3 font-bold text-gray-800 uppercase">
                                    🏫 Aula: {{ $aula ?: 'Sin Asignar' }}
                                </td>
                            </tr>
                            @foreach($objetos as $obj)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="p-3 pl-8 text-gray-600 font-medium">↳ {{ $obj->objeto }}</td>
                                <td class="p-3 text-blue-600 font-bold text-right">{{ $obj->total }} unidades</td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="2" class="p-4 text-center text-gray-500">No hay datos suficientes para mostrar el desglose.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts de Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // --- GRÁFICO 1: BARRAS DE ESTADO GLOBAL ---
            const ctxEstado = document.getElementById('graficoEstado').getContext('2d');
            new Chart(ctxEstado, {
                type: 'bar',
                data: {
                    labels: ['Bueno', 'Regular', 'Malo'],
                    datasets: [{
                        label: 'Unidades Totales',
                        data: [{{ $cantBueno ?: 0 }}, {{ $cantRegular ?: 0 }}, {{ $cantMalo ?: 0 }}],
                        backgroundColor: ['#22c55e', '#eab308', '#ef4444'], // Verde, Amarillo, Rojo
                        borderRadius: 4
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
                }
            });

            // --- GRÁFICO 2: BARRAS APILADAS POR OBJETO (¡La Magia Visual!) ---
            const matriz = @json($matrizObjetos);
            
            // Extraemos los datos de la base de datos para armar el gráfico
            const labelsObjetos = matriz.map(item => item.objeto);
            const dataBuenas = matriz.map(item => parseInt(item.buenas));
            const dataRegulares = matriz.map(item => parseInt(item.regulares));
            const dataMalas = matriz.map(item => parseInt(item.malas));

            const ctxObjetos = document.getElementById('graficoObjetos').getContext('2d');
            new Chart(ctxObjetos, {
                type: 'bar',
                data: {
                    labels: labelsObjetos,
                    datasets: [
                        {
                            label: 'Buen Estado',
                            data: dataBuenas,
                            backgroundColor: '#22c55e', // Verde
                            borderRadius: { topLeft: 0, topRight: 0, bottomLeft: 4, bottomRight: 4 }
                        },
                        {
                            label: 'Regular',
                            data: dataRegulares,
                            backgroundColor: '#eab308' // Amarillo
                        },
                        {
                            label: 'Mal Estado',
                            data: dataMalas,
                            backgroundColor: '#ef4444', // Rojo
                            borderRadius: { topLeft: 4, topRight: 4, bottomLeft: 0, bottomRight: 0 }
                        }
                    ]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: true, position: 'top' }, // Mostramos leyenda para que la directora la entienda
                        tooltip: { mode: 'index', intersect: false } // Al pasar el mouse, muestra el resumen de ese objeto
                    },
                    scales: { 
                        x: { stacked: true }, // Apila las barras en el eje X
                        y: { stacked: true, beginAtZero: true, ticks: { stepSize: 1 } } // Apila en el eje Y
                    }
                }
            });
        });
    </script>
</body>
</html>