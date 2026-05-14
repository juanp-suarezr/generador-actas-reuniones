<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear permisos
        $permissions = [
            'view actas',
            'create actas',
            'edit actas',
            'delete actas',
            'share actas',
            'download actas',
            'manage users',
            'manage roles',
            'manage secretarias',
            'manage comunas',
            'manage cargos',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles
        $adminRole = Role::create(['name' => 'admin']);
        $userRole = Role::create(['name' => 'user']);

        // Asignar permisos a roles
        $adminRole->syncPermissions($permissions);

        $userRole->syncPermissions([
            'view actas',
            'create actas',
            'edit actas',
            'share actas',
            'download actas',
        ]);

        // Crear usuario admin de ejemplo
        $admin = \App\Models\User::where('cedula', '123456789')->first();
        if ($admin) {
            $admin->assignRole('admin');
        }
    }
}
