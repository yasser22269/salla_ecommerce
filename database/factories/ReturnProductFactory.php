<?php

namespace Database\Factories;

use App\Models\ReturnProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ReturnProduct>
 */
class ReturnProductFactory extends Factory
{
    protected $model = ReturnProduct::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'reason' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
