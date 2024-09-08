<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin',
            'email' => 'yazansh7700@gmail.com',
            'password' => Hash::make('@Admin123'), // Hash the password
        ]);

        // Create a regular user
        // User::create([
        //     'name' => 'Regular',
        //     'email' => 'user@example.com',
        //     'password' => Hash::make('password'), // Hash the password
        // ]);
    }
}
