<?php

namespace Database\Seeders;

use App\Models\ClassroomSession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomSessionSeeder extends Seeder
{
    public function run()
    {
        ClassroomSession::factory()->count(50)->create();
    }
}
