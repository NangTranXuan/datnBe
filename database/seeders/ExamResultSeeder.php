<?php

namespace Database\Seeders;

use App\Models\ExamResult;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExamResultSeeder extends Seeder
{
    public function run()
    {
        ExamResult::factory()->count(50)->create();
    }
}
