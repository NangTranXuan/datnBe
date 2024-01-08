<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            RoomSeeder::class,
            ClassroomSeeder::class,
            ExamSeeder::class,
            AttendanceSeeder::class,
            NotificationSeeder::class,
            ClassroomStudentSeeder::class,
            ExamResultSeeder::class,
            ClassroomRoomSeeder::class,
            LessonSeeder::class,
            HomeworkSeeder::class,
        ]);
    }
}
