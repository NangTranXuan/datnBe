<?php

namespace Database\Factories;

use App\Models\Classroom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ExamFactory extends Factory
{
    public function definition()
    {
        $date = $this->faker->dateTimeBetween();
        $classIds  = Classroom::get()->pluck('id')->toArray();
        return [
            'classroom_id' => $this->faker->randomElement($classIds),
            'exam_name' => $this->faker->words(3, true),
            'start_time' => $date,
            'end_time' =>  $this->faker->dateTimeBetween($date, '+1 hour'),
        ];
    }
}
