<?php

namespace Database\Factories;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'order_id' => \App\Models\Order::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 100),
            'payment_status' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
