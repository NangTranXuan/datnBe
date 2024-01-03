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
        $classIds  = Classroom::get()->pluck('id')->toArray();
        return [
            'classroom_id' => $this->faker->randomElement($classIds),
            'date' => $this->faker->date(),
        ];
    }
}
