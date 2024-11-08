<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['code' => 'HR', 'name' => 'Human Resources'],
            ['code' => 'IT', 'name' => 'Information Technology'],
            ['code' => 'MKT', 'name' => 'Marketing'],
            ['code' => 'SLS', 'name' => 'Sales'],
            ['code' => 'FIN', 'name' => 'Finance'],
            ['code' => 'OPS', 'name' => 'Operations'],
            ['code' => 'CS', 'name' => 'Customer Service'],
            ['code' => 'RD', 'name' => 'Research and Development'],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
