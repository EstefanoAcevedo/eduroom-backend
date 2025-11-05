<?php

namespace Database\Seeders;

use App\Models\Enrollments;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EnrollmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Enrollments::factory()->count(18)->create();
    }
}
