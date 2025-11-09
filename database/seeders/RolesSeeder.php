<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 🚀 Define roles for your GRC platform
        $roles = [
            'Admin',
            'Manager',
            'Auditor',
            'User',
        ];

        // 🧠 Optional: Define some permissions for demonstration
        $permissions = [
            'view risks',
            'create risks',
            'edit risks',
            'delete risks',
            'view controls',
            'manage users',
            'view reports',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create roles & assign sample permissions
        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);

            switch ($roleName) {
                case 'Admin':
                    $role->givePermissionTo(Permission::all());
                    break;

                case 'Manager':
                    $role->givePermissionTo([
                        'view risks',
                        'create risks',
                        'edit risks',
                        'view reports',
                    ]);
                    break;

                case 'Auditor':
                    $role->givePermissionTo([
                        'view risks',
                        'view controls',
                        'view reports',
                    ]);
                    break;

                case 'User':
                    $role->givePermissionTo([
                        'view risks',
                        'view controls',
                    ]);
                    break;
            }
        }

        $this->command->info('✅ Roles & Permissions seeded successfully!');
    }
}
