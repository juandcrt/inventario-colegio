<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ==========================================
        // 1. USUARIOS INSTITUCIONALES
        // ==========================================
        User::updateOrCreate(
            ['dni' => '40000001'],
            [
                'name' => 'Administrador I.E. Tungasuca',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'permissions' => json_encode(['inventory', 'library', 'tic'])
            ]
        );

        User::updateOrCreate(
            ['dni' => '40000002'],
            [
                'name' => 'Soporte Técnico',
                'password' => Hash::make('soporte2026'),
                'role' => 'directiva',
                'permissions' => json_encode(['inventory', 'library', 'tic'])
            ]
        );

        User::updateOrCreate(
            ['dni' => '40000003'],
            [
                'name' => 'Encargado de Biblioteca',
                'password' => Hash::make('12345678'),
                'role' => 'bibliotecario',
                'permissions' => json_encode(['library'])
            ]
        );

        User::updateOrCreate(
            ['dni' => '40000004'],
            [
                'name' => 'Encargado de Equipos TIC',
                'password' => Hash::make('12345678'),
                'role' => 'tic',
                'permissions' => json_encode(['tic'])
            ]
        );

        // ==========================================
        // 2. GRADOS
        // ==========================================
        $grados = [
            'Primer Grado', 'Segundo Grado', 'Tercer Grado',
            'Cuarto Grado', 'Quinto Grado',
            'Aulas de Innovación y TIC',
        ];

        $gradosIds = [];
        foreach ($grados as $nombre) {
            $g = Grade::firstOrCreate(['name' => $nombre]);
            $gradosIds[$nombre] = $g->id;
        }

        // ==========================================
        // 3. AULAS REGULARES (nombres normalizados del Excel)
        // ==========================================
        $aulasPorGrado = [
            'Primer Grado'  => ['1° A', '1° B', '1° C', '1° D', '1° E'],
            'Segundo Grado' => ['2° A', '2° B', '2° C', '2° D', '2° E'],
            'Tercer Grado'  => ['3° A', '3° B', '3° C', '3° D'],
            'Cuarto Grado'  => ['4° A', '4° B', '4° C', '4° D'],
            'Quinto Grado'  => ['5° A', '5° B', '5° C', '5° D'],
        ];

        foreach ($aulasPorGrado as $grado => $aulas) {
            foreach ($aulas as $aula) {
                Classroom::firstOrCreate(
                    ['name' => strtoupper($aula)],
                    ['grade_id' => $gradosIds[$grado]]
                );
            }
        }

        // ==========================================
        // 4. AULAS ESPECIALES (todas van al grado TIC o como libres)
        // ==========================================
        $aulasEspeciales = [
            // AIPs
            'AIP',
            'AULA DE INGLES',
            'AULA DE INNOVACIÓN PEDAGOGICA',
            'AULA DE INNOVACION',
            'AULA TIC-MATEMATICA',
            'AULA TIC-EPT',
            'AULA TIC-INGLES',
            'AULA DE COMPUTO',
            
            // Áreas académicas
            'AREA DE CIENCIAS SOCIALES',
            'AREA DE COMUNICACION',
            'EPT',
            'TALLER DE MATEMATICA',
            'LABORATORIO CTA',
            'LABORATORIO',
            
            // Oficinas
            'DIRECCIÓN',
            'SUBDIRECCION',
            'SECRETARIA',
            'SECRETARIA DE DIRECCION',
            'SALA DE PROFESORES',
            'SALA DE COORDINACION',
            'PSICOLOGIA',
            'TUTORIA',
            'AULA TOE',
            
            // Depósitos
            'ALMACÉN',
            'DEPOSITO',
            
            // Áreas comunes
            'PATIO',
            'PATIO CENTRAL',
            'PATIO GENERAL',
            'BIBLIOTECA',
        ];

        foreach ($aulasEspeciales as $nombre) {
            Classroom::firstOrCreate(
                ['name' => strtoupper($nombre)],
                ['grade_id' => $gradosIds['Aulas de Innovación y TIC']]
            );
        }

        // ==========================================
        // 5. EJECUTAR EL SEEDER DEL INVENTARIO
        // ==========================================
        $this->call([
            InventarioSeeder::class,
        ]);
    }
}