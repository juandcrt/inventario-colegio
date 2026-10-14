<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administrador General
        User::create([
            'name' => 'Administrador General',
            'dni' => '40000001',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'permissions' => json_encode(['inventory', 'library', 'tic'])
        ]);

        // Encargado de Biblioteca
        User::create([
            'name' => 'Prof. Bibliotecario',
            'dni' => '40000002',
            'password' => Hash::make('12345678'),
            'role' => 'bibliotecario',
            'permissions' => json_encode(['library'])
        ]);

        // Encargado TIC
        User::create([
            'name' => 'Prof. Soporte TIC',
            'dni' => '40000003',
            'password' => Hash::make('12345678'),
            'role' => 'tic',
            'permissions' => json_encode(['tic'])
        ]);
    }
}