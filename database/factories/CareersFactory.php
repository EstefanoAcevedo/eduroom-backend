<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Careers>
 */
class CareersFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'career_name' => $this->faker->unique()->sentence(3),
            'career_alias' => $this->faker->unique()->word()
        ];
    }

    // Crea un nuevo método 'configure' para definir la secuencia
    public function configure(): static
    {
        return $this->sequence(
            ['career_name' => 'Tecnicatura Superior en Análisis y Desarrollo de Software', 'career_alias' => 'Software'],
            ['career_name' => 'Profesorado de Primaria', 'career_alias' => 'Primaria'],
            ['career_name' => 'Profesorado de Matemática', 'career_alias' => 'Matemática'],
            ['career_name' => 'Tecnicatura Superior en Enfermería', 'career_alias' => 'Enfermería'],
        );
    }
}
