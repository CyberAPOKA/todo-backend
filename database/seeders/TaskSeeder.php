<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Task;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 1000; $i++) {
            Task::create([
                'title' => 'Tarefa ' . $i + 1,
                'description' => $faker->sentence(),
                'date' => now()->addDays($i),
                'status' => $faker->randomElement(['pending', 'in_progress', 'completed']),
            ]);
        }
    }
}
