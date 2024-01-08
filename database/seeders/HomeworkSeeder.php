<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\Homework;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HomeworkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Homework::factory()->count(20)->create();
    }
}
