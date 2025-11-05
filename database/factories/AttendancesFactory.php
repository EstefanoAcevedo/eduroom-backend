<?php

namespace Database\Factories;

use App\Models\AttendanceStates;
use App\Models\Enrollments;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendances>
 */
class AttendancesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attendance_date' => $this->faker->date(),
            'attendance_is_justified' => $this->faker->boolean(),
            'attendance_state_id' => AttendanceStates::inRandomOrder()->first()->attendance_state_id,
            'enrollment_id' => Enrollments::inRandomOrder()->first()->enrollment_id,
        ];
    }

    // Crea un nuevo método 'configure' para definir la secuencia
    public function configure(): static
    {
        return $this->sequence(
            /* Asistencias del enrollment 1 */
            ['attendance_date' => '2025-10-01', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-02', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-03', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-04', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-05', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-06', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-07', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-08', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-09', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-10', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-11', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-12', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-13', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-14', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-15', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-16', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-17', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 1],
            ['attendance_date' => '2025-10-18', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 1],

            /* Asistencias del enrollment 2 */
            ['attendance_date' => '2025-10-01', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-02', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-03', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-04', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-05', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-06', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-07', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-08', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-09', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-10', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-11', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-12', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-13', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-14', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-15', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-16', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-17', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 2],
            ['attendance_date' => '2025-10-18', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 2],

            /* Asistencias del enrollment 3 */
            ['attendance_date' => '2025-10-01', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-02', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-03', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-04', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-05', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-06', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-07', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-08', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-09', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-10', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-11', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-12', 'attendance_is_justified' => false, 'attendance_state_id' => 2, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-13', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-14', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-15', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-16', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-17', 'attendance_is_justified' => false, 'attendance_state_id' => 3, 'enrollment_id' => 3],
            ['attendance_date' => '2025-10-18', 'attendance_is_justified' => false, 'attendance_state_id' => 1, 'enrollment_id' => 3],
        );
    }
}
