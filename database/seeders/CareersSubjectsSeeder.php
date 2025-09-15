<?php

namespace Database\Seeders;

use App\Models\Careers;
use App\Models\Subjects;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CareersSubjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crea 10 carreras y, por cada una, 20 unidades curriculares
        Careers::factory(4)
            ->has(Subjects::factory()->count(10))
            ->create();
    }
}
