<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AttendanceStates>
 */
class AttendanceStatesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attendance_state_name' => $this->faker->unique()->word(),
            'attendance_state_value' => $this->faker->unique()->word()
        ];
    }

    // Crea un nuevo método 'configure' para definir la secuencia
    public function configure(): static
    {
        return $this->sequence(
            ['attendance_state_name' => 'Presente', 'attendance_state_value' => 1.00],
            ['attendance_state_name' => 'Media falta', 'attendance_state_value' => 0.50],
            ['attendance_state_name' => 'Ausente', 'attendance_state_value' => 0.00],
        );
    }
}
