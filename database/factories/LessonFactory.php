<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween();
        $classIds  = Classroom::get()->pluck('id')->toArray();
        return [
            'classroom_id' => $this->faker->randomElement($classIds),
            'lesson_name' => $this->faker->words(3, true),
            'start_time' => $date,
            'end_time' =>  $this->faker->dateTimeBetween($date, '+2 hour'),
        ];
    }
}
