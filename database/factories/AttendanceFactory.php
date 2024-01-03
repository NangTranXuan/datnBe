<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttendanceFactory extends Factory
{

    public function definition()
    {
        $classIds  = Classroom::get()->pluck('id')->toArray();
        $userIds  = User::where('role', 3)->get()->pluck('id')->toArray();

        return [
            'classroom_id' => $this->faker->randomElement($classIds),
            'student_id' => $this->faker->randomElement($userIds),
            'date' => $this->faker->date(),
            'status' => $this->faker->randomElement(['1', '0']),
        ];
    }
}
