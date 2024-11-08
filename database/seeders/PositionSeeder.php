<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            ['name' => 'HR Manager', 'code' => 'HRM', 'department_id' => '1'],
            ['name' => 'Recruiter', 'code' => 'HRC', 'department_id' => '1'],
            ['name' => 'IT Manager', 'code' => 'ITM', 'department_id' => '2'],
            ['name' => 'Developer', 'code' => 'ITD', 'department_id' => '2'],
            ['name' => 'Marketing Manager', 'code' => 'MKTM', 'department_id' => '3'],
            ['name' => 'Content Creator', 'code' => 'MKTC', 'department_id' => '3'],
            ['name' => 'Sales Manager', 'code' => 'SLSS', 'department_id' => '4'],
            ['name' => 'Sales Representative', 'code' => 'SLSP', 'department_id' => '4'],
            ['name' => 'Finance Manager', 'code' => 'FINM', 'department_id' => '5'],
            ['name' => 'Accountant', 'code' => 'FINA', 'department_id' => '5'],
            ['name' => 'Operations Manager', 'code' => 'OPSM', 'department_id' => '6'],
            ['name' => 'Logistic Coordinator', 'code' => 'OPSL', 'department_id' => '6'],
            ['name' => 'Customer Service Manager', 'code' => 'CSM', 'department_id' => '7'],
            ['name' => 'Support Agent', 'code' => 'CSSA', 'department_id' => '7'],
            ['name' => 'R&D Manager', 'code' => 'RDNDM', 'department_id' => '8'],
            ['name' => 'Research Analyst', 'code' => 'RDA', 'department_id' => '8'],
        ];

        foreach ($positions as $position) {
            Position::create($position);
        }
    }
}
