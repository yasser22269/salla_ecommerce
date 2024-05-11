<?php

namespace Database\Factories;

use App\Models\Coupon;
use Carbon\Carbon;
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
            'type' => $this->faker->randomElement(['fixed_amount', 'percentage', 'free_shipping']),
            'discount' => $this->faker->randomFloat(2, 5, 30),
            'valid_from' => Carbon::now()->addDays(rand(1, 30)),
            'valid_to' => Carbon::now()->addDays(rand(31, 365))
        ];
    }
}
