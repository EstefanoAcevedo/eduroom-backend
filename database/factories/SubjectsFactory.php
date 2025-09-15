<?php

namespace Database\Factories;

use App\Models\Careers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subjects>
 */
class SubjectsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject_name' => $this->faker->unique()->words(2, true),
            'career_id' => Careers::factory(),
        ];
    }
}
