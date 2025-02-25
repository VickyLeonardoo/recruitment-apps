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

        $userAdminRole = User::create([
            'name' => 'Christian',
            'email' => 'admin@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userStaffManager = User::create([
            'name' => 'Fedro',
            'email' => 'manager@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $userStaffHr = User::create([
            'name' => 'Leonardo',
            'email' => 'hr@example.com',
            'password' => bcrypt('123'),
            'email_verified_at' => '2021-01-01 00:00:00',
        ]);

        $user = User::create([
            'name' => 'Ordep',
            'email' => 'user1@example.com',
            'password' => bcrypt('123'),
            'identity_no' => '2171878887899002',
            'email_verified_at' => '2021-01-01 00:00:00',
            'address' => 'Bengkong Telaga Indah',
            'city' => 'Batam',
            'dob' => '2002-07-07',
            'phone' => '081278668899',
            'gender' => 'male',
            'status' => 'Single',
            'nationality' => 'Indonesia',
            'religion' => 'Islam',
        ]);

        $userSuperAdmin->assignRole($superAdminRole);
        $user->assignRole($applicant);
        $userAdminRole->assignRole($adminRole);
        $userStaffManager->assignRole($staffManager);
        $userStaffHr->assignRole($staffHr);
    }
}
