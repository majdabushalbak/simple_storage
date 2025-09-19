<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the UserSeeder
        $this->call(UserSeeder::class);
        $this->call(RepairSeeder::class);

        // // Call the ProductSeeder
         $this->call(ProductSeeder::class);
    }
}
