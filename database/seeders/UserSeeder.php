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
            'email' => 'admin@tungasuca.edu.pe',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'permissions' => json_encode(['inventory', 'library', 'tic']),
            'theme' => 'light'
        ]);

        // Encargado de Biblioteca
        User::create([
            'name' => 'Prof. Bibliotecario',
            'email' => 'biblioteca@tungasuca.edu.pe',
            'password' => Hash::make('12345678'),
            'role' => 'bibliotecario',
            'permissions' => json_encode(['library']),
            'theme' => 'light'
        ]);

        // Encargado TIC
        User::create([
            'name' => 'Prof. Soporte TIC',
            'email' => 'tic@tungasuca.edu.pe',
            'password' => Hash::make('12345678'),
            'role' => 'tic',
            'permissions' => json_encode(['tic']),
            'theme' => 'light'
        ]);
    }
}