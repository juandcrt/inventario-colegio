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
        // 1. Crear Cuentas de Usuario Institucionales con Roles y Permisos
        User::updateOrCreate(
            ['email' => 'admin@tungasuca.edu.pe'],
            [
                'name' => 'Administrador I.E. Tungasuca',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'permissions' => json_encode(['inventory', 'library', 'tic']),
                'theme' => 'light'
            ]
        );

        User::updateOrCreate(
            ['email' => 'soporte@tungasuca.edu.pe'],
            [
                'name' => 'Soporte Técnico',
                'password' => Hash::make('soporte2026'),
                'role' => 'directiva',
                'permissions' => json_encode(['inventory', 'library', 'tic']),
                'theme' => 'light'
            ]
        );

        User::updateOrCreate(
            ['email' => 'biblioteca@tungasuca.edu.pe'],
            [
                'name' => 'Encargado de Biblioteca',
                'password' => Hash::make('12345678'),
                'role' => 'bibliotecario',
                'permissions' => json_encode(['library']),
                'theme' => 'light'
            ]
        );

        User::updateOrCreate(
            ['email' => 'tic@tungasuca.edu.pe'],
            [
                'name' => 'Encargado de Equipos TIC',
                'password' => Hash::make('12345678'),
                'role' => 'tic',
                'permissions' => json_encode(['tic']),
                'theme' => 'light'
            ]
        );

        // 2. Crear los Grados
        $g1 = Grade::create(['name' => 'Primer Grado']);
        $g2 = Grade::create(['name' => 'Segundo Grado']);
        $g3 = Grade::create(['name' => 'Tercer Grado']);
        $g4 = Grade::create(['name' => 'Cuarto Grado']);
        $g5 = Grade::create(['name' => 'Quinto Grado']);
        $gTic = Grade::create(['name' => 'Aulas de Innovación y TIC']);

        // 3. Crear las Secciones asociadas a cada Grado (Llaves Foráneas)
        $g1->classrooms()->createMany([['name' => '1A'], ['name' => '1B'], ['name' => '1C'], ['name' => '1D'], ['name' => '1E']]);
        $g2->classrooms()->createMany([['name' => '2A'], ['name' => '2B'], ['name' => '2C'], ['name' => '2D'], ['name' => '2E']]);
        $g3->classrooms()->createMany([['name' => '3A'], ['name' => '3B'], ['name' => '3C'], ['name' => '3D']]);
        $g4->classrooms()->createMany([['name' => '4A'], ['name' => '4B'], ['name' => '4C'], ['name' => '4D']]);
        $g5->classrooms()->createMany([['name' => '5A'], ['name' => '5B'], ['name' => '5C'], ['name' => '5D']]);
        $gTic->classrooms()->createMany([
            ['name' => 'TIC EPT'],
            ['name' => 'TIC INGLES'],
            ['name' => 'Aula innovación IPE'],
            ['name' => 'TIC COMUNICACIÓN'],
            ['name' => 'TIC MATEMÁTICA'],
            ['name' => 'TIC CIENCIAS SOCIALES']
        ]);
    }
}