<?php

namespace Database\Factories;

use App\Models\Shipping;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Shipping>
 */
class ShippingFactory extends Factory
{
    protected $model = Shipping::class;

    public function definition()
    {
        return [
            'order_id' => \App\Models\Order::factory(),
            'tracking_number' => $this->faker->unique()->numerify('TN###'),
            'shipping_status' => $this->faker->randomElement(['shipped', 'out_for_delivery', 'delivered']),
        ];
    }
}
