<?php

namespace Database\Factories;

use App\Models\Analytics;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Analytics>
 */
class AnalyticsFactory extends Factory
{
    protected $model = Analytics::class;

    public function definition()
    {
        return [
            'page_views' => $this->faker->numberBetween(1000, 5000),
            'unique_visitors' => $this->faker->numberBetween(500, 2000),
            'sales' => $this->faker->randomFloat(2, 500, 5000),
            'conversion_rate' => $this->faker->randomFloat(2, 0.5, 5),
        ];
    }
}
