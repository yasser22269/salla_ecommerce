<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    protected $model = Coupon::class;

    public function definition()
    {
        return [
            'code' => $this->faker->unique()->word,
            'discount_percentage' => $this->faker->randomFloat(2, 5, 30),
            'validity_period' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }
}
