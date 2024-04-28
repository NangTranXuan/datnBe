<?php

namespace Database\Seeders;

use App\Models\ClassroomStudent;
use Illuminate\Database\Seeder;

class ClassroomStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        ClassroomStudent::factory()->count(50)->create();
    }
}
