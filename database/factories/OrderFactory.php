<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->numberBetween(0, 200),
            'customer_id' => \App\Models\Customer::inRandomOrder()->value('id'),
            'description' => $this->faker->word(),
            'status' => 'Pending',
        ];
    }
}
