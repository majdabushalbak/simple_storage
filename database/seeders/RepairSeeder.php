<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Repair;

class RepairSeeder extends Seeder
{
    public function run(): void
    {
        Repair::factory()->count(200)->create(); // creates 50 random repairs
    }
}
