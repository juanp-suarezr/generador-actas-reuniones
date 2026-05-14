<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Spatie\Permission\Models\Role;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario admin
        $admin = User::firstOrCreate(
            ['cedula' => '123456789'],
            [
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'estado' => 'activo',
            ]
        );

        // Asignar rol admin
        $admin->assignRole('admin');

        // Crear usuarios de ejemplo con rol user
        $users = [
            [
                'name' => 'Usuario 1',
                'email' => 'user1@example.com',
                'cedula' => '111111111',
                'password' => Hash::make('password'),
                'estado' => 'activo',
            ],
            [
                'name' => 'Usuario 2',
                'email' => 'user2@example.com',
                'cedula' => '222222222',
                'password' => Hash::make('password'),
                'estado' => 'activo',
            ],
            [
                'name' => 'Usuario 3',
                'email' => 'user3@example.com',
                'cedula' => '333333333',
                'password' => Hash::make('password'),
                'estado' => 'activo',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['cedula' => $userData['cedula']],
                $userData
            );
            $user->assignRole('user');
        }
    }
}