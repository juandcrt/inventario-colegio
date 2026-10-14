<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryItem;
use App\Models\LibraryItem;
use App\Models\AipItem;
use App\Models\Classroom;
use App\Models\Grade;

class InventarioSeeder extends Seeder
{
    /**
     * Mapa de normalización de nombres de ambientes
     * Unifica todas las variantes a un solo nombre canónico.
     */
    private array $mapaAmbientes = [
        // ---- AULAS 1° ----
        'AULA 1° A'         => '1° A',
        'AULA 1RO "A"'      => '1° A',
        'AULA 1° GRADO A'   => '1° A',
        'AULA 1° B'         => '1° B',
        'AULA 1RO "B"'      => '1° B',
        'AULA 1° C'         => '1° C',
        'AULA 1RO "C"'      => '1° C',
        'AULA 1° GRADO C'   => '1° C',
        'AULA 1° D'         => '1° D',
        'AULA 1RO "D"'      => '1° D',
        'AULA 1° GRADO D'   => '1° D',
        'AULA 1° E'         => '1° E',
        'AULA 1RO "E"'      => '1° E',

        // ---- AULAS 2° ----
        'AULA 2° A'         => '2° A',
        'AULA 2DO "A"'      => '2° A',
        'AULA 2° B'         => '2° B',
        'AULA 2DO "B"'      => '2° B',
        'AULA 2° C'         => '2° C',
        'AULA 2DO "C"'      => '2° C',
        'AULA 2° D'         => '2° D',
        'AULA 2DO "D"'      => '2° D',
        'AULA 2° E'         => '2° E',
        'AULA 2DO "E"'      => '2° E',

        // ---- AULAS 3° ----
        'AULA 3° A'         => '3° A',
        'AULA 3RO "A"'      => '3° A',
        'AULA 3° B'         => '3° B',
        'AULA 3RO "B"'      => '3° B',
        'AULA 3° C'         => '3° C',
        'AULA 3RO "C"'      => '3° C',
        'AULA 3° D'         => '3° D',
        'AULA 3RO "D"'      => '3° D',

        // ---- AULAS 4° ----
        'AULA 4° A'         => '4° A',
        'AULA 4TO "A"'      => '4° A',
        'AULA 4° B'         => '4° B',
        'AULA 4TO "B"'      => '4° B',
        'AULA 4° C'         => '4° C',
        'AULA 4TO "C"'      => '4° C',
        'AULA 4° D'         => '4° D',
        'AULA 4TO "D"'      => '4° D',

        // ---- AULAS 5° ----
        'AULA 5° A'         => '5° A',
        'AULA 5TO "A"'      => '5° A',
        'AULA 5° GRADO A'   => '5° A',
        'AULA 5° B'         => '5° B',
        'AULA 5TO "B"'      => '5° B',
        'AULA 5° C'         => '5° C',
        'AULA 5TO "C"'      => '5° C',
        'AULA 5° D'         => '5° D',
        'AULA 5TO "D"'      => '5° D',

        // ---- EXTERIORES Y AUDITORIO → Almacén ----
        'EXTERIORES'        => 'ALMACÉN',
        'AUDITORIO'         => 'ALMACÉN',
        'ALMACEN DE EQUIPOS'=> 'ALMACÉN',
    ];

    /**
     * Ambientes que van a AIP (tecnológicos).
     */
    private array $ambientesAIP = [
        'AIP',
        'AULA DE INGLES',
        'AULA DE INNOVACIÓN PEDAGOGICA',
        'AULA DE INNOVACION',
        'AULA TIC-MATEMATICA',
        'AULA TIC-EPT',
        'AULA TIC-INGLES',
        'AULA DE COMPUTO',
    ];

    public function run(): void
    {
        $csvPath = database_path('seeders/data/inventario.csv');

        if (!file_exists($csvPath)) {
            $this->command->error("No se encontró: $csvPath");
            return;
        }

        $handle = fopen($csvPath, 'r');
        fgetcsv($handle); // Saltar encabezados

        $contador = ['mobiliario' => 0, 'biblioteca' => 0, 'aip' => 0, 'ignorados' => 0];
        $classroomsCache = [];

        // Pre-cargar aulas existentes
        foreach (Classroom::all() as $c) {
            $classroomsCache[strtoupper($c->name)] = $c->id;
        }

        // Crear grados y aulas base si no existen
        $this->crearAulasBase($classroomsCache);

        while (($row = fgetcsv($handle)) !== false) {
            // Índices de columnas del CSV (ajusta si tu CSV tiene otro orden)
            $ambiente    = strtoupper(trim($row[4] ?? ''));  // AMBIENTE
            $descripcion = trim($row[6] ?? '');               // DESCRIPCIÓN
            $marca       = trim($row[8] ?? '');               // MARCA
            $modelo      = trim($row[9] ?? '');               // MODELO
            $serie       = trim($row[11] ?? '');              // SERIE
            $estado      = trim($row[15] ?? '');              // ESTADO

            if (empty($ambiente) || empty($descripcion)) {
                $contador['ignorados']++;
                continue;
            }

            // Aplicar mapa de normalización
            $ambienteNormalizado = $this->mapaAmbientes[$ambiente] ?? $ambiente;

            // ========== BIBLIOTECA ==========
            if (str_contains($ambienteNormalizado, 'BIBLIOTECA')) {
                LibraryItem::create([
                    'title'         => $descripcion,
                    'author'        => $marca ?: 'Sin autor',
                    'isbn'          => $serie ?: null,
                    'quantity'      => 1,
                    'status'        => $this->normalizarEstado($estado),
                    'observaciones' => 'Importado desde Excel',
                ]);
                $contador['biblioteca']++;
                continue;
            }

            // ========== AIP / TIC ==========
            if (in_array($ambienteNormalizado, $this->ambientesAIP)) {
                AipItem::create([
                    'equipment_name' => $descripcion,
                    'location'       => $ambienteNormalizado,
                    'serial_number'  => $serie ?: null,
                    'brand'          => $marca ?: 'S/MARCA',
                    'model'          => $modelo ?: 'S/MODELO',
                    'specs'          => trim("Marca: {$marca} | Modelo: {$modelo}", ' |'),
                    'status'         => $this->normalizarEstado($estado),
                ]);
                $contador['aip']++;
                continue;
            }

            // ========== MOBILIARIO (todo lo demás) ==========
           $classroomId = $classroomsCache[$ambienteNormalizado] ?? null;

if (!$classroomId) {
    // Crear aula si no existe (firstOrCreate evita duplicados)
    $classroom = Classroom::firstOrCreate(
        ['name' => $ambienteNormalizado],
        ['grade_id' => null]
    );
    $classroomId = $classroom->id;
    $classroomsCache[$ambienteNormalizado] = $classroomId;
}

            InventoryItem::create([
                'classroom_id' => $classroomId,
                'objeto'       => $descripcion,
                'cantidad'     => 1,
                'condicion'    => $this->normalizarEstado($estado),
                'category'     => 'Mobiliario',
            ]);
            $contador['mobiliario']++;
        }

        fclose($handle);

        $this->command->info("✅ Importación completa:");
        $this->command->info("   📦 Mobiliario: {$contador['mobiliario']}");
        $this->command->info("   📚 Biblioteca: {$contador['biblioteca']}");
        $this->command->info("   💻 AIP/TIC: {$contador['aip']}");
        $this->command->info("   ⏭️  Ignorados: {$contador['ignorados']}");
    }

    /**
     * Crea las 5 secciones de secundaria y sus aulas.
     */
    private function crearAulasBase(array &$cache): void
    {
        // Crear grados si no existen
        $grados = [
            '1° Secundaria', '2° Secundaria', '3° Secundaria',
            '4° Secundaria', '5° Secundaria',
        ];

        $gradosIds = [];
        foreach ($grados as $nombre) {
            $g = Grade::firstOrCreate(['name' => $nombre]);
            $gradosIds[$nombre] = $g->id;
        }

        // Secciones por grado
        $seccionesPorGrado = [
            '1° Secundaria' => ['A', 'B', 'C', 'D', 'E'],
            '2° Secundaria' => ['A', 'B', 'C', 'D', 'E'],
            '3° Secundaria' => ['A', 'B', 'C', 'D'],
            '4° Secundaria' => ['A', 'B', 'C', 'D'],
            '5° Secundaria' => ['A', 'B', 'C', 'D'],
        ];

        foreach ($seccionesPorGrado as $gradoNombre => $secciones) {
            $numero = explode('°', $gradoNombre)[0]; // "1", "2", etc.
            foreach ($secciones as $sec) {
                $nombreAula = "{$numero}° {$sec}";

                // Si ya existe, guardarlo en cache
                $aula = Classroom::firstOrCreate(
                    ['name' => strtoupper($nombreAula)],
                    ['grade_id' => $gradosIds[$gradoNombre]]
                );

                $cache[strtoupper($nombreAula)] = $aula->id;
            }
        }
    }

    /**
     * Normaliza los estados a valores estándar.
     */
    private function normalizarEstado(string $estado): string
    {
        $e = strtoupper(trim($estado));

        return match(true) {
            str_contains($e, 'BUENO')         => 'Bueno',
            str_contains($e, 'REGULAR')       => 'Regular',
            str_contains($e, 'MALO')          => 'Malo',
            str_contains($e, 'OPERATIVO')     => 'Operativo',
            str_contains($e, 'MANTENIMIENTO') => 'Mantenimiento',
            str_contains($e, 'AVERIADO')      => 'Averiado',
            default                           => 'Regular',
        };
    }
}