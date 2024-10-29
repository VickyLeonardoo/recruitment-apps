<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $lang = Language::create([
            'name' => 'English',
            'code' => 'ENG'
        ]);

        $lang = Language::create([
            'name' => 'Mandarin',
            'code' => 'MAN'
        ]);
    }
}
