<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WorkorderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'po' => 'PO'.fake()->randomNumber(7, true),
            'location' => fake()->address(),
            'service_date' => fake()->dateTimeBetween('-5 years', '+3 weeks'),
            'nte' => fake()->randomFloat(2, 0, 9999),
            'store' => fake()->company(),
            'rep' => fake()->name(),
            'rep_number' => fake()->phoneNumber(),
            'sow' => fake()->paragraphs(2, true),
            'created_at' => fake()->dateTimeBetween('-5 years'),
            'status' => fake()->randomElement([
                'Open',
                'Invoice',
                'Pending',
                'Completed',
                'PO Paid',
                'Needs Quote',
                'Cancelled',
            ]),
        ];
    }
}
