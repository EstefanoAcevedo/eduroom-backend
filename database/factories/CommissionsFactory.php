<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commissions>
 */
class CommissionsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'commission_name' => $this->faker->unique()->words(2, true),
        ];
    }

    // Crea un nuevo método 'configure' para definir la secuencia
    public function configure(): static
    {
        return $this->sequence(
            ['commission_name' => 'Primera División'],
            ['commission_name' => 'Segunda División'],
            ['commission_name' => 'Tercera División'],
        );
    }
}
