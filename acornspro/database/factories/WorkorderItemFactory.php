<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\WorkorderItem>
 */
class WorkorderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'item_id' => \App\Models\Item::factory(),
            'qty' => fake()->randomDigit(),
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
