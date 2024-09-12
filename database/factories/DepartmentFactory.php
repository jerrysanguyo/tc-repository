<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name'          =>  $this->faker->name(),
            'remarks'       =>  $this->faker->sentence(),
            'created_by'    =>  User::factory(),
            'updated_by'    =>  User::factory(),
        ];
    }
}
