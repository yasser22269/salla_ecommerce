<?php

namespace Database\Factories;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Option>
 */
class OptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'attribute_id' => Attribute::inRandomOrder()->first()->id,
            'product_id' => Product::inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(100,500),
            'name' => $this->faker->word,
        ];
    }
}
