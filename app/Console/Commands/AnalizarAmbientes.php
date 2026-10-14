<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AnalizarAmbientes extends Command
{
    protected $signature = 'inventario:analizar {archivo=database/seeders/data/inventario.csv}';
    protected $description = 'Analiza los ambientes únicos del CSV de inventario';

    public function handle()
    {
        $path = base_path($this->argument('archivo'));

        if (!file_exists($path)) {
            $this->error("No existe: $path");
            return 1;
        }

        $handle = fopen($path, 'r');
        fgetcsv($handle); // saltar encabezados

        $ambientes = [];
        $total = 0;

        while (($row = fgetcsv($handle)) !== false) {
            $ambiente = strtoupper(trim($row[4] ?? ''));
            if (empty($ambiente)) continue;

            $ambientes[$ambiente] = ($ambientes[$ambiente] ?? 0) + 1;
            $total++;
        }
        fclose($handle);

        arsort($ambientes); // ordenar por cantidad

        $this->info("📊 Total de filas: $total");
        $this->info("📋 Ambientes únicos: " . count($ambientes));
        $this->newLine();

        $this->table(
            ['Ambiente', 'Registros', 'Clasificación Sugerida'],
            collect($ambientes)->map(function ($count, $name) {
                return [$name, $count, $this->clasificar($name)];
            })->values()->toArray()
        );

        // Guardar resumen en un archivo para referencia
        $resumen = "# Ambientes detectados\n\n";
        foreach ($ambientes as $name => $count) {
            $resumen .= sprintf("%-50s | %5d | %s\n", $name, $count, $this->clasificar($name));
        }
        file_put_contents(storage_path('app/ambientes.txt'), $resumen);
        $this->info("💾 Resumen guardado en storage/app/ambientes.txt");

        return 0;
    }

    private function clasificar(string $ambiente): string
    {
        $a = strtoupper($ambiente);

        if (str_contains($a, 'BIBLIOTECA')) return '📚 BIBLIOTECA';
        if (preg_match('/\b(AIP|TIC)\b/', $a)) return '💻 AIP';
        if (str_contains($a, 'INNOVACION') || str_contains($a, 'INNOVACIÓN')) return '💻 AIP';
        if (str_contains($a, 'COMPUTO') || str_contains($a, 'CÓMPUTO')) return '💻 AIP';
        if (str_contains($a, 'INGLES') || str_contains($a, 'INGLÉS')) return '💻 AIP';
        if (str_contains($a, 'LABORATORIO')) return '🔬 AULA ESPECIAL';
        if (str_contains($a, 'ALMACEN') || str_contains($a, 'ALMACÉN')) return '📦 DEPÓSITO';
        if (str_contains($a, 'DEPOSITO') || str_contains($a, 'DEPÓSITO')) return '📦 DEPÓSITO';
        if (str_contains($a, 'PATIO')) return '🏫 PATIO';
        if (str_contains($a, 'DIRECCION') || str_contains($a, 'DIRECCIÓN')) return '🏢 OFICINA';
        if (str_contains($a, 'SECRETARIA')) return '🏢 OFICINA';
        if (str_contains($a, 'SUB')) return '🏢 OFICINA';
        if (str_contains($a, 'PSICOLOGIA')) return '🏢 OFICINA';
        if (str_contains($a, 'TUTORIA')) return '🏢 OFICINA';
        if (str_contains($a, 'COORDINACION')) return '🏢 OFICINA';
        if (str_contains($a, 'PROFESORES')) return '🏢 OFICINA';
        if (str_contains($a, 'TOE')) return '🏢 OFICINA';
        if (str_contains($a, 'CIENCIAS')) return '🏫 AULA';
        if (str_contains($a, 'COMUNICACION') || str_contains($a, 'COMUNICACIÓN')) return '🏫 AULA';
        if (str_contains($a, 'MATEMATICA') || str_contains($a, 'MATEMÁTICA')) return '🏫 AULA';
        if (str_contains($a, 'EPT')) return '🏫 AULA';
        if (str_contains($a, 'TALLER')) return '🏫 AULA';
        if (str_contains($a, 'TUTORIA') || str_contains($a, 'TUTORÍA')) return '🏫 AULA';
        if (preg_match('/\bAULA\s+\d+/', $a)) return '🏫 AULA';
        if (preg_match('/\d+[°º]\s*[A-Z]/', $a)) return '🏫 AULA';
        return '❓ POR DEFINIR';
    }
}