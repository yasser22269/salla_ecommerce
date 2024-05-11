<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {
       $is_parent = $this->faker->numberBetween(0,1);
        return [
            'name' => $this->faker->word,
            "is_parent" => $this->faker->numberBetween(0,1),
            "parent_id" => ($is_parent ? null : \App\Models\Category::factory()),
        ];
    }
}


