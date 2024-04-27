<?php

namespace Database\Factories;

use App\Models\Exam;
use App\Models\Homework;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $homeworkIds  = Homework::get()->pluck('id')->toArray();
        $examIds  = Exam::get()->pluck('id')->toArray();
        return [
            'homework_id' => $this->faker->randomElement($homeworkIds),
            'exam_id' => $this->faker->randomElement($examIds),
            'question' => $this->faker->words(20, true),
            'answer_1' => $this->faker->words(10, true),
            'answer_2' => $this->faker->words(10, true),
            'answer_3' => $this->faker->words(10, true),
            'answer_4' => $this->faker->words(10, true),
            'result' => $this->faker->randomElement([1,2,3,4]),
        ];
    }
}
