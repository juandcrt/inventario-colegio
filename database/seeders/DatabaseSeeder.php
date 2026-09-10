<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Classroom;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Crear los Grados
        $g1 = Grade::create(['name' => 'Primer Grado']);
        $g2 = Grade::create(['name' => 'Segundo Grado']);
        $g3 = Grade::create(['name' => 'Tercer Grado']);
        $g4 = Grade::create(['name' => 'Cuarto Grado']);
        $g5 = Grade::create(['name' => 'Quinto Grado']);
        $gTic = Grade::create(['name' => 'Aulas de Innovación y TIC']);

        // 2. Crear las Secciones asociadas a cada Grado (Llaves Foráneas)
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