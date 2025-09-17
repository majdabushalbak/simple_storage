<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
   public function definition(): array
{
    return [
        'car_id' => strtoupper($this->faker->bothify('CAR-###??')), // e.g. CAR-123AB
        'name'   => $this->faker->name(),
        'phone'  => $this->faker->phoneNumber(),
        'type'   => $this->faker->randomElement(['Sedan', 'SUV', 'Truck', 'Van']),
    ];
}

}
