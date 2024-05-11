<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryParentFactory extends Factory
{
    protected $model = Category::class;

    public function definition()
    {

        return [
            'name' => $this->faker->word,
            "is_parent" => 1,
            "parent_id" =>  null,
        ];
    }
}

