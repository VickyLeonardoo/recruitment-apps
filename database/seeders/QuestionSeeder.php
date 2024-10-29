<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Generate 50 questions, 40 with Faker
        for ($i = 0; $i < 50; $i++) {
            DB::table('questions')->insert([
                'description' => $faker->sentence(10), // Generate random sentence
                'image' => null, // Nullable image
                'difficult' => $faker->randomElement(['easy', 'medium', 'hard']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
