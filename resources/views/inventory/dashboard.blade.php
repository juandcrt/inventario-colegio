<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Control - Inventario I.E. Tungasuca</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Plugin para mostrar los números fijos encima de las barras -->
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
</head>
<body class="bg-slate-100 min-h-screen p-6 font-sans">
    <div class="max-w-7xl mx-auto">
        
        <!-- Encabezado Institucional -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 bg-white p-6 rounded-xl shadow-sm border border-slate-200 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">🏫 Sistema de Inventario Escolar</h1>
                <p class="text-slate-500 text-sm">I.E. Tungasuca - Panel de Control y Estadísticas Generales</p>
            </div>

            <div class="flex items-center gap-3 w-full md:w-auto">
                <!-- Selector de Aula Profesional -->
                <form method="GET" action="{{ route('inventory.dashboard') }}" class="flex items-center gap-2">
                    <select name="classroom_id" onchange="this.form.submit()" class="px-3 py-2 border border-slate-300 rounded-lg text-sm bg-white font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-blue-600 shadow-sm">
                        <option value="">📊 Vista General (Todo el Colegio)</option>
                        @foreach($classroomsList as $room)
                            <option value="{{ $room->id }}" {{ request('classroom_id') == $room->id ? 'selected' : '' }}>
                                Aula: {{ $room->name }}
                            </option>
                        @endforeach
                    </select>
                </form>

                <a href="{{ route('inventory.index') }}" class="bg-slate-800 text-white px-4 py-2 rounded-lg hover:bg-slate-900 transition font-medium shadow-sm text-sm whitespace-nowrap">
                    ⬅️ Volver al Registro
                </a>
            </div>
        </div>

        <!-- Tarjetas de Métricas Ejecutivas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 border-l-4 border-l-blue-600">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Total de Recursos</p>
                <h3 class="text-3xl font-extrabold text-slate-800 mt-2">{{ $totalCantidad }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 border-l-4 border-l-emerald-600">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Buen Estado</p>
                <h3 class="text-3xl font-extrabold text-emerald-600 mt-2">{{ $cantBueno }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 border-l-4 border-l-amber-500">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Estado Regular</p>
                <h3 class="text-3xl font-extrabold text-amber-500 mt-2">{{ $cantRegular }}</h3>
            </div>
            <div class="bg-white p-5 rounded-xl shadow-sm border border-slate-200 border-l-4 border-l-rose-600">
                <p class="text-xs text-slate-500 font-bold uppercase tracking-wider">Mal Estado</p>
                <h3 class="text-3xl font-extrabold text-rose-600 mt-2">{{ $cantMalo }}</h3>
            </div>
        </div>

        <!-- Zona de Gráficos Profesionales -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            
            <!-- Gráfico 1: Estado Detallado por Objeto (Muestra claramente qué objeto está bueno, regular o malo) -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col justify-between">
                <h2 class="text-base font-bold text-slate-700 mb-4 border-b pb-2">Estado por Cada Objeto y Condición</h2>
                <div class="w-full h-80">
                    <canvas id="graficoEstadoObjetos"></canvas>
                </div>
            </div>

            <!-- Gráfico 2: Inventario Total por Objeto -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex flex-col justify-between">
                <h2 class="text-base font-bold text-slate-700 mb-4 border-b pb-2">Inventario Total por Objeto</h2>
                <div class="w-full h-80">
                    <canvas id="graficoObjetos"></canvas>
                </div>
            </div>

        </div>

        <!-- Tabla de Desglose Profesional -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h2 class="text-base font-bold text-slate-700 mb-4 border-b pb-2">Detalle Estructural por Aula</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-600 uppercase text-xs tracking-wider border-b">
                            <th class="p-3">Objeto / Mobiliario</th>
                            <th class="p-3 text-right">Cantidad Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($detalleAula as $aula => $objetos)
                            <tr class="bg-slate-100/70">
                                <td colspan="2" class="p-3 font-bold text-slate-800 uppercase">
                                    🏫 Aula: {{ $aula ?: 'Sin Asignar' }}
                                </td>
                            </tr>
                            @foreach($objetos as $obj)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="p-3 pl-8 text-slate-600 font-medium">↳ {{ $obj->objeto }}</td>
                                <td class="p-3 text-slate-800 font-bold text-right">{{ $obj->total }} unidades</td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="2" class="p-4 text-center text-slate-400">No hay registros disponibles para esta selección.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Scripts de Configuración de Chart.js -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            
            // Registramos el plugin de datalabels para mostrar los valores exactos arriba de cada barra
            Chart.register(ChartDataLabels);

            const matriz = @json($matrizObjetos);
            const labelsObjetos = matriz.map(item => item.objeto);
            const dataBuenas = matriz.map(item => parseInt(item.buenas));
            const dataRegulares = matriz.map(item => parseInt(item.regulares));
            const dataMalas = matriz.map(item => parseInt(item.malas));
            const totalesObjetos = matriz.map(item => parseInt(item.total));

            // --- GRÁFICO 1: ESTADO POR CADA OBJETO (BARRAS AGRUPADAS) ---
            const ctxEstado = document.getElementById('graficoEstadoObjetos').getContext('2d');
            new Chart(ctxEstado, {
                type: 'bar',
                data: {
                    labels: labelsObjetos,
                    datasets: [
                        {
                            label: 'Buen Estado',
                            data: dataBuenas,
                            backgroundColor: '#059669', // Verde
                            borderRadius: 4
                        },
                        {
                            label: 'Regular',
                            data: dataRegulares,
                            backgroundColor: '#d97706', // Amarillo/Ámbar
                            borderRadius: 4
                        },
                        {
                            label: 'Mal Estado',
                            data: dataMalas,
                            backgroundColor: '#e11d48', // Rojo
                            borderRadius: 4
                        }
                    ]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: true, position: 'top' },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#334155',
                            font: {
                                weight: 'bold',
                                size: 11
                            },
                            formatter: function(value) {
                                return value > 0 ? value : ''; // Muestra el número exacto solo si hay unidades
                            }
                        }
                    },
                    scales: { 
                        x: { grid: { display: false }, ticks: { font: { weight: '600' } } },
                        y: { beginAtZero: true, ticks: { stepSize: 2 } } 
                    }
                }
            });

            // --- GRÁFICO 2: TOTAL POR OBJETO ---
            const ctxObjetos = document.getElementById('graficoObjetos').getContext('2d');
            new Chart(ctxObjetos, {
                type: 'bar',
                data: {
                    labels: labelsObjetos,
                    datasets: [{
                        label: 'Total de Unidades',
                        data: totalesObjetos,
                        backgroundColor: '#2563eb', // Azul corporativo
                        borderRadius: 4,
                        barThickness: 40
                    }]
                },
                options: { 
                    responsive: true, 
                    maintainAspectRatio: false,
                    plugins: { 
                        legend: { display: false },
                        datalabels: {
                            anchor: 'end',
                            align: 'top',
                            color: '#334155',
                            font: {
                                weight: 'bold',
                                size: 13
                            }
                        }
                    },
                    scales: { 
                        x: { grid: { display: false }, ticks: { font: { weight: '600' } } },
                        y: { beginAtZero: true, ticks: { stepSize: 2 } }
                    }
                }
            });
        });
    </script>
</body>
</html>