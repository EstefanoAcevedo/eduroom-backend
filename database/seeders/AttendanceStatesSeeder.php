<?php

namespace Database\Seeders;

use App\Models\AttendanceStates;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendanceStatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AttendanceStates::factory()->count(3)->create();
    }
}
