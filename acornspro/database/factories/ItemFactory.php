<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sku' => fake()->numerify('FAC-####'),
            'name' => fake()->word(),
            'cost' => fake()->randomFloat(2, max: 5000),
            'price' => fake()->randomFloat(2, max: 5000),
            'type' => fake()->randomElement([
                'fee',
                'labor',
                'part',
                'tool',
            ]),
        ];
    }
}
