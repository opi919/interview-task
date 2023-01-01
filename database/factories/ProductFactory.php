<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'image' => 'product0' . rand(1, 9) . '.png',
            'description' => $this->faker->paragraph,
            'price' => rand(100, 1000),
            'quantity' => rand(1, 10),
        ];
    }
}
