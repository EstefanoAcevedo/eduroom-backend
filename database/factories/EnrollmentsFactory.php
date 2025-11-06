<?php

namespace Database\Factories;

use App\Models\Commissions;
use App\Models\Subjects;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Enrollments>
 */
class EnrollmentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'enrollment_academic_year' => $this->faker->year(),
            'enrollment_status' => $this->faker->boolean(),
            'user_id' => User::factory(),
            'subject_id' => Subjects::factory(),
            'commission_id' => Commissions::factory()
        ];
    }

    // Crea un nuevo método 'configure' para definir la secuencia
    public function configure(): static
    {
        return $this->sequence(
            /* Inscripciones aprobadas en comisión 1 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 1, 'commission_id' => 1],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 2, 'commission_id' => 1],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 3, 'commission_id' => 1],
            /* Inscripciones pendientes de aprobación en comisión 1 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 4, 'commission_id' => 1],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 5, 'commission_id' => 1],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 6, 'commission_id' => 1],

            /* Inscripciones aprobadas en comisión 2 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 7, 'commission_id' => 2],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 8, 'commission_id' => 2],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 9, 'commission_id' => 2],
            /* Inscripciones pendientes de aprobación en comisión 2 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 10, 'commission_id' => 2],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 11, 'commission_id' => 2],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 12, 'commission_id' => 2],

            /* Inscripciones aprobadas en comisión 3 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 13, 'commission_id' => 3],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 14, 'commission_id' => 3],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'approved', 'user_id' => 3, 'subject_id' => 15, 'commission_id' => 3],
            /* Inscripciones pendientes de aprobación en comisión 3 */
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 16, 'commission_id' => 3],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 17, 'commission_id' => 3],
            ['enrollment_academic_year' => 2025, 'enrollment_status' => 'pending', 'user_id' => 3, 'subject_id' => 18, 'commission_id' => 3],
        );
    }
}
