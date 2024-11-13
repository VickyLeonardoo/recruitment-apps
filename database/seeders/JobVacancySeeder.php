<?php

namespace Database\Seeders;

use App\Models\JobVacancy;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JobVacancySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobVacancies = [
            [
                'code' => 'JV001',
                'title' => 'HR Manager',
                'description' => 'Responsible for managing HR activities and strategies.',
                'position_id' => 1, // Sesuaikan dengan ID posisi HR Manager
                'requirements' => '5+ years of experience in HR.',
                'responsibilities' => 'Bachelor\'s degree in Human Resources or related field.',
                'type' => 'Full Time',
                'start_date' => '2024-11-01',
                'end_date' => '2024-12-01',
                'min_salary' => 8000000,
                'max_salary' => 12000000,
                'status' => 'Active',
                'is_archive' => false,
                'max_pax' => 1,
            ],
            [
                'code' => 'JV002',
                'title' => 'IT Manager',
                'description' => 'Oversee IT department and manage technology infrastructure.',
                'position_id' => 3, // Sesuaikan dengan ID posisi IT Manager
                'requirements' => '3+ years of experience in IT management.',
                'responsibilities' => 'Bachelor\'s degree in Information Technology.',
                'type' => 'Full Time',
                'start_date' => '2024-11-01',
                'end_date' => '2024-12-15',
                'min_salary' => 10000000,
                'max_salary' => 15000000,
                'status' => 'Active',
                'is_archive' => false,
                'max_pax' => 1,
            ],
            [
                'code' => 'JV003',
                'title' => 'Marketing Manager',
                'description' => 'Lead marketing campaigns and strategies.',
                'position_id' => 5, // Sesuaikan dengan ID posisi Marketing Manager
                'requirements' => '4+ years of experience in marketing.',
                'responsibilities' => 'Bachelor\'s degree in Marketing or related field.',
                'type' => 'Full Time',
                'start_date' => '2024-11-15',
                'end_date' => '2024-12-15',
                'min_salary' => 9000000,
                'max_salary' => 13000000,
                'status' => 'Active',
                'is_archive' => false,
                'max_pax' => 1,
            ],
            [
                'code' => 'JV004',
                'title' => 'Sales Representative',
                'description' => 'Manage sales activities and build client relationships.',
                'position_id' => 7, // Sesuaikan dengan ID posisi Sales Representative
                'requirements' => '2+ years of experience in sales.',
                'responsibilities' => 'Bachelor\'s degree in Business or related field.',
                'type' => 'Full Time',
                'start_date' => '2024-12-01',
                'end_date' => '2025-01-01',
                'min_salary' => 6000000,
                'max_salary' => 9000000,
                'status' => 'Active',
                'is_archive' => false,
                'max_pax' => 2,
            ],
            [
                'code' => 'JV005',
                'title' => 'Finance Manager',
                'description' => 'Manage financial reporting and budgeting.',
                'position_id' => 9, // Sesuaikan dengan ID posisi Finance Manager
                'requirements' => '5+ years of experience in finance.',
                'responsibilities' => 'Bachelor\'s degree in Finance or Accounting.',
                'type' => 'Full Time',
                'start_date' => '2024-11-20',
                'end_date' => '2024-12-20',
                'min_salary' => 9500000,
                'max_salary' => 14000000,
                'status' => 'Active',
                'is_archive' => false,
                'max_pax' => 1,
            ],
        ];

        foreach ($jobVacancies as $jobVacancy) {
            JobVacancy::create($jobVacancy);
        }
    }
}
