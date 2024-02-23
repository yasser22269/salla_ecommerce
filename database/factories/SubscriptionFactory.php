<?php

namespace Database\Factories;

use App\Models\Subscription;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subscription>
 */
class SubscriptionFactory extends Factory
{
    protected $model = Subscription::class;

    public function definition()
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'plan' => $this->faker->randomElement(['basic', 'standard', 'premium']),
            'billing_cycle' => $this->faker->randomElement(['monthly', 'annual']),
            'subscription_status' => $this->faker->randomElement(['active', 'paused', 'canceled']),
        ];
    }
}
