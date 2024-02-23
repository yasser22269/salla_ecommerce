<?php

namespace Database\Factories;

use App\Models\Discount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discount>
 */
class DiscountFactory extends Factory
{
    protected $model = Discount::class;

    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'discount_percentage' => $this->faker->randomFloat(2, 5, 30),
            'start_date' => $this->faker->dateTimeBetween('now', '+1 month'),
            'end_date' => $this->faker->dateTimeBetween('+2 months', '+6 months'),
        ];
    }
}
