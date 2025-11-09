<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Create the "Admin" role if it doesn’t exist
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);

        // Create the admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@grc.com'],
            [
                'name' => 'System Administrator',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );

        // Assign role
        $admin->assignRole($adminRole);

        $this->command->info('✅ Admin user created: admin@grc.com / Admin@12345');
    }
}
