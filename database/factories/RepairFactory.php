<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    public function definition(): array
    {
        return [
            'car_id' => $this->faker->numberBetween(1000, 1010), // random car IDs
            'note' => $this->faker->sentence(5),
            'status' => $this->faker->randomElement(['pending', 'in-progress', 'completed']),
            'cost' => $this->faker->randomFloat(2, 50, 500),
        ];
    }
}
