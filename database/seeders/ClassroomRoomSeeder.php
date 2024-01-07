<?php

namespace Database\Seeders;

use App\Models\ClassroomRoom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassroomRoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClassroomRoom::factory()->count(50)->create();
    }
}
