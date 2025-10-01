<?php

namespace Database\Seeders;

use App\Models\Commissions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Commissions::factory()->count(3)->create();
    }
}
