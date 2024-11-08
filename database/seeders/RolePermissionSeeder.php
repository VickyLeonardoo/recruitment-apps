<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminRole = Role::create([
            'name' => 'superadmin',
        ]);

        $adminRole = Role::create([
            'name' => 'admin',
        ]);

        $staffManager = Role::create([
            'name' => 'manager',
        ]);

        $staffHr = Role::create([
            'name' => 'hr',
        ]);

        $applicant = Role::create([
            'name' => 'applicant'
        ]);

        //Super admin
        $userSuperAdmin = User::create([
            'name' => 'Superadmin',
            'email' => 'sadmin@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $user = User::create([
            'name' => 'Ordep',
            'email' => 'user@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userSuperAdmin->assignRole($superAdminRole);
        $user->assignRole($applicant);
    }
}
